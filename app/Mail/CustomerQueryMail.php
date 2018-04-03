<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Config;

class CustomerQueryMail extends Mailable
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
        $customer = $dataMail['customer'];
        return $this->view($dataMail['view'])
            ->from($customer->email, $customer->name)
            ->subject($dataMail['subject'])
            ->with([
                'customer' => $customer,
                'subject' => $dataMail['subject'],
                'msg' => $dataMail['msg']
            ]);
    }
}
