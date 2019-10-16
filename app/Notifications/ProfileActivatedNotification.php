<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Zakhayko\Banners\Models\Banner;

class ProfileActivatedNotification extends Notification
{
    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = [
            'info' => Banner::get('info'),
        ];
        return (new MailMessage)
            ->subject(__('mails.profile_activated.subject'))
            ->view('site.mails.profile_activated', $data);
    }
}
