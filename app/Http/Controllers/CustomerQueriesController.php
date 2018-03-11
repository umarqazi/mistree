<?php

namespace App\Http\Controllers;

use App\CustomerQuery;
use Illuminate\Http\Request;
use JWTAuth, Session, View, Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class CustomerQueriesController extends Controller
{
    /**
     * Display a listing of the customerQueries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerQueries = CustomerQuery::all()->load('customer');
        return View::make('customer.index_customer_query')->with('customerQueries', $customerQueries);
    }

    /**
     * Store a newly created customerQuery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @SWG\Post(
     *   path="/api/customer/customerQueries",
     *   summary="Add Customer Query",
     *   operationId="add_customer_query",
     *   produces={"application/json"},
     *   tags={"Queries"},
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
            $customer = JWTAuth::Authenticate();
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
            $customer->queries()->create([
                'subject'       => $request->subject,
                'message'       => $request->message,
                'status'        => 'Open',
                'is_resolved'   => false
            ]);
            $subject = "Customer Query - ".$request->subject;
            Mail::send('customer.emails.query', ['customer' => $customer, 'subject' => $request->subject, 'message' => $request->message],
            function($mail) use ($subject){
                $mail->from(config('app.mail_username'), config('app.name'));
                $mail->to(config('app.mail_username'));
                $mail->subject($subject);
            });
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => 'success',
                'message' => 'Query has been Added.',
                'body' => null
            ],Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerQuery  $customerQuery
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerQuery $customerQuery)
    {
        return View::make('customer.show_customer_query')->with('customerQuery', $customerQuery);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerQuery  $customerQuery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerQuery $customerQuery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerQuery  $customerQuery
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerQuery $customerQuery)
    {
        // delete
        $customerQuery->delete();

        Session::flash('success_message', 'Successfully deleted the request!');
        return Redirect::to('admin/customer-queries');
    }

    /**
     * Resolve the specified customerQuery from storage.
     *
     * @param  \App\CustomerQuery  $customerQuery
     * @return \Illuminate\Http\Response
     */
    public function resolve(CustomerQuery $customerQuery)
    {
        $customerQuery->status      = 'Closed';
        $customerQuery->is_resolved = true;
        $customerQuery->save();

        Session::flash('success_message', 'Successfully updated the Status!');
        return Redirect::to('admin/customer-queries/');
    }
}
