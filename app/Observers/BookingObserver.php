<?php 

namespace App\Observers;

use App\Workshop;
use App\Bokking;
use App\Admin;
use App\Notifications\NewBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Notification;

class BookingObserver
{
	public function saved(Booking $booking)
    {
    	$workshop = $booking->workshop();
    	Notification::send($workshop, new NewBooking($booking));
    }

}