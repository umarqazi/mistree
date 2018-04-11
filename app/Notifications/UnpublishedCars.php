<?php

namespace App\Notifications;

use App\Car;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnpublishedCars extends Notification
{
    use Queueable;

    protected $car;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Car $car)
    {
        $this->car  = $car;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'created_at'        => Carbon::now(),
            'notification_url'  => '/admin/unpublished/cars',
            'msg'               => 'Seems like someone wasn\'t lucky enough to find their car. We have a new unpublished car entry as: '.$this->car->make.' - '.$this->car->model,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
