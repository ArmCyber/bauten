<?php

namespace App\Models;

use App\Http\Traits\Resetable;
use App\Notifications\Admin\ResetPassword;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin extends User
{
    use Notifiable, Resetable;

    protected const GUARD = 'cms';

//    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        try {
            $this->notify(new ResetPassword($this->email, $token));
        } catch (\Exception $e){}
    }

    public static function action($user, $inputs){
        $user['name'] = $inputs['name'];
        $user['email'] = $inputs['email'];
        if (!empty($inputs['change_password'])) {
            $user['password'] = Hash::make($inputs['new_password']);
        }
        $result = $user->save();
        Auth::login($user);
        return $result;
    }

}
