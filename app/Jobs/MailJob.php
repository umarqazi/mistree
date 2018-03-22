<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Config;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $dataMail;
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
        $subject = $dataMail['subject'];
        Mail::send($dataMail['view'], [$dataMail['user'] => $dataMail['userObject'], 'subject' => $subject, 'msg' => $dataMail['msg'] ],
            function($mail) use ($subject){
                $mail->from(Config::get('app.mail_username'), Config::get('app.name'));
                $mail->to(Config::get('app.mail_username'));
                $mail->subject($subject);
            });
    }
}
