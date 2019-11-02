<?php

namespace App\Models;

use App\Http\Traits\Resetable;
use App\Mail\NewEmailVerificationToken;
use App\Mail\UserRegistered;
use App\Mail\UserVerified;
use App\Notifications\PartnerGroupChangedNotification;
use App\Notifications\ProfileActivatedNotification;
use App\Notifications\RegisteredNotification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifiedNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, Resetable;

    //region Constants
    public const TYPE_INDIVIDUAL = 1;
    public const TYPE_ENTITY = 2;

    public const STATUS_ACTIVE = 1;
    public const STATUS_BLOCKED = 0;
    public const STATUS_PENDING = -1;

    public const CHANGE_EMAILS_TABLE = 'change_emails';

    public static function change_emails() {
        return DB::table(self::CHANGE_EMAILS_TABLE);
    }

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
        'seen_at', 'logged_in_at',
    ];

    public static function register($inputs, $verification_token) {
        $user = new self;
        merge_model($inputs, $user, ['type', 'name', 'region_id', 'city', 'phone', 'email']);
        $region = Region::find($inputs['region_id']);
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

    public static function updateSettings($user, $inputs) {
        $user['name'] = $inputs['name'];
//        $user['last_name'] = $inputs['last_name'];
        $user['phone'] = $inputs['phone'];
        $region = Region::find($inputs['region_id']);
        $user['region_id'] = $region->id;
        $user['country_name'] = $region->country->title;
        $user['region_name'] = $region->title;
        $user['city'] = $inputs['city'];
        if ($user->is_entity) {
            $user['company'] = $inputs['company'];
            $user['bin'] = $inputs['bin'];
        }
        $user->save();

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

    public function sendProfileActivatedNotification(){
        try {
            $this->notify(new ProfileActivatedNotification());
        } catch (\Exception $e) {}
    }

    public function sendPasswordResetNotification($token)
    {
        try {
            $this->notify(new ResetPasswordNotification($this->email, $token));
        } catch (\Exception $e) {}
    }

    public function sendPartnerGroupChangedNotification($partner_group) {
        try {
            $this->notify(new PartnerGroupChangedNotification($partner_group));
        } catch (\Exception $e) {}
    }

    public function sendNewEmailVerificationToken($email, $token){
//        try {
            Mail::to($email)->send(new NewEmailVerificationToken($this, $token));
//        } catch (\Exception $e) {}
    }

    public static function adminList(){
        return self::with('manager')->sort()->get();
    }

    /** @return User */
    public static function getItem($id) {
        return self::where('id', $id)->with(['manager', 'partner_group'])->firstOrFail();
    }

    public function scopeSort($q){
        return $q->orderBy('id', 'asc');
    }

    public function manager(){
        return $this->belongsTo('App\Models\Admin', 'manager_id', 'id')->where('role', config('roles.manager'));
    }

    public function region(){
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
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
        return ($this->seen_at && (now()->getTimestamp()-$this->seen_at->getTimestamp())<480)?true:false; //8 Minutes
    }

    public function updateSeenAt(){
        $this->seen_at = now();
        $this->timestamps = false;
        $this->save();
        $this->timestamps = true;
    }

    public function updateLoggedInAt(){
        $this->logged_in_at = now();
        $this->timestamps = false;
        $this->save();
        $this->timestamps = true;
    }

    public static function getPendingUsersCount(){
        $result = self::where('status', self::STATUS_PENDING)->count();
        return $result>9?'9+':$result;
    }

    public static function detachManager($manager_id) {
        self::where('manager_id', $manager_id)->update(['manager_id'=>null]);
    }

    public static function checkUser($request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = self::where('email', $email)->first();
        if (!$user) return false;
        return Hash::check($password, $user->password)?$user:false;
    }

    public function cannotAuth(){
        if ($this->verification) return 'notVerified';
        if ($this->status==self::STATUS_PENDING) return 'pending';
        if ($this->status==self::STATUS_BLOCKED) return 'blocked';
        return false;
    }

    public static function changePassword($user, $password){
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        return true;
    }

    public function partner_group(){
        return $this->belongsTo('App\Models\PartnerGroup')->sort();
    }

    public static function getChangeEmail($user_id){
        return self::change_emails()->where('user_id', $user_id)->first();
    }

    public function getIsEntityAttribute() {
        return $this->type==self::TYPE_ENTITY;
    }

    public static function deleteItem($model) {
        $model->delete();
        return true;
    }

    public static function createNewEmailVerification($user, $email) {
        $token = Str::random(32);
        self::change_emails()->insert([
            'user_id' => $user->id,
            'email' => $email,
            'verification' => $token,
        ]);
        $user->sendNewEmailVerificationToken($email, $token);
    }

    public static function deleteChangeEmail($user_id) {
        self::change_emails()->where('user_id', $user_id)->delete();
    }

    public static function deleteChangeEmails($email) {
        self::change_emails()->where('email', $email)->delete();
    }

    public static function getChangeEmailFromToken($token) {
        return self::change_emails()->where('verification', $token)->first();
    }

    public function getSaleAttribute(){
        return $this->partner_group->sale;
    }

    public function favourites(){
        return $this->belongsToMany('App\Models\Part', 'favourites', 'user_id', 'part_id')->where('parts.active', 1)->withPivot('id')->orderBy('pivot_id', 'desc');
    }
}
