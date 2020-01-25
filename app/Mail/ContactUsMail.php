<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function build()
    {
        return $this->from($this->payload['email'])
            ->subject($this->payload['subject'])
            ->view('email.contactUs');
    }
}
