<?php

namespace App\Http\Controllers\WorkshopAuth;

use App\Events\NewWorkshopEvent;
use App\Workshop;
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
use Validator;
use App\Service, View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;

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
            'name'                           => 'required|regex:/^[\pL\s\-]+$/u',
            'owner_name'                     => 'required|regex:/^[\pL\s\-]+$/u',
            'email'                          => 'required|email|unique:workshops',
            'password'                       => 'required|confirmed|min:8',
            'password_confirmation'          => 'required',
            'cnic'                           => 'required|digits:15',
            'mobile'                         => 'required|digits:12',
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
            $client = new SoapClient('http://58.27.201.81:8090/WS_CarMaintenancePayment.asmx?wsdl');
            $jazz_cash = (int)$client->GetWorkShopId()->GetWorkShopIdResult;
        }else{
            $jazz_cash = null;
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
            'jazzcash_id'   => $jazz_cash

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

        //Insert Services data from request
        foreach($data['services'] as $service)
        {
            $workshop->services()->attach($service, ['service_rate' => Input::get('service-rates')[$service] , 'service_time' => Input::get('service-times')[$service] ]);
        }

        $balance = new WorkshopBalance([ 'balance' => 0 ]);
        $workshop->balance()->save($balance);

        $workshops_path = public_path().'/uploads/workshops/';
        $specified_workshop_path = 'uploads/workshops/'.$workshop->id;

        if (!empty($data['profile_pic']))
        {
            if(!Storage::disk('public')->has($specified_workshop_path.'/logo')){
                $path = $workshops_path.$workshop->id.'/logo';
                Storage::MakeDirectory($path, 0775, true);
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
                Storage::MakeDirectory($path, 0775, true);
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
                Storage::MakeDirectory($path, 0775, true);
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
        Mail::send('workshop.emails.verify', ['name' => $data['name'], 'verification_code' => $verification_code],
            function($mail) use ($data, $subject){
                $mail->from(Config::get('app.mail_username'), Config::get('app.name'));
                $mail->to($data['email'], $data['name']);
                $mail->subject($subject);
            });

        //Firing an Event to Generate Notifications
        event(new NewWorkshopEvent($workshop));

        return $workshop;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $services = Service::all(); 
        return View::make('workshop.auth.register', ['services' => $services]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        // Config::set('auth.providers.users.model', \App\Workshop::class);
        return Auth::guard('workshop');
    }
}
