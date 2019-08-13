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

    public const ROLES = [
        1 => 'Оператор',
        2 => 'Контент менеджер',
        3 => 'Администратор',
        4 => 'Главный администратор',
    ];

    public static function getAvailableRoles(){
        $role = Auth::user()->role;
        return collect(self::ROLES)->filter(function($value, $key) use ($role){
            return $key<$role;
        })->toArray();
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        try {
            $this->notify(new ResetPassword($this->email, $token));
        } catch (\Exception $e){}
    }

    public static function changeSettings($user, $inputs){
        $user['name'] = $inputs['name'];
        $user['email'] = $inputs['email'];
        if (!empty($inputs['change_password'])) {
            $user['password'] = Hash::make($inputs['new_password']);
        }
        $result = $user->save();
        Auth::login($user);
        return $result;
    }

    public static function action($model, $inputs) {
        if (!$model) $model = new self;
        $model['name'] = $inputs['name'];
        $model['email'] = $inputs['email'];
        if (!empty($inputs['password'])) $model['password'] = Hash::make($inputs['password']);
        $model['active'] = (int) array_key_exists('active', $inputs);
        $model['role'] = $inputs['role'];
        return $model->save();
    }

    public static function adminList(){
        return self::where('role', '<', Auth::user()->role)->sort()->get();
    }

    public static function getItem($id){
        return self::where('id', $id)->where('role', '<', Auth::user()->role)->firstOrFail();
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public function scopeSort($q) {
        return $q->orderBy('id', 'desc');
    }

}
