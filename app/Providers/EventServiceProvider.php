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
        'App\Events\LeadExpiryEvent' => [
            'App\Listeners\LeadExpiryEventListener'
        ],
        'App\Events\JobAcceptedEvent' => [
            'App\Listeners\JobAcceptedEventListener'
        ],
        'App\Events\JobClosedEvent' => [
            'App\Listeners\JobClosedEventListener'
        ],
        'App\Events\NotificationsBeforeBookingEvent' => [
            'App\Listeners\NotificationsBeforeBookingEventListener'
        ],
        'App\Events\CustomerQueryEvent' => [
            'App\Listeners\CustomerQueryEventListener'
        ],
        'App\Events\WorkshopQueryEvent' => [
            'App\Listeners\WorkshopQueryEventListener'
        ],
        'App\Events\RateNotificationEvent' => [
            'App\Listeners\RateNotificationEventListener'
        ],
        'App\Events\InformApprovalEvent' => [
            'App\Listeners\InformApprovalEventListener'
        ],
        'App\Events\CompleteLeadEvent' => [
            'App\Listeners\CompleteLeadEventListener'
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
