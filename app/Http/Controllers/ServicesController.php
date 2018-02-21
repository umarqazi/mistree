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

        if ($validator->fails()) {
            return Redirect::to('services/'. $id .'/edit')
                ->withErrors($validator);                
        } else {
            $service = Service::find($id);
         
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
}
