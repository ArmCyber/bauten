<?php

namespace App\Notifications\Admin;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    private $email;
    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('admin.password.recover', ['email'=>$this->email, 'token'=>$this->token]);
        return (new MailMessage)
                    ->subject('Востоновления пароля администратора')
                    ->greeting('Востоновления пароля администратора')
                    ->line('Для востоновление пароля переходите по этой ссылке')
                    ->action($url, $url);
    }
}
