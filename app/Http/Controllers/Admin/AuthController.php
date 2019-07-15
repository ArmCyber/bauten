<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ThrottlesLogins;

    public function login() {
        return view('admin.auth.login');
    }

    public function username(){
        return 'email';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        Validator::make($credentials, [
            $this->username() => 'required|email',
            'password' => 'required',
        ])->validate();

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if (!Auth::guard('cms')->attempt($credentials)) {
            $this->incrementLoginAttempts($request);
            return $this->sendErrors(['root'=>[__('admin/auth/messages.failed')]]);
        }
        $this->clearLoginAttempts($request);
        return $this->redirectToHomepage();
    }

    private function sendErrors($errors) {
        return redirect()->route('admin.login')
            ->withErrors($errors)
            ->withInput();
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'root' => [__('admin/auth/messages.throttle', ['seconds' => $seconds])],
        ])->status(429);
    }

    public function reset(){
        return view('admin.auth.reset');
    }

    public function attemptReset(Request $request) {
        $request->validate([
            $this->username()=>'required',
        ]);
        if (Password::broker('admins')->sendResetLink($request->only('email')) != Password::RESET_LINK_SENT) return redirect()->back()->withInput()->withErrors([
            'email'=>'Указанная эл. почта не существует',
        ]);
        return redirect()->route('admin.password.reset')->with('reset_link_sent', true);
    }

    public function recover($email, $token) {
        if (!($user = Admin::getUserFromRecoveryToken($email, $token))) abort(404);
        return view('admin.auth.recover', ['email'=>$user->email, 'token'=>$token]);
    }

    public function attemptRecover($email, $token, Request $request) {
        if (!($user = Admin::getUserFromRecoveryToken($email, $token))) abort(404);
        $inputs = $request->all();
        Validator::make($inputs,[
            'new_password'=>'required|string|min:8|confirmed',
        ])->validate();
        Admin::resetPassword($user, $inputs['new_password']);
        Notify::success('Пароль успешно восстановлен.');
        return $this->redirectToHomepage();
    }

    public function redirectToHomepage(){
        return redirect()->route(config('admin.homepage'));
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
