<?php

namespace App\Listeners;

use App\Events\NotifictionsBeforeBookingEvent;
use App\Notifications\NotificationsBeforeBooking;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifictionsBeforeBookingEventListener
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
     * @param  NotifictionsBeforeBookingEvent  $event
     * @return void
     */
    public function handle(NotifictionsBeforeBookingEvent $event)
    {
        $booking = $event->booking;
        $user = $event->user;
        $notification_booking = new NotificationsBeforeBooking($booking, $user);
        if( $user == "customer"){
            Notification::send($booking->customer, $notification_booking);
            if($booking->customer->fcm_token ){
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60*20);
                $notificationBuilder = new PayloadNotificationBuilder('Mystri - Booking at '.$booking->job_time);
                $notificationBuilder->setBody('You have '.($booking->job_time)->diff(Carbon::now())->format('%I').' Minutes in your booking to start.')->setSound('default');

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
                $notificationBuilder = new PayloadNotificationBuilder('Mystri - Lead at '.$booking->job_time);
                $notificationBuilder->setBody('You have '.($booking->job_time)->diff(Carbon::now())->format('%I').' Minutes in your lead to start.')->setSound('default');

                $dataBuilder = new PayloadDataBuilder();
                $dataBuilder->addData(['booking_id' => $booking->id]);

                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data = $dataBuilder->build();

                $token = $booking->customer->fcm_token;

                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
            }
        }
    }
}
