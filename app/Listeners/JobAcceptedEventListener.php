<?php

namespace App\Listeners;

use App\Booking;
use App\Events\JobAcceptedEvent;
use App\Notifications\JobAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Notification;

class JobAcceptedEventListener
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
     * @param  JobAcceptedEvent  $event
     * @return void
     */
    public function handle(JobAcceptedEvent $event)
    {
        $booking = $event->booking;
        Notification::send($booking->customer, new JobAccepted($booking));

        if($booking->customer->fcm_token){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder(env('APP_NAME').' - Booking Accepted');
            $notificationBuilder->setBody('Your booking request has been accepted by "'.$booking->workshop->name.'".')->setSound('default');

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
