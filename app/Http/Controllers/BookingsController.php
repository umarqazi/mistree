<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Hash, DB, Config, Mail, View;
use Session;
use App\Workshop;
use App\Service;
use App\Billing;
use App\WorkshopAddress;
use App\WorkshopLedger;
use App\Customer;
use App\Booking;

class BookingsController extends Controller
{   

     /**
     * @SWG\Post(
     *   path="/api/workshop/createbooking",
     *   summary="Create Booking",
     *   operationId="booking",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="customer_id",
     *     in="formData",
     *     description="Customer id",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="workshop_id",
     *     in="formData",
     *     description="Workshop ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="customer_car_id",
     *     in="formData",
     *     description="Customer Car ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="job_date",
     *     in="formData",
     *     description="Job Date",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="job_time",
     *     in="formData",
     *     description="Job Time",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="services",
     *     in="formData",
     *     description="[id1,id2,id3,...]",
     *     required=true,
     *     type="array",
     *     items="integer"      
     *   ),
     *   @SWG\Parameter(
     *     name="vehicle_no",
     *     in="formData",
     *     description="Vehicle Number",
     *     required=true,
     *     type="string"     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
	public function createBooking(Request $request){
		$rules = [
            'customer_id'                    => 'required|integer',
            'workshop_id'                    => 'required|integer',
            'customer_car_id'                => 'required|integer',
            'job_date'                       => 'required',            
            'job_time'                       => 'required',
            'services'                       => 'required'             
        ];        

        $input = $request->only('customer_id', 'workshop_id', 'customer_car_id', 'job_date', 'job_time', 'services');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages(),
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }

        $booking = new Booking;

        $booking->customer_id            = $request->customer_id;
        $booking->workshop_id            = $request->workshop_id;
		$booking->customer_car_id        = $request->customer_car_id;
        $booking->job_date	             = $request->job_date;
        $booking->job_time               = $request->job_time;
        $booking->response 			     = 'waiting';
        $booking->job_status 			 = 'not-started';
        $booking->vehicle_no             = $request->vehicle_no;

        $booking->save();

        //Insert Services data from request        
        $services = $request->services;        
        if(!empty($services)){
            foreach($services as $service){
                $workshop = Workshop::find($request->workshop_id);
                $service_info = $workshop->services()->where('service_id',$service)->first();
                $booking->services()->attach($service,['name' => $service_info->name, 'service_rate' => $service_info->pivot->service_rate, 'service_time' => $service_info->pivot->service_time]);
            }
        }        

        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking create',
                    'body' => $request->all()
                ],Response::HTTP_OK);

	}

    /**
     * @SWG\Patch(
     *   path="/api/workshop/accept-booking/{booking_id}",
     *   summary="Accept Booking",
     *   operationId="acception",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="booking_id",
     *     in="path",
     *     description="Booking ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
    */
    public function acceptBooking($booking_id){
        $workshop_id = Auth::user()->id;
        $workshop = Workshop::find($workshop_id);
        $workshop->bookings()->where('id', $booking_id)->update(['response' => 'accepted']);
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking Accepted',
                    'body' => ''
                ],Response::HTTP_OK);
    }


     /**
     * @SWG\Patch(
     *   path="/api/workshop/reject-booking/{booking_id}",
     *   summary="Reject Booking",
     *   operationId="rejection",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="booking_id",
     *     in="path",
     *     description="Booking ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )     
    */
    public function rejectBooking($booking_id){
        $workshop_id = Auth::user()->id;
        $workshop = Workshop::find($workshop_id);
        $workshop->bookings()->where('id', $booking_id)->update(['response' => 'rejected']);
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking Rejected',
                    'body' => ''
                ],Response::HTTP_OK);
    }

     /**
     * @SWG\Post(
     *   path="/api/customer/amount-paid",
     *   summary="Bill Paid by customer",
     *   operationId="Paid Bill",
     *   produces={"application/json"},
     *   tags={"Customers"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="billing_id",
     *     in="formData",
     *     description="Billing ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="paid_amount",
     *     in="formData",
     *     description="Customer Total Paid Amount",
     *     required=true,
     *     type="number"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function customerpaidbill(Request $request){

        $billing = Billing::find($request->billing_id);
        $billing->paid_amount = $request->paid_amount;
        $billing->save();

        $billing->booking->services;

        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking Services',
                    'body' => $billing
                ],Response::HTTP_OK);
    }

    /**
     * @SWG\Post(
     *   path="/api/workshop/complete-job",
     *   summary="Workshop Complete Job",
     *   operationId="Insert Billing",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="booking_id",
     *     in="formData",
     *     description="Booking ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="customer_id",
     *     in="formData",
     *     description="Customer ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function completeLead(Request $request){
        $workshop_id = Auth::user()->id;
        $rules = [                        
            'booking_id'                        => 'required|integer',
            'customer_id'                       => 'required|integer'           
        ];   
        
        $input = $request->only('booking_id', 'customer_id');

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages(),
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }             

        $booking = Booking::find($request->booking_id);                            
        $booking_services = $booking->services;
        $booking->job_status = 'completed';
        $booking->save();

        $bill = 0;
        foreach($booking_services as $service){
            $bill = $service->pivot->service_rate + $bill;            
        }        

        $billing = new Billing;
        $billing->workshop_id                = $workshop_id;         
        $billing->booking_id                 = $request->booking_id;
        $billing->amount                     = $bill;
        $billing->customer_id                = $request->customer_id;

        $billing->save();

        $services_count = $booking->services->count();
        $deduction = $services_count * 50;
        $workshop = Workshop::find($workshop_id);
        $balance = $workshop->balance->balance;        
        $new_balance = $balance - $deduction;

        $workshop->balance->update(['balance'=>$new_balance]);

        $transaction = new WorkshopLedger;

        $transaction->workshop_id                   = $workshop_id;         
        $transaction->booking_id                    = $request->booking_id;         
        $transaction->amount                        = $deduction;         
        $transaction->transaction_type              = 'Job-Billing';         
        $transaction->unadjusted_balance            = $balance;         
        $transaction->adjusted_balance              = $new_balance;

        $transaction->save();

        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Job Completed',
                    'body' => ''
                ],Response::HTTP_OK);
    }    

    // Leads

     /**
     * @SWG\Get(
     *   path="/api/workshop/leads-info",
     *   summary="Leads Information",
     *   operationId="get",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLeadsInfo(){
        $workshop = Auth::guard('workshop')->user();
        $accepted_leads = $workshop->bookings()->where('response','accepted')->get()->count();
        $completed_leads = $workshop->bookings()->where('job_status', 'completed')->get()->count();
        $received_leads = $workshop->bookings()->count();
        $balance = $workshop->balance->balance;
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Workshop Ledger',
                    'body' => ['accepted_leads' => $accepted_leads, 'completed_leads' => $completed_leads, 'received_leads' => $received_leads, 'balance' => $balance]
                ],Response::HTTP_OK);
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/history",
     *   summary="Leads History",
     *   operationId="get",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Getting Workshop LeadHistory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function leadsHistory(Request $request){
        $workshop = Auth::guard('workshop')->user();
        $bookings = Booking::where('workshop_id', $workshop->id)->get()->load(['billing', 'services']);
       
        // check request Type
        if( $request->header('Content-Type') == 'application/json')
        {
            if(count($bookings) == 0){
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => false,
                            'message' => 'No Leads Found',
                            'body' => ''
                        ],Response::HTTP_OK);            
            }else{            
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'Workshop History',
                            'body' => $bookings
                        ],Response::HTTP_OK);
            }
        }
        else 
        {            
                return View::make('workshop.history', ['bookings' => $bookings]);    

        }
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/leads/accepted",
     *   summary="Accepted Leads",
     *   operationId="get",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Getting Workshop AcceptedLeads.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function acceptedLeads(Request $request){
        $workshop = Auth::guard('workshop')->user();
        $accepted_leads = Booking::where('workshop_id', $workshop->id)->where('is_accepted',1)->with('services')->get();
         // check request Type
         if( $request->header('Content-Type') == 'application/json')
         {
            if(count($accepted_leads) == 0){
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'No Accepted Leads Found',
                            'body' => ''
                        ],Response::HTTP_OK);            
            }else{            
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'Accepted Leads',
                            'body' => $accepted_leads
                        ],Response::HTTP_OK);
            }     
        } 
        else
        {
            return View::make('workshop.accepted_leads', ['accepted_leads' => $accepted_leads]); 
        }           
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/leads/rejected",
     *   summary="Rejected Leads",
     *   operationId="get",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Getting Workshop rejectedLeads.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectedLeads(Request $request){
        $workshop = Auth::guard('workshop')->user();
        $rejected_leads = Booking::where('workshop_id', $workshop->id)->where('is_accepted',0)->with('services')->get();
        if( $request->header('Content-Type') == 'application/json')
        {
            if(count($rejected_leads) == 0){
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'No rejected Leads Found',
                            'body' => ''
                        ],Response::HTTP_OK);            
            }else{
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'Rejected Leads',
                            'body' => $rejected_leads
                        ],Response::HTTP_OK);            
            } 
         }
         else
         {
            return View::make('workshop.rejected_leads', ['rejected_leads' => $rejected_leads]);
         }        
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/leads/completed",
     *   summary="Completed Leads",
     *   operationId="get",
     *   produces={"application/json"},
     *   tags={"Bookings"},
     *    @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *    
     * Getting Workshop Ledger.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completedLeads(){
        $workshop = Auth::user();
        $completed_leads = Booking::where('workshop_id', $workshop->id)->where('job_status','completed')->with('services')->get();

        if(count($completed_leads) == 0){
            return response()->json([
                        'http-status' => Response::HTTP_OK,
                        'status' => true,
                        'message' => 'No Completed Leads Found',
                        'body' => ''
                    ],Response::HTTP_OK);            
        }else{
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Completed Leads',
                    'body' => $completed_leads
                ],Response::HTTP_OK);            
        }         
        
    }
    

}
