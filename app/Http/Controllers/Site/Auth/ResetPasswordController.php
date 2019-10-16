<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\BaseController;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        parent::__construct();
    }

    public function showResetForm($email, $token)
    {
        $user = User::getUserFromRecoveryToken($email, $token);
        if (!$user) abort(404);
        $data = [
            'email' => $user->email,
            'token' => $token,
        ];
        return view('site.pages.auth.password_reset', $data);
    }

    public function reset(Request $request, $email, $token)
    {
        $user = User::getUserFromRecoveryToken($email, $token);
        if (!$user) abort(404);
        $request->validate([
            'password' => 'required|string|min:8|max:255|confirmed'
        ],
        [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'min' => 'Пароль должен содержать мин 8 символов.',
            'confirmed' => 'Пароль и подверждение не совпадают.',
        ]);
        User::resetPassword($user, $request->input('password'), false);
        return redirect()->route('login')->withInput(['email'=>$user->email])->with(['action'=>'recovered']);
    }
}
