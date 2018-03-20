<?php

namespace App\Listeners;

use App\Events\JobClosedEvent;
use App\Notifications\JobClosed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Notification;

class JobClosedEventListener
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
     * @param  JobClosedEvent  $event
     * @return void
     */
    public function handle(JobClosedEvent $event)
    {
        $booking = $event->booking;
        Notification::send($booking->customer, new JobClosed($booking));
        if($booking->customer->fcm_token){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder('Mistri - Booking Completed');
            $notificationBuilder->setBody('Your booking has been marked as completed by "'.$booking->workshop->name.'".')->setSound('default');

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