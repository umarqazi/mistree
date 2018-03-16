<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NewWorkshopEvent' => [
          'App\Listeners\NewWorkshopEventListener'
        ],
        'App\Events\NewBookingEvent' => [
            'App\Listeners\NewBookingEventListener'
        ],
        'App\Events\SelectAnotherWorkshopEvent' => [
            'App\Listeners\SelectAnotherWorkshopEventListener'
        ],
        'App\Events\MinimumBalanceEvent' => [
            'App\Listeners\MinimumBalanceEventListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
