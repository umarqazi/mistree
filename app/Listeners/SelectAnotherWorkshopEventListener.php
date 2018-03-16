<?php

namespace App\Listeners;

use App\Events\SelectAnotherWorkshopEvent;
use App\Notifications\SelectAnotherWorkshop;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Notification;

class SelectAnotherWorkshopEventListener
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
     * @param  SelectAnotherWorkshopEvent  $event
     * @return void
     */
    public function handle(SelectAnotherWorkshopEvent $event)
    {
        $booking = $event->booking;
        $notification_booking = new SelectAnotherWorkshop($booking);
        Notification::send($booking->customer, $notification_booking);

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('Select Another Workshop');
        $notificationBuilder->setBody('Please select another workshop, "'.$booking->workshop->name.'" has not accepted your request.')->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['booking_id' => $booking->id]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = $booking->workshop->fcm_token;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    }
}
