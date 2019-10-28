<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class NewEmailVerificationToken extends Mailable
{
    private $user;
    private $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        $data = [
            'url' => route('profile.verify_new_email', ['token'=>$this->token]),
            'user' => $this->user
        ];
        return $this->subject(__('mails.new_email.subject'))->view('site.mails.new_email', $data);
    }
}
