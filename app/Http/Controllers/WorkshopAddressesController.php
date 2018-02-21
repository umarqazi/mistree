<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WorkshopAddress;
use Workshop;

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
    *   path="/api/workshop/address/id",
    *   summary="Workshop Address Details",
    *   operationId="fetch",
    *   produces={"application/json"},
    *   tags={"Workshops"},
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
        $workshop = Workshop::find($id);
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
    *   path="/api/workshop/address/id/edit",
    *   summary="Workshop Address Details",
    *   operationId="fetch",
    *   produces={"application/json"},
    *   tags={"Workshops"},
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
     *   path="/api/workshop/address/id",
     *   summary="Update Workshop Address",
     *   operationId="update",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="address id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_city",
     *     in="query",
     *     description="Workshop Address City",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_block",
     *     in="query",
     *     description="Workshop Address Block",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_town",
     *     in="query",
     *     description="Workshop Address Town",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_area",
     *     in="query",
     *     description="Workshop Address Area",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_type",
     *     in="query",
     *     description="Workshop Address Type",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_house_no",
     *     in="query",
     *     description="Workshop House No",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_street_no",
     *     in="query",
     *     description="Workshop Street No",
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
            'address_type'                   => 'required|alpha',
            'address_house_no'               => 'required|numeric',
            'address_street_no'              => 'required|numeric',
            'address_block'                  => 'required|alpha_dash',
            'address_area'                   => 'required|alpha_dash',
            'address_town'                   => 'required|alpha_dash',
            'address_city'                   => 'required|alpha'
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
                    'body' => $request
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
