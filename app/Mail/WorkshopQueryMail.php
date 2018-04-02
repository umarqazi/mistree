<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Config;

class WorkshopQueryMail extends Mailable
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
        $workshop = $dataMail['workshop'];
        return $this->view($dataMail['view'])
            ->from($workshop->email, $workshop->name)
            ->subject($dataMail['subject'])
            ->with([
                'workshop' => $workshop,
                'subject' => $dataMail['subject'],
                'msg' => $dataMail['msg']
            ]);
    }
}
