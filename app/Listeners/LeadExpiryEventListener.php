<?php

namespace App\Listeners;

use App\Events\LeadExpiryEvent;
use App\Notifications\LeadExpiry;
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

class LeadExpiryEventListener
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
     * @param  LeadExpiryEvent  $event
     * @return void
     */
    public function handle(LeadExpiryEvent $event)
    {
        $booking = $event->booking;
        $notification_booking = new LeadExpiry($booking);
        Notification::send($booking->workshop, $notification_booking);

        if($booking->workshop->fcm_token){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder('Mystri - Lead Will Expire');
            $notificationBuilder->setBody('Lead from "'.$booking->customer->name.'" will expire in 5 minutes.')->setSound('default');

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
