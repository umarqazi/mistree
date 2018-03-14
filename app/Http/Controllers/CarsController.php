<?php

namespace App\Http\Controllers;

use JWTAuth;
use Hash, DB, Config, Mail, View, Session;
use Illuminate\Support\Facades\Redirect;
use App\Car;
use App\Category;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class CarsController extends Controller
{
    /**
     * Display a listing of the Cars.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Get(
     *   path="/api/cars",
     *   summary="Get All Cars",
     *   operationId="Cars",
     *   produces={"application/json"},
     *   tags={"Cars"},
     *   consumes={"application/json"},
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
    public function index(Request $request)
    {
        // get all the nerds ->toJson()
        $cars = Car::where('is_published',true)->orderBy('created_at', 'desc')->get();
        if( $request->header('Content-Type') == 'application/json'){
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => '',
                'body' => [ 'cars' => $cars ]
            ],Response::HTTP_OK);
        }
        else
        {
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
        $types = Category::all();
        return View::make('cars.create')->with('types', $types);
    }

    /**
     * Store a newly created cars in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $types  = Category::all();
        $types  = implode(',',$types->pluck('id')->toArray());

        // validate
        $rules = array(
            'type'       => 'required|in:'.$types,
            'make'       => 'required',
            'model'      => 'required|unique:cars,model,NULL,id,make,'.trim(Input::get('make')),
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $car = new Car;
            $car->make       = trim(Input::get('make'));
            $car->model      = trim(Input::get('model'));

            $car->category()->associate(Category::find(Input::get('type')));

            $car->save();

            // redirect
            Session::flash('message', 'Success! Car Created.');
            return Redirect::to('admin/cars');
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

        //
    }

    /**
     * Show the form for editing the specified car.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car    = Car::find($id);
        $types  = Category::all();

        return View::make('cars.edit')
            ->with('car', $car)->with('types', $types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $types  = Category::all();
        $types  = implode(',',$types->pluck('id')->toArray());

        $rules = array(
            'type'       => 'required|in:'.$types,
            'make'       => 'required',
            'model'      => 'required|unique:cars,model,'.$id.',id,make,'.trim(Input::get('make'))
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
            $car->make       = Input::get('make');
            $car->model      = Input::get('model');

            $car->category()->associate(Category::find(Input::get('type')));

            $car->save();

            // redirect
            return Redirect::to('admin/cars')->with('message', 'Success! Car Updated');
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
       // soft delete
        $car = Car::find($id);
        $car->delete();

        // redirect
        return Redirect::to('admin/cars')->with('message', 'Success! Car Deactivated.');
    }
    
    /**
     * Restore the specified car from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // restore
        $car = Car::withTrashed()->find($id);
        $car->restore();

        // redirect
        return Redirect::to('admin/cars')->with('message', 'Success! Car Restored.');
    }

    public function delete_car($id)
    {
       // delete
        $car = Car::find($id);
        $car->forceDelete();

        // redirect
        return Redirect::to('admin/cars')->with('message', 'Success! Car Deleted.');
    }

    public function inactive_cars()
    {
        $cars = Car::onlyTrashed()->get();  
        return View::make('cars.inactive')
        ->with('cars', $cars);
    }

    public function unPublished(){
        $cars   = Car::where('is_published', FALSE)->get();

        return View::make('cars.unpublished')->with('cars', $cars);
    }
    
    public function publish(Request $request)
    {        
        $car = Car::find($request->car_id);      
        $car->is_published = 1;        
        $car->update();         
         return Redirect::to('admin/cars')->with('message', 'Success! Car Published.');
    }

    /**
     * Assign a specific car to owner.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/car",
     *   summary="Add customer's car",
     *   operationId="add_customer_car",
     *   produces={"application/json"},
     *   tags={"Cars"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="car_id",
     *     in="formData",
     *     description="Car Id",
     *     required=false,
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
     *     required=false,
     *     type="boolean"
     *   ),
     *   @SWG\Parameter(
     *     name="year",
     *     in="formData",
     *     description="Year",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="type",
     *     in="formData",
     *     description="Car Type",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="make",
     *     in="formData",
     *     description="Car Make",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="model",
     *     in="formData",
     *     description="Car Model",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function assignCar(Request $request)
    {
        $customer   = JWTAuth::authenticate();
        $rules = array(
            'car_id'        => 'required_without:model,make',
            'vehicle_no'    => 'required|unique:car_customer,vehicle_no,NULL,id,removed_at,NULL',
            'millage'       => 'required|numeric',
            'year'          => 'required|numeric',
            'model'         => 'required_without:car_id',
            'make'          => 'required_without:car_id',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages()->first(),
                    'body' => null
                ],Response::HTTP_OK);
        }

        // store
        $car        = Car::find($request->car_id);
        if(is_null($car))
        {
            $car    = new Car();
            $car->type          = $request->type;
            $car->make          = $request->make;
            $car->model         = $request->model;
            $car->is_published  = FALSE;
            $car->save();
        }

        $customer->cars()->attach($car, array('millage' => $request->millage, 'vehicle_no' => $request->vehicle_no, 'insurance' => $request->insurance, 'year' => $request->year));

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Car Added!',
            'body'          => null
        ],Response::HTTP_OK);
    }

    /**
     * Unassign a specific car to owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Patch(
     *   path="/api/customer/car",
     *   summary="Delete customer's car",
     *   operationId="remove_customer_car",
     *   produces={"application/json"},
     *   tags={"Cars"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="car_id",
     *     in="formData",
     *     description="Car Id",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="vehicle_no",
     *     in="formData",
     *     description="Vechile No.",
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
        $customer   = JWTAuth::authenticate();

        $rules = array(
            'vehicle_no'   => 'required|exists:car_customer,vehicle_no,customer_id,'.$customer->id,
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'Incorrect Details',
                'body' => null
            ],Response::HTTP_OK);
        }

        $car = $customer->cars()->withTrashed()->where('vehicle_no', 'like', '%'.$request->vehicle_no.'%');
        if(!empty($request->car_id))
        {
            $car->where('car_id', $request->car_id);
        }
        $car    = $car->orderBy('car_customer.created_at', 'desc')->firstOrFail();

        if( ! empty( $car->pivot->removed_at ) )
        {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => 'Car has already been removed.',
                'body' => null
            ], Response::HTTP_OK);
        }
        else
        {
            $customer->cars()->withTrashed()->newPivotStatement()->where('customer_id', $customer->id)->where('vehicle_no', 'like', '%'.$request->vehicle_no.'%')->where('removed_at',null)->update(['removed_at' => DB::raw('NOW()')]);

            return response()->json([
                'http-status'   => Response::HTTP_OK,
                'status'        => true,
                'message'       => 'Car deleted!',
                'body'          => null
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
     *   path="/api/customer/cars",
     *   summary="Get customer's car",
     *   operationId="getCustomerCar",
     *   produces={"application/json"},
     *   tags={"Cars"},
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
    public function getCustomerCar()
    {
        $customer   = JWTAuth::authenticate();
        //$validator  = Validator::make($customer_id, $rules);
        if (!$customer) {
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Invalid Request!',
                    'body' => null
                ],Response::HTTP_OK);
        } else {
            return response()->json([
                'http-status'   => Response::HTTP_OK,
                'status'        => true,
                'message'       => '',
                'body'          => $customer->cars()->withTrashed()->where('removed_at', null)->get()
            ],Response::HTTP_OK);
        }
    }  
}
