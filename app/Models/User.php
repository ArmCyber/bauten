<?php

namespace App\Models;

use App\Mail\UserRegistered;
use App\Mail\UserVerified;
use App\Notifications\RegisteredNotification;
use App\Notifications\VerifiedNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    public const INDIVIDUAL = 1;
    public const ENTITY = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    public static function register($inputs, $verification_token) {
        $user = new self;
        merge_model($inputs, $user, ['type', 'name', 'last_name', 'region_id', 'city', 'phone', 'email']);
        $region = Region::find($inputs['region_id'])->with('country')->first();
        if ($inputs['type']==self::ENTITY) {
            $user['company'] = $inputs['company'];
            $user['bin'] = $inputs['bin'];
        }
        $user['region_name'] = $region->title??null;
        $user['country_name'] = $region->country->title??null;
        $user['password'] = Hash::make($inputs['password']);
        $user['verification'] = Hash::make($verification_token);
        $user->save();
        return $user;
    }

    public function sendRegisteredNotification($token, $admin_email = null) {
        try {
            $this->notify(new RegisteredNotification($this->email, $token));
        } catch (\Exception $e) {}
        if ($admin_email) try {
            Mail::to($admin_email)->send(new UserRegistered($this->email));
        } catch (\Exception $e) {}
    }

    public function sendVerifiedNotification($manager, $admin_email = null) {
        try {
            $this->notify(new VerifiedNotification);
        } catch (\Exception $e) {}
        if ($admin_email) try {
            Mail::to($admin_email)->send(new UserVerified($this->email, $manager));
        } catch (\Exception $e) {}
    }

    public static function adminList(){
        return self::sort()->get();
    }

    public function scopeSort($q){
        return $q->orderBy('id', 'asc');
    }
}
