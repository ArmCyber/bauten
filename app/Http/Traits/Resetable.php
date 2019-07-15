<?php 

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait Resetable {

    public static function getResetModel(){
        return DB::table('password_resets');
    }

    public static function getUserFromRecoveryToken($email, $token) {
        $passwordReset = self::getResetModel()->where(['email'=>$email])->first();
        if (!$passwordReset || !Hash::check($token, $passwordReset->token)) return false;
        return self::where('email',$email)->first();
    }

    public static function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        self::getResetModel()->where('email', $user->email)->delete();
        Auth::guard(self::GUARD)->login($user);
    }
}