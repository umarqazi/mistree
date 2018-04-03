<?php

namespace App\Listeners;

use App\Admin;
use App\Events\CustomerQueryEvent;
use App\Notifications\CustomerQuery;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class CustomerQueryEventListener
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
     * @param  CustomerQueryEvent  $event
     * @return void
     */
    public function handle(CustomerQueryEvent $event)
    {
        echo $event->query;
        die();

        $admins = Admin::all();
        Notification::send($admins, new CustomerQuery($event->query));
    }
}
