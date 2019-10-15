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

    public function __construct($email)
    {
        $this->data = [
            'email' => $email,
        ];
    }

    public function build()
    {
        return $this->subject('Пользователь подтверждил свой адрес эл.почты на сайте Bauten.kz')
            ->view('site.mails.admin.user_verified', $this->data);
    }
}
