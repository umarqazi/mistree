<?php

namespace App\Listeners;

use App\Events\NewBookingEvent;
use App\Notifications\NewBooking;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;
use App\Workshop;
use App\Booking;
use App\Admin;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;


class NewBookingEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  NewBookingEvent  $event
     * @return void
     */
    public function handle(NewBookingEvent $event)
    {
        $booking = $event->booking;
        $notification_booking = new NewBooking($booking);
        Notification::send($booking->workshop, $notification_booking);

         $optionBuilder = new OptionsBuilder();
         $optionBuilder->setTimeToLive(60*20);

         $notificationBuilder = new PayloadNotificationBuilder('New Booking');
         $notificationBuilder->setBody('You have a new lead name form "'.$booking->customer->name.'".')->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['booking_id' => $booking->id]);

         $option = $optionBuilder->build();
         $notification = $notificationBuilder->build();

         $token = $booking->workshop->fcm_token;

         $downstreamResponse = FCM::sendTo($token, $option, $notification);
    }
}
