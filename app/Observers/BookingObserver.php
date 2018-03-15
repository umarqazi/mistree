<?php 

namespace App\Observers;

use App\Workshop;
use App\Booking;
use App\Admin;
use App\Notifications\NewBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Notification;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class BookingObserver
{
	public function saving(Booking $booking)
    {
    	$workshop = $booking->workshop;
    	// dd($workshop);
    	$notification_booking = new NewBooking($booking);
    	Notification::send($workshop, $notification_booking);



    	$optionBuilder = new OptionsBuilder();
		$optionBuilder->setTimeToLive(60*20);

		$notificationBuilder = new PayloadNotificationBuilder('New Booking');
		$notificationBuilder->setBody($notification_booking->data['msg'])->setSound('default');

		$option = $optionBuilder->build();
		$notification = $notificationBuilder->build();

		$token = $booking->workshop->fcm_token;

		$downstreamResponse = FCM::sendTo($token, $option, $notification);

    }

}