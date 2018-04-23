<?php

namespace App\Listeners;

use App\CustomerQuery;
use App\Events\CustomerQueryResolveEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;


class CustomerQueryResolveEventListener
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
     * @param  CustomerQueryResolveEvent  $event
     * @return void
     */
    public function handle(CustomerQueryResolveEvent $event)
    {
        $query = $event->query;
        if($query->customer->fcm_token){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder(env('APP_NAME').' - Query Resolved');
            $notificationBuilder->setBody('Your query "'.$query->subject.'" has been resolved by Admin.')->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['query_id' => $query->id, 'status' => 3 ]);
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $token = $query->customer->fcm_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
    }
}
