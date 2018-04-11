<?php

namespace App\Listeners;

use App\Events\InformApprovalEvent;
use App\Notifications\InformApprovalNotification;
use Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class InformApprovalEventListener
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
     * @param  InformApprovalEvent $event
     * @return void
     */
    public function handle(InformApprovalEvent $event)
    {
        $workshop = $event->workshop;
        $notification = new InformApprovalNotification($workshop);
        Notification::send($workshop, $notification);

        if ($workshop->fcm_token) {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder('Mystri - Congratulations');
            $notificationBuilder->setBody('Congratulations! Your workshop has been approved.')->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['workshop_id' => $workshop->id]);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            $token = $workshop->fcm_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
    }
}