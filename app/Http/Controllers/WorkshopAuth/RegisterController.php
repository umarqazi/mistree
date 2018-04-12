<?php

namespace App\Http\Controllers\WorkshopAuth;

use App\Events\NewWorkshopEvent;
use App\Jobs\MailJobRegister;
use App\Mail\WorkshopRegistrationMail;
use App\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Response;
use SoapClient;
use App\WorkshopAddress;
use App\WorkshopBalance;
use App\WorkshopImages;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use App\Service, View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use Config;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('workshop.guest');
    }

    /*Overwritten the Existing Register Function in RegistersUsers*/

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                           => 'required|string',
            'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
            'email'                          => 'required|email|unique:workshops',
            'password'                       => 'required|confirmed|min:6',
            'password_confirmation'          => 'required',
            'cnic'                           => 'required|regex:/^\d{5}-\d{7}-\d{1}$/u',
            'mobile'                         => 'required|regex:/^0?3\d{2}-\d{7}$/u',
            'landline'                       => 'regex:/^\d{7,14}$/u|nullable',
            'open_time'                      => 'required',
            'close_time'                     => 'required',
            'type'                           => 'required|in:Authorized,Unauthorized',
            'team_slots'                     => 'integer',
            'profile_pic'                    => 'image|mimes:jpg,png,jpeg',
            'cnic_image'                     => 'image|mimes:jpg,png,jpeg',
            'images.*'                       => 'image|mimes:jpg,png,jpeg',

            'shop'                           => 'nullable|regex:/^[a-zA-Z\s\/\-\d]+$/u',
            'building'                       => 'string|nullable',
            'block'                          => 'string|nullable',
            'street'                         => 'nullable|string',
            'town'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'city'                           => 'required|regex:/^[\pL\s\-]+$/u',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Workshop
     */
    protected function create(array $data)
    {
        if(env('APP_ENV') == "production"){
            $client     = new SoapClient('http://58.27.201.81:8090/WS_CarMaintenancePayment.asmx?wsdl');
            $workshopId = (int)$client->GetWorkShopId()->GetWorkShopIdResult;
        }else{
            $workshopId = null;
        }
        $workshop = Workshop::create([
            'name'          => $data['name'],
            'owner_name'    => $data['owner_name'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'cnic'          => $data['cnic'],
            'mobile'        => $data['mobile'],
            'type'          => $data['type'],
            'slots'         => $data['team_slot'],
            'open_time'     => $data['open_time'],
            'close_time'    => $data['close_time'],
            'is_approved'   => false,
            'workshopId'    => $workshopId

        ]);

        //Insert Address data from request
        $address = WorkshopAddress::create([
            'shop'          => $data['shop'],
            'building'      => $data['building'],
            'street'        => $data['street'],
            'block'         => $data['block'],
            'town'          => $data['town'],
            'city'          => $data['city'],
            'workshop_id'   => $workshop->id,
            'coordinates'   => NULL
        ]);

        if(!empty($data['hatchback'])){
            //Insert Hatchback Services data from request
            foreach($data['hatchback'] as $hatchback)
            {
                $workshop->services()->attach($hatchback, ['service_rate' => Input::get('hatchback-rates')[$hatchback] , 'service_time' => Input::get('hatchback-times')[$hatchback] ]);
            }
        }

        if(!empty($data['sedan'])){
            //Insert Sedan Services data from request
            foreach($data['sedan'] as $sedan)
            {
                $workshop->services()->attach($sedan, ['service_rate' => Input::get('sedan-rates')[$sedan]
                    , 'service_time' => Input::get('sedan-times')[$sedan] ]);
            }
        }

        if(!empty($data['luxury'])){
            //Insert Luxury Services data from request
            foreach($data['luxury'] as $luxury)
            {
                $workshop->services()->attach($luxury, ['service_rate' => Input::get('luxury-rates')[$luxury]
                    , 'service_time' => Input::get('luxury-times')[$luxury] ]);
            }
        }

        if(!empty($data['suv'])){
            //Insert Suv Services data from request
            foreach($data['suv'] as $suv)
            {
                $workshop->services()->attach($suv, ['service_rate' => Input::get('suv-rates')[$suv] , 'service_time' => Input::get('suv-times')[$suv] ]);
            }
        }

        $balance = new WorkshopBalance([ 'balance' => 0 ]);
        $workshop->balance()->save($balance);

        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;

        if (!empty($data['profile_pic']))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/logo')){
                $path = $workshops_path.$workshop->id.'/logo';
                mkdir($path, 0775, true);
            }
            $profile_pic =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/logo', new File($data['profile_pic']), 'public');

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

        if (!empty($data['cnic_image']))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/cnic')){
                $path = $workshops_path.$workshop->id.'/cnic';
                mkdir($path, 0775, true);
            }

            $cnic_image =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/cnic', new File($data['cnic_image']), 'public');
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

        if (!empty($data['images']))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/images')){
                $path = $workshops_path.$workshop->id.'/images';
                mkdir($path, 0775, true);
            }
            foreach($data['images'] as $file)
            {
                $images = new WorkshopImages;
                $image =  Storage::disk('public')->putFile('/'.$specified_workshop_path.'/images', new File($file), 'public');
                $images->url = url('/').'/'.$image;
                $images->workshop()->associate($workshop);
                $images->save();
            }
        }

        $subject = "Please verify your email address.";
        $verification_code = str_random(30); //Generate verification code
        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        $dataMail = [
            'subject' => $subject,
            'view' => 'workshop.emails.verify',
            'name' => $data['name'],
            'email' => $data['email'],
            'verification_code' => $verification_code,
        ];
        Mail::to($dataMail['email'], $dataMail['name'])->later(Carbon::now()->addMinutes(2), (new WorkshopRegistrationMail($dataMail))->onQueue('emails'));


        //Firing an Event to Generate Notifications
        event(new NewWorkshopEvent($workshop));

        return $workshop;
    }

    /**
     * API Resend Verification Email for Workshop, on success return Success Message
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/api/workshop/resendverification",
     *   summary="Workshop Resend Verification Code",
     *   operationId="resend_verification",
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
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function resendVerificationEmail()
    {
        $workshop   = JWTAuth::authenticate();

        $verification_code  = str_random(30);
        $code   = DB::table('workshop_verifications')->where('ws_id', $workshop->id)->first();

        if(!is_null($code))
        {
            DB::table('workshop_verifications')->where('ws_id', $workshop->id)->update(['token' => $verification_code]);
        }
        else
        {
            DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id, 'token'=>$verification_code]);
        }

        $dataMail = [
            'subject'   => 'Please verify your email address.',
            'view'      => 'workshop.emails.verify',
            'name'      => $workshop->name,
            'email'     => $workshop->email,
            'verification_code' => $verification_code,
        ];

        Mail::to($dataMail['email'], $dataMail['name'])->later(Carbon::now()->addMinutes(2), (new WorkshopRegistrationMail($dataMail))->onQueue('emails'));

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Please check your email address: '. $workshop->email .' to find the verification code.',
            'body'          => null
        ], Response::HTTP_OK);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $hatchback = Service::hatchback()->get();
        $sedan = Service::sedan()->get();
        $luxury = Service::luxury()->get();
        $suv = Service::suv()->get();
        return View::make('workshop.auth.register', ['hatchback' => $hatchback, 'sedan' => $sedan, 'luxury' => $luxury, 'suv' => $suv]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('workshop');
    }
}
