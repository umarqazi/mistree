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

class CustCarsController extends Controller
{
    /**
     * Assign a specific car to owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignCar($id)
    {
       $rules = array(
            'car_id'       => 'required',
            'cust_id'      => 'required',
            'millage'      => 'required',
            'vehicle_no'   => 'required',
            'insurance'    => 'required'
        );

        if ($validator->fails()) {
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator,
                    'body' => $request->all()
                ],Response::HTTP_OK);
        } else {
            // store
            $custcar = new CustCar;
            $custcar->car_id       = $request->car_id;
            $custcar->cust_id      = $request->cust_id;
            $custcar->millage      = $request->millage;
            $custcar->vehicle_no   = $request->vehicle_no;
            $custcar->insurance    = $request->insurance;
            $custcar->status       = 1;
            $custcar->save();

            return response()->json([
                'http-status'   => Response::HTTP_OK,
                'status'        => true,
                'message'       => $validator,
                'body'          => '' 
            ],Response::HTTP_OK);
        }
    }

    /**
     * Unassign a specific car to owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unassignCar($id)
    {
       // delete
        $custcar = CustCar::find($id);
        $custcar->delete();

        return response()->json([
            'http-status'   => Response::HTTP_OK,
            'status'        => true,
            'message'       => 'Car deleted!!',
            'body'          => '' 
        ],Response::HTTP_OK);
    }

    /**
     * Fetch customer's to car.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCustCar($id)
    {
       // 
    }
}
