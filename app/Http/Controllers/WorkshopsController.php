<?php

namespace App\Http\Controllers;

use App\Customer;
use JWTAuth;
use Session;
use Hash, DB, Config, Mail, View;
use Illuminate\Support\Facades\Redirect;
use App\Workshop;
use App\WorkshopImages;
use App\Service;
use App\Booking;
use App\Car;
use App\WorkshopAddress;
use App\WorkshopLedger;
use App\WorkshopBalance;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class WorkshopsController extends Controller
{
    /**
     * Fetching Guard.
     *
     * @return Auth::guard()
     */
    protected function guard()
    {
        return Auth::guard('workshop');
    }

    /**
     * Constructor.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     *
     * @return void
     */
    public function __construct()
    {
        $this->auth = app('auth')->guard('workshop');
    }

    /**
     * Display a listing of the workshop.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // get all the workshops
        $workshops = Workshop::orderBy('created_at', 'desc')->get();
        // load the view and pass the nerds
        return View::make('workshop.index')->with('workshops', $workshops);
    }

    /**
     * Show the form for creating a new workshop.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();        
        return View::make('workshop.create', ['services' => $services]);
    }

    /**
     * Store a newly created workshop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
            'email'                          => 'required|email|unique:workshops',
            'password'                       => 'required|confirmed|min:8',
            'password_confirmation'          => 'required',
            'cnic'                           => 'required|digits:13',
            'mobile'                         => 'required|digits:11',
            'landline'                       => 'digits:11|nullable',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'type'                           => 'required|in:Authorized,Unauthorized',
            'team_slots'                     => 'integer',
            'profile_pic'                    => 'image|mimes:jpg,png,jpeg',
            'cnic_image'                     => 'image|mimes:jpg,png,jpeg',
            'images.*'                       => 'image|mimes:jpg,png,jpeg',

            'shop'                           => 'required|numeric',
            'building'                       => 'string|nullable',
            'block'                          => 'string|nullable',
            'street'                         => 'nullable|string',
            'town'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'city'                           => 'required|regex:/^[\pL\s\-]+$/u',

            'services.*'                     => 'required|integer:unique',
            'service-rates.*'                => 'required',
            'service-times.*'                => 'required',
        ];

        $input = $request->only('name', 'owner_name', 'email', 'password', 'password_confirmation', 'cnic', 'mobile', 'landline','open_time', 'close_time', 'type', 'shop', 'building', 'block', 'street', 'town', 'city', 'services');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return Redirect::back()
                ->withErrors($validator)
                ->withInput(Input::except('password','password_confirmation'));
        }

        //Insert Workshop data from request
        $workshop = Workshop::create([
            'name'          => $request->name,
            'owner_name'    => $request->owner_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'cnic'          => $request->cnic,
            'mobile'        => $request->mobile,
            'type'          => $request->type,
            'slots'         => $request->team_slot,
            'open_time'     => $request->open_time,
            'close_time'    => $request->close_time,
            'is_approved'   => true,
        ]);

        //Insert Address data from request
        $address = WorkshopAddress::create([
            'shop'          => $request->shop,
            'building'      => $request->building,
            'street'        => $request->street,
            'block'         => $request->block,
            'town'          => $request->town,
            'city'          => $request->city,
            'workshop_id'   => $workshop->id,
            'coordinates'   => NULL
        ]);

        //Insert Services data from request        
        foreach($request->services as $service)
        {
            $workshop->services()->attach($service, ['service_rate' => Input::get('service-rates')[$service] , 'service_time' => Input::get('service-times')[$service] ]);
        }

        $balance = new WorkshopBalance([ 'balance' => 0 ]);
        $workshop->balance()->save($balance);

        if ($request->hasFile('profile_pic'))
        {
            $profile_pic =  Storage::disk('s3')->putFile('workshops/'. $workshop->id .'/logo', new File($request->profile_pic), 'public');
           
            $profile_pic = config('app.s3_bucket_url').$profile_pic;
            $workshop->profile_pic   = $profile_pic;
            $workshop->save();            
        }
        else
        {
            $profile_pic         =  url('img/thumbnail.png');
            $workshop->profile_pic   = $profile_pic;
            $workshop->save();
        }

        if ($request->hasFile('cnic_image')) 
        {
            $cnic_image =  Storage::disk('s3')->putFile('workshops/'. $workshop->id .'/cnic', new File($request->cnic_image), 'public');
            $cnic_image =  config('app.s3_bucket_url').$cnic_image;
            $workshop->cnic_image   = $cnic_image;
            $workshop->save();
        }
        else
        { 
            $cnic_image         =  url('img/thumbnail.png');
            $workshop->cnic_image   = $cnic_image;
            $workshop->save();
        }

        if ($request->hasFile('images'))
        {
            foreach($request->file('images') as $file)
            {
                $images = new WorkshopImages;                
                $image =  Storage::disk('s3')->putFile('workshops/'. $workshop->id .'/images', new File($file), 'public');
                $image =  config('app.s3_bucket_url').$image;
                $images->url = $image;
                $images->workshop()->associate($workshop);
                $images->save();
            }
        }       

        $subject = "Please verify your email address.";
        $verification_code = str_random(30); //Generate verification code         
        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        Mail::send('workshop.emails.verify', ['name' => $request->name, 'verification_code' => $verification_code],
            function($mail) use ($request, $subject){
                $mail->from(config('app.mail_username'), config('app.name'));
                $mail->to($request->email, $request->name);
                $mail->subject($subject);
            });

        return Redirect::to('admin/workshops')->with('message', 'Success! Workshop Created.');       
    }

    /**
     * Display the specified workshop.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        // get the workshop
        $workshop = Workshop::find($id);        
        // show the view and pass the workshop to it
        return View::make('workshop.show', ['workshop' => $workshop]);
    }

    /**
     * Show the form for editing the specified workshop.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {           
        // get the workshop
        $workshop = Workshop::find($id);
        // show the edit form and pass the workshop        
        return View::make('workshop.edit')->with('workshop', $workshop)->with('images', $workshop->images);
    }

    /**
     * Update the specified workshop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {                     
        $rules = [
            'name'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
            'cnic'                           => 'required|digits:13',
            'mobile'                         => 'required|digits:11',
            'landline'                       => 'digits:11|nullable',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'type'                           => 'required|in:Authorized,Unauthorized',
            'team_slots'                     => 'integer',
            'profile_pic'                    => 'image|mimes:jpg,png,jpeg',
            'cnic_image'                     => 'image|mimes:jpg,png,jpeg',
            'images.*'                       => 'image|mimes:jpg,png,jpeg',

            'shop'                           => 'required|numeric',
            'building'                       => 'string|nullable',
            'block'                          => 'string|nullable',
            'street'                         => 'nullable|string',
            'town'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'city'                           => 'required|regex:/^[\pL\s\-]+$/u',
        ];

        $input = $request->only('name', 'owner_name', 'cnic', 'mobile', 'landline','open_time', 'close_time', 'type', 'shop', 'building', 'block', 'street', 'town', 'city');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return Redirect::back()
                ->withErrors($validator);
        }

         // Update workshop
        $workshop = Workshop::find($id);        
        if ($request->hasFile('profile_pic')) 
        {            
            $profile_pic =  Storage::disk('s3')->putFile('workshops/'. $workshop->id .'/logo', new File($request->profile_pic), 'public');
            $profile_pic =  config('app.s3_bucket_url').$profile_pic;
        }
        else
        {
            $profile_pic         =  $workshop->profile_pic;
        }


        if ($request->hasFile('cnic_image')) 
        {
            $cnic_image =  Storage::disk('s3')->putFile('workshops/'. $workshop->id .'/cnic', new File($request->cnic_image), 'public');
            $cnic_image =  config('app.s3_bucket_url').$cnic_image;
        }
        else
        {
            $cnic_image         =  $workshop->cnic_image;
        }

        $workshop->name             = Input::get('name');        
        $workshop->owner_name       = Input::get('owner_name');  
        $workshop->cnic             = Input::get('cnic');
        $workshop->mobile           = Input::get('mobile');
        $workshop->landline         = Input::get('landline');
        $workshop->type             = Input::get('type');
        $workshop->slots            = Input::get('team_slot');
        $workshop->profile_pic      = $profile_pic;
        $workshop->cnic_image       = $cnic_image;
        $workshop->open_time        = Input::get('open_time');
        $workshop->close_time       = Input::get('close_time');        
        $workshop->save();   

        // Update Workshop Address
        $address = WorkshopAddress::find($workshop->address->id);        
        $address->shop              = Input::get('shop');
        $address->building          = Input::get('building');
        $address->street            = Input::get('street');
        $address->block             = Input::get('block');
        $address->town              = Input::get('town');
        $address->city              = Input::get('city');
        $address->update();        

        if($request->hasFile('images'))
        {
            if(!is_null($workshop->images)){
                $images = $workshop->images;
                foreach($images as $image){
                    $image = WorkshopImages::find($image->id);                                    
                    $image->delete();                    
                }
            }            
            foreach($request->file('images') as $file)
            {
                $images = new WorkshopImages;
                $image =  Storage::disk('s3')->putFile('workshops/'. $workshop->id .'/images', new File($file), 'public');
                $image =  config('app.s3_bucket_url').$image;
                $images->url            = $image;
                $images->workshop_id    = $workshop->id;
                $images->save();
            }
        }
        
        Session::flash('message', 'Success! Workshop Updated');
        return Redirect::to('admin/workshops');
    }

    /**
     * Remove the specified workshop from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $workshop = Workshop::find($id);
        $workshop->delete();

        // redirect
        Session::flash('message', 'Success! Workshop Blocked');
        return Redirect::to('admin/workshops');      
    }

    public function inactive_workshops()
    {
        $workshops = Workshop::onlyTrashed()->get();  
        return View::make('workshop.inactive')
        ->with('workshops', $workshops); 
    }

    public function restore($id) 
    {
        $workshop = Workshop::withTrashed()->find($id)->restore();
        Session::flash('message', 'Success! Workshop Restored.');
        return redirect ('admin/workshops');
    }
    
    /**
     * API Register for new workshop.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Post(
     *   path="/api/workshop/register",
     *   summary="Register Workshop",
     *   operationId="register",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Name of Workshop",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="owner_name",
     *     in="formData",
     *     description="Owner Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Workshop Email Address",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Workshop Login Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password_confirmation",
     *     in="formData",
     *     description="Workshop Confirm Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cnic",
     *     in="formData",
     *     description="Workshop CNIC card Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="mobile",
     *     in="formData",
     *     description="Workshop Mobile Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="landline",
     *     in="formData",
     *     description="Workshop Landline Number",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="team_slots",
     *     in="formData",
     *     description="Team Slots",
     *     required=false,
     *     type="integer",
     *     enum={0,1,2,3,4,5,6,7,8,9}
     *   ),
     *   @SWG\Parameter(
     *     name="type",
     *     in="formData",
     *     description="Workshop Type",
     *     required=true,
     *     type="string",
     *     enum={"Authorized", "Unauthorized"}
     *   ),
     *   @SWG\Parameter(
     *     name="open_time",
     *     in="formData",
     *     description="Workshop Opening Time",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="close_time",
     *     in="formData",
     *     description="Workshop Closing Time",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="services",
     *     in="formData",
     *     description="Workshop Services",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(Request $request)
    {
        $rules = [
            'name'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
            'email'                          => 'required|email|unique:workshops',
            'password'                       => 'required|confirmed|min:8',
            'password_confirmation'          => 'required',
            'team_slots'                     => 'integer',
            'cnic'                           => 'required|digits:13',
            'mobile'                         => 'required|digits:11',
            'landline'                       => 'digits_between:0,11',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'type'                           => 'required|in:Authorized,Unauthorized'            
        ];        

        $input = $request->only('name', 'owner_name', 'email', 'password', 'password_confirmation', 'cnic', 'mobile', 'landline','open_time', 'close_time', 'type', 'team_slots');        
        
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages(),
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }      
        //Insert Workshop data from request 
        $workshop = Workshop::create([
                                'name' => $request->name, 
                                'owner_name' => $request->owner_name ,
                                'email' => $request->email, 
                                'password' => Hash::make($request->password), 
                                'cnic' => $request->cnic, 
                                'mobile' => $request->mobile, 
                                'landline' => $request->landline,
                                'type' => $request->type,                                 
                                'slots' => $request->team_slots,                                 
                                'open_time' => $request->open_time, 
                                'close_time' => $request->close_time, 
                                'is_approved' => 0
                            ]);

        //By Default Inserting Workshop Balance 2000
        $workshop_balance = new WorkshopBalance;        
        $workshop_balance->balance              = 2000;
        $workshop_balance->workshop_id          = $workshop->id;
        $workshop_balance->save();

         //Insert Services data from request        
        $services = $request->services;
        if(count($services) > 0){
            foreach($services as $service){
                $workshop->services()->attach($service->service_id,['service_rate' => $service->service_rate, 'service_time' => $service->service_time]);
            }
        }

        $name = $request->name;        
        $email = $request->email;        
        $subject = "Please verify your email address.";
        $verification_code = str_random(30); //Generate verification code

        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        Mail::send('workshop.emails.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(config('app.mail_username'), config('app.name'));
                $mail->to($email, $name);
                $mail->subject($subject);
            });

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $token = JWTAuth::attempt($credentials);

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Thanks for signing up! Please check your email to complete your registration.',
            'body' => ['workshop'=>'', 'token'=>$token]
        ],Response::HTTP_OK);
    }

    /**
     * API Login for workshop, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    
    /**
     * @SWG\Post(
     *   path="/api/workshop/login",
     *   summary="Workshop Login",
     *   operationId="login",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Email of Workshop",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Workshop Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $rules  = [
            'email' => 'exists:workshops'
        ];

        $validation = Validator::make($request->only('email'), $rules);

        if($validation->fails()){
            $request->offsetUnset('password');

            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validation->messages()->first(),
                'body' => $request->all()
            ], Response::HTTP_OK);
        }

        try {
            Config::set('auth.providers.users.model', \App\Workshop::class);
            if (! $token = JWTAuth::attempt($credentials)) {
                $request->offsetUnset('password');

                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Failed to login with provided details. Try again!',
                    'body' => $request->all()
                ],Response::HTTP_OK);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $request->offsetUnset('password');

            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'Failed to login, please try again.',
                'body' => $request->all()
            ],Response::HTTP_OK);
        }
        $workshop = Auth::user();

        $request->offsetUnset('password');

        if( ( ! $workshop->is_approved ) ){

            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Workshop is pending approval yet.',
                    'body' => [ 'token' => $token ]
                ],Response::HTTP_OK);
        }
        // all good so return the token and workshop collection

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'success',
            'body' => [ 'token' => $token , 'workshop' => $workshop ],
        ],Response::HTTP_OK);
    }

    /**
     * Log out
     * Invalidate the token, so workshop cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    /**
     * @SWG\Post(
     *   path="/api/workshop/logout",
     *   summary="Workshop Logout",
     *   operationId="logout",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Auth Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function logout() {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'success',
                'body' => null
            ],Response::HTTP_OK);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'Failed to logout, please try again.',
                'body' => null
            ],Response::HTTP_OK);
        }
    }

    /**
     * API Recover Password for new workshop.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Post(
     *   path="/api/workshop/recover",
     *   summary="Recover Workshop Password",
     *   operationId="recover",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Workshop Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function recover(Request $request)
    {
        $rules  = [
            'email' => 'exists:workshops'
        ];

        $validation = Validator::make($request->only('email'), $rules);

        if($validation->fails()){

            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validation->messages()->first(),
                'body' => null
            ], Response::HTTP_OK);
        }

        try {
            Config::set('auth.providers.users.model', \App\Workshop::class);

            $this->broker()->sendResetLink(
                $request->only('email')
            );            
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();

            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $error_message,
                'body' => null
            ],Response::HTTP_OK);
        }

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'A reset email has been sent! Please check your email.',
            'body' => ''
        ],Response::HTTP_OK);
    }

    protected function broker()
    {
        return Password::broker('workshops');
    }


    /**
     * API Verify Email
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmail($verification_code)
    {
        $check = DB::table('workshop_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
            $workshop = Workshop::find($check->ws_id);
            if( $workshop->is_verified ){

                return View::make('workshop.thankyou')->with('message', 'Account already verified.');
            }

            $workshop->update(['is_verified' => 1]);
            DB::table('workshop_verifications')->where('token',$verification_code)->delete();

            return View::make('workshop.thankyou')->with('message', 'Thank You For Verifying Your Email.');
        }

        return View::make('workshop.thankyou')->with('message', 'Verification code is invalid.');
    }

    /**
     * API Password Reset for Workshop, on success return Success Message
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Post(
     *   path="/api/workshop/password-reset",
     *   summary="Workshop Password Reset",
     *   operationId="password Reset",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="prev_password",
     *     in="formData",
     *     description="Workshop's Previous Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Workshop's New Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password_confirmation",
     *     in="formData",
     *     description="Workshop's Confirm Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function passwordReset(Request $request)
    {
        $rules = [
            'prev_password'  => 'required',
            'password'  => 'required|confirmed|min:6',
        ];

        $input = $request->only('prev_password','password', 'password_confirmation');
        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            $request->offsetUnset('prev_password');
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ],Response::HTTP_OK);
        }
        else{
            $workshop   = JWTAuth::authenticate();

            try {                
                Config::set('auth.providers.users.model', \App\Workshop::class);
                if (!Hash::check($request->prev_password, $workshop->password)) {
                    $request->offsetUnset('prev_password');
                    $request->offsetUnset('password');
                    $request->offsetUnset('password_confirmation');
                    return response()->json([
                        'http-status' => Response::HTTP_OK,
                        'status' => false,
                        'message' => 'Your provided password didn\'t match.',
                        'body' => null
                    ],Response::HTTP_OK);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                $request->offsetUnset('prev_password');
                $request->offsetUnset('password');
                $request->offsetUnset('password_confirmation');
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Failed to Reset Password, please try again.',
                    'body' => null
                ],Response::HTTP_OK);
            }
            // all good so Reset Customer's Password
            $workshop->password = Hash::make($request->password);
            $workshop->save();

            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'success',
                'body' => [ 'workshop' => $workshop ],
            ],Response::HTTP_OK);
        }
    }

    /**
     *  Approve Workshop
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveWorkshop($id){
        //Approve Workshop
        $workshop = Workshop::find($id);
        $workshop->is_approved       = 1;
        $workshop->save();
        $subject = "Conragulations! Your workshop has been approved by Admin.";
           Mail::send('workshop.emails.confirmationEmail', ['name' => $workshop->name],
            function($mail) use ($workshop, $subject){
                $mail->from(config('app.mail_username'), config('app.name'));
                $mail->to($workshop->email, $workshop->name);
                $mail->subject($subject);
            });        
        return Redirect::to('admin/workshops');
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/profile",
     *   summary="Get Workshop Details",
     *   operationId="fetch",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),    
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
    */     
    public function getWorkshop(){
        $workshop = JWTAuth::authenticate();

        return response([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Workshop Details!',
            'body' => [ 'workshop' => $workshop->load(['address', 'services', 'balance', 'transactions', 'bookings']) ]
        ],Response::HTTP_OK);
    }
    /**
     * @SWG\Put(
     *   path="/api/workshop/profile/",
     *   summary="Update Workshop Details",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Name of Workshop",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="owner_name",
     *     in="formData",
     *     description="Owner Name",
     *     required=true,
     *     type="string"
     *   ),     
     *   @SWG\Parameter(
     *     name="cnic",
     *     in="formData",
     *     description="CNIC Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="mobile",
     *     in="formData",
     *     description="Workshop Mobile Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="landline",
     *     in="formData",
     *     description="Workshop Landline Number",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="type",
     *     in="formData",
     *     description="Workshop Type",
     *     required=true,
     *     type="string",
     *     enum={"Authorized", "Unauthorized"}
     *   ),
     *   @SWG\Parameter(
     *     name="team_slots",
     *     in="formData",
     *     description="Team Slots",
     *     required=false,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="open_time",
     *     in="formData",
     *     description="Workshop Opening Time",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="close_time",
     *     in="formData",
     *     description="Workshop Closing Time",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="profile_pic",
     *     in="formData",
     *     description="Workshop Profile Image",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cnic_image",
     *     in="formData",
     *     description="Workshop CNIC Image",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="_method",
     *     in="formData",
     *     description="Always give PUT",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    /**
     * API Register update data of existing customer.
     *
     * @param Request $request
     * @param $id
     * @param $address_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileUpdate(Request $request)
    {                
        $rules = [                        
            'name'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
            'cnic'                           => 'required|digits:13',
            'mobile'                         => 'required|digits:11',
            'landline'                       => 'digits:11|nullable',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'type'                           => 'required|in:Authorized,Unauthorized',
            'team_slots'                     => 'integer',
            'profile_pic'                    => 'image|mimes:jpg,png,jpeg',
            'cnic_image'                     => 'image|mimes:jpg,png,jpeg',
            'images.*'                       => 'image|mimes:jpg,png,jpeg',

            'shop'                           => 'required|numeric',
            'building'                       => 'string|nullable',
            'block'                          => 'string|nullable',
            'street'                         => 'nullable|string',
            'town'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'city'                           => 'required|regex:/^[\pL\s\-]+$/u',
        ];          

        $input = $request->only('name', 'owner_name', 'cnic', 'mobile', 'landline','open_time', 'close_time', 'type');

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {            
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages()->first(),
                    'body' => null
                ],Response::HTTP_OK);
        }
        $workshop = JWTAuth::authenticate();
        $workshop->name             = $request->name;        
        $workshop->owner_name       = $request->owner_name;  
        $workshop->cnic             = $request->cnic;
        $workshop->slots            = $request->team_slots;
        $workshop->mobile           = $request->mobile;
        $workshop->landline         = $request->landline;
        $workshop->open_time        = $request->open_time;
        $workshop->close_time       = $request->close_time;        
        $workshop->type             = $request->type;        
        $workshop->save();      
        
        return response([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Details Updated!',
            'body' => null
        ],Response::HTTP_OK);
    }

    /**
     *  Edit Workshop Service View
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editWorkshopService($id){
        $services = Service::all();
        $workshop_service = DB::table('workshop_service')->where('id', $id)->first();
        return View::make('workshop.services.edit')->with('workshop_service', $workshop_service)->with('services',$services);            

    }

    /**
     *  Update Workshop Service
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateWorkshopService(Request $request){
        $rules = [            
            'service_rate'    => 'required|numeric',            
            'service_time'    => 'required'                        
            ];        
        $input = $request->only('service_rate', 'service_time' );
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $workshop_service_id = $request->workshop_service_id ;            
            return Redirect::to('admin/edit-workshop-service/'.$workshop_service_id)
                ->withErrors($validator);
        }                 
        $workshop = Workshop::find($request->workshop_id);
        $workshop->services()->updateExistingPivot($request->service_id, ['service_rate' => $request->service_rate, 'service_time' => $request->service_time ]);
        return Redirect::to('admin/workshops/'.$request->workshop_id);               

    }

    /**
     *  Add Workshop Service
     *
     * @param $workshop
     * @return \Illuminate\Http\JsonResponse
     */
    public function addWorkshopService($workshop){
        $workshop = Workshop::find($workshop);
        $services = Service::all();        
        return View::make('workshop.services.add')->with('workshop', $workshop)->with('services',$services);            
    }
    
    /**
     *  Store Workshop Service
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeWorkshopService(Request $request){
        $rules = [
            'service_rate'    => 'required',            
            'service_time'    => 'required'                        
            ];
        $input = $request->only('service_rate', 'service_time' );

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {            
            return Redirect::to('admin/add-workshop-service/'.$request->workshop_id)
                ->withErrors($validator)
                ->withInput();
        }        
        $workshop = Workshop::find($request->workshop_id);
        $service = $request->service_id; 
        $rate = $request->service_rate;
        $time = $request->service_time;       
        
        $workshop->services()->attach($service, ['service_rate' => $rate , 'service_time' => $time]);
        
        return Redirect::to('admin/add-workshop-service/'.$workshop->id);               
    }

    /**
     *  Delete Workshop Service
     *
     * @param $workshop_id
     * @param $service_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteWorkshopService($workshop_id, $service_id){
        $workshop = Workshop::find($workshop_id);
        $workshop->services()->detach($service_id);        
        // show the view and pass the workshop to it
        return Redirect::to('admin/workshops/'.$workshop->id);               
    }

    /**
     *  Show History Workshop 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_history()
    {
        return View::make('workshop.history');
    }

    /**
     *  Show Customers Workshop 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_customers()
    {
        $workshop = Auth::guard('workshop')->user();
        $bookings = Booking::where('workshop_id', $workshop->id)->get()->load(['customer']);
        return View::make('workshop.customers', ['bookings' => $bookings]);
    }

    /**
     *  Show Requests 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_requests()
    {
        return View::make('workshop.requests');
    }


     /**
     * Searching a workshop.
     *
     */
     /**
     * @SWG\Post(
     *   path="/api/customer/search-workshop",
     *   summary="Search Workshop",
     *   operationId="searchByWorkshop",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Workshop Name",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="type",
     *     in="formData",
     *     description="Workshop Type",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="service_name",
     *     in="formData",
     *     description="Service Name",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_block",
     *     in="formData",
     *     description="Workshop Address Block",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_town",
     *     in="formData",
     *     description="Workshop Address Town",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_city",
     *     in="formData",
     *     description="Workshop Address City",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function searchWorkshop(Request $request)
    {   
        $workshops      = Workshop::with('address');
        if ($request->has('name')) {
            $workshops  = $workshops->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->has('type')) {
            $workshops  = $workshops->where('type', $request->type);
        }
        if ($request->has('address_block')) {
            $workshops  = Workshop::get_workshop_by_address($workshops, 'block', $request->address_block);
        }
        if ($request->has('address_town')) {
           $workshops  = Workshop::get_workshop_by_address($workshops, 'town', $request->address_town);
        }
        if ($request->has('address_city')) {
           $workshops  = Workshop::get_workshop_by_address($workshops, 'city', $request->address_city);
        }
        if ($request->has('service_name')) {
            $workshops = Workshop::get_workshop_by_service($workshops, $request->service_name);
        }
        $workshops          = $workshops->get();
        foreach ($workshops as $key =>$workshop) {
            $workshops[$key]->est_rates = $workshop->sumOfServiceRates($workshop);
        }
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => '',
            'body' => $workshops,
        ],Response::HTTP_OK);
    }

    /**
     * @SWG\Post(
     *   path="/api/workshop/service",
     *   summary="Add New Workshop Services",
     *   operationId="insert",
     *   produces={"application/json"},
     *   tags={"Services"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="service_id",
     *     in="formData",
     *     description="service id",
     *     required=true,
     *     type="integer"
     *   ), 
     *   @SWG\Parameter(
     *     name="service_rate",
     *     in="formData",
     *     description="service rate",
     *     required=true,
     *     type="number"          
     *   ), 
     *   @SWG\Parameter(
     *     name="service_time",
     *     in="formData",
     *     description="service time",
     *     required=true,
     *     type="string"     
     *   ), 
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )    
     *  Store Workshop Service
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertService(Request $request){
        $workshop   = JWTAuth::authenticate();
        $services   = Service::all();
        $services   = implode(',',$services->pluck('id')->toArray());

        $rules = [
            'service_id'      => 'required|in:'.$services.'|unique:workshop_service,service_id,NULL,id,workshop_id,'.$workshop->id,
            'service_rate'    => 'required|numeric',            
            'service_time'    => 'required|numeric'                        
            ];
        $input = $request->only('service_id', 'service_rate', 'service_time' );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ],Response::HTTP_OK);
        }

        $service = $request->service_id;
        $rate = $request->service_rate;
        $time = $request->service_time;       
        
        $workshop->services()->attach($service, ['service_rate' => $rate , 'service_time' => $time]);
        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Workshop Service Added!!',
            'body'          => ''
        ],Response::HTTP_OK);                  
    }
     /**
     * @SWG\Patch(
     *   path="/api/workshop/service",
     *   summary="Edit Workshop Services",
     *   operationId="insert",
     *   produces={"application/json"},
     *   tags={"Services"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="service_id",
     *     in="formData",
     *     description="service id",
     *     required=true,
     *     type="integer"
     *   ), 
     *   @SWG\Parameter(
     *     name="service_rate",
     *     in="formData",
     *     description="service rate",
     *     required=true,
     *     type="number"          
     *   ), 
     *   @SWG\Parameter(
     *     name="service_time",
     *     in="formData",
     *     description="service time",
     *     required=true,
     *     type="number"     
     *   ), 
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * ) 
     *  Update Workshop Service
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateService(Request $request){
        $workshop   = JWTAuth::authenticate();

        $rules = [
            'service_id'      => ['required', Rule::exists('workshop_service')->where(function($query) use ($workshop){
                $query->where('workshop_id', $workshop->id);
            })],
            'service_rate'    => 'required|numeric',
            'service_time'    => 'required|numeric',
            ];        
        $input = $request->only('service_id','service_rate', 'service_time' );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ],Response::HTTP_OK);
        }
        
        $workshop->services()->updateExistingPivot($request->service_id, ['service_rate' => $request->service_rate, 'service_time' => $request->service_time ]);

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Workshop Service Updated!!',
            'body'          => ''
        ],Response::HTTP_OK);             

    }
    /**
     * @SWG\Delete(
     *   path="/api/workshop/service",
     *   summary="Delete Workshop Service",
     *   operationId="delete",
     *   produces={"application/json"},
     *   tags={"Services"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="service_id",
     *     in="formData",
     *     description="service id",
     *     required=true,
     *     type="integer"
     *   ), 
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function unassignService(Request $request){
        // delete
        $workshop   = JWTAuth::authenticate();

        $rules = [
            'service_id'      => ['required', Rule::exists('workshop_service')->where(function($query) use ($workshop){
                $query->where('workshop_id', $workshop->id);
            })]
        ];
        $input = $request->only( 'service_id' );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ],Response::HTTP_OK);
        }

        $workshop->services()->detach($request->service_id);

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Workshop Service deleted!!',
            'body'          => ''
        ],Response::HTTP_OK);
    }
    /**
    * @SWG\Get(
    *   path="/api/workshop/services",
    *   summary="All services of Workshop",
    *   operationId="fetch",
    *   produces={"application/json"},
    *   tags={"Services"},
    *   @SWG\Parameter(
    *     name="Authorization",
    *     in="header",
    *     description="token",
    *     required=true,
    *     type="string"
    *   ),    
    *   @SWG\Response(response=200, description="successful operation"),
    *   @SWG\Response(response=406, description="not acceptable"),
    *   @SWG\Response(response=500, description="internal server error")
    * )
    */
    public function workshopServices(){
        $workshop   = JWTAuth::authenticate();

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'success',
            'body'          => $workshop->services
        ],Response::HTTP_OK);   
    }

    public function workshop_profile(){
        $workshop = Auth::guard('workshop')->user();
        return View::make('workshop_profile.index')->with('workshop', $workshop);                       
    }

    public function edit_profile($id){
     // get the workshop
     $workshop = Workshop::find($id);
     $services = Service::all();
     // show the edit form and pass the workshop   
     return View::make('workshop_profile.edit')->with('workshop', $workshop)->with('services',$services);                         
    }

    public function update_profile(Request $request, $id)
    {
        $rules = [           
                        'name'                           => 'required|regex:/^[\pL\s\-]+$/u',
                        'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
                        'cnic'                           => 'required|digits:13',
                        'mobile'                         => 'required|digits:11',
                        'landline'                       => 'digits:11',
                        'open_time'                      => 'required',
                        'close_time'                     => 'required',
                        'type'                           => 'required',
                        'profile_pic'                    => 'image|mimes:jpg,png',  
                        'cnic_image'                     => 'image|mimes:jpg,png',  
            
                        'shop'                           => 'required|numeric',
                        'building'                       => 'regex:/^[\pL\s\-]+$/u',
                        'block'                          => 'regex:/^[\pL\s\-]+$/u',
                        'street'                         => 'required|string',
                        'town'                           => 'required|regex:/^[\pL\s\-]+$/u',
                        'city'                           => 'required|regex:/^[\pL\s\-]+$/u'
                    ];  
                                
                    $input = $request->only('name', 'owner_name', 'cnic', 'mobile', 'landline','open_time', 'close_time', 'type', 'shop', 'building', 'street', 'town', 'city');
                    $validator = Validator::make($input, $rules);
                    if($validator->fails()) {
                        return Redirect::back()
                            ->withErrors($validator);
                    } 
            
                     // Update workshop
                    $workshop = Workshop::find($id);
            
                    if ($request->hasFile('profile_pic')) 
                    {
                        $ws_name = str_replace(' ', '_', $request->name);
                        $s3_path =  Storage::disk('s3')->putFile('workshops/'.$ws_name.'/logo', new File($request->profile_pic), 'public');
                       
                        $profile_pic_path = config('app.s3_bucket_url').$s3_path;
                        $profile_pic = $profile_pic_path;
                        
                    }
                    else
                    {
                      $profile_pic         =  $workshop->profile_pic;
                    }
            
            
                    if ($request->hasFile('cnic_image')) 
                    {
                        $ws_name = str_replace(' ', '_', $request->name);
                        $s3_path =  Storage::disk('s3')->putFile('workshops/'.$ws_name.'/cnic', new File($request->cnic_image), 'public');
                        $cnic_pic_path = config('app.s3_bucket_url').$s3_path;
                        $cnic_image = $cnic_pic_path;
                    }
                    else
                    {
                      $cnic_image         =  $workshop->cnic_image;
                    }
            
                    $workshop->name             = Input::get('name');        
                    $workshop->owner_name       = Input::get('owner_name');  
                    $workshop->cnic             = Input::get('cnic');
                    $workshop->mobile           = Input::get('mobile');
                    $workshop->landline         = Input::get('landline');
                    $workshop->type             = Input::get('type');
                    $workshop->profile_pic      = $profile_pic;
                    $workshop->cnic_image      =  $cnic_image;
                    $workshop->open_time        = Input::get('open_time');
                    $workshop->close_time       = Input::get('close_time');
                    $workshop->save();   
            
                    // Update Workshop Address
                    $address = WorkshopAddress::find($workshop->address->id);
                                
                    $address->shop              = Input::get('shop');
                    $address->building          = Input::get('building');
                    $address->street         = Input::get('street');
                    $address->block             = Input::get('block');
                    $address->town              = Input::get('town');
                    $address->city              = Input::get('city');
                    $address->town              = Input::get('town');                
                    $address->update();
                    
                    Session::flash('message', 'Success! Workshop Updated.');
                    return Redirect::to('/profile');
    }

    public function addProfileService($workshop){       
        $workshop = Workshop::find($workshop);
        $services = Service::all();        
        return View::make('workshop_profile.services.add')->with('workshop', $workshop)->with('services',$services);            
    }

    public function storeProfileService(Request $request){        
        $rules = [
            'service_rate'    => 'required',            
            'service_time'    => 'required'                        
            ];
        $input = $request->only('service_id', 'service_rate', 'service_time' );

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);                
        }        
        $workshop = Workshop::find($request->workshop_id);
        $service = $request->service_id; 
        $rate = $request->service_rate;
        $time = $request->service_time;       
        
        $workshop->services()->attach($service, ['service_rate' => $rate , 'service_time' => $time]);
        
        return Redirect::to('profile');               
    }

    public function editProfileService($id){        
        $services = Service::all();
        $workshop_service = DB::table('workshop_service')->where('id', $id)->first();
        return View::make('workshop_profile.services.edit')->with('workshop_service', $workshop_service)->with('services',$services);            

    }
    
    public function updateProfileService(Request $request){        
        $rules = [            
            'service_rate'    => 'required|numeric',            
            'service_time'    => 'required'                        
            ];        
        $input = $request->only('service_rate', 'service_time' );
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $workshop_service_id = $request->workshop_service_id ;            
            return Redirect::back()
                ->withErrors($validator);
        }                 
        $workshop = Workshop::find($request->workshop_id);
        $workshop->services()->updateExistingPivot($request->service_id, ['service_rate' => $request->service_rate, 'service_time' => $request->service_time ]);
        return Redirect::to('profile');               

    }

    public function deleteProfileService($workshop_id, $service_id){
        $workshop = Workshop::find($workshop_id);
        $workshop->services()->detach($service_id);        
        // show the view and pass the workshop to it
        return Redirect::to('profile/');               
    }


    public function topup(){
        $workshops = Workshop::all();
        return View::make('admin.topup.topup')->with('workshops', $workshops);
    }

    public function topupBalance(Request $request){
        $rules = [
            'amount'         => 'required|numeric',
            'workshop_id'    => 'required|integer'
        ];        

        $input = $request->only('amount', 'workshop_id');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {            
            return Redirect::to('admin/top-up')
                ->withErrors($validator);                
        }

        $workshop = Workshop::find($request->workshop_id);
        if(is_null($workshop->balance))
        {
            $balance     = 0;
            $new_balance = $request->amount;            
            $workshop->balance()->create([
                'balance'   => $new_balance
            ]);
        }
        else
        {
            $balance     = $workshop->balance->balance;
            $new_balance = $request->amount + $balance;
            $workshop->balance->update(['balance' => $new_balance]);
        }

        $transaction = new WorkshopLedger;
        $transaction->amount                        = $request->amount;
        $transaction->workshop_id                   = $request->workshop_id;
        $transaction->transaction_type              = 'Top-Up';        
        $transaction->unadjusted_balance            = $balance;
        $transaction->adjusted_balance              = $new_balance;
        
        $transaction->save();

        return Redirect::to('admin/top-up');       
    }

    /**
     * Show Home
     *
     * @return \Illuminate\Http\Response
     */
    public function showHome() {

        $workshop        = Auth::guard('workshop')->user();
        $leads           = Booking::where('workshop_id', $workshop->id)->get()->load(['customer']);
        $completed_leads = Booking::where('workshop_id', $workshop->id)->where('job_status','completed')->get();
        $accepted_leads  = Booking::where('workshop_id', $workshop->id)->where('is_accepted',1)->get();
        $rejected_leads  = Booking::where('workshop_id', $workshop->id)->where('is_accepted',0)->get();

        if(count($leads)){
            $leads_count     = count($leads);
            $customer_count  = count($leads->customer);
        }
        else{
            $leads_count     = 0;
            $customer_count  = 0;
        }
        if(count($completed_leads)){
            $completed_leads = count($completed_leads);
        }
        else{
            $completed_leads = 0;
        }
        if(count($accepted_leads)){
            $accepted_leads  = count($accepted_leads);
        }else{
            $accepted_leads  = 0;
        }
        if(count($rejected_leads)){
            $rejected_leads  = count($rejected_leads);
        }else{
            $rejected_leads  = 0;
        }

        return view('workshop_profile.home')->with(['leads_count' => $leads_count,'accepted_leads'=> $accepted_leads,'rejected_leads'=> $rejected_leads ,'completed_leads'=> $completed_leads,'customer_count'=> $customer_count ]);
      
    }

    /**
    * @SWG\Get(
    *   path="/api/workshop/address",
    *   summary="Workshop Address Details",
    *   operationId="get",
    *   produces={"application/json"},
    *   tags={"Workshops"},
    *    @SWG\Parameter(
    *     name="Authorization",
    *     in="header",
    *     description="Token",
    *     required=true,
    *     type="string"
    *   ), 
    *   @SWG\Response(response=200, description="successful operation"),
    *   @SWG\Response(response=406, description="not acceptable"),
    *   @SWG\Response(response=500, description="internal server error")
    * )    
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function getAddress()
    {         
        $workshop   = JWTAuth::authenticate();
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'success',
            'body' => $workshop->address
        ],Response::HTTP_OK);
    }

    /**
     * @SWG\Post(
     *   path="/api/workshop/address",
     *   summary="Update Workshop Address",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="shop",
     *     in="formData",
     *     description="Workshop Shop No",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Parameter(
     *     name="building",
     *     in="formData",
     *     description="Workshop Building",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="street",
     *     in="formData",
     *     description="Workshop Street",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="block",
     *     in="formData",
     *     description="Workshop Block",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="town",
     *     in="formData",
     *     description="Workshop Town",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="city",
     *     in="formData",
     *     description="Workshop City",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(Request $request)
    {   
        $workshop   = JWTAuth::authenticate();
        $address    = $workshop->address;

        $rules = [
            'shop'                           => 'required|numeric',
            'building'                       => 'regex:/^[\pL\s\-]+$/u',
            'block'                          => 'regex:/^[\pL\s\-]+$/u',
            'street'                         => 'required|string',
            'town'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'city'                           => 'required|regex:/^[\pL\s\-]+$/u',
        ];

        $input = $request->only('shop', 'building', 'block', 'street', 'town', 'city');

        $validator = Validator::make($input , $rules);

        // process the login
        if ($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => $request->all()
            ],Response::HTTP_OK);
        }

        if (!count($address)) {
            $address = new WorkshopAddress;
        }
         
        $address->shop          =  $request->shop;
        $address->building      =  $request->building;        
        $address->block         =  $request->block;
        $address->street        =  $request->street;
        $address->town          =  $request->town;
        $address->city          =  $request->city;        
        $workshop->address()->save($address);
        
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'success',
                    'body' => $request->all()
                ],Response::HTTP_OK);               
    }

    /**
     * @SWG\Post(
     *   path="/api/workshop/update-images",
     *   summary="Update Workshop Images",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="images",
     *     in="formData",
     *     description="[{old_url,new_image}]",
     *     required=true,
     *     type="array",
     *     items="[old_url,new_image]"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImages(Request $request)
    {            
        $workshop_id = JWTAuth::authenticate()->id;
        $images = $request->images;
        $url_array = [];
        foreach($images as $image){
            $file_data = $image->new_image;                                 
            if( (empty($image->old_url)) && (!empty($image->new_image)) ){

                $url = $this->upload_image($file_data,$workshop_id);
                array_push($url_array, $url);
                $workshop_image = new WorkshopImages;
                $workshop_image->url            = $url;
                $workshop_image->workshop_id    = $workshop_id;
                $workshop->save();
                       
            }elseif( (!empty($image->old_url)) && (!empty($image->new_image)) ){

                $url = $this->upload_image($file_data,$workshop_id);                                
                array_push($url_array, $url);
                WorkshopImages::where('url', $image->old_url)
                                ->where('workshop_id',$workshop_id)
                                ->update(['url' => $url]);                
            }            
        }        
        
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Images Uploaded Successfully!',
                    'body' => $url_array
                ],Response::HTTP_OK);               
    }

    /**
     * @SWG\Patch(
     *   path="/api/workshop/update-profile-image",
     *   summary="Update Profile Images",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="profile_pic",
     *     in="formData",
     *     description="Base64 String",
     *     required=true,
     *     type="string"     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfileImage(Request $request)
    {            
        $workshop   = JWTAuth::authenticate();
        $file_data = $request->profile_pic;
        $url = $this->upload_image($file_data,$workshop->id);
        $profile_image = $workshop->update(['profile_pic' => $url]);

        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'success',
                    'body' => $url
                ],Response::HTTP_OK);               
    }

    /**
     * @SWG\Patch(
     *   path="/api/workshop/update-cnic-image",
     *   summary="Update Cnic Images",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cnic_image",
     *     in="formData",
     *     description="Base64 String",
     *     required=true,
     *     type="string"     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCnicImage(Request $request)
    {            
        $workshop   = JWTAuth::authenticate();
        $file_data = $request->cnic_image;
        $url = $this->upload_image($file_data,$workshop->id);
        $cnic_image = $workshop->update(['cnic_image' => $url]);

        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'success',
                    'body' => $url
                ],Response::HTTP_OK);               
    }

    public function upload_image($file_data , $workshop_id){
        $full_path = storage_path()."/app/workshop/temp/".md5(microtime()).".jpg";
        $path = "/workshop/temp";
        if(!is_dir($path)) {
            Storage::makeDirectory($path);            
        }
        $file   = fopen($full_path, "wb");        
        fwrite($file, base64_decode($file_data));
        fclose($file);
        $s3_path =  Storage::disk('s3')->putFile('workshops/'. $workshop_id . '/images', new File($full_path), 'public');
        $workshop_image = config('app.s3_bucket_url').$s3_path;
        Storage::delete($path.'/'.basename($full_path));
        return $workshop_image;
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/ledger/",
     *   summary="Workshop Legder",
     *   operationId="get",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Getting Workshop Ledger.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLedger(Request $request){
        if($request->header('content-type') == "application/json"){
            $workshop   = JWTAuth::authenticate()->load('transactions','balance');        
            return response()->json([
                        'http-status' => Response::HTTP_OK,
                        'status' => true,
                        'message' => 'Workshop Ledger',
                        'body' => ['transactions'=>$workshop->transactions]
                    ],Response::HTTP_OK);            
        }else{
            $workshop = Auth::guard('workshop')->user()->load('transactions','balance');                        
            return view::make('workshop_profile.ledger')->with('workshop',$workshop);
        }
    }

    public function workshopLedger(Workshop $workshop){
        $workshop->load('transactions','balance');
        return view::make('workshop.ledger')->with('workshop',$workshop);
    }

  /**
     * @SWG\Get(
     *   path="/api/workshop/get-customers",
     *   summary="Get Workshop Customers",
     *   operationId="get",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     * Getting Workshop Customers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getCustomers()
    {
        $workshop = JWTAuth::authenticate();
        $bookings = $workshop->bookings()->pluck('customer_id');

        if (!$bookings)
        {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'No Records Exists',
                'body' => null
            ],Response::HTTP_OK);
        }

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'success',
            'body' => Customer::whereIn('id', $bookings)->get()
        ],Response::HTTP_OK);
    }

    public function authorized()
    {
        $workshops = Workshop::orderBy('created_at', 'desc')->where('type', 'Authorized')->get();
        return View::make('workshop.authorized')->with('workshops', $workshops);
    }

    public function unauthorized()
    {
        $workshops = Workshop::orderBy('created_at', 'desc')->where('type', 'UnAuthorized')->get();
        return View::make('workshop.unauthorized')->with('workshops', $workshops);
    }

    public function workshopGallery(Workshop $workshop){
        return view::make('workshop.gallery')->with('images', $workshop->images)->with('workshop', $workshop);
    }

}


