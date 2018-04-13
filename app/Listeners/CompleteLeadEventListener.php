<?php

namespace App\Listeners;

use App\Events\CompleteLeadEvent;
use App\Notifications\CompleteTheLead;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class CompleteLeadEventListener
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
     * @param  CompleteLeadEvent $event
     * @return void
     */
    public function handle(CompleteLeadEvent $event)
    {
        $booking = $event->booking;
        if ($booking->workshop->fcm_token) {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder(env('APP_NAME').' - Complete The Lead');
            $notificationBuilder->setBody('Please complete your lead with "' . $booking->customer->name . '"')->setSound('default');

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
