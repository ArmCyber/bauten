<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Site\BaseController;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends BaseController
{
    use RegistersUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest:web');
        parent::__construct();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function verifyEmail($email, $token)
    {
        $user = User::where('email', $email)->firstOrFail();
        if (!$user->verification || !Hash::check($token, $user->verification)) abort(404);
        $user->verification = null;
        $user->save();
        return redirect()->route('login')->with(['verified' => true])->withInput(['email' => $user->email]);
    }

    public function showRegistrationForm()
    {
        $data = [];
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        return view('site.pages.auth.register', $data);
    }
}
