<?php

namespace App\Listeners;

use App\Events\MinimumBalanceEvent;
use App\Notifications\MinimumBalance;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class MinimumBalanceEventListener
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
     * @param  MinimumBalanceEvent  $event
     * @return void
     */
    public function handle(MinimumBalanceEvent $event)
    {
        Notification::send($event->workshop, new MinimumBalance());
        if($event->workshop->fcm_token){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder(env('APP_NAME').' - Balance Update');
            $notificationBuilder->setBody('You are running out of balance. Please recharge your account.')->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['workshop_id' => $event->workshop->id]);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            $token = $event->workshop->fcm_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
    }
}
