<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Config;
use Illuminate\Mail\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MailJobRegister implements ShouldQueue
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
        if($dataMail['verification']){
            Mail::send($dataMail['view'], ['name' => $dataMail['name'], 'verification_code' => $dataMail['verification_code'] ],
                function($mail) use ($subject, $dataMail){
                    $mail->from(Config::get('app.mail_username'), Config::get('app.name'));
                    $mail->to($dataMail['email'], $dataMail['name']);
                    $mail->subject($subject);
                });
        }
        else{
            Mail::send($dataMail['view'], ['name' => $dataMail['name'] ],
                function($mail) use ($subject, $dataMail){
                    $mail->from(Config::get('app.mail_username'), Config::get('app.name'));
                    $mail->to($dataMail['email'], $dataMail['email']);
                    $mail->subject($subject);
                });
        }

    }
}
