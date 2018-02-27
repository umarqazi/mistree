<?php

namespace App\Http\Controllers;

use JWTAuth;

use Illuminate\Support\Facades\Redirect;
use Hash, DB, Config, Mail, View;
use App\Customer;
use App\Address;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class CustomersController extends Controller
{
    /**
     * Fetching Guard.
     *
     * @return Auth::guard()
     */
    protected function guard()
    {
        return Auth::guard('customer');
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
        $this->auth = app('auth')->guard('customer');
    }

    /**
     * Display a listing of the customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return View::make('customer.index')->with('customers', $customers);
        // return View::make('customer.index');
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('customers.create');
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:customers',
            'password'  => 'required|confirmed|min:6',
            'con_number'=> 'required',
        ];
        $input = $request->only('name', 'email', 'password', 'password_confirmation', 'con_number');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::to('customer/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $customer = new Customers;
            $customer->name       = Input::get('name');
            $customer->email      = Input::get('email');
            $customer->password   = Input::get('password');
            $customer->con_number = Input::get('con_number');
            $customer->status     = 1;
            
            $customer->save();

            // redirect
            Session::flash('message', 'Successfully created customer!');
            return Redirect::to('customer');
        }
    }

    /**
     * Display the specified customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        return View::make('customers.show')
            ->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        return View::make('customers.edit')
            ->with('customer', $customer);
    }

    /**
     * Update the specified customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:customers',
            'password'  => 'required|confirmed|min:6',
            'con_number'=> 'required',
        ];
        $input = $request->only('name', 'email', 'password', 'password_confirmation', 'con_number');
        $validator = Validator::make($input, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('customers/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $customer = Customer::find($id);
            $customer->name       = Input::get('name');
            $customer->email      = Input::get('email');
            $customer->password   = Input::get('password');
            $customer->con_number = Input::get('con_number');
            $customer->save();

            // redirect
            Session::flash('message', 'Successfully updated customer!');
            return Redirect::to('customers');
        }
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // soft delete
        $customer = Customers::find($id);
        $customer->status = 0;
        $customer->save();

        // redirect
        Session::flash('message', 'Successfully deleted the customer!');
        return Redirect::to('customers');
    }

    /**
     * API Register for new customer.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/register",
     *   summary="Register customer",
     *   operationId="register",
     *   produces={"application/json"},
     *   tags={"Customers"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Customer Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Customer Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Customer Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password_confirmation",
     *     in="formData",
     *     description="Customer Password Confirmation",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="con_number",
     *     in="formData",
     *     description="Customer Contact Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:customers',
            'password'  => 'required|confirmed|min:6',
            'con_number'=> 'required',
        ];
        $input = $request->only('name', 'email', 'password', 'password_confirmation', 'con_number');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            $request->offsetUnset('password_confirmation');
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages(),
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }
        $name = $request->name;
        $con_number = $request->con_number;
        $email = $request->email;
        $password = $request->password;
        $customer = Customer::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'status' => 1, 'con_number' => $con_number]);
        // return $this->login($request);
        $verification_code = str_random(30); //Generate verification code
        DB::table('customer_verifications')->insert(['cust_id'=>$customer->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::send('customer.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "umar.farooq@gems.techverx.com");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Thanks for signing up! Please check your email to complete your registration.',
            'body' => null
        ],Response::HTTP_OK);
    }

    /**
     * API Login for customer, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/login",
     *   summary="Login customer",
     *   operationId="login",
     *   produces={"application/json"},
     *   tags={"Customers"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Customer Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Customer Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
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
        try {
            // Config::set('jwt.user' , "App\Customer");
            Config::set('auth.providers.users.model', \App\Customer::class);
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
        $customer = Auth::user();
        // Config::set('jwt.user' , "App\User");
        // Config::set('auth.providers.users.model', \App\User::class);
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'success',
            'body' => [ 'token' => $token , 'customer' => $customer ],
        ],Response::HTTP_OK);
    }

    /**
     * Log out
     * Invalidate the token, so customer cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/logout",
     *   summary="Logout customer",
     *   operationId="logout",
     *   produces={"application/json"},
     *   tags={"Customers"},
     *   @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Auth Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            Config::set('auth.providers.users.model', \App\Customer::class);
            JWTAuth::invalidate($request->input('token'));
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
                'body' => $request->all()
            ],Response::HTTP_OK);
        }
    }

    /**
     * API Recover Password for new customer.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/recover",
     *   summary="Recover Customer Password",
     *   operationId="recover",
     *   produces={"application/json"},
     *   tags={"Customers"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Customer Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function recover(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            $error_message = "Your email address was not found.";
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $error_message,
                'body' => null
            ],Response::HTTP_OK);
        }
        try {
            Config::set('auth.providers.users.model', \App\Customer::class);

            $response = $this->broker()->sendResetLink(
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
        return Password::broker('customers');
    }

    /**
     * API Verify Email
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @SWG\Get(
     *   path="/api/customer/verify-email",
     *   summary="Verify Customer Email",
     *   operationId="verifyEmail",
     *   produces={"application/json"},
     *   tags={"Customers"},
     *   consumes={"application/xml", "application/json"},
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="verification_code",
     *     in="query",
     *     description="Verification Code",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function verifyEmail($verification_code)
    {
        $check = DB::table('customer_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
            $customer = Customer::find($check->id);
            if($customer->is_verified == 1){
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Account already verified.',
                    'body' => null
                ],Response::HTTP_OK);
            }
            $customer->update(['is_verified' => 1]);
            DB::table('customer_verifications')->where('token',$verification_code)->delete();
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'You have successfully verified your email address.',
                'body' => null
            ],Response::HTTP_OK);
        }
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => false,
            'message' => 'Verification code is invalid.',
            'body' => null
        ],Response::HTTP_OK);
    }

    /**
     * API Register store data of new customer.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function regStoreData(Request $request)
    {
         // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'cust_id'               => 'required',
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
            //customer
            $customer = Customer::findOrFail($request->cust_id);
            //address
            $address = new Address;
            $address->cust_id       =  $request->cust_id;
            $address->ws_id         =  '';
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
            return response([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Details Added!',
                'body' => null
            ],Response::HTTP_OK);
        }
    }

    /**
     * Profile Update customer.
     *
     * @param Request $request
     * @param $id
     * @param $address_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileUpdate(Request $request, $id, $address_id)
    {
        $request_customer = $request->customer;
        $customer = Customer::find($id);
        $customer->fill($request_customer);
        $update_address = $request->update_address;
        if($update_address == true){
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
                    $address->cust_id       =  $id;
                    $address->ws_id         =  '';
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
        }
        //address   
        return response([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Details Added!',
            'body' => null
        ],Response::HTTP_OK);
    }

    public function activateCustomer($id){        
        $customer = Customer::where('id', '=', $id)->first();
        $customer->update(['status' => 1]);        
        return Redirect::to('/admin/customers');
    }

    public function deactivateCustomer($id){        
        $customer = Customer::where('id', '=', $id)->first();
        $customer->update(['status' => 0]);        
        return Redirect::to('/admin/customers');
    }
}