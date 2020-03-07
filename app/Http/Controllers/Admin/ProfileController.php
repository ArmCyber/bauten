<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Zakhayko\Banners\Models\Banner;

class ProfileController extends BaseController
{
    public function main(){
        $data = ['title'=>'Настройки профиля'];
        $data['user'] = Auth::user();
        $data['user']['ip'] = Banner::getBanners('profile')->first()[0]['data'];
        return view('admin.pages.profile.form', $data);
    }

    public function patch(Request $request){
        $inputs = $request->all();
        $banner_id = Banner::getBanners('profile')->first()[0]['id'];
        $user = Auth::user();
        $this->validator($inputs, $user->id, $user->password)->validate();
        Banner::updateBanner('profile','verify',$request->IP, $banner_id);
        if(Admin::changeSettings($user, $inputs)) {
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
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255|email|unique:admins,email,'.$ignore,
            'phone'=>'required|string|max:255|phone|unique:admins,phone,'.$ignore,
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
