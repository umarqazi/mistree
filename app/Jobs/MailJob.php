<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dataMail)
    {
        $this->dataMail = $dataMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataMail = $this->dataMail;
        $subject = $dataMail->subject;
        Mail::send($dataMail->view, [$dataMail->user => $dataMail->userObject, 'subject' => $subject, 'msg' => $dataMail->msg ],
            function($mail) use ($subject){
                $mail->from(config('app.mail_username'), config('app.name'));
                $mail->to(config('app.mail_username'));
                $mail->subject($subject);
            });
    }
}
