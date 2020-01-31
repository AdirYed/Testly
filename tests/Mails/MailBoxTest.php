<?php

namespace Tests\Mails;

use App\InboundEmail;
use BeyondCode\Mailbox\Facades\Mailbox;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailBoxTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_catches_logged_mails()
    {
        Mailbox::to('support@' . config('services.mailgun.domain'), function (InboundEmail $email) {
            $this->assertSame($email->from(), 'matan.yed@gmail.com');
            $this->assertSame($email->subject(), 'This is a subject');
            $this->assertSame($email->html(), '<html>Example email content</html>');
        });

        Mail::to('support@' . config('services.mailgun.domain'))->send(new TestMail);

        $this->assertSame(1, InboundEmail::count());
    }
}

class TestMail extends Mailable
{
    public function build()
    {
        $this->from('matan.yed@gmail.com')
            ->subject('This is a subject')
            ->html('<html>Example email content</html>');
    }
}
