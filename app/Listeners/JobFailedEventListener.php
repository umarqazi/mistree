<?php

namespace App\Listeners;

use App\Events\JobFailedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobFailedEventListener
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
     * @param  JobFailedEvent  $event
     * @return void
     */
    public function handle(JobFailedEvent $event)
    {

    }
}
