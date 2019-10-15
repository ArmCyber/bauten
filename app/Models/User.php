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
    //region Constants
    public const TYPE_INDIVIDUAL = 1;
    public const TYPE_ENTITY = 2;

    public const STATUS_ACTIVE = 1;
    public const STATUS_BLOCKED = 0;
    public const STATUS_PENDING = -1;

    public static function getTypes() {
        return [
            'individual' => User::TYPE_INDIVIDUAL,
            'entity' => User::TYPE_ENTITY,
        ];
    }
    //endregion

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'seen_at',
    ];

    public static function register($inputs, $verification_token) {
        $user = new self;
        merge_model($inputs, $user, ['type', 'name', 'last_name', 'region_id', 'city', 'phone', 'email']);
        $region = Region::find($inputs['region_id'])->with('country')->first();
        if ($inputs['type']==self::TYPE_ENTITY) {
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

    public function sendVerifiedNotification($admin_email = null) {
        try {
            $this->notify(new VerifiedNotification);
        } catch (\Exception $e) {}
        if ($admin_email) try {
            Mail::to($admin_email)->send(new UserVerified($this->email));
        } catch (\Exception $e) {}
    }

    public static function adminList(){
        return self::with('manager')->sort()->get();
    }

    public static function getItem($id) {
        return self::where('id', $id)->with('manager')->firstOrFail();
    }

    public function scopeSort($q){
        return $q->orderBy('id', 'asc');
    }

    public function manager(){
        return $this->belongsTo('App\Models\Admin', 'manager_id', 'id')->where('role', config('roles.manager'));
    }

    public function getTypeNameAttribute() {
        if ($this->type == self::TYPE_ENTITY) return 'Юридическое лицо';
        return 'Физическое лицо';
    }

    public function getStatusNameAttribute(){
        if ($this->status == self::STATUS_PENDING) return 'ожидание';
        else if ($this->status == self::STATUS_BLOCKED) return 'блокирован';
        return 'активно';
    }

    public function getIsOnlineAttribute(){
        return ($this->seen_at && (now()->getTimestamp()-$this->seen_at->getTimestamp())<900)?true:false; //15 Minutes
    }

    public function updateSeenAt(){
        $this->seen_at = now();
        $this->save(['timestamps'=>false]);
    }

    public static function getPendingUsersCount(){
        $result = self::where('status', self::STATUS_PENDING)->count();
        return $result>9?'9+':$result;
    }
}
