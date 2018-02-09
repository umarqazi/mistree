<?php

namespace App\Http\Controllers;

use JWTAuth;
use Hash, DB, Config, Mail;
use App\Car;
use App\CustCar;
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
    public function index(Request $request)
    {
        // get all the nerds ->toJson()
        $cars = Car::all();
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
            'maker'      => 'required',
            'model'      => 'required',
            'year'       => 'required'
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
            $car->maker      = Input::get('maker');
            $car->model      = Input::get('model');
            $car->year       = Input::get('year');
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
            'maker'      => 'required',
            'model'      => 'required',
            'year'       => 'required',
            'picture'    => 'required'
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
            $car->maker      = Input::get('maker');
            $car->model      = Input::get('model');
            $car->year       = Input::get('year');
            $car->picture       = Input::get('picture');
            $car->save();

            // redirect
            Session::flash('message', 'Successfully updated car!');
            return Redirect::to('cars');
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
        $car->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the car!');
        return Redirect::to('cars');
    }
    
}
