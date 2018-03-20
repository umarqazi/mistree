<?php

namespace App\Http\Controllers;

use App\WorkshopQuery;
use Illuminate\Http\Request;
use JWTAuth, Session, Config, View, Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class WorkshopQueriesController extends Controller
{
    /**
     * Fetching Guard.
     *
     * @return Auth::guard()
     */
    protected function guard()
    {
        return Auth::guard('workshop');
    }

    /**
     * Constructor.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     *
     * @return void
     */
    public function __construct()
    {
        $this->auth = app('auth')->guard('workshop');
    }

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('workshop.create_workshop_query');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/api/workshop/workshop-queries",
     *   summary="Add Workshop Query",
     *   operationId="add_workshop_query",
     *   tags={"Queries"},
     *   consumes={"application/json"},
     *   produces={"application/json"},
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
     *     description="Message Text",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function store(Request $request)
    {
        if( $request->header('Content-Type') == 'application/json'){
            $workshop = JWTAuth::Authenticate();
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
            }
            $workshop->queries()->create([
                'subject'       => $request->subject,
                'message'       => $request->message,
                'status'        => 'Open',
                'is_resolved'   => false
            ]);
            $subject = "Workshop Query - ".$request->subject;
            Mail::send('workshop.emails.query', ['workshop' => $workshop, 'subject' => $request->subject, 'msg' => $request->message],
                function($mail) use ($subject){
                    $mail->from(Config::get('app.mail_username'), Config::get('app.name'));
                    $mail->to(Config::get('app.mail_username'));
                    $mail->subject($subject);
                });
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Query has been Added.',
                'body' => null
            ],Response::HTTP_OK);
        }else{
            $workshop = Auth::guard('workshop')->user();
            $rules = array(
                'subject'      => 'required',
                'message'      => 'required'
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('error_message', 'Invalid Details!');
                return Redirect::to('workshop-queries/create');
            }
            $workshop->queries()->create([
                'subject'       => $request->subject,
                'message'       => $request->message,
                'status'        => 'Open',
                'is_resolved'   => false
            ]);
            $subject = "Workshop Query - ".$request->subject;
            Mail::send('workshop.emails.query', ['workshop' => $workshop, 'subject' => $request->subject, 'msg' => $request->message],
                function($mail) use ($subject){
                    $mail->from(Config::get('app.mail_username'), Config::get('app.name'));
                    $mail->to(Config::get('app.mail_username'));
                    $mail->subject($subject);
                });
            Session::flash('success_message', 'Successfully Added the Request!');
            return Redirect::to('workshop-queries/create');
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
    public function destroy(WorkshopQuery $workshopQuery)
    {
       // delete
        $workshopQuery->delete();

        Session::flash('success_message', 'Successfully deleted the request!');
        return Redirect::to('admin/workshop-queries');
    }

    /**
     * Resolve the specified workshopQuery from storage.
     *
     * @param  \App\WorkshopQuery  $workshopQuery
     * @return \Illuminate\Http\Response
     */
    public function resolve(WorkshopQuery $workshopQuery)
    {
        $workshopQuery->status      = 'Closed';
        $workshopQuery->is_resolved = true;
        $workshopQuery->save();

        Session::flash('success_message', 'Successfully updated the Status!');
        return Redirect::to('admin/workshop-queries');
    }
}
