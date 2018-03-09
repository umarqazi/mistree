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
    /**
     * @SWG\Get(
     *   path="/api/sign-up/services",
     *   summary="All Services for Workshops",
     *   operationId="select services",
     *   produces={"application/json"},
     *   tags={"Services"},
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function index(Request $request)
    {        
        // get all the services
        $services = Service::orderBy('created_at')->get();            
        $reqFrom = $request->header('Content-Type');
        if( $reqFrom == 'application/json'){
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'all services',
                'body' => [ 'services' => $services ]
            ],Response::HTTP_OK);
        }
        else{
        // load the view and pass the services
        return View::make('services.index')
            ->with('services', $services);
        }                 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::orderBy('service_parent')->get();
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
        $services   = Service::all();
        $services   = implode(',',$services->pluck('id')->toArray());
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'              => 'required|unique:services|max:255',            
            'loyalty-points'    => 'required|numeric',
            'lead-charges'      => 'required|numeric',
            'service-parent'    => 'in:0,'.$services,
            'image'             => 'mimes:jpeg,jpg,png',         
        );
        $inputs = $request->only('name','loyalty-points','service-parent', 'lead-charges');

        $validator = Validator::make($inputs, $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            // store
            $service = new Service;

            if ($request->hasFile('image')) 
            {
                $s3_path =  Storage::disk('s3')->putFile('services', new File($request->image), 'public');
                $img_path = config('app.s3_bucket_url').$s3_path;
                $service->image          = $img_path;
            }
            else
            {
              $service->image        =  url('img/thumbnail.png');
            }

            $service->name           = Input::get('name');
            $service->service_parent = Input::get('service-parent');
            $service->loyalty_points = Input::get('loyalty-points');
            $service->lead_charges = Input::get('lead-charges');
            $service->save();

            // redirect
            Session::flash('message', 'Success! Service Created.');
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
        // get the service
        $service = Service::find($id);
        $services = Service::where('id', '<>', $service->id)->orderBy('service_parent')->get();

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
        // dd($request);
        $services   = Service::where('id', '<>', $id)->get();
        $services   = implode(',',$services->pluck('id')->toArray());
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'           => 'required|unique:services,id,'.$id.'|max:255',
            'loyalty-points' => 'required|numeric',
            'lead-charges'   => 'required|numeric',
            'service-parent' => 'in:0,'.$services,
            'image'          => 'mimes:jpeg,jpg,png',          
        );

        $inputs = $request->only('name', 'service-parent','loyalty-points', 'lead-charges');
        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            $service = Service::find($id);
         
            if ($request->hasFile('image')) 
            {
                $s3_path =  Storage::disk('s3')->putFile('services', new File($request->image), 'public');
                $img_path = config('app.s3_bucket_url').$s3_path;
                $service->image          = $img_path;
            }
            else
            {
              $service->image        = $service->image;
            }
            $service->name           = Input::get('name');
            $service->service_parent = Input::get('service-parent');
            $service->loyalty_points = Input::get('loyalty-points');
            $service->lead_charges   = Input::get('lead-charges');
            $service->update();

            // redirect
            Session::flash('message', 'Success! Service Updated.');
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
        $service = Service::find($id);
        $service->delete();

        // redirect
        Session::flash('message', 'Success! Service Deactivated');
        return Redirect::to('admin/services');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $service = Service::withTrashed()->find($id);
        $service->restore();
        return redirect ('/admin/service/inactive');
    }

    public function inactive_services()
    {
        $services = Service::onlyTrashed()->get();  
        return View::make('services.inactive')
        ->with('services', $services);
    }

    /**
     * @SWG\Get(
     *   path="/api/services",
     *   summary="All Services for Workshops",
     *   operationId="select services",
     *   produces={"application/json"},
     *   tags={"Services"},     
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Auth Token",
     *     required=true,
     *     type="string"
     *   ),     
     *   @SWG\Parameter(
     *     name="service_ids",
     *     in="formData",
     *     description="Workshop Services",
     *     required=false,
     *     type="array",
     *     items = "service_ids"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )     
     */
    public function filteredServices(Request $request)
    {        
        // get all the services
        $service_ids = $request->service_ids;
        if(count($service_ids)>0){
            $services = Service::orderBy('created_at')->whereNotIn('id',$service_ids)->get();
        }else{
            $services = Service::orderBy('created_at')->get();
        }        
        return response()->json([
            'http-status' => Response::HTTP_OK,
            'status' => true,
            'message' => 'all services',
            'body' => [ 'services' => $services ]
        ],Response::HTTP_OK);        
    }
}
