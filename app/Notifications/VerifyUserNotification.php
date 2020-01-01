<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Date;

class VerifyUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->markdown('email.verifyUser');
    }

    public function toDatabase(User $notifiable): array
    {
        return [
            'expiration' => Date::now()->addHour()->toDateTimeString(),
        ];
    }

    public function toArray(User $notifiable)
    {
        return [
            //
        ];
    }
}
