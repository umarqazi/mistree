<?php

namespace App\Http\Controllers;

use JWTAuth;
use Session;
use DB, Config, View;
use Illuminate\Http\Request;
use App\WorkshopAddress;
use App\Workshop;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

class WorkshopAddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
    * @SWG\Get(
    *   path="/api/workshop/address/{workshop_id}",
    *   summary="Workshop Address Details",
    *   operationId="fetch",
    *   produces={"application/json"},
    *   tags={"Workshops"},
    *    @SWG\Parameter(
    *     name="token",
    *     in="query",
    *     description="Token",
    *     required=true,
    *     type="string"
    *   ),
    *   @SWG\Parameter(
    *     name="workshop_id",
    *     in="path",
    *     description="workshop id",
    *     required=true,
    *     type="integer"
    *   ), 
    *   @SWG\Response(response=200, description="successful operation"),
    *   @SWG\Response(response=406, description="not acceptable"),
    *   @SWG\Response(response=500, description="internal server error")
    * )    
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($workshop_id)
    {           
        $workshop = Workshop::find($workshop_id);
        $address = $workshop->address; 
        
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Workshop Details!',
            'body' => $address
        ],Response::HTTP_OK);
    }

     /**
    * @SWG\Get(
    *   path="/api/workshop/address/{address_id}/edit",
    *   summary="Workshop Address Details",
    *   operationId="fetch",
    *   produces={"application/json"},
    *   tags={"Workshops"},
    *    @SWG\Parameter(
    *     name="token",
    *     in="query",
    *     description="Token",
    *     required=true,
    *     type="string"
    *   ),
    *   @SWG\Parameter(
    *     name="address_id",
    *     in="path",
    *     description="address id",
    *     required=true,
    *     type="integer"
    *   ),    
    *   @SWG\Response(response=200, description="successful operation"),
    *   @SWG\Response(response=406, description="not acceptable"),
    *   @SWG\Response(response=500, description="internal server error")
    * ) 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = WorkshopAddress::find($id);
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'Workshop Details!',
            'body' => $address
        ],Response::HTTP_OK);
    }
    /**
     * @SWG\Post(
     *   path="/api/workshop/address/{id}",
     *   summary="Update Workshop Address",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *    @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="address id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_city",
     *     in="formData",
     *     description="Workshop Address City",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_block",
     *     in="formData",
     *     description="Workshop Address Block",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_town",
     *     in="formData",
     *     description="Workshop Address Town",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_area",
     *     in="formData",
     *     description="Workshop Address Area",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_type",
     *     in="formData",
     *     description="Workshop Address Type",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_house_no",
     *     in="formData",
     *     description="Workshop House No",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_street_no",
     *     in="formData",
     *     description="Workshop Street No",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="_method",
     *     in="formData",
     *     description="Required to update form",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = WorkshopAddress::find($id);                
        $rules = [            
            'address_type'                   => 'required',
            'address_house_no'               => 'required|numeric',
            'address_street_no'              => 'required|numeric',
            'address_block'                  => 'required',
            'address_area'                   => 'required',
            'address_town'                   => 'required',
            'address_city'                   => 'required|regex:/^[\pL\s\-]+$/u'
            ];

        $input = $request->only('address_type', 'address_house_no', 'address_street_no', 'address_block', 'address_area', 'address_town', 'address_city');

        $validator = Validator::make($input , $rules);

        // process the login
        if ($validator->fails()) {
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => false,
                'message' => $validator->messages(),
                'body' => $request->all()
            ],Response::HTTP_OK);
        }         
        $address->type          =  $request->address_type;
        $address->house_no      =  $request->address_house_no;
        $address->street_no     =  $request->address_street_no;
        $address->block         =  $request->address_block;
        $address->area          =  $request->address_area;
        $address->town          =  $request->address_town;
        $address->city          =  $request->address_city;
        $address->status        = 1;
        $address->save(); 
        
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Address updated Successfully!',
                    'body' => $request->all()
                ],Response::HTTP_OK);               
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
