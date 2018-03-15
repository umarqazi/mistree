<?php

namespace App\Listeners;

use App\Events\NewBookingEvent;
use App\Notifications\NewBooking;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class NewBookingEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  NewBookingEvent  $event
     * @return void
     */
    public function handle(NewBookingEvent $event)
    {
        $booking = $event->booking;
        Notification::send($booking->workshop(), new NewBooking($booking));
    }
}
