<?php

namespace App\Listeners;

use App\Events\RateNotificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  RateNotificationEvent  $event
     * @return void
     */
    public function handle(RateNotificationEvent $event)
    {
        //
    }
}
