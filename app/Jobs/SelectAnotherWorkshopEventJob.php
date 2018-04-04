<?php

namespace App\Jobs;

use App\Booking;
use App\Events\SelectAnotherWorkshopEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SelectAnotherWorkshopEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(($this->booking->is_accepted != true) && ($this->booking->job_status != 'rejected')){
            $booking = Booking::find($this->booking->id);
            $booking->job_status = "expired";
            $booking->save();
            event(new SelectAnotherWorkshopEvent($this->booking));
        }
    }
}