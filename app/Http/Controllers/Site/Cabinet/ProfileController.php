<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    public function main(){
        $data = [
            'change_email' => User::getChangeEmail($this->shared['user']->id),
            'seo' => $this->staticSEO('Настройки профиля'),
        ];
        return view('site.pages.cabinet.profile', $data);
    }

    public function settings(){
        $data = [];
        config(['fake_route'=>'cabinet.profile']);
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        $data['seo'] = $this->staticSEO('Изменение личных данных');
        return view('site.pages.cabinet.profile_settings', $data);
    }

    public function settings_post(Request $request) {
        $rules = [
            'region_id' => 'required|integer|exists:regions,id',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
//            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
        ];
        if ($this->shared['user']->is_entity) {
            $rules['company'] = 'required|string|max:255';
            $rules['bin'] = 'required|string|size:12';
        }
        $request->validate($rules, [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'integer' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'size' => 'Бин должен содержать 12 символов.',
            'phone' => 'Недействительный номер телефона.',
            'region_id.exists' => 'Поле обязательно для заполнения.',
        ]);
        User::updateSettings($this->shared['user'], $request->all());
        return redirect()->route('cabinet.profile')->with('notify', 'changes_saved');
    }

    public function changePassword(){
        config(['fake_route'=>'cabinet.profile']);
        $data = [
            'seo' => $this->staticSEO('Изменение пароля'),
        ];
        return view('site.pages.cabinet.profile_change_password', $data);
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

    public function changeEmail(){
        if(User::getChangeEmail($this->shared['user']->id)) return redirect()->route('cabinet.profile');
        config(['fake_route'=>'cabinet.profile']);
        $data = [
            'seo' => $this->staticSEO('Изменение адреса эл.почты'),
        ];
        return view('site.pages.cabinet.profile_change_email', $data);
    }

    public function changeEmail_post(Request $request){
        if(User::getChangeEmail($this->shared['user']->id)) return redirect()->route('cabinet.profile');
        $current_password = $this->shared['user']->password;
        $current_email = $this->shared['user']->email;
        $request->validate([
            'new_email' => ['required','string','mail','max:255','unique:users,email,'.$this->shared['user']->id, function($attribute, $value, $fail) use ($current_email){
                if (mb_strtolower($value)==$current_email) $fail('Новый e-mail совпадает с текущей.');
            }],
            'password' => ['required', 'string', function($attribute, $value, $fail) use ($current_password){
                if (!Hash::check($value, $current_password)) $fail('Неправильный пароль.');
            }],
        ], [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'confirmed' => 'Новый пароль и подверждение не совпадают.',
            'max' => 'Макс. :max символов.',
            'min' => 'Пароль должен содержать мин 8 символов.',
            'mail' => 'Недействительный адрес эл.почты.',
            'unique' => 'Эл.почта уже существует.',
        ]);
        User::createNewEmailVerification($this->shared['user'], mb_strtolower($request->input('new_email')));
        return redirect()->route('cabinet.profile')->with('notify', 'email_sent');
    }

    public function verifyNewEmail($token) {
        $change_email = User::getChangeEmailFromToken($token);
        if (!$change_email) abort(404);
        $user = User::find($change_email->user_id);
        $user->email = $change_email->email;
        $user->save();
        User::deleteChangeEmails($change_email->email);
        if ($this->shared['user']) Auth::logout();
        return redirect('login')->with('action', 'email_changed');
    }

    public function cancelChangeEmail() {
        if(!User::getChangeEmail($this->shared['user']->id)) return redirect()->route('cabinet.profile');
        User::deleteChangeEmail($this->shared['user']->id);
        return redirect()->route('cabinet.profile')->with('notify', 'change_email_canceled');
    }
}
