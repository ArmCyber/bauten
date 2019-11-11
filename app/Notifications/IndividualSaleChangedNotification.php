<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Zakhayko\Banners\Models\Banner;

class IndividualSaleChangedNotification extends Notification
{
    private $individual_sale;

    public function __construct($individual_sale)
    {
        $this->individual_sale = $individual_sale;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = [
            'info' => Banner::get('info'),
            'individual_sale' => $this->individual_sale,
        ];
        return (new MailMessage)
            ->subject(__('mails.individual_sale_changed.subject'))
            ->view('site.mails.individual_sale_changed', $data);
    }
}
