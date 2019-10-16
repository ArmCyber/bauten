<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Site\BaseController;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();
    }

    public function showLoginForm(){
        return view('site.pages.auth.login', []);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $user = User::checkUser($request);
        if (!$user) {
            $this->incrementLoginAttempts($request);
            return $this->sendLoginError(__('auth.failed'));
        }
        $cannotAuth = $user->cannotAuth();
        if ($cannotAuth) {
            $this->sendLoginError(__('auth.'.$cannotAuth));
        }
        Auth::guard('web')->login($user);
        return $this->sendLoginResponse($request);
    }


    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'global' => [trans('auth.throttle', ['seconds' => $seconds])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    private function sendLoginError($message) {
        throw ValidationException::withMessages([
            'global' => [$message],
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect('/');
    }
}
