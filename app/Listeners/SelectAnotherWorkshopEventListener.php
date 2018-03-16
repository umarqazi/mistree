<?php

namespace App\Listeners;

use App\Events\SelectAnotherWorkshopEvent;
use App\Notifications\SelectAnotherWorkshop;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
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
        Notification::send($booking->customer, new SelectAnotherWorkshop($booking));
    }
}
