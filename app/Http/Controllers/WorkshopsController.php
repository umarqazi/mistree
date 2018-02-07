<?php

namespace App\Http\Controllers;

use JWTAuth;
use Hash, DB, Config, Mail;
use App\Workshop;
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
        //
    }

    /**
     * Show the form for creating a new workshop.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created workshop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified workshop.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified workshop.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified workshop from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            'name' => 'required',
            'email' => 'required|email|unique:workshops',
            'password' => 'required|confirmed|min:6',
        ];
        $input = $request->only('name', 'email', 'password', 'password_confirmation');
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
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $workshop = Workshop::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'card_number' => '', 'con_number' => '', 'type' => '', 'profile_pic' => '', 'pic1' => '', 'pic2' => '', 'pic3' => '', 'geo_cord'=> '', 'team_slot' =>'', 'open_time' => '', 'close_time' => '', 'status' => 1]);
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
     * API Login for workshop, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
  
    public function login(Request $request)
    {
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
}
