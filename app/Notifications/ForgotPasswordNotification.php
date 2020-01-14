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
            'expires_at' => now()->addHour(),
        ]);

        $forgotPasswordUrl = UrlToken::forgotPasswordUrl($this->token);

        return (new MailMessage)
            ->replyTo($notifiable->email)
            ->subject('איפוס סיסמה Testly')
            ->greeting('איפוס סיסמה')
            ->line('ביקשת לאפס את סיסמתך ב Testly. נא ללחוץ על הלינק למטה כדי לסיים את האיפוס.')
            ->action('איפוס סיסמה', url($forgotPasswordUrl))
            ->line('אם אינך יכול ללחוץ על הקישור שלמעלה, פשוט העתק והדבק את הקישור הבא בדפדפן שלך.')
            ->line(url($forgotPasswordUrl))
            ->line('הלינק בתוקף רק ליום אחד. אם התוקף יפוג, תוכל לבקש אחד חדש.')
            ->line('אם אינך הגשת בקשה זו, נא התעלם מאימייל זה ומחק אותו.');
    }

    public function toDatabase(User $notifiable)
    {
        return [
            'token' => $this->token,
        ];
    }
}
