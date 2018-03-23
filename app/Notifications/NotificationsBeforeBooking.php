<?php

namespace App\Notifications;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationsBeforeBooking extends Notification
{
    use Queueable;

    protected $booking, $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $user)
    {
        $this->booking = $booking;
        $this->user = $user;
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
        $booking_job_time = Carbon::parse($booking->job_time);
        $booking_time_diff = strval($booking_job_time->diffInMinutes());
        if($this->user == "customer"){
            return [
                'created_at'        => Carbon::now(),
                'msg'               =>  'You have '.$booking_time_diff.' Minutes in your booking to start.'
            ];
        }else{
            return [
                'created_at'        => Carbon::now(),
                'notification_url'  => '/leads',
                'msg'               =>  'You have '.$booking_time_diff.' Minutes in your lead to start.'
            ];
        }
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
