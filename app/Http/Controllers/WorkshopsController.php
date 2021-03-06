<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Events\InformApprovalEvent;
use App\Events\NewWorkshopEvent;
use App\Mail\WorkshopConfirmationMail;
use App\Mail\WorkshopRegistrationMail;
use JWTAuth;
use SoapClient;
use Session;
use Carbon\Carbon;
use Hash, DB, Config, Mail, View;
use Illuminate\Support\Facades\Redirect;
use App\Workshop;
use App\WorkshopImages;
use App\Service;
use App\Booking;
use App\Category;
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
use Tymon\JWTAuth\Exceptions\JWTException;

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

    public function frontPage(){
        return View::make('landing_page.index');
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
        $hatchback = Service::hatchback()->get();
        $sedan = Service::sedan()->get();
        $luxury = Service::luxury()->get();
        $suv = Service::suv()->get();
        return View::make('workshop.create', ['hatchback' => $hatchback, 'sedan' => $sedan, 'luxury' => $luxury, 'suv' => $suv]);
    }

    /**
     * Store a newly created workshop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only('name', 'owner_name', 'email', 'password', 'password_confirmation', 'cnic',
            'mobile', 'landline','open_time', 'close_time', 'type', 'shop', 'building', 'block', 'street', 'town', 'city');
        $validator = validate_inputs($request, $input);
        if($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput(Input::except('password','password_confirmation'));
        }

        if(env('APP_ENV') == "production"){
            $client     = new SoapClient('http://58.27.201.81:8090/WS_CarMaintenancePayment.asmx?wsdl');
            $workshopId = (int)$client->GetWorkShopId()->GetWorkShopIdResult;
        }else{
            $workshopId = null;
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
            'workshopId'   => $workshopId
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

        if($request->hatchback){
            //Insert Services data from request
            foreach($request->hatchback as $hatchback)
            {
                $workshop->services()->attach($hatchback, ['service_rate' => Input::get('hatchback-rates')[$hatchback] , 'service_time' => Input::get('hatchback-times')[$hatchback] ]);
            }
        }

        if($request->sedan){
            //Insert Services data from request
            foreach($request->sedan as $sedan)
            {
                $workshop->services()->attach($sedan, ['service_rate' => Input::get('sedan-rates')[$sedan]
                    , 'service_time' => Input::get('sedan-times')[$sedan] ]);
            }
        }

        if($request->luxury){
            //Insert Services data from request
            foreach($request->luxury as $luxury)
            {
                $workshop->services()->attach($luxury, ['service_rate' => Input::get('luxury-rates')[$luxury]
                    , 'service_time' => Input::get('luxury-times')[$luxury] ]);
            }
        }

        if($request->suv){
            //Insert Services data from request
            foreach($request->suv as $suv)
            {
                $workshop->services()->attach($suv, ['service_rate' => Input::get('suv-rates')[$suv] , 'service_time' => Input::get('suv-times')[$suv] ]);
            }
        }

        $balance = new WorkshopBalance([ 'balance' => 0 ]);
        $workshop->balance()->save($balance);

        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;

        if ($request->hasFile('profile_pic'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/logo')){
                $path = $workshops_path.$workshop->id.'/logo';
                mkdir($path, 0775, true);
            }
            $profile_pic =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/logo', new File($request->profile_pic), 'public');

            $profile_pic = url('/').'/'.$profile_pic;
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
            if(!Storage::disk('public')->has($specified_workshop_path.'/cnic')){
                $path = $workshops_path.$workshop->id.'/cnic';
                mkdir($path, 0775, true);
            }

            $cnic_image =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/cnic', new File($request->cnic_image), 'public');
            $cnic_image =  url('/').'/'.$cnic_image;
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
            if(!Storage::disk('public')->has($specified_workshop_path.'/images')){
                $path = $workshops_path.$workshop->id.'/images';
                mkdir($path, 0775, true);
            }
            foreach($request->file('images') as $file)
            {
                $images = new WorkshopImages;
                $image =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/images', new File($file), 'public');
                $images->url = url('/').'/'.$image;
                $images->workshop()->associate($workshop);
                $images->save();
            }
        }

        $verification_code = str_random(30); //Generate verification code         
        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        $dataMail = [
            'subject' => 'Please verify your email address.',
            'view' => 'workshop.emails.verify',
            'name' => $request->name,
            'email' => $request->email,
            'verification_code' => $verification_code,
        ];
        Mail::to($dataMail['email'], $dataMail['name'])->send(new WorkshopRegistrationMail($dataMail));
        if(Auth::guard('admin')->user())
        {
            return Redirect::to('admin/workshops')->with('message', 'Success! Workshop Created.');
        }
        else
        {
            return Redirect::to('/home')->with('message', 'Success! Workshop Created.');
        }
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
        $leads           = $workshop->bookings;
        $completed_leads = $workshop->bookings()->completedbookings()->get();
        $accepted_leads  = $workshop->bookings()->acceptedbookings()->get();
        $expired_leads   = $workshop->bookings()->expiredbookings()->get();
        $rejected_leads  = $workshop->bookings()->rejectedbookings()->get();
        $total_revenue   = $workshop->revenue;
        $current_balance = $workshop->balance->balance;

        if(count($leads)){
            $customers = $workshop->bookings()->pluck('customer_id')->toArray();
            $customers = array_unique($customers);
            $leads_count     = count($leads);
            $customer_count  = count($customers);
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
        if(count($expired_leads)){
            $expired_leads  = count($expired_leads);
        }else{
            $expired_leads  = 0;
        }

        // show the view and pass the workshop to it
        return View::make('workshop.show', ['workshop' => $workshop, 'leads_count' => $leads_count, 'accepted_leads'=>
            $accepted_leads, 'rejected_leads'=> $rejected_leads , 'completed_leads'=> $completed_leads,
            'customer_count'=> $customer_count, 'revenue' => $total_revenue, 'balance' => $current_balance ,'expired_leads'=> $expired_leads]);
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
        $request->offsetSet('id', $id);
        $input = $request->only('name', 'owner_name', 'email', 'cnic', 'mobile', 'landline','open_time', 'close_time', 'type', 'shop', 'building', 'block', 'street', 'town', 'city');
        $validator = validate_inputs($request, $input);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return Redirect::back()
                ->withErrors($validator);
        }

        // Update workshop
        $workshop = Workshop::find($id);
        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;

        if ($request->hasFile('profile_pic'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/logo')){
                $path = $workshops_path.$workshop->id.'/logo';
                mkdir($path, 0775, true);
            }

//          Unlink Image(Remove Previous Image from Directory)
                $this->unlinkImage($workshop->profile_pic);

            $profile_pic =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/logo', new File($request->profile_pic), 'public');

            $profile_pic = asset($profile_pic);
        }
        else
        {
            $profile_pic         =  $workshop->profile_pic;
        }


        if ($request->hasFile('cnic_image'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/cnic')){
                $path = $workshops_path.$workshop->id.'/cnic';
                mkdir($path, 0775, true);
            }

//          Unlink Image(Remove Previous Image from Directory)
            $this->unlinkImage($workshop->cnic_image);

            $cnic_image =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/cnic', new File($request->cnic_image), 'public');
            $cnic_image =  asset($cnic_image);
        }
        else
        {
            $cnic_image         =  $workshop->cnic_image;
        }

        $workshop->name             = Input::get('name');
        $workshop->owner_name       = Input::get('owner_name');
        $workshop->email            = Input::get('email');
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
        if(is_null($workshop->address)){
            $address = new WorkshopAddress;
            $address->workshop_id      = $workshop->id;
        }else{
            $address = WorkshopAddress::find($workshop->address->id);
        }
        $address->shop              = Input::get('shop');
        $address->building          = Input::get('building');
        $address->street            = Input::get('street');
        $address->block             = Input::get('block');
        $address->town              = Input::get('town');
        $address->city              = Input::get('city');
        $address->save();

        if($request->hasFile('images'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/images')){
                $path = $workshops_path.$workshop->id.'/images';
                mkdir($path, 0775, true);
            }

            foreach($request->file('images') as $key=>$value)
            {
                $image = WorkshopImages::find($key);

//              Unlink Image(Remove Previous Image from Directory)
                $this->unlinkImage($image->url);

                $file =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/images', new File($value), 'public');

                $image->url            = asset($file);
                $image->workshop_id    = $workshop->id;
                $image->save();
            }
        }

        if ($request->hasFile('images_new'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/images')){
                $path = $workshops_path.$workshop->id.'/images';
                mkdir($path, 0775, true);
            }

            foreach($request->file('images_new') as $value)
            {
                $image = new WorkshopImages();
                $file =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/images', new File($value), 'public');

                $image->url            = asset($file);
                $image->workshop_id    = $workshop->id;
                $image->save();
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

    public function pending_workshops()
    {
        $workshops = Workshop::where('is_approved',false)->orderBy('created_at', 'desc')->get();
        return View::make('workshop.pending')->with('workshops', $workshops);;
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
     *     description="format : 09:00:00",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="close_time",
     *     in="formData",
     *     description="format : 022:00:00",
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
        $input = $request->only('name', 'owner_name', 'email', 'password', 'password_confirmation', 'cnic', 'mobile', 'landline','open_time', 'close_time', 'type', 'team_slots');
        $validator = validate_inputs($request, $input);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ],Response::HTTP_OK);
        }

        if(env('APP_ENV') == "production"){
            $client     = new SoapClient('http://58.27.201.81:8090/WS_CarMaintenancePayment.asmx?wsdl');
            $workshopId = $client->GetWorkShopId()->GetWorkShopIdResult;
        }else{
            $workshopId = null;
        }

        //Insert Workshop data from request 
        $workshop = Workshop::create([
            'name'          => $request->name,
            'owner_name'    => $request->owner_name ,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'cnic'          => $request->cnic,
            'mobile'        => $request->mobile,
            'landline'      => $request->landline,
            'type'          => $request->type,
            'slots'         => $request->team_slots,
            'open_time'     => $request->open_time,
            'close_time'    => $request->close_time,
            'is_approved'   => 0,
            'workshopId'    => $workshopId
        ]);

        //By Default Inserting Workshop Balance 2000
        $workshop_balance = new WorkshopBalance;
        $workshop_balance->balance              = 0;
        $workshop_balance->workshop_id          = $workshop->id;
        $workshop_balance->save();

        //Insert Services data from request
        $services = json_decode($request->services);
        if(count($services) > 0){
            foreach($services as $service){
                $workshop->services()->attach($service->service_id,['service_rate' => $service->service_rate, 'service_time' => $service->service_time]);
            }
        }

        $name = $request->name;
        $email = $request->email;
        $verification_code = str_random(30); //Generate verification code

        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        $dataMail = [
            'subject' => 'Please verify your email address.',
            'view' => 'workshop.emails.verify',
            'name' => $request->name,
            'email' => $request->email,
            'verification_code' => $verification_code,
        ];
        Mail::to($dataMail['email'], $dataMail['name'])->send(new WorkshopRegistrationMail($dataMail));

        //Firing an Event to Generate Notifications
        event(new NewWorkshopEvent($workshop));

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        Config::set('auth.providers.users.model', \App\Workshop::class);
        $token = JWTAuth::attempt($credentials);

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Thanks for signing up! Please check your email to complete your registration.',
            'body' => ['token'=>$token]
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
     *   @SWG\Parameter(
     *     name="fcm_token",
     *     in="formData",
     *     description="Workshop Firebase Token",
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

        if(!is_null($workshop->jwt_token))
        {
            try{
                JWTAuth::invalidate($workshop->jwt_token);
            }
            catch (JWTException $exception)
            {
                // do nothing, exception is just what we want to do.
            }
        }

        /* Update Customer FCM Token */
        if($request->has('fcm_token')){
            $workshop->fcm_token = $request->fcm_token;
        }

        $workshop->jwt_token    = $token;
        $workshop->update();

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
            $workshop = JWTAuth::authenticate();
            $workshop->fcm_token = null;
            $workshop->save();
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
            'body' => null
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

            return View::make('workshop.thankyou')->with('message', 'Thank You For Verifying Your Email.');
        }

        return View::make('workshop.thankyou')->with('message', 'Verification code is either invalid or expired.');
    }

    public function changePassword()
    {
        return View::make('workshop_profile.change-password');
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
            'password'  => 'required|confirmed|min:6|max:16',
        ];

        $input = $request->only('prev_password','password', 'password_confirmation');
        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            $request->offsetUnset('prev_password');
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
            if($request->header('Content-Type') == "application/json")
            {
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages()->first(),
                    'body' => null
                ],Response::HTTP_OK);
            }
            else
            {
                return Redirect::back()
                    ->withErrors($validator);
            }
        }
        else
        {
            if($request->header('Content-Type') == "application/json")
            {
                $workshop   = JWTAuth::authenticate();
            }
            else
            {
                $workshop   = Auth::guard('workshop')->user();
            }

            if (!Hash::check($request->prev_password, $workshop->password)) {
                $request->offsetUnset('prev_password');
                $request->offsetUnset('password');
                $request->offsetUnset('password_confirmation');
                if($request->header('Content-Type') == "application/json")
                {
                    return response()->json([
                        'http-status' => Response::HTTP_OK,
                        'status' => false,
                        'message' => 'Your provided password didn\'t match.',
                        'body' => null
                    ],Response::HTTP_OK);
                }
                else
                {
                    return Redirect::back()
                        ->withErrors($validator->getMessageBag()->add('prev_password','Your provided password didn\'t match.'));
                }
            }

            // all good so Reset Customer's Password
            $workshop->password = Hash::make($request->password);
            $workshop->update();

            if($request->header('Content-Type') == "application/json")
            {
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Success! Your password has been changed',
                    'body' => null
                ],Response::HTTP_OK);
            }
            else
            {
                Session::flash('message', 'Success! Your password has been changed');
                return Redirect::to('/profile');
            }
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
        $workshop->is_approved       = true;
        $workshop->save();
        event(new InformApprovalEvent($workshop));
        $dataMail = [
            'subject' => 'Conragulations! Your workshop has been approved by Admin.',
            'view' => 'workshop.emails.confirmationEmail',
            'name' => $workshop->name,
            'email' => $workshop->email,
        ];
        Mail::to($dataMail['email'], $dataMail['name'])->send(new WorkshopConfirmationMail($dataMail));
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
     * @SWG\Patch(
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
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="owner_name",
     *     in="formData",
     *     description="Owner Name",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="mobile",
     *     in="formData",
     *     description="Workshop Mobile Number",
     *     required=false,
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
     *     required=false,
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
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="close_time",
     *     in="formData",
     *     description="Workshop Closing Time",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="_method",
     *     in="formData",
     *     description="Always give Patch",
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
        $input = $request->all();
        $validator = validate_inputs($request, $input);
        if($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ],Response::HTTP_OK);
        }
        $workshop = JWTAuth::authenticate();

        if($request->has('name')){
            $workshop->name             = $request->name;
        }

        if($request->has('owner_name')){
            $workshop->owner_name       = $request->owner_name;
        }

        if($request->has('team_slots')){
            $workshop->slots            = $request->team_slots;
        }

        if($request->has('mobile')){
            $workshop->mobile           = $request->mobile;
        }

        if($request->has('landline')){
            $workshop->landline         = $request->landline;
        }

        if($request->has('open_time')){
            $workshop->open_time        = $request->open_time;
        }
        if($request->has('close_time')){
            $workshop->close_time       = $request->close_time;
        }

        if($request->has('type')) {
            $workshop->type = $request->type;
        }
        $workshop->save();

        return response([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Details Updated!',
            'body' => $workshop
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
        $workshop = Workshop::find($workshop_service->workshop_id);
        return View::make('workshop.services.edit')->with('workshop_service', $workshop_service)->with('workshop', $workshop)->with('services',$services);

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
        Session::flash('message', 'Service Updated Successfully!');
        return Redirect::to('admin/workshops/'.$request->workshop_id);

    }

    /**
     *  Add Workshop Service
     *
     * @param $workshop
     * @return \Illuminate\Http\JsonResponse
     */
    public function addWorkshopService(Workshop $workshop){
        $categories = Category::all();
        return View::make('workshop.services.add')->with('workshop', $workshop)->with('categories', $categories);

    }

    /**
     *  Add Workshop Service
     *
     * @param $workshop
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryServices(){
        $category = $_POST['category'];
        $workshop = $_POST['workshop'];
        $workshop = Workshop::find($workshop)->load('services');
        $services = $workshop->services()->pluck('service_id')->toArray();
        $filtered_services = json_encode(Service::where('category_id', $category)->whereNotIn('id', $services)->get
        ());
        echo $filtered_services;
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
        Session::flash('message', 'Service Added Successfully!');
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

        $customers = Customer::whereIn('id', $workshop->bookings()->pluck('customer_id')->toArray())->get()->load('cars','addresses');
        return View::make('workshop.customers', ['customers' => $customers]);
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

    public function searchWorkshop(Request $request)
    {
        $customer       = JWTAuth::authenticate();
        $customer_addresses = $customer->addresses;
        $workshops      = Workshop::where('is_verified', true)->where('is_approved', true)->with('address', 'balance');

        if ($request->has('name')) {
            $workshops  = $workshops->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->has('type')) {
            $workshops  = $workshops->where('type', $request->type);
        }
        if ($request->has('booking_time')) {
            $workshops  = $workshops->where('open_time','<=',$request->booking_time) ->where('close_time','>=',$request->booking_time);
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
        if ($request->has('service_ids')) {
            $workshops = Workshop::get_workshop_by_service_ids($workshops, $request->service_ids);
        }
        $workshops1 = $workshops;
        $workshops_with_out_address = $workshops->get()->sortByDesc('rating');
        $workshops     = Workshop::get_workshop_by_customer_addresses( $workshops1, $customer_addresses);
        $workshops_with_address     = $workshops->get()->sortByDesc('rating');
        $workshops     = $workshops_with_address->merge($workshops_with_out_address);

        foreach ($workshops as $key => $workshop) {
            $workshops[$key]->est_rates = $workshop->sumOfServiceRates($workshop);
        }
        if(count($workshops)){
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => '',
                'body' => ['workshops' => $workshops],
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'No workshops found.',
                'body' => null,
            ],Response::HTTP_OK);
        }
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
            'body'          => ['workshop' => JWTAuth::authenticate()]
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
            'body'          => null
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
            'body'          => null
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
            'body'          => ['services' => $workshop->services]
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
        return View::make('workshop_profile.edit')->with('workshop', $workshop)->with('services',$services)->with('images', $workshop->images);
    }

    public function update_profile(Request $request, $id)
    {
        $input = $request->only('name', 'owner_name', 'mobile', 'landline','open_time', 'close_time', 'type',
            'shop', 'building', 'block', 'street', 'town', 'city');
        $validator = validate_inputs($request, $input);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return Redirect::back()
                ->withErrors($validator);
        }

        // Update workshop
        $workshop = Workshop::find($id);
        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;
        if ($request->hasFile('profile_pic'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/logo')){
                $path = $workshops_path.$workshop->id.'/logo';
                mkdir($path, 0775, true);
            }

//          Unlink Image(Remove Previous Image from Directory)
            $this->unlinkImage($workshop->profile_pic);

            $profile_pic =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/logo', new File($request->profile_pic), 'public');

            $profile_pic = asset($profile_pic);
        }
        else
        {
            $profile_pic         =  $workshop->profile_pic;
        }


        if ($request->hasFile('cnic_image'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/cnic')){
                $path = $workshops_path.$workshop->id.'/cnic';
                mkdir($path, 0775, true);
            }

//          Unlink Image(Remove Previous Image from Directory)
            $this->unlinkImage($workshop->cnic_image);

            $cnic_image =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/cnic', new File($request->cnic_image), 'public');
            $cnic_image =  asset($cnic_image);
        }
        else
        {
            $cnic_image         =  $workshop->cnic_image;
        }

        $workshop->name             = Input::get('name');
        $workshop->owner_name       = Input::get('owner_name');
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
        if(is_null($workshop->address)){
            $address                        = new WorkshopAddress;
            $address->workshop_id           = $workshop->id;
        }else{
            $address = WorkshopAddress::find($workshop->address->id);
        }
        $address->shop              = Input::get('shop');
        $address->building          = Input::get('building');
        $address->street            = Input::get('street');
        $address->block             = Input::get('block');
        $address->town              = Input::get('town');
        $address->city              = Input::get('city');
        $address->save();

        if($request->hasFile('images'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/images')){
                $path = $workshops_path.$workshop->id.'/images';
                mkdir($path, 0775, true);
            }

            foreach($request->file('images') as $key=>$value)
            {
                $image = WorkshopImages::find($key);

//              Unlink Image(Remove Previous Image from Directory)
                $this->unlinkImage($image->url);

                $file =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/images', new File($value), 'public');

                $image->url            = asset($file);
                $image->workshop_id    = $workshop->id;
                $image->save();
            }
        }

        if ($request->hasFile('images_new'))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/images')){
                $path = $workshops_path.$workshop->id.'/images';
                mkdir($path, 0775, true);
            }

            foreach($request->file('images_new') as $value)
            {
                $image = new WorkshopImages();
                $file =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/images', new File($value), 'public');

                $image->url            = asset($file);
                $image->workshop_id    = $workshop->id;
                $image->save();
            }
        }

        Session::flash('message', 'Success! Workshop Updated');
        return Redirect::to('/profile');
    }

    public function addProfileService($workshop){
        $workshop = Workshop::find($workshop);
        $categories = Category::all();
        return View::make('workshop_profile.services.add')->with('workshop', $workshop)->with('categories',$categories);
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
        Session::flash('message','Service Added Successfully');
        return Redirect::to('profile/add-profile-service/'.$workshop->id);
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
        Session::flash('message','Service Updated Successfully');
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
        $transaction->transaction_type              = 'Admin Top-Up';
        $transaction->unadjusted_balance            = $balance;
        $transaction->adjusted_balance              = $new_balance;

        $transaction->save();

        Session::flash('message', 'PKR '.$request->amount .' has been topped up to '.$workshop->name);
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

        $expired_leads   = Booking::where('workshop_id', $workshop->id)->where('job_status','expired')->get();

        $rejected_leads  = Booking::where('workshop_id', $workshop->id)->where('is_accepted',0)->get();
        $total_revenue   = $workshop->revenue;
        $current_balance = $workshop->balance->balance;


        if(count($leads)){
            $customer_ids  = [];
            foreach($leads as $lead){
                if(!is_null($lead->customer)){
                    array_push($customer_ids, $lead->customer->id);
                }
            }
            $customer_ids = array_unique($customer_ids);
            $leads_count     = count($leads);
            $customer_count  = count($customer_ids);
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
        if(count($expired_leads)){
            $expired_leads  = count($expired_leads);
        }else{
            $expired_leads  = 0;
        }

        return view('workshop_profile.home')->with(['leads_count' => $leads_count,'accepted_leads'=>
            $accepted_leads,'rejected_leads'=> $rejected_leads ,'completed_leads'=> $completed_leads,
            'customer_count'=> $customer_count, 'revenue' => $total_revenue, 'balance' => $current_balance ,'expired_leads'=> $expired_leads ]);

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
            'body' => ['address' => $workshop->address]
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

        $input = $request->only('shop', 'building', 'block', 'street', 'town', 'city');
        $validator = validate_inputs($request, $input);
        // process the login
        if ($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ],Response::HTTP_OK);
        }

        if (is_null($address)) {
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
            'body' => ['workshop' => $workshop ]
        ],Response::HTTP_OK);
    }

    /**
     * @SWG\Post(
     *   path="/api/workshop/update-image",
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
     *     name="workshop_image",
     *     in="formData",
     *     description="Base64 Image",
     *     required=true,
     *     type="string",
     *   ),
     *   @SWG\Parameter(
     *     name="old_url",
     *     in="formData",
     *     description="Old Url of image",
     *     required=false,
     *     type="string",
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
        $workshop = JWTAuth::authenticate();
        $workshop_id = $workshop->id;
        $image = $request->workshop_image;
        $old_url = $request->old_url;

        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;

        if(!Storage::disk('public')->has($specified_workshop_path.'/images')){
            $path = $workshops_path.$workshop->id.'/images';
            mkdir($path, 0775, true);
        }

        $full_path = $workshops_path.$workshop->id.'/images/'.md5(microtime()).".jpg";
        if( (empty($old_url)) && (!empty($image)) ){
            $url = $this->upload_image($image,$workshop_id,$full_path);
            $url = url('/').'/'.$specified_workshop_path.'/images/'.basename($url);
            $workshop_image = new WorkshopImages;
            $workshop_image->url            = $url;
            $workshop_image->workshop_id    = $workshop_id;
            $workshop_image->save();

        }elseif( (!empty($old_url)) && (!empty($image)) ){
            $url = $this->upload_image($image,$workshop_id,$full_path);
            $url = url('/').'/'.$specified_workshop_path.'/images/'.basename($url);
            WorkshopImages::where('url', $old_url)
                ->where('workshop_id',$workshop_id)
                ->update(['url' => $url]);

//          Unlink Image(Remove Previous Image from Directory)
            $this->unlinkImage($old_url);
        }

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Image Uploaded Successfully!',
            'body' => ['image' => $url]
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

        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;

        if(!Storage::disk('public')->has($specified_workshop_path.'/logo')){
            $path = $workshops_path.$workshop->id.'/logo';
            mkdir($path, 0775, true);
        }

//      Unlink Image(Remove Previous Image from Directory)
        $this->unlinkImage($workshop->profile_pic);

        $full_path = $workshops_path.$workshop->id.'/logo/'.md5(microtime()).".jpg";
        $url = $this->upload_image($file_data,$workshop->id,$full_path);
        $url = url('/').'/'.$specified_workshop_path.'/logo/'.basename($url);
        $profile_image = $workshop->update(['profile_pic' => $url]);

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Profile Image Uploaded',
            'body' => ['profile_picture' => $url]
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

        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;

        if(!Storage::disk('public')->has($specified_workshop_path.'/cnic')){
            $path = $workshops_path.$workshop->id.'/cnic';
            mkdir($path, 0775, true);
        }

//      Unlink Image(Remove Previous Image from Directory)
        $this->unlinkImage($workshop->cnic_image);

        $full_path = $workshops_path.$workshop->id.'/cnic/'.md5(microtime()).".jpg";
        $url = $this->upload_image($file_data,$workshop->id,$full_path);
        $url = url('/').'/'.$specified_workshop_path.'/cnic/'.basename($url);
        $cnic_image = $workshop->update(['cnic_image' => $url]);

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'CNIC Image Uploaded',
            'body' => ['cnic_image' => $url]
        ],Response::HTTP_OK);
    }

    public function upload_image($file_data , $workshop_id, $full_path){
        $file   = fopen($full_path, "wb");
        fwrite($file, base64_decode($file_data));
        fclose($file);
        return $full_path;
    }


    /**
     * @SWG\Get(
     *   path="/api/workshop/ledger/",
     *   summary="Workshop Legder",
     *   operationId="get",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="from",
     *     in="query",
     *     description="From Date",
     *     required=true,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="to",
     *     in="query",
     *     description="To Date",
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
        if($request->header('Content-Type') == 'application/json'){
            $workshop   = JWTAuth::authenticate();
            $from = $request->from;
            $to = $request->to;
            $transactions = WorkshopLedger::where('workshop_id', $workshop->id)->whereBetween('created_at', [$from." 00:00:00", $to." 23:59:59"])->get();
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Workshop Ledger',
                'body' => ['transactions' => $transactions, 'balance'=> $workshop->balance->balance ]
            ],Response::HTTP_OK);
        }else{
            $workshop = Auth::guard('workshop')->user()->load('transactions','balance');
            $total_earning = $workshop->billings->sum('amount');
            return view::make('workshop_profile.ledger')->with('workshop',$workshop)->with('total_earning', $total_earning);
        }
    }

    public function workshopLedger(Workshop $workshop){
        $workshop->load(['transactions' => function($query){
            return $query->parentLevel()->get();
        },'balance']);
        return view::make('workshop.ledger')->with('workshop',$workshop);
    }

    public function ledgerAdjustment(Request $request){
        $ledger = WorkshopLedger::find($request->ledger);
        $workshop = Workshop::find($ledger->workshop_id);
        if(!is_null($workshop->balance)){
            $balance = $workshop->balance->balance;
        }else{
            $balance = 0;
        }
        if($request->transaction_type == "Credit"){
            $new_balance = $balance + $request->amount;
        }else{
            $new_balance = $balance - $request->amount;
        }
        $workshop->balance->update(['balance'=>$new_balance]);

        $transaction = new WorkshopLedger;
        $transaction->workshop_id                   = $workshop->id;
        $transaction->amount                        = $request->amount;
        $transaction->transaction_type              = $request->transaction_type;
        $transaction->unadjusted_balance            = $balance;
        $transaction->adjusted_balance              = $new_balance;
        $transaction->transaction_parent            = $request->ledger;
        $transaction->save();

        return Redirect::back();
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
            'body' => ['customers' => Customer::whereIn('id', $bookings)->get()]
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

    public function workshop_gallery(){
        $workshop = Auth::guard('workshop')->user();
        return view::make('workshop_profile.gallery')->with('images', $workshop->images)->with('workshop', $workshop);
    }

    /**
     * @SWG\Post(
     *   path="/api/topup",
     *   summary="Update Workshop Topup",
     *   operationId="post_jazz_cash_topup",
     *   produces={"application/json"},
     *   tags={"Topup"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="customerId",
     *     in="formData",
     *     description="Customer ID",
     *     required=true,
     *     type="integer"
     *   ),
     *    @SWG\Parameter(
     *     name="amount",
     *     in="formData",
     *     description="Topup Amount",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=401, description="unauthorized"),
     *   @SWG\Response(response=404, description="not found"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     * Updating Workshop Topup.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jazzCashTopup(Request $request)
    {
        $rules = [
            'customerId'    => 'required|integer',
            'amount'        => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'http-status'   => Response::HTTP_NOT_ACCEPTABLE,
                'status'        => "NOT_ACCEPTABLE",
                'errors'        => $validator->messages()->first()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        $workshop = Workshop::where('workshopId',$request->customerId)->first();
        if(is_null($workshop))
        {
            return response()->json([
                'http-status'   => Response::HTTP_NOT_FOUND,
                'status'        => "NOT_FOUND",
            ], Response::HTTP_NOT_FOUND);
        }


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
        $transaction->workshop_id                   = $workshop->id;
        $transaction->transaction_type              = 'Top-Up';
        $transaction->unadjusted_balance            = $balance;
        $transaction->adjusted_balance              = $new_balance;

        $transaction->save();

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => "OK",
            'response'      => "The Workshop balance has been topped up with amount Rs.".$request->amount
        ], Response::HTTP_OK);
    }

    public function editWorkshopPassword(Workshop $workshop)
    {
        return View::make('workshop.editpassword')->with('workshop', $workshop);
    }

    public function updateWorkshopPassword(Request $request)
    {
        $rules = [
            'password'  => 'required|confirmed|min:6|max:16',
        ];

        $input = $request->only('password', 'password_confirmation');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
            return Redirect::back()
                ->withErrors($validator);
        }

        // Update workshop Password
        $workshop = Workshop::find($request->workshop_id);
        $workshop->password = Hash::make($request->password);
        $workshop->update();

        Session::flash('message', 'Success! Workshop Password Updated');
        return Redirect::to('admin/workshops');
    }

    public function unlinkImage($url)
    {
        if (strpos($url,'uploads/workshops'))
        {
            $path = str_replace(url('/').'/','',$url);
            unlink($path);
        }
    }

    /**
     * @SWG\Patch(
     *   path="/api/workshop/contact-info",
     *   summary="Update Workshop Contact Number",
     *   operationId="Update Contact",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="landline",
     *     in="formData",
     *     description="Landline Number",
     *     required=false,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="mobile",
     *     in="formData",
     *     description="Mobile Number",
     *     required=false,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="owner_name",
     *     in="formData",
     *     description="Owner Name",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=401, description="unauthorized"),
     *   @SWG\Response(response=404, description="not found"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function updateDetails(Request $request)
    {
        $rules = [
            'mobile'                         => 'sometimes|required|regex:/^0?3\d{2}-\d{7}$/u',
            'landline'                       => 'sometimes|regex:/^\d{7,14}$/u|nullable',
            'owner_name'                     => 'sometimes|required|regex:/^[\pL\s\-]+$/u'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages()->first(),
                'body' => null
            ], Response::HTTP_OK);
        }

        $workshop = JWTAuth::authenticate();

        if($request->has('mobile'))
        {
            $workshop->update(['mobile' => $request->mobile]);
        }
        if($request->has('landline'))
        {
            $workshop->update(['landline' => $request->landline]);
        }
        if($request->has('owner_name'))
        {
            $workshop->update(['owner_name' => $request->owner_name]);
        }

        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Successfully Updated',
            'body' => ['workshop' => $workshop ]
        ], Response::HTTP_OK);
    }

    public function topupDetails(){
        $transactions = WorkshopLedger::where('transaction_type','Top-Up')->get()->load('workshop');
        return View::make('admin.topup.topup_details')->with('transactions', $transactions);
    }
}


