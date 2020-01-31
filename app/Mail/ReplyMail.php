<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $reply;

    public function __construct(string $subject, string $reply)
    {
        $this->subject = $subject;
        $this->reply = $reply;
    }

    public function build()
    {
        $this->from('support@' . config('services.mailgun.domain'))
            ->view('email.reply');
    }
}
