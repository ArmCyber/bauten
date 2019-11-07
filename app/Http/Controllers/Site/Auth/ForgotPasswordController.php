<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Site\BaseController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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

    public function showLinkRequestForm()
    {
        $data = [
            'seo' => $this->staticSEO('Восстоновление пароля'),
        ];
        return view('site.pages.auth.password_email', $data);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        if (Password::broker('users')->sendResetLink($request->only('email')) != Password::RESET_LINK_SENT) return redirect()->back()->withInput()->withErrors([
            'email'=>'Пользователь с таким эл.адресом не существует.',
        ]);
        return redirect()->route('password.request')->with(['action'=>'reset link sent']);
    }
    protected function validateEmail(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|string|mail'
        ], [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'mail' => 'Недействительный адрес эл.почты.',
        ])->validate();
    }
}
