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
        2 => 'Менеджер',
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
        $user['phone'] = $inputs['phone'];
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
        $model['phone'] = $inputs['phone'];
        $model['code'] = $inputs['role']==config('roles.manager')?$inputs['code']:null;
        if (!empty($inputs['password'])) $model['password'] = Hash::make($inputs['password']);
        $model['active'] = (int) array_key_exists('active', $inputs);
        $model['role'] = $inputs['role'];
        return $model->save();
    }

    public static function managerExists($id) {
        return self::where(['id'=>$id, 'role'=>config('roles.manager'), 'active'=>1])->count()==1;
    }

    public static function adminList(){
        return self::where('role', '<', Auth::user()->role)->sort()->get();
    }

    public static function getManagers(){
        return self::select('id', 'email', 'code')->where(['role'=>config('roles.manager'), 'active'=>1])->sort()->get();
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
