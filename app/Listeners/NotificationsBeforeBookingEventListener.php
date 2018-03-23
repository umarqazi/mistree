<?php

namespace App\Listeners;

use App\Events\NotificationsBeforeBookingEvent;
use App\Notifications\NotificationsBeforeBooking;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotificationsBeforeBookingEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationsBeforeBookingEvent  $event
     * @return void
     */
    public function handle(NotificationsBeforeBookingEvent $event)
    {
        $booking = $event->booking;
        $user = $event->user;
        $notification_booking = new NotificationsBeforeBooking($booking, $user);
        $booking_job_time = Carbon::parse($booking->job_time);
        $booking_time_diff = strval($booking_job_time->diffInMinutes());

        if( $user == "customer"){
            Notification::send($booking->customer, $notification_booking);
            if($booking->customer->fcm_token ){
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60*20);
                $notificationBuilder = new PayloadNotificationBuilder('Mystri - Booking at '.Carbon::parse($booking->job_time)->format('g:i A'));
                $notificationBuilder->setBody('You have '.$booking_time_diff.' Minutes in your booking to start.')->setSound('default');

                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['booking_id' => $booking->id]);

                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data = $dataBuilder->build();

                $token = $booking->customer->fcm_token;

                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
            }
        }else{
            Notification::send($booking->workshop, $notification_booking);
            if($booking->workshop->fcm_token ){
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60*20);
                $notificationBuilder = new PayloadNotificationBuilder('Mystri - Lead at '.Carbon::parse($booking->job_time)->format('g:i A'));
                $notificationBuilder->setBody('You have '.$booking_time_diff.' Minutes in your lead to start.')->setSound('default');

                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['booking_id' => $booking->id]);

                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data = $dataBuilder->build();

                $token = $booking->workshop->fcm_token;

                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
            }
        }
    }
}
