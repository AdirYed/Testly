<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\URL;

class VerifyUserNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private $verifyUrl;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addWeek(),
            ['user' => $user->id]
        );
    }

    public function via(User $notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->replyTo($notifiable->email)
            ->subject('אימות אימייל Testly')
            ->markdown('email.verifyUser', ['verifyUrl' => $this->verifyUrl]);
    }

    public function toDatabase(User $notifiable): array
    {
        return [
            'url' => $this->verifyUrl,
            'expiration' => now()->addWeek()->toDateTimeString(),
        ];
    }

    public function toArray(User $notifiable)
    {
        return [
            //
        ];
    }
}
