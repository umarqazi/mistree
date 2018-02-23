<?php

namespace App\Http\Controllers;

use JWTAuth;
use Hash, DB, Config, Mail, View, Session;
use Illuminate\Support\Facades\Redirect;
use App\Car;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CarsController extends Controller
{
    /**
     * Display a listing of the Cars.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Get(
     *   path="/api/customer/get-cars",
     *   summary="Get All Cars",
     *   operationId="getCars",
     *   produces={"application/json"},
     *   tags={"Cars"},
     *   consumes={"application/xml", "application/json"},
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function index(Request $request)
    {
        // get all the nerds ->toJson()
        $cars = Car::where('status', 1)->get();
        $reqFrom = $request->header('Content-Type');
        if( $reqFrom == 'application/json'){
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => '',
                'body' => [ 'cars' => $cars ]
            ],Response::HTTP_OK);
        }
        else{
            return View::make('cars.index')->with('cars', $cars);
        }
    }

    /**
     * Show the form for creating a new cars.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('cars.create');
    }

    /**
     * Store a newly created cars in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $rules = array(
            'type'       => 'required',
            'model'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('cars/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $car = new Car;
            $car->type       = Input::get('type');
            $car->model      = Input::get('model');
            $car->picture    = '';
            $car->status     = 1;
            $car->save();

            // redirect
            Session::flash('message', 'Successfully created car!');
            return Redirect::to('car');
        }
    }

    /**
     * Display the specified car.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $car = Car::find($id);

        return View::make('cars.show')
            ->with('car', $car);
    }

    /**
     * Show the form for editing the specified car.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        return View::make('cars.edit')
            ->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $rules = array(
            'type'       => 'required',
            'model'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('cars/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $car = Car::find($id);
            $car->type       = Input::get('type');
            $car->model      = Input::get('model');
            $car->picture    = '';
            $car->save();

            // redirect
            Session::flash('message', 'Successfully updated car!');
            return Redirect::to('admin/cars');
        }
    }

    /**
     * Remove the specified car from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // delete
        $car = Car::find($id);
        $car->status = 0;
        $car->save();

        // redirect
        Session::flash('message', 'Successfully deleted the car!');
        return Redirect::to('admin/cars');
    }
    

    /**
     * Assign a specific car to owner.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/add-customer-car",
     *   summary="Add customer's car",
     *   operationId="add_customer_car",
     *   produces={"application/json"},
     *   tags={"Cars"},
     *   @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="car_id",
     *     in="formData",
     *     description="Car Id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="customer_id",
     *     in="formData",
     *     description="Customer Id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="millage",
     *     in="formData",
     *     description="Millage",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="vehicle_no",
     *     in="formData",
     *     description="Vehicle Number",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="insurance",
     *     in="formData",
     *     description="Insurance",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="year",
     *     in="formData",
     *     description="Year",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function assignCar(Request $request)
    {
       $rules = array(
            'car_id'       => 'required',
            'customer_id'  => 'required',
            'year'         => 'required',
            'millage'      => 'required',
            'vehicle_no'   => 'required',
            'insurance'    => 'required'
        );
        $car_exists = "";
        $current_time = Carbon::now()->toDateTimeString();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator,
                    'body' => $request->all()
                ],Response::HTTP_OK);
        } else {
            // store
            $car        = Car::find($request->car_id);
            $customer   = Customer::find($request->customer_id);
            $car_exists = $customer->cars()->where('customer_id', $request->customer_id)->where('vehicle_no', $request->vehicle_no)->get();
            //->where('car_customer.status', 0)
            if(count($car_exists) == 0){
                $customer->cars()->attach($car, array('millage' => $request->millage, 'vehicle_no' => $request->vehicle_no, 'insurance' => $request->insurance, 'year' => $request->year, 'status' => 1, 'created_at' => $current_time));
                return response()->json([
                    'http-status'   => Response::HTTP_OK,
                    'status'        => true,
                    'message'       => 'Car Added!',
                    'body'          => '' 
                ],Response::HTTP_OK);
            }else{
                $car_exists_with_status_0 = $customer->cars()->where('customer_id', $request->customer_id)->where('vehicle_no', $request->vehicle_no)->whereNotNull('car_customer.deleted_at')->get();
                if(count($car_exists_with_status_0)){
                    $customer->cars()->newPivotStatement()->where([['customer_id','=', $request->customer_id], ['vehicle_no','=', $request->vehicle_no] ])->update(array('millage' => $request->millage, 'insurance' => $request->insurance, 'year' => $request->year, 'status' => 1, 'updated_at' => $current_time, 'deleted_at' => null));
                    return response()->json([
                        'http-status'   => Response::HTTP_OK,
                        'status'        => true,
                        'message'       => 'Car Added!',
                        'body'          => '' 
                    ],Response::HTTP_OK);
                }else{
                    return response()->json([
                        'http-status'   => Response::HTTP_OK,
                        'status'        => true,
                        'message'       => 'A Car already exists with the same registration no.',
                        'body'          => '' 
                    ],Response::HTTP_OK);
                }
            }
        }
    }

    /**
     * Unassign a specific car to owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/remove-customer-car",
     *   summary="Delete customer's car",
     *   operationId="remove_customer_car",
     *   produces={"application/json"},
     *   tags={"Cars"},
     *   @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="car_id",
     *     in="formData",
     *     description="Car Id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="vehicle_no",
     *     in="formData",
     *     description="Vechile No.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="customer_id",
     *     in="formData",
     *     description="Customer Id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function unassignCar(Request $request)
    {
        if ($request->custmer_id && $request->vehicle_no && $request->car_id){
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Incorrect Details',
                    'body' => $request->all()
                ],Response::HTTP_OK);
        } else {
           // soft delete
            $customer   = Customer::find($request->customer_id);
            $customer->cars()->newPivotStatement()->where('customer_id', $request->customer_id)->where('vehicle_no', $request->vehicle_no)->where('car_id', $request->car_id)->update(array('deleted_at' => DB::raw('NOW()')));

            return response()->json([
                'http-status'   => Response::HTTP_OK,
                'status'        => true,
                'message'       => 'Car deleted!',
                'body'          => '' 
            ],Response::HTTP_OK);
        }
    }

    /**
     * Fetch customer's to car.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Get(
     *   path="/api/customer/get-customer-car",
     *   summary="Get customer's car",
     *   operationId="getCustCar",
     *   produces={"application/json"},
     *   tags={"Cars"},
     *   @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="customer_id",
     *     in="query",
     *     description="Customer Id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function getCustCar($customer_id)
    {
       $rules = array(
            'custmer_id'        => 'required',
        );
        $validator  = Validator::make($customer_id, $rules);
        if ($validator->fails()) {
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator,
                    'body' => $request->all()
                ],Response::HTTP_OK);
        } else {
            $customer   = Customer::find($request->customer_id);
            $cars       = $customer->cars();
            return response()->json([
                'http-status'   => Response::HTTP_OK,
                'status'        => true,
                'message'       => '',
                'body'          => $cars 
            ],Response::HTTP_OK);
        }
    }  
}
