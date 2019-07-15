<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{
    public function main(){
        $data = ['title'=>'Настройки профиля'];
        $data['user'] = Auth::user();
        return view('admin.pages.profile.form', $data);
    }

    public function patch(Request $request){
        $inputs = $request->all();
        $user = Auth::user();
        $this->validator($inputs, $user->id, $user->password)->validate();
        if(Admin::action($user, $inputs)) {
            Notify::success('Профиль редактирован.');
            return redirect()->route('admin.profile.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    private function validator($inputs, $ignore, $current_password) {
        $rules = [
            'name'=>'required|string',
            'email'=>'required|string|email|unique:admins,email,'.$ignore,
            'current_password'=>[
                'required',
                'string',
                function($attribute, $value, $fail) use ($current_password){
                    if (!Hash::check($value, $current_password)) $fail('Неправильный текуший пароль');
                }
            ],
        ];
        if (!empty($inputs['change_password'])) {
            $rules['new_password'] = 'required|string|min:8|confirmed';
        }
        return Validator::make($inputs, $rules);
    }
}
