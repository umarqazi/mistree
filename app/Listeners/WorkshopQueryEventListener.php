<?php

namespace App\Listeners;

use App\Admin;
use App\Events\WorkshopQueryEvent;
use App\Notifications\WorkshopQuery;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class WorkshopQueryEventListener
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
     * @param  WorkshopQueryEvent  $event
     * @return void
     */
    public function handle(WorkshopQueryEvent $event)
    {
        $admins = Admin::all();
        Notification::send($admins, new WorkshopQuery($event->query));
    }
}
