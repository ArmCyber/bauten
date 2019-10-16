<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    private $email;
    private $token;
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('password.reset', ['email'=>$this->email, 'token'=>$this->token]);
        return (new MailMessage)
            ->subject(__('mails.reset.subject'))
            ->view('site.mails.password_reset', ['url'=>$url]);
    }
}
