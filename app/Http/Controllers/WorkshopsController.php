<?php

namespace App\Http\Controllers;

use JWTAuth;
use Hash, DB, Config, Mail, View;
use App\Workshop;
use App\Address;
use App\WorkshopSepcialty;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        return View::make('workshops.index')
            ->with('workshops', $workshops);
    }

    /**
     * Show the form for creating a new workshop.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('workshops.create');
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
            'name'              => 'required',
            'email'             => 'required|email|unique:workshops',
            'password'          => 'required|confirmed|min:6',
            'card_number'       => 'required|numeric|min:13',
            'con_number'        => 'required|numeric|min:11',            
            // 'status'            => 'required|alpha',            
            'address_type'      => 'required',
            'address_house_no'  => 'required',
            'address_street_no' => 'required',
            'address_block'     => 'required',
            'address_area'      => 'required',
            'address_town'      => 'required',
            'address_city'      => 'required',            
        ];        

        $input = $request->only('name', 'email', 'password', 'password_confirmation', 'card_number', 'con_number', 'address_type', 'address_house_no', 'address_street_no', 'address_block', 'address_area', 'address_town', 'address_city');
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
        $workshop = Workshop::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'card_number' => $request->card_number, 'con_number' => $request->con_number, 'type' => $request->type, 'profile_pic' => '', 'pic1' => '', 'pic2' => '', 'pic3' => '', 'team_slot' => $request->team_slot, 'open_time' => $request->open_time, 'close_time' => $request->close_time, 'status' => 1, 'is_approved' => 0]);        

        //Insert Address data from request
        $address = Address::create(['type' => $request->address_type, 'house_no' => $request->address_house_no, 'street_no' => $request->address_street_no, 'block' => $request->address_block, 'area' => $request->address_area, 'town' => $request->address_town, 'city' => $request->address_city, 'ws_id' => $workshop->id, 'cust_id' => '','admin_id' => '', 'geo_cord' => '' ]);

        //Insert Services data from request
        $services = $request->services;
        if(!empty($services)){
            foreach($services as $service){
                $speicality = new WorkshopSepcialty;

                $speicality->service_id = $service->service_id;
                $speicality->service_rate = $service->service_rate;
                $speicality->service_time = $service->service_time;
                $speicality->workshop_id = $workshop->id;

                $speicality->save();
            }
        }
        // return $this->login($request);
        $verification_code = str_random(30); //Generate verification code
        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::send('workshop.verify', ['name' => $request->name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "jazib.javed@gems.techverx.com");
                $mail->to($request->email, $request->name);
                $mail->subject($subject);
            });        
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
        return View::make('workshops.show')
            ->with('workshop', $workshop);
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
        return View::make('workshops.edit')
            ->with('workshop', $workshop);            
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
            'name'              => 'required',            
            'password'          => 'required|confirmed|min:6',
            'card_number'       => 'required|numeric|min:13',
            'con_number'        => 'required|numeric|min:11',                                                    
        ];  

        $input = $request->only('name', 'password', 'password_confirmation', 'card_number', 'con_number');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return Redirect::to('workshops/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } 

         // Update workshop
        $workshop = Workshop::find($id);

        $workshop->name             = Input::get('name');
        $workshop->password         = Input::get('password');
        $workshop->card_number      = Input::get('card_number');
        $workshop->con_number       = Input::get('con_number');
        $workshop->type             = Input::get('type');
        $workshop->profile_pic      = '';
        $workshop->pic1             = '';
        $workshop->pic2             = '';
        $workshop->pic3             = '';
        $workshop->team_slot        = Input::get('team_slot');
        $workshop->open_time        = Input::get('open_time');
        $workshop->close_time       = Input::get('close_time');
        $workshop->status           = 1;
        $workshop->save();                

        // redirect
        Session::flash('message', 'Successfully updated Workshop!');
        return Redirect::to('workshops');
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
     * API Register for new workshop.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name'              => 'required',
            'email'             => 'required|email|unique:workshops',
            'password'          => 'required|confirmed|min:6',
            'card_number'       => 'required|numeric|min:13',
            'con_number'        => 'required|numeric|min:11',                        
            'address_type'      => 'required',
            'address_house_no'  => 'required',
            'address_street_no' => 'required',
            'address_block'     => 'required',
            'address_area'      => 'required',
            'address_town'      => 'required',
            'address_city'      => 'required',            
        ];        

        $input = $request->only('name', 'email', 'password', 'password_confirmation', 'card_number', 'con_number', 'address_type', 'address_house_no', 'address_street_no', 'address_block', 'address_area', 'address_town', 'address_city');
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
        $workshop = Workshop::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'card_number' => $request->card_number, 'con_number' => $request->con_number, 'type' => $request->type, 'profile_pic' => '', 'pic1' => '', 'pic2' => '', 'pic3' => '', 'team_slot' => $request->team_slot, 'open_time' => $request->open_time, 'close_time' => $request->close_time, 'status' => 1, 'is_approved' => 0]);        

        //Insert Address data from request
        $address = Address::create(['type' => $request->address_type, 'house_no' => $request->address_house_no, 'street_no' => $request->address_street_no, 'block' => $request->address_block, 'area' => $request->address_area, 'town' => $request->address_town, 'city' => $request->address_city, 'ws_id' => $workshop->id, 'cust_id' => '','admin_id' => '', 'geo_cord' => '' ]);

        //Insert Services data from request
        $services = $request->services;
        if(!empty($services)){
            foreach($services as $service){
                $speicality = new WorkshopSepcialty;

                $speicality->service_id = $service->service_id;
                $speicality->service_rate = $service->service_rate;
                $speicality->service_time = $service->service_time;
                $speicality->workshop_id = $workshop->id;

                $speicality->save();
            }
        }
        // return $this->login($request);
        $verification_code = str_random(30); //Generate verification code
        DB::table('workshop_verifications')->insert(['ws_id'=>$workshop->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::send('workshop.verify', ['name' => $request->name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "jazib.javed@gems.techverx.com");
                $mail->to($request->email, $request->name);
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
     * API Login for workshop, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
  
    public function login(Request $request)
    {   
        $check = Workshop::select('is_approved')->where('email', $request->email)->get();
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
        if (!$user) {
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
            $workshop = Workshop::find($check->user_id);
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

    public function approveWorkshop($id){
        //Approve Workshop
        $workshop = Workshop::find($id);
        $workshop->is_approved       = 1;
        $workshop->save();

        // redirect
        Session::flash('message', 'Successfully Approved the Workshop!');
        return Redirect::to('workshops');


    }

    /**
     * API Register store data of new customer.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileUpdate(Request $request, $id, $address_id)
    {
        $request_workshop = $request->workshop;
        $workshop = Workshop::find($id);
        $workshop->fill($request_workshop);
        if($address_id != ''){
            $request_address = $request->address;
            $address = Address::find($id);
            $address->fill($request_address);
        }else{
            $rules = array(
                'address_type'          => 'required',
                'address_house_no'      => 'required',
                'address_street_no'     => 'required',
                'address_block'         => 'required',
                'address_area'          => 'required',
                'address_town'          => 'required',
                'address_city'          => 'required'
            );
            $validator = Validator::make($request->all(), $rules);

            // process the login
            if ($validator->fails()) {
                return response([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Invalid Details!',
                    'body' => $request->all()
                ],Response::HTTP_OK);
            } else {
                $address = new Address;
                $address->cust_id       =  '';
                $address->ws_id         =  $id;
                $address->admin_id      =  '';
                $address->type          =  $request->address_type;
                $address->house_no      =  $request->address_house_no;
                $address->street_no     =  $request->address_street_no;
                $address->block         =  $request->address_block;
                $address->area          =  $request->address_area;
                $address->town          =  $request->address_town;


                $address->city          =  $request->address_city;
                $address->status        = 1;
                $address->save(); 
            }
        }
        //address   
        return response([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Details Added!',
            'body' => ''
        ],Response::HTTP_OK);
    }
}
