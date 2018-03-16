<?php

namespace App\Listeners;

use App\Events\MinimumBalanceEvent;
use App\Notifications\MinimumBalance;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

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
    }
}
