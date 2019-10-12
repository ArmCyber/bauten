<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerified extends Mailable
{
    use SerializesModels;

    private $data;

    public function __construct($email, $manager)
    {
        $this->data = [
            'email' => $email,
            'manager' => $manager
        ];
    }

    public function build()
    {
        return $this->subject('Пользователь активировал свой профиль на сайте Bauten.kz')
            ->view('site.mails.admin.user_verified', $this->data);
    }
}
