<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->replyTo($notifiable->email)
            ->subject('כדי לסיים את הליך הרישום שלך ל ' . config('app.name') . ', היכנס ולחץ על הקישור')
            ->markdown('email.verifyUser');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
