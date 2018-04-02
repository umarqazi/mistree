<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Customer;
use App\Mail\CustomerRegistrationMail;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/customer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.guest');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Customer
     */
    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * API Resend Verification Email for Customer, on success return Success Message
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/api/customer/resendverification",
     *   summary="Customer Resend Verification Code",
     *   operationId="resend_verification",
     *   produces={"application/json"},
     *   tags={"Customers"},
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
        $customer   = JWTAuth::authenticate();

        $verification_code  = str_random(30);
        $code   = DB::table('customer_verifications')->where('cust_id', $customer->id)->first();

        if(!is_null($code))
        {
            DB::table('customer_verifications')->where('cust_id', $customer->id)->update(['token' => $verification_code]);
        }
        else
        {
            DB::table('customer_verifications')->insert(['cust_id'=>$customer->id, 'token'=>$verification_code]);
        }

        $dataMail = [
            'subject'   => 'Please verify your email address.',
            'view'      => 'customer.verify',
            'name'      => $customer->name,
            'email'     => $customer->email,
            'verification_code' => $verification_code,
        ];

        Mail::to($dataMail['email'], $dataMail['name'])->later(Carbon::now()->addMinutes(2), (new CustomerRegistrationMail($dataMail))->onQueue('emails'));

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Please check your email address: '. $customer->email .' to find the verification code.',
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
        return view('customer.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }
}
