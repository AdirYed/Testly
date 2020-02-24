<?php

namespace App\Notifications;

use App\UrlToken;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPasswordNotification extends Notification
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

    public function toMail(User $notifiable)
    {
        $notifiable->urlTokens()->create([
            'type' => UrlToken::TYPE_FORGOT_PASSWORD,
            'token' => $this->token,
            'expires_at' => now()->addDay(),
        ]);

        $forgotPasswordUrl = UrlToken::forgotPasswordUrl($this->token);

        return (new MailMessage)
            ->subject('איפוס סיסמה Testly')
            ->markdown('email.forgotPassword', ['forgotPasswordUrl' => url($forgotPasswordUrl)]);
    }

    public function toDatabase(User $notifiable)
    {
        return [
            'token' => $this->token,
        ];
    }
}
