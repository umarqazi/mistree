<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workshop;
use App\Service;
use App\WorkshopAddress;
use App\CustomerAddress;
use App\Customer;
use App\Booking;

class BookingsController extends Controller
{
	public function createBooking(Request $request){
		$rules = [
            'customer_id'                    => 'required|integer',
            'workshop_id'                    => 'required|integer',
            'customer_car_id'                => 'required|integer',
            'job_date'                       => 'required',            
            'job_time'                       => 'required',
            'workshop_service_id'            => 'required|array'             
        ];        

        $input = $request->only('customer_id', 'workshop_id', 'customer_car_id', 'job_date', 'job_time', 'workshop_service_id');
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $request->offsetUnset('password');
            return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Booking Failed',
                    'body' => $request->all()
                ],Response::HTTP_OK);
        }

        $booking = new Booking;

        $booking->customer_id            = $request->customer_id;
        $booking->workshop_id            = $request->workshop_id;
		$booking->customer_car_id        = $request->customer_car_id;
        $booking->job_date	             = $request->customer_id;
        $booking->job_time               = $request->customer_id;
        $booking->response 			     = 'waiting';
        $booking->job_status 			 = 'not-started';

        $booking->save();

        $

	}
    
}
