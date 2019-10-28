<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Site\BaseController;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Zakhayko\Banners\Models\Banner;

class RegisterController extends BaseController
{
    use RegistersUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
        parent::__construct();
    }

    protected function validator(array $data)
    {
        $rules = [
            'region_id' => 'required|integer|exists:regions,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|mail|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'city' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
            'manager' => [
                'nullable',
                'string',
                Rule::exists('admins', 'code')->where(function($q){
                    $q->where(['active'=>1, 'role'=>config('roles.manager')]);
                })
            ],
        ];
        if ($data['type']==User::TYPE_ENTITY) {
            $rules['company'] = 'required|string|max:255';
            $rules['bin'] = 'required|string|max:255';
        }
        return Validator::make($data, $rules, [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'integer' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'min' => 'Пароль должен содержать мин 8 символов.',
            'mail' => 'Недействительный адрес эл.почты.',
            'phone' => 'Недействительный номер телефона.',
            'confirmed' => 'Пароль и подверждение не совпадают.',
            'unique' => 'Эл.почта уже существует.',
            'region_id.exists' => 'Поле обязательно для заполнения.',
            'manager.exists' => 'Менеджер с таким кодом не найден.',
        ]);
    }

    public function showRegistrationForm()
    {
        $data = [];
        $data['banners'] = Banner::get('auth');
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        $data['types'] = User::getTypes();
        return view('site.pages.auth.register', $data);
    }

    public function register(Request $request) {
        $inputs = $request->all();
        if (isset($inputs['type']) && $inputs['type']!=User::TYPE_ENTITY) $inputs['type']=User::TYPE_INDIVIDUAL;
        $this->validator($inputs)->validate();
        $inputs['email'] = mb_strtolower($inputs['email']);
        $verification_token = Str::random(32);
        $user = User::register($inputs, $verification_token);
        $user->sendRegisteredNotification($verification_token, $this->shared['email']?:null);
        return redirect()->route('login')->with(['action'=>'registered'])->withInput(['email'=>$inputs['email']]);
    }

    public function verify($email, $token) {
        $user = User::where('email', $email)->firstOrFail();
        if (!$user->verification || !Hash::check($token, $user->verification)) abort(404);
        $user['verification'] = null;
        $user->save();
        $user->sendVerifiedNotification($this->shared['email']);
        return redirect()->route('login')->with(['action'=>'verified']);
    }

}
