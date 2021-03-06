<?php

namespace App\Events;

use App\Workshop;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewWorkshopEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $workshop;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Workshop $workshop)
    {
        $this->workshop = $workshop;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
