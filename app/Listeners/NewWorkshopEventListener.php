<?php

namespace App\Listeners;

use App\Admin;
use App\Events\NewWorkshopEvent;
use App\Notifications\NewWorkshop;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class NewWorkshopEventListener
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
     * @param  NewWorkshopEvent  $event
     * @return void
     */
    public function handle(NewWorkshopEvent $event)
    {
        $admins = Admin::all();
        Notification::send($admins, new NewWorkshop($event->workshop));
    }
}
