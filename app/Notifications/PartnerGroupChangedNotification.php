<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Zakhayko\Banners\Models\Banner;

class PartnerGroupChangedNotification extends Notification
{
    private $partner_group;

    public function __construct($partner_group)
    {
        $this->partner_group = $partner_group;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = [
            'info' => Banner::get('info'),
            'partner_group' => $this->partner_group,
        ];
        return (new MailMessage)
            ->subject(__('mails.partner_group_changed.subject'))
            ->view('site.mails.partner_group_changed', $data);
    }
}
