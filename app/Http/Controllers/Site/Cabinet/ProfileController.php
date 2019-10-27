<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    public function main(){
        return view('site.pages.cabinet.profile');
    }

    public function settings(){
        $data = [];
        config(['fake_route'=>'cabinet.profile']);
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        return view('site.pages.cabinet.profile_settings', $data);
    }

    public function settings_post(Request $request) {
        $rules = [
            'region_id' => 'required|integer|exists:regions,id',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
        ];
        if ($this->shared['user']->is_entity) {
            $rules['company'] = 'required|string|max:255';
            $rules['bin'] = 'required|string|max:255';
        }
        $request->validate($rules, [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'integer' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'phone' => 'Недействительный номер телефона.',
            'region_id.exists' => 'Поле обязательно для заполнения.',
        ]);
        User::updateSettings($this->shared['user'], $request->all());
        return redirect()->route('cabinet.profile')->with('notify', 'changes_saved');
    }

    public function changePassword(){
        config(['fake_route'=>'cabinet.profile']);
        return view('site.pages.cabinet.profile_change_password');
    }

    public function changePassword_post(Request $request){
        $current_password = $this->shared['user']->password;
        $request->validate([
            'new_password' => 'required|string|min:8|max:255|confirmed',
            'password' => ['required', 'string', function($attribute, $value, $fail) use ($current_password){
                if (!Hash::check($value, $current_password)) $fail('Неправильный пароль.');
            }],
        ], [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'confirmed' => 'Новый пароль и подверждение не совпадают.',
            'max' => 'Макс. :max символов.',
            'min' => 'Пароль должен содержать мин 8 символов.',
        ]);
        User::changePassword($this->shared['user'], $request->input('new_password'));
        return redirect()->route('cabinet.profile')->with('notify', 'changes_saved');
    }
}
