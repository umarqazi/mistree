<?php

namespace App\Http\Controllers;

use App\Service;
use DB, View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the services wit status Active
        // $services = Service::all();
        
        $services = Service::where('status', '=', 1)->get();
        
        // load the view and pass the services
        return View::make('services.index')
            ->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return View::make('services.create')->with('services', $services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'              => 'required',            
            'loyalty_points'    => 'numeric',            
        );

        $inputs = $request->only('name','loyalty_points');

        $validator = Validator::make($inputs, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('services/create')
                ->withErrors($validator);               
        } else {
            // store
            $service = new Service;

            if ($request->hasFile('image')) 
            {
                $s3_path =  Storage::disk('s3')->putFile('services', new File($request->image), 'public');
                $img_path = 'https://s3-us-west-2.amazonaws.com/mymystri-staging/'.$s3_path;
                $service->image          = $img_path;
            }
            else
            {
              $service->image          =  url('img/thumbnail.png');
            }

            $service->name           = Input::get('name');
            $service->parent_id      = Input::get('parent_id');            
            $service->loyalty_points = Input::get('loyalty_points');                     
            $service->status         = 1;            
            $service->save();

            // redirect
            Session::flash('message', 'Successfully created service!');
            return Redirect::to('admin/services');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the service
        $service = Service::find($id);

        // show the view and pass the service to it
        return View::make('services.show')
            ->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        // get the service
        $service = Service::find($id);
        $services = Service::all();
        // dd($service);
        // show the view and pass the service to it
        return View::make('services.edit', compact('service','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation

        $rules = array(
            'name'       => 'required',
            'parent_id'      => 'required|numeric',            
        );

        $inputs = $request->only('name', 'parent_id');
        $validator = Validator::make($inputs, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('services/'. $id .'/edit')
                ->withErrors($validator);                
        } else {
            $service = Service::find($id);
            // update            

            if ($request->hasFile('image')) 
            {
                $s3_path =  Storage::disk('s3')->putFile('services', new File($request->image), 'public');
                $img_path = 'https://s3-us-west-2.amazonaws.com/mymystri-staging/'.$s3_path;
                $service->image          = $img_path;
            }
            else
            {
              $service->image          = $service->image;
            }

            $service->name           = $request->name;
            $service->parent_id      = $request->parent_id;
            $service->save();

            // redirect
            Session::flash('message', 'Successfully updated the Service!');
            return Redirect::to('admin/services');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        // dd($id);
        $service = Service::find($id);
        $service->status = 0;
        $service->update();
        // $service->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Service!');
        return Redirect::to('admin/services');
    }
    /**
     * Searching a workshop.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * @SWG\Post(
     *   path="/api/customer/search-service",
     *   summary="Search Service",
     *   operationId="searchService",
     *   produces={"application/json"},
     *   tags={"Service"},
     *   @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="service_name",
     *     in="formData",
     *     description="Service Name",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="workshop_name",
     *     in="formData",
     *     description="Workshop Name",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="workshop_type",
     *     in="formData",
     *     description="Workshop Type",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_block",
     *     in="formData",
     *     description="Workshop Address Block",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_area",
     *     in="formData",
     *     description="Workshop Address Area",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_town",
     *     in="formData",
     *     description="Workshop Address Town",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="address_city",
     *     in="formData",
     *     description="Workshop Address City",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    // public function searchService(Request $request)
    // {   
    //     // $workshops = Workshop::leftJoin('workshop_addresses', 'workshops.id', '=','workshop_addresses.workshop_id')->where('workshops.status', 1)->get();
    //     /*$workshops = Workshop::join('workshop_service', 'workshops.id', '=','workshop_service.workshop_id')->leftJoin('services', 'workshop_service.service_id', '=','services.id')->where('workshops.status', 1)->with('address')->get();*/
    //     $services = Service::where('status', 1)->with('workhops');
    //     $service_ids = [];
    //     if ($request->has('service_name')) {
    //         $services = $services->where('name', 'LIKE', '%'.$request->service_name.'%');
    //     }
    //     if ($request->has('workshop_name')) {
    //         // $workshops = $workshops->where('services.name', $request->service_name);
    //         // $workshop_ids = Db::table('workshop_service')->join('services', 'workshop_service.service_id', '=', 'services.id')->select('workshop_service.workshop_id')->where('services.name', $request->service_name)->get()->pluck('workshop_id')->toArray();
    //         // $workshops = $workshops->whereIn('id', $workshop_ids);
    //         $service_ids = Db::table('workshop_service')->join('workshops', 'workshop_service.workshop_id', '=', 'workshops.id')->select('workshop_service.service_id')->where('workshops.name', 'LIKE', '%'.$request->workshop_name.'%')->get()->pluck('service_id')->toArray();
    //         $services = $services->whereIn('id', $service_ids);
    //     }
    //     // if ($request->has('address_block')) {
    //     //     // $workshops = $workshops->where('adress.block', $request->address_block);
    //     //     $workshops = $workshops->where('address.block', 'LIKE', '%'.$request->address_block .'%');
    //     // }
    //     // if ($request->has('address_area')) {
    //     //     $workshops = $workshops->where('address.area', 'LIKE', '%'.$request->address_area.'%');
    //     // }
    //     // if ($request->has('address_town')) {
    //     //     $workshops = $workshops->where('address.town', 'LIKE', '%'.$request->address_town.'%');
    //     // }
    //     // if ($request->has('address_city')) {
    //     //     $workshops = $workshops->where('address.city', 'LIKE', '%'.$request->address_city.'%');
    //     // }
    //     return response()->json([
    //         'http-status' => Response::HTTP_OK,
    //         'status' => true,
    //         'message' => '',
    //         'body' => $services->get()
    //     ],Response::HTTP_OK);
    // }
}
