<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Site\BaseController;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VerificationController extends BaseController
{
    private function checkVerificationToken($email, $token){
        $user = User::where('email', $email)->firstOrFail();
        if (!$user->verification || !Hash::check($token, $user->verification)) abort(404);
        return $user;
    }

    public function showVerificationForm($email, $token){
        $user = $this->checkVerificationToken($email, $token);
        if (Auth::check()) {
            Auth::logout();
            return redirect();
        }
        $data = ['user' => $user];
        return view('site.pages.auth.verification');
    }

    public function verify($email, $token, Request $request) {
        $user = $this->checkVerificationToken($email, $token);
        if (Auth::check()) {
            Auth::logout();
            return redirect();
        }
        $inputs = $request->all();
        if (empty($inputs['skip'])) {
            Validator::make($inputs, [
                'manager' => 'required|string',
            ], [
                'manager.*' => 'Введите ID или Номер телефона менеджера или нажмите "Пропустить".'
            ])->validate();
            $manager_code = $inputs['manager'];
            $manager = Admin::select('id', 'email')->where('role', config('roles.manager'))->where(function($q) use ($manager_code) {
                $q->where('code', $manager_code)->orWhere('phone', $manager_code);
            })->first();
            if (!$manager) return redirect()->back()->withInput()->withErrors(['manager'=>'Менеджер с таким кодом или номером телефона не найден.']);
            $user['manager_id'] = $manager->id;
        } else $manager = null;
        $user['verification'] = null;
        $user->save();
        $user->sendVerifiedNotification($manager, $this->shared['email']);
        Auth::login($user);
        return redirect()->route('page');
    }
}
