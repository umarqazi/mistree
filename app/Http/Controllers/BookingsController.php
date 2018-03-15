<?php

namespace App\Http\Controllers;

use JWTAuth;
use DB, Config, Mail, View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
     *   path="/api/customer/create-booking",
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
     *     name="workshop_id",
     *     in="formData",
     *     description="Workshop ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="car_id",
     *     in="formData",
     *     description="Car ID",
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
     *   @SWG\Parameter(
     *     name="is_doorstep",
     *     in="formData",
     *     description="Doorstep or not",
     *     required=true,
     *     type="boolean"     
     *   ),
     *   @SWG\Parameter(
     *     name="customer_address_id",
     *     in="formData",
     *     description="Customer Address for booking",
     *     required=true,
     *     type="integer"     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
	public function createBooking(Request $request){
        $customer_id = JWTAuth::authenticate()->id;        
		$rules = [            
            'workshop_id'                    => 'required|integer',
            'car_id'                         => 'required|integer',
            'job_date'                       => 'required',            
            'job_time'                       => 'required',
            'services'                       => 'required',             
            'is_doorstep'                    => 'required',
            'customer_address_id'            => 'required|integer',
            'vehicle_no'                     => 'regex:^[A-Z]{2}[A-Z]{0,2}[-]0?[1-9]{1}\d{0,3}$'
        ];        

        $input = $request->only('workshop_id', 'car_id', 'job_date', 'job_time', 'services', 'is_doorstep', 'customer_address_id');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages()->first(),
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }

        $booking = new Booking;

        $booking->customer_id            = $customer_id;
        $booking->workshop_id            = $request->workshop_id;
		$booking->car_id                 = $request->car_id;
        $booking->job_date	             = $request->job_date;
        $booking->job_time               = $request->job_time;
        $booking->is_accepted 			 = false;
        $booking->job_status 			 = 'open';
        $booking->vehicle_no             = $request->vehicle_no;
        $booking->customer_address_id    = $request->customer_address_id;
        $booking->is_doorstep            = $request->is_doorstep;

        $booking->save();

        //Insert Services data from request        
        $services = json_decode($request->services);        
        if(!empty($services)){
            foreach($services as $service){
                $workshop = Workshop::find($request->workshop_id);
                $service_info = $workshop->services()->where('service_id',$service)->first();
                $booking->services()->attach($service,['name' => $service_info->name, 'lead_charges' => $service_info->lead_charges, 'loyalty_points' => $service_info->loyalty_points, 'service_rate' => $service_info->pivot->service_rate, 'service_time' => $service_info->pivot->service_time]);
            }
        }        

        $booking->services;
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking created',
                    'body' => ['booking' => $booking ]
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
        $workshop_id = JWTAuth::authenticate()->id;
        $workshop = Workshop::find($workshop_id);
        $workshop->bookings()->where('id', $booking_id)->update(['is_accepted' => true]);
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking Accepted',
                    'body' => null
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
        $workshop_id = JWTAuth::authenticate()->id;
        $workshop = Workshop::find($workshop_id);
        $workshop->bookings()->where('id', $booking_id)->update(['is_accepted' => false, 'job_status' => 
            'rejected']);
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking Rejected',
                    'body' => null
                ],Response::HTTP_OK);
    }

     /**
     * @SWG\Post(
     *   path="/api/customer/billing/{billing_id}/amount-paid",
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
     *     in="path",
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
    public function customerpaidbill(Request $request, $billing_id){

        $billing = Billing::find($billing_id);
        $billing->paid_amount = $request->paid_amount;
        $billing->save();

        $billing->booking->services;

        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Booking Services',
                    'body' => [ 'billing' => $billing ]
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
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function completeLead(Request $request){
        $workshop   = JWTAuth::authenticate();
        $workshop_id = $workshop->id;
        $rules = [                        
            'booking_id'                        => 'required|integer',            
        ];   
        
        $input = $request->only('booking_id');

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => $validator->messages()->first(),
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }             

        $booking = Booking::find($request->booking_id);                                    
        $bill = $booking->services->pluck('pivot')->sum('service_rate');
        $lead_charges = $booking->services->pluck('pivot')->sum('lead_charges');
        $loyalty_points = $booking->services->pluck('pivot')->sum('loyalty_points');
        
        $booking->job_status = 'completed';
        $booking->loyalty_points = $loyalty_points;
        $booking->save();

        $customer = Customer::find($booking->customer_id);
        $customer->loyalty_points = $loyalty_points + $customer->loyalty_points;        
        $customer->save();

            
        $billing = new Billing;
        $billing->workshop_id                = $workshop_id;         
        $billing->booking_id                 = $request->booking_id;
        $billing->amount                     = $bill;
        $billing->customer_id                = $booking->customer_id;

        if($workshop->billings->count()>=10){
            $billing->lead_charges           = $lead_charges;
            $billing->is_free                = false;
            $billing->save();

            $workshop = Workshop::find($workshop_id);
            $balance = $workshop->balance->balance;        
            $new_balance = $balance - $lead_charges;
            
            $workshop->balance->update(['balance'=>$new_balance]);

            $transaction = new WorkshopLedger;
            $transaction->workshop_id                   = $workshop_id;         
            $transaction->booking_id                    = $request->booking_id;         
            $transaction->amount                        = $lead_charges;         
            $transaction->transaction_type              = 'Job-Billing';         
            $transaction->unadjusted_balance            = $balance;         
            $transaction->adjusted_balance              = $new_balance;

            $transaction->save();


        }else{
            $billing->lead_charges           = 0;
            $billing->is_free                = true;           
            $billing->save();
        }

        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Job Completed',
                    'body' => ['billing'=> $billing]
                ],Response::HTTP_OK);
    }

    /**
     * @SWG\Patch(
     *   path="/api/workshop/lead/{booking_id}/enter-millage",
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
     *    @SWG\Parameter(
     *     name="booking_id",
     *     in="path",
     *     description="Booking ID",
     *     required=true,
     *     type="integer"
     *   ),
     *    @SWG\Parameter(
     *     name="millage",
     *     in="formData",
     *     description="Millage at job date",
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
    public function insertMillage(Request $request, $booking_id){        
        
        $booking = Booking::find($booking_id);
        $booking->millage =$request->millage;
        $booking->save() ;

        return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Millage Entered',
                'body' => ['booking' => $booking ]
            ],Response::HTTP_OK);      
    }

    public function workshopHistory(Workshop $workshop){        
        $total_earning = $workshop->billings->sum('amount');
        return view::make('workshop.history',['balance'=>$workshop->balance, 'total_earning' => $total_earning, 'leads' => $workshop->bookings, 'workshop'=>$workshop]);
    }

    public function workshopRejectedLeads(Workshop $workshop){        
        $total_earning = $workshop->billings->sum('amount');
        return view::make('workshop.rejected_leads',['balance'=>$workshop->balance, 'total_earning' => $total_earning, 'leads' => $workshop->bookings->where('job_status' , 'rejected')->where('is_accepted' , false ), 'workshop'=>$workshop]);       
    }

    public function workshopAcceptedLeads(Workshop $workshop){        
        $total_earning = $workshop->billings->sum('amount');
        return view::make('workshop.accepted_leads',['balance'=>$workshop->balance, 'total_earning' => $total_earning, 'leads' => $workshop->bookings->where('is_accepted',true), 'workshop'=>$workshop]);       
    }

    public function workshopCompletedLeads(Workshop $workshop){        
        $total_earning = $workshop->billings->sum('amount');
        return view::make('workshop.completed_leads',['balance'=>$workshop->balance, 'total_earning' => $total_earning, 'leads' => $workshop->bookings->where('job_status' , 'completed')->where('is_accepted' , true ), 'workshop'=>$workshop]);       
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
        $workshop   = JWTAuth::authenticate();        
        $accepted_leads = $workshop->bookings()->where('is_accepted', true)->get()->count();
        $completed_leads = $workshop->bookings()->where('is_accepted', true)->where('job_status', 'completed')->get()->count();
        $rejected_leads = $workshop->bookings()->where('is_accepted', false)->where('job_status', 'rejected')->get()->count();
        $received_leads = $workshop->bookings()->count();
        $balance = $workshop->balance->balance;
        $matured_revenue = $workshop->billings->sum('amount');
        $leads = ['accepted_leads' => $accepted_leads, 'rejected_leads'=> $rejected_leads, 'completed_leads' =>
        $completed_leads,
        'received_leads' =>
            $received_leads, 'balance' => $balance, 'matured_revenue' => $matured_revenue ];
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Workshop Ledger',
                    'body' => ['leads'=> $leads]
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
        $req = $request->header('Content-Type');
        if($req == 'application/json'){            
            $workshop = JWTAuth::authenticate();            
        }else{                    
            $workshop = Auth::guard('workshop')->user();
        }        
        if($workshop->billings != null){            
            $total_earning = $workshop->billings->sum('amount');
        }else{
            $total_earning = null;
        }
        $bookings = Booking::where('workshop_id', $workshop->id)->get()->load(['billing', 'services']);
               
        if( $request->header('Content-Type') == 'application/json')
        {
            if(count($bookings) == 0){
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => false,
                            'message' => 'No Leads Found',
                            'body' => null
                        ],Response::HTTP_OK);            
            }else{            
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'Workshop History',
                            'body' => ['bookings' => $bookings, 'total_earning' => $total_earning]
                        ],Response::HTTP_OK);
            }
        }
        else 
        {            
                return View::make('workshop_profile.history', ['bookings' => $bookings, 'workshop'=>$workshop, 'total_earning'=>$total_earning,'balance'=>$workshop->balance]);    

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
        if($request->header('content-type') == 'application/json'){
            $workshop = JWTAuth::authenticate();
        }else{
            $workshop = Auth::guard('workshop')->user();
        }
        $accepted_leads = Booking::where('workshop_id', $workshop->id)->where('is_accepted', true)->with('services')->get();
        $total_earning = $workshop->billings->sum('amount');
        // check request Type
         if( $request->header('Content-Type') == 'application/json')
         {
            if(count($accepted_leads) == 0){
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'No Accepted Leads Found',
                            'body' => null
                        ],Response::HTTP_OK);            
            }else{            
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'Accepted Leads',
                            'body' => ['accepted_leads' => $accepted_leads]
                        ],Response::HTTP_OK);
            }     
        } 
        else
        {
            return View::make('workshop_profile.accepted_leads', ['accepted_leads' => $accepted_leads,'workshop'=>$workshop, 'total_earning'=>$total_earning,'balance'=>$workshop->balance]); 
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
        if($request->header('content-type') == 'application/json'){
            $workshop = JWTAuth::authenticate();
        }else{
            $workshop = Auth::guard('workshop')->user();
        }
        $total_earning = $workshop->billings->sum('amount');
        $rejected_leads = Booking::where('workshop_id', $workshop->id)->where('job_status','rejected')->where('is_accepted', false)->with('services')->get();
        if( $request->header('Content-Type') == 'application/json')
        {
            if(count($rejected_leads) == 0){
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'No rejected Leads Found',
                            'body' => null
                        ],Response::HTTP_OK);            
            }else{
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'Rejected Leads',
                            'body' => ['rejected_leads' => $rejected_leads]
                        ],Response::HTTP_OK);            
            } 
         }
         else
         {
            return View::make('workshop_profile.rejected_leads', ['workshop'=>$workshop,'balance'=>$workshop->balance,'total_earning'=>$total_earning, 'rejected_leads' => $rejected_leads]);
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
    public function completedLeads(Request $request){
        if($request->header('content-type') == 'application/json'){
            $workshop = JWTAuth::authenticate();
        }else{
            $workshop = Auth::guard('workshop')->user();
        }
        $completed_leads = Booking::where('workshop_id', $workshop->id)->where('job_status','completed')->where('is_accepted', true)->with('services')->get();
        $total_earning = $workshop->billings->sum('amount');
        if( $request->header('Content-Type') == 'application/json')
        {
            if(count($completed_leads) == 0){
                return response()->json([
                            'http-status' => Response::HTTP_OK,
                            'status' => true,
                            'message' => 'No Completed Leads Found',
                            'body' => null
                        ],Response::HTTP_OK);            
            }else{
                return response()->json([
                        'http-status' => Response::HTTP_OK,
                        'status' => true,
                        'message' => 'Completed Leads',
                        'body' => ['completed_leads' => $completed_leads]
                    ],Response::HTTP_OK);            
            }   
        }   
        else{
            return View::make('workshop_profile.completed_leads', ['workshop'=>$workshop,'balance'=>$workshop->balance,'total_earning'=>$total_earning, 'completed_leads'=>$completed_leads]);
        }   
        
    }

    /**
     * @SWG\Get(
     *   path="/api/workshop/leads/pending",
     *   summary="Pending Leads",
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
    public function pendingLeads(Request $request){
        $workshop = JWTAuth::authenticate();
        $pending_leads = Booking::where('workshop_id', $workshop->id)->where('job_status','open')->where('is_accepted', false)->with('services')->get();
                
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Pending Bookings',
                    'body' => ['pending_bookings' => $pending_leads]
                ],Response::HTTP_OK);

    }

    /**
     * @SWG\Get(
     *   path="/api/customer/bookings/",
     *   summary="Customer Bookings",
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
    public function customerBookings(Request $request){
        $customer = JWTAuth::authenticate();
        $bookings = Booking::where('customer_id', $customer->id)->with('services')->get();        
                
        return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Bookings',
                    'body' => ['bookings' => $bookings]
                ],Response::HTTP_OK);                        
        
    }


}
