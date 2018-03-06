<?php

namespace App\Http\Controllers;

use App\WorkshopQuery;
use Illuminate\Http\Request;
use JWTAuth, Session, View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class WorkshopQueriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshopQueries = WorkshopQuery::all()->load('workshop');
        return View::make('workshop.index_workshop_query')->with('workshopQueries', $workshopQueries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/api/workshop/add-workshop-query",
     *   summary="Add Workshop Query",
     *   operationId="add_workshop_query",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   consumes={"application/xml", "application/json"},
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="subject",
     *     in="formData",
     *     description="Subject",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="message",
     *     in="formData",
     *     description="Message",
     *     required=true,
     *     type="text"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function store(Request $request)
    {   
            $workshop_id = JWT::Authenticate()->id;
            $rules = array(
                'subject'      => 'required',
                'message'      => 'required'
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Incomplete Details!',
                    'body' => $request->all()
                ],Response::HTTP_OK);
            } else {
                // store
                $workshopQuery              = new WorkshopQuery;
                $workshopQuery->workshop_id = $request->workshop_id;
                $workshopQuery->subject     = $request->subject;
                $workshopQuery->message     = $request->message;
                $workshopQuery->status      = 'Open';
                $workshopQuery->save();

                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Query has been Added.',
                    'body' => ''
                ],Response::HTTP_OK);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkshopQuery  $workshopQuery
     * @return \Illuminate\Http\Response
     */
    public function show(WorkshopQuery $workshopQuery)
    {
        return View::make('workshop.show_workshop_query')->with('workshopQuery', $workshopQuery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkshopQuery  $workshopQuery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkshopQuery $workshopQuery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkshopQuery  $workshopQuery
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Delete(
     *   path="/api/workshop/delete-workshop-query",
     *   summary="Delete Workshop Query",
     *   operationId="delete_workshop_query",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   consumes={"application/xml", "application/json"},
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Workshop Query Id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function destroy(WorkshopQuery $workshopQuery)
    {
       // delete
        $workshopQuery->delete();

        Session::flash('success_message', 'Successfully deleted the request!');
        return Redirect::to('admin/workshopQuery');
    }

    /**
     * Resolve the specified workshopQuery from storage.
     *
     * @param  \App\WorkshopQuery  $workshopQuery
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/api/workshop/delete-workshop-query",
     *   summary="Delete Workshop Query",
     *   operationId="delete_workshop_query",
     *   produces={"application/json"},
     *   tags={"Workshops"},
     *   consumes={"application/xml", "application/json"},
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Workshop Query Id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function resolve(WorkshopQuery $workshopQuery)
    {
        $workshopQuery->status      = 'Closed';
        $workshopQuery->is_resolved = true;
        $workshopQuery->save();

        Session::flash('success_message', 'Successfully updated the Status!');
        return Redirect::to('admin/workshopQuery/');
    }
}
