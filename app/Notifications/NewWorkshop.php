<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Carbon\Carbon;

class NewWorkshop extends Notification
{
    use Queueable;

    protected $workshop;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($workshop)
    {
        $this->workshop = $workshop;
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
            'notification_url'  => '/admin/workshops',
            'msg'           => 'A new workshop by name "'.$this->workshop->name.'" has been registered.'
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
