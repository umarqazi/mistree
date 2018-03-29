<?php

namespace App\Mail;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkshopRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $dataMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataMail)
    {
        $this->dataMail = $dataMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dataMail = $this->dataMail;
        return $this->view($dataMail['view'])
            ->from(Config::get('app.mail_username'), Config::get('app.name'))
            ->subject($dataMail['subject'])
            ->with([
                'name' => $dataMail['name'],
                'verification_code' => $dataMail['verification_code']
            ]);
    }
}
