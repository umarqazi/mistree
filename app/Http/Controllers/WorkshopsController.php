<?php

namespace App\Http\Controllers;

use JWTAuth;
use Session;
use Hash, DB, Config, Mail, View;
use Illuminate\Support\Facades\Redirect;
use App\Workshop;
use App\WorkshopImages;
use App\Service;
use App\WorkshopAddress;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        $workshops = Workshop::all();
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
            'card_number'                    => 'required|digits:13',
            'con_number'                     => 'required|digits:11',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'address_type'                   => 'required|alpha',
            'address_house_no'               => 'required|numeric',
            'address_street_no'              => 'required|numeric',
            'address_block'                  => 'required|regex:/^[\pL\s\-]+$/u',
            'address_area'                   => 'required|regex:/^[\pL\s\-]+$/u',
            'address_town'                   => 'required|regex:/^[\pL\s\-]+$/u',
            'address_city'                   => 'required|regex:/^[\pL\s\-]+$/u',
            // 'service_id.*'                   => 'required|integer',
            // 'service_rate.*'                 => 'required|integer',
            // 'service_time.*'                 => 'required|alpha_dash' 
        ];        

        $input = $request->only('name', 'email', 'owner_name', 'password', 'password_confirmation', 'card_number', 'con_number', 'address_type', 'address_house_no', 'address_street_no', 'address_block', 'address_area', 'address_town', 'address_city','open_time', 'close_time');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return Redirect::to('admin/workshops/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }       

        if ($request->hasFile('profile_pic')) 
        {
            $ws_name = str_replace(' ', '_', $request->name);
            $s3_path =  Storage::disk('s3')->putFile('workshops/'.$ws_name.'/logo', new File($request->profile_pic), 'public');
           
            $profile_pic_path = 'https://s3-us-west-2.amazonaws.com/mymystri-staging/'.$s3_path;
            $profile_pic = $profile_pic_path;
            // dd($profile_pic_path);
        }
        else
        {
          $profile_pic         =  url('img/thumbnail.png');
        }

        if ($request->hasFile('cnic_image')) 
        {
            $ws_name = str_replace(' ', '_', $request->name);
            $s3_path =  Storage::disk('s3')->putFile('workshops/'.$ws_name.'/cnic', new File($request->cnic_image), 'public');
            $cnic_pic_path = 'https://s3-us-west-2.amazonaws.com/mymystri-staging/'.$s3_path;
            $cnic_image = $cnic_pic_path;
            // dd($profile_pic_path);
        }
        else
        {
          $cnic_image         =  '';
        }

        //Insert Workshop data from request 
        $workshop = Workshop::create(['name' => $request->name, 'owner_name' => $request->owner_name ,'email' => $request->email, 'password' => Hash::make($request->password), 'card_number' => $request->card_number, 'con_number' => $request->con_number, 'type' => $request->type, 'profile_pic' => $profile_pic,'cnic_image' => $cnic_image, 'team_slot' => $request->team_slot, 'open_time' => $request->open_time, 'close_time' => $request->close_time, 'status' => 1, 'is_approved' => 0]); 

        //Insert Address data from request
        $address = WorkshopAddress::create(['type' => $request->address_type, 'house_no' => $request->address_house_no, 'street_no' => $request->address_street_no, 'block' => $request->address_block, 'area' => $request->address_area, 'town' => $request->address_town, 'city' => $request->address_city, 'workshop_id' => $workshop->id, 'geo_cord' => NULL, 'status' => 1 ]);

        //Insert Services data from request        
        $service_ids = $request->service_id;
        $service_rates = $request->service_rate;
        $service_times = $request->service_time;    
        if(!empty($service_ids)){
            for($i = 0; $i<count($service_ids); $i++){            
                $workshop->service()->attach($service_ids[$i], ['service_rate' => $service_rates[$i] , 'service_time' => $service_times[$i] ]);
            }
        }

        if ($request->hasFile('ws_images')) 
        {
             $files = $request->file('ws_images');

            foreach($files as $file)
            {
                $images = new WorkshopImages;
               $ws_name = str_replace(' ', '_', $request->name);
                   $s3_path =  Storage::disk('s3')->putFile('workshops/'.$ws_name.'/ws_images', new File($file), 'public');  

                   $ws_pic_path = 'https://s3-us-west-2.amazonaws.com/mymystri-staging/'.$s3_path;

                   $ws_pic = $ws_pic_path;

                   $images->url = $ws_pic;
                   $images->workshop_id = $workshop->id;
                   $images->save();
              }
        }       

        $name = $request->name;        
        $email = $request->email;        
        $subject = "Please verify your email address.";
        $verification_code = str_random(30); //Generate verification code         
        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        Mail::send('workshop.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "jazib.javed@gems.techverx.com");
                $mail->to($email, $name);
                $mail->subject($subject);
            });

        return Redirect::to('admin/workshops');       
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
        $services = Service::all();
        // show the edit form and pass the workshop        
        return View::make('workshop.edit')->with('workshop', $workshop)->with('services',$services);            
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
            'email'                          => 'required|email|unique:workshops',
            'password'                       => 'required|confirmed|min:8',
            'password_confirmation'          => 'required',
            'card_number'                    => 'required|digits:13',
            'con_number'                     => 'required|digits:11',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'address_type'                   => 'required|alpha',
            'address_house_no'               => 'required|numeric',
            'address_street_no'              => 'required|numeric',
            'address_block'                  => 'required|regex:/^[\pL\s\-]+$/u',
            'address_area'                   => 'required|regex:/^[\pL\s\-]+$/u',
            'address_town'                   => 'required|regex:/^[\pL\s\-]+$/u',
            'address_city'                   => 'required|regex:/^[\pL\s\-]+$/u',
            // 'service_id.*'                   => 'required|integer',
            // 'service_rate.*'                 => 'required|integer',
            // 'service_time.*'                 => 'required|alpha_dash' 
        ];   

        $input = $request->only('name', 'owner_name', 'card_number', 'con_number', 'address_type', 'address_house_no', 'address_street_no', 'address_block', 'address_area', 'address_town', 'address_city', 'close_time', 'open_time');

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return Redirect::to('admin/workshops/' . $id . '/edit')
                ->withErrors($validator);
                // ->withInput(Input::except('password'));
        } 

         // Update workshop
        $workshop = Workshop::find($id);

        if ($request->hasFile('profile_pic')) 
        {
            $ws_name = str_replace(' ', '_', $request->name);
            $s3_path =  Storage::disk('s3')->putFile('workshops/'.$ws_name.'/logo', new File($request->profile_pic), 'public');
           
            $profile_pic_path = 'https://s3-us-west-2.amazonaws.com/mymystri-staging/'.$s3_path;
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
            $cnic_pic_path = 'https://s3-us-west-2.amazonaws.com/mymystri-staging/'.$s3_path;
            $cnic_image = $cnic_pic_path;
        }
        else
        {
          $cnic_image         =  $workshop->cnic_image;
        }

        $workshop->name             = Input::get('name');        
        $workshop->owner_name       = Input::get('owner_name');  
        $workshop->card_number      = Input::get('card_number');
        $workshop->con_number       = Input::get('con_number');
        $workshop->type             = Input::get('type');
        $workshop->profile_pic      = $profile_pic;
        $workshop->cnic_image      =  $cnic_image;
        // $workshop->pic1             = '';
        // $workshop->pic2             = '';
        // $workshop->pic3             = '';
        $workshop->team_slot        = Input::get('team_slot');
        $workshop->open_time        = Input::get('open_time');
        $workshop->close_time       = Input::get('close_time');
        $workshop->status           = 1;
        $workshop->save();   

        // Update Workshop Address
        $address = WorkshopAddress::find($workshop->address->id);

        $address->type              = Input::get('address_type');
        $address->house_no          = Input::get('address_house_no');
        $address->street_no         = Input::get('address_street_no');
        $address->block             = Input::get('address_block');
        $address->area              = Input::get('address_area');
        $address->town              = Input::get('address_town');
        $address->city              = Input::get('address_city');
        $address->town              = Input::get('address_town');                
        $address->save();
        
        // Session::flash('message', 'Successfully updated Workshop!');
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
        Session::flash('message', 'Successfully deleted the Workshop!');
        return Redirect::to('workshops');      
    }
    /**
     * @SWG\Post(
     *   path="/api/workshop/register",
     *   summary="Register Workshop",
     *   operationId="register",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name of Workshop",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="owner_name",
     *     in="query",
     *     description="Owner Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="email",
     *     in="query",
     *     description="Workshop Email Address",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="query",
     *     description="Workshop Login Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password_confirmation",
     *     in="query",
     *     description="Workshop Confirm Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="card_number",
     *     in="query",
     *     description="Workshop CNIC card Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="con_number",
     *     in="query",
     *     description="Workshop Contact Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="type",
     *     in="query",
     *     description="Workshop Type",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="team_slot",
     *     in="query",
     *     description="Workshop Team Slots",
     *     required=false,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="open_time",
     *     in="query",
     *     description="Workshop Opening Time",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="close_time",
     *     in="query",
     *     description="Workshop Closing Time",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_city",
     *     in="query",
     *     description="Workshop Address City",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_block",
     *     in="query",
     *     description="Workshop Address Block",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_town",
     *     in="query",
     *     description="Workshop Address Town",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_area",
     *     in="query",
     *     description="Workshop Address Area",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_type",
     *     in="query",
     *     description="Workshop Address Type",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_house_no",
     *     in="query",
     *     description="Workshop House No",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_street_no",
     *     in="query",
     *     description="Workshop Street No",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="service_id",
     *     in="query",
     *     description="Workshop selected service Ids in array",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="service_rate",
     *     in="query",
     *     description="Workshop Service rates associated to each service id in array",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="service_time",
     *     in="query",
     *     description="Workshop Service rates associated to each service id in array",
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
     * API Register for new workshop.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
            'email'                          => 'required|email|unique:workshops',
            'password'                       => 'required|confirmed|min:8',
            'password_confirmation'          => 'required',
            'card_number'                    => 'required|digits:13',
            'con_number'                     => 'required|digits:11',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'address_type'                   => 'required|alpha',
            'address_house_no'               => 'required|numeric',
            'address_street_no'              => 'required|numeric',
            'address_block'                  => 'required|regex:/^[\pL\s\-]+$/u',
            'address_area'                   => 'required|regex:/^[\pL\s\-]+$/u',
            'address_town'                   => 'required|regex:/^[\pL\s\-]+$/u',
            'address_city'                   => 'required|regex:/^[\pL\s\-]+$/u',
            // 'service_id.*'                   => 'required|integer',
            // 'service_rate.*'                 => 'required|integer',
            // 'service_time.*'                 => 'required|alpha_dash' 
        ];        
        
        $input = $request->only('name', 'email', 'owner_name', 'password', 'password_confirmation', 'card_number', 'con_number', 'address_type', 'address_house_no', 'address_street_no', 'address_block', 'address_area', 'address_town', 'address_city','open_time', 'close_time');
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
        $workshop = Workshop::create(['name' => $request->name, 'owner_name' => $request->owner_name ,'email' => $request->email, 'password' => Hash::make($request->password), 'card_number' => $request->card_number, 'con_number' => $request->con_number, 'type' => $request->type, 'profile_pic' => '', 'pic1' => '', 'pic2' => '', 'pic3' => '', 'team_slot' => $request->team_slot, 'open_time' => $request->open_time, 'close_time' => $request->close_time, 'status' => 1, 'is_approved' => 0]);        

        //Insert Address data from request
        $address = WorkshopAddress::create(['type' => $request->address_type, 'house_no' => $request->address_house_no, 'street_no' => $request->address_street_no, 'block' => $request->address_block, 'area' => $request->address_area, 'town' => $request->address_town, 'city' => $request->address_city, 'workshop_id' => $workshop->id, 'geo_cord' => NULL, 'status' => 1 ]);

        //Insert Services data from request        
        $service_ids = $request->service_id;
        $service_rates = $request->service_rate;
        $service_times = $request->service_time;          

        if(!empty($service_ids)){
            for($i = 0; $i<count($service_ids); $i++){            
                $workshop->service()->attach($service_ids[$i], ['service_rate' => $service_rates[$i] , 'service_time' => $service_times[$i] ]);
            }
        }

        $name = $request->name;
        $con_number = $request->con_number;
        $email = $request->email;        
         // return $this->login($request);
        $verification_code = str_random(30); //Generate verification code
        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::send('workshop.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "jazib.javed@gems.techverx.com");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Thanks for signing up! Please check your email to complete your registration.',
            'body' => $request->all()
        ],Response::HTTP_OK);
    }

    /**
     * @SWG\Post(
     *   path="/api/workshop/login",
     *   summary="Workshop Login",
     *   operationId="login",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="query",
     *     description="Email of Workshop",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="query",
     *     description="Workshop Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
    /**
     * API Login for workshop, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
  
    public function login(Request $request)
    {           
        $check = Workshop::select('is_approved')->where('email', $request->email)->first();        
        if($check->is_approved == 0){                
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Workshop is not approved by the admin',
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        try {
            Config::set('auth.providers.users.model', \App\Workshop::class);
            if (! $token = JWTAuth::attempt($credentials)) {
                $request->offsetUnset('password');
                $request->offsetUnset('password_confirmation');
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'We cant find an account with this credentials.',
                    'body' => $request->all()
                ],Response::HTTP_OK);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'Failed to login, please try again.',
                'body' => $request->all()
            ],Response::HTTP_OK);
        }
        // all good so return the token
        $workshop = Auth::user();
        // Config::set('jwt.user' , "App\User");
        // Config::set('auth.providers.users.model', \App\User::class);
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
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            Config::set('auth.providers.users.model', \App\Workshop::class);
            JWTAuth::invalidate($request->input('token'));
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'success',
                'body' => ''
            ],Response::HTTP_OK);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'Failed to logout, please try again.',
                'body' => $request->all()
            ],Response::HTTP_OK);
        }
    }

    /**
     * API Recover Password for new workshop.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {
        $workshop = Workshop::where('email', $request->email)->first();
        if (!$workshop) {
            $error_message = "Your email address was not found.";
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $error_message,
                'body' => ''
            ],Response::HTTP_OK);
        }
        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $error_message,
                'body' => ''
            ],Response::HTTP_OK);
        }
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'A reset email has been sent! Please check your email.',
            'body' => ''
        ],Response::HTTP_OK);
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
            if($workshop->is_verified == 1){
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Account already verified.',
                    'body' => ''
                ],Response::HTTP_OK);
            }
            $workshop->update(['is_verified' => 1]);
            DB::table('workshop_verifications')->where('token',$verification_code)->delete();
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'You have successfully verified your email address.',
                'body' => ''
            ],Response::HTTP_OK);
        }
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => false,
            'message' => 'Verification code is invalid.',
            'body' => ''
        ],Response::HTTP_OK);
    }
    /**
     * Registration Store Data
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function regStoreData(Request $request){
        $this->validate($request, ['token' => 'required']);
        try {
            Config::set('auth.providers.users.model', \App\Workshop::class);
            $rules = [
                'card_number' => 'required',
                'con_number' => 'required',
                'type' => 'required',                
                'open_time' => 'required',
                'close_time' => 'required',
                'address_type' => 'required',
                'address_house_no' => 'required',
                'address_street_no' => 'required',
                'address_block' => 'required',
                'address_area' => 'required',
                'address_town' => 'required',
                'address_city' => 'required',



            ];
            $input = $request->only('card_number', 'con_number', 'type', 'team_slot', 'open_time', 'close_time' , 'status', 'is_verified');

            $validator = Validator::make($input, $rules);
            if($validator->fails()) {                
                return response()->json([
                        'http-status' => Response::HTTP_OK,
                        'status' => false,
                        'message' => $validator->messages(),
                        'body' => $request->all()
                    ],Response::HTTP_OK);
            }

            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'success',
                'body' => ''
            ],Response::HTTP_OK);
        } catch (JWTException $e) {

            // something went wrong whilst attempting to encode the token
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => '',
                'body' => $request->all()
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
        $subject = "Conragulations! Your workshop has been approved.";
           Mail::send('workshop.confirmationEmail', ['name' => $name],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "jazib.javed@gems.techverx.com");
                $mail->to($email, $name);
                $mail->subject($subject);
            });        
        return Redirect::to('admin/workshops');
    }

    /**
     *  Unapprove Workshop
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function undoWorkshopApproval($id){
        //Approve Workshop
        $workshop = Workshop::find($id);
        $workshop->is_approved       = 0;
        $workshop->save();                
        return Redirect::to('admin/workshops');
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/getWorkshop/id",
     *   summary="Get Workshop Details",
     *   operationId="fetch detials",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Workshop details",
     *     required=true,
     *     type="integer"
     *   ),    
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
    */     
    public function getWorkshop($id){
        $workshop = Workshop::find($id);
        return response([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Workshop Details!',
            'body' => $workshop
        ],Response::HTTP_OK);
    }
    /**
     * @SWG\Post(
     *   path="/api/workshop/updateProfile",
     *   summary="Update Workshop Details",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name of Workshop",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="owner_name",
     *     in="query",
     *     description="Owner Name",
     *     required=true,
     *     type="string"
     *   ),     
     *   @SWG\Parameter(
     *     name="card_number",
     *     in="query",
     *     description="Workshop CNIC card Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="con_number",
     *     in="query",
     *     description="Workshop Contact Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="type",
     *     in="query",
     *     description="Workshop Type",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="team_slot",
     *     in="query",
     *     description="Workshop Team Slots",
     *     required=false,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="open_time",
     *     in="query",
     *     description="Workshop Opening Time",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="close_time",
     *     in="query",
     *     description="Workshop Closing Time",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    /**
     * API Register store data of new customer.
     *
     * @param Request $request
     * @param $id
     * @param $address_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileUpdate(Request $request, $id)
    {
        // $request_workshop = $request->workshop;
        $rules = [            
            'name'                           => 'required|alpha',
            'owner_name'                     => 'required|alpha',            
            'card_number'                    => 'required|digits:13',
            'con_number'                     => 'required|digits:11',
            'open_time'                      => 'required',
            'close_time'             
        ];  

        $input = $request->only('name', 'owner_name', 'card_number', 'con_number');

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
        $workshop = Workshop::find($id);
        $workshop->fill($request);        
        //address   
        return response([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Details Updated!',
            'body' => $request
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
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }                 
        $workshop = Workshop::find($request->workshop_id);
        $workshop->service()->updateExistingPivot($request->service_id, ['service_rate' => $request->service_rate, 'service_time' => $request->service_time ]);
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
            // 'service_id'      => 'required|unique_with:workshop_service,workshop_id',
            'service_rate'    => 'required',            
            'service_time'    => 'required'                        
            ];
        $input = $request->only('service_id', 'service_rate', 'service_time' );

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return Redirect::to('admin/add-workshop-service/'.$request->workshop_id)
                ->withErrors($validator);                
        }        
        $workshop = Workshop::find($request->workshop_id);
        $service = $request->service_id; 
        $rate = $request->service_rate;
        $time = $request->service_time;       
        
        $workshop->service()->attach($service, ['service_rate' => $rate , 'service_time' => $time]);
        
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
        $workshop->service()->detach($service_id);        
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
        return View::make('workshop.customers');
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
     *     name="token",
     *     in="formData",
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
     *     description="Sercice Name",
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
     *     name="address_area",
     *     in="formData",
     *     description="Workshop Address Area",
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
        // $workshops = Workshop::leftJoin('workshop_addresses', 'workshops.id', '=','workshop_addresses.workshop_id')->where('workshops.status', 1)->get();
        /*$workshops = Workshop::join('workshop_service', 'workshops.id', '=','workshop_service.workshop_id')->leftJoin('services', 'workshop_service.service_id', '=','services.id')->where('workshops.status', 1)->with('address')->get();*/
        $workshops = Workshop::where('workshops.status', 1)->with('address');
        $workshop_ids = [];
        if ($request->has('name')) {
            $workshops = $workshops->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->has('type')) {
            $workshops = $workshops->where('type', $request->type);
        }
        // if ($request->has('geo_cord')) {
        //     $workshops->where('geo_cord', $request->geo_cord);
        // }
        if ($request->has('service_name')) {
            // $workshops = $workshops->where('services.name', $request->service_name);
            $service_names = explode(", ",$request->service_name);
            foreach($service_names as $service_name){
                 $workshop_ids = Db::table('workshop_service')->join('services', 'workshop_service.service_id', '=', 'services.id')->select('workshop_service.workshop_id')->where('services.name', 'LIKE', '%'.$service_name.'%')->get()->pluck('workshop_id')->toArray();
                $workshops = $workshops->whereIn('id', $workshop_ids);
            }

            $workshops=$workshops->with(['services' => function($query) use ($service_names) {
                $query->whereIn('name', $service_names);
            }]);
        }
        if ($request->has('address_block')) {
            $workshops = $workshops->where('address.block', 'LIKE', '%'.$request->address_block .'%');
        }
        if ($request->has('address_area')) {
            $workshops = $workshops->where('address.area', 'LIKE', '%'.$request->address_area.'%');
        }
        if ($request->has('address_town')) {
            $workshops = $workshops->where('address.town', 'LIKE', '%'.$request->address_town.'%');
        }
        if ($request->has('address_city')) {
            $workshops = $workshops->where('address.city', 'LIKE', '%'.$request->address_city.'%');
        }
        $workshops = $workshops->get();
        $eachWorkShop = new Workshop();

        foreach ($workshops as $key =>$workshop) {
            $workshops[$key]->est_rates = $workshop->sumOfServiceRates($workshop);
        }
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => '',
            'body' => $workshops
        ],Response::HTTP_OK);
    }
    /**
     * @SWG\Post(
     *   path="/api/workshop/deleteWorkshopService",
     *   summary="Delete Workshop Service",
     *   operationId="delete",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="workshop_id",
     *     in="path",
     *     description="workshop id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="service_id",
     *     in="path",
     *     description="service id",
     *     required=true,
     *     type="integer"
     *   ), 
     @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function unassignService($workshop_id, $service_id){
        // delete
        $workshop = Workshop::find($workshop_id);
        $workshop->service()->dettach($service_id);

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Workshop Service deleted!!',
            'body'          => '' 
        ],Response::HTTP_OK);
    }
    /**
    * @SWG\Post(
    *   path="/api/workshop/workshopServices",
    *   summary="All services of Workshop",
    *   operationId="fetch",
    *   produces={"application/json"},
    *   tags={"Workshops"},
    *   @SWG\Parameter(
    *     name="workshop_id",
    *     in="path",
    *     description="workshop id",
    *     required=true,
    *     type="integer"
    *   ),    
    *   @SWG\Response(response=200, description="successful operation"),
    *   @SWG\Response(response=406, description="not acceptable"),
    *   @SWG\Response(response=500, description="internal server error")
    * )
    */
    public function allWorkshopServices($workshop_id){
        $workshop = Workshop::find($workshop_id);
        $workshop_services = $workshop->service;
        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Workshop Services!!',
            'body'          => $workshop_services 
        ],Response::HTTP_OK);   
    }

    public function workshop_profile(){
        $workshop = Auth::guard('workshop')->user();
        return View::make('workshops.index')->with('workshop', $workshop);                       
    }

    /**
     * Show Home
     *
     * @return \Illuminate\Http\Response
     */
    public function showHome() {
        return view('workshop.home');
    }
}
