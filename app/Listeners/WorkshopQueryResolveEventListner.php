<?php

namespace App\Listeners;

use App\WorkshopQuery;
use App\Events\WorkshopQueryResolveEvent;
use App\Notifications\WorkshopQueryResolved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;


class WorkshopQueryResolveEventListner
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
     * @param  WorkshopQueryResolveEvent  $event
     * @return void
     */
    public function handle(WorkshopQueryResolveEvent $event)
    {
        $query = $event->query;
        Notification::send($query->workshop , new WorkshopQueryResolved($event->query));

        if($query->workshop->fcm_token){
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder(env('APP_NAME').' - Query Resolved');
            $notificationBuilder->setBody('Your query "'.$query->subject.'" has been resolved by Admin.')->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['query_id' => $query->id ]);
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $token = $query->workshop->fcm_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
    }
}
