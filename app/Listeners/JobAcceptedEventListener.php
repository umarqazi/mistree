<?php

namespace App\Listeners;

use App\Events\JobAcceptedEvent;
use App\Notifications\JobAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class JobAcceptedEventListener
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
     * @param  JobAcceptedEvent  $event
     * @return void
     */
    public function handle(JobAcceptedEvent $event)
    {
        $booking = $event->booking;
        Notification::send($booking->customer, new JobAccepted($booking));
    }
}
