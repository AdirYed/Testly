<?php

namespace App\Notifications;

use App\UrlToken;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyUserNotification extends Notification
{
    use Queueable;

    private $token;

    public function __construct()
    {
        $this->token = UrlToken::createToken();
    }

    public function via(User $notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $notifiable->urlTokens()->create([
            'type' => UrlToken::TYPE_VERIFICATION,
            'token' => $this->token,
        ]);

        $verifyUrl = UrlToken::verifyUrl($this->token);

        return (new MailMessage)
            ->replyTo($notifiable->email)
            ->subject('אימות אימייל Testly')
            ->markdown('email.verifyUser', ['verifyUrl' => $verifyUrl]);
    }

    public function toDatabase(User $notifiable): array
    {
        return [
            'token' => $this->token,
        ];
    }
}
