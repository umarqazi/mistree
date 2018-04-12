<?php

namespace App\Listeners;

use App\Events\RateNotificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class RateNotificationEventListener
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
     * @param  RateNotificationEvent $event
     * @return void
     */
    public function handle(RateNotificationEvent $event)
    {
        $booking = $event->booking;
        if ($booking->customer->fcm_token) {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder(env('APP_NAME').' - Rate & Reviews');
            $notificationBuilder->setBody('Please rate and review your experience with "' . $booking->workshop->name . '".')->setSound('default');

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
