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
use Zakhayko\Banners\Models\Banner;

class RegisterController extends BaseController
{
    use RegistersUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:web');
        parent::__construct();
    }

    protected function validator(array $data)
    {
        $rules = [
            'region_id' => 'required|integer|exists:regions,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|mail|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'city' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
        ];
        if ($data['type']==User::ENTITY) {
            $rules['company'] = 'required|string|max:255';
            $rules['bin'] = 'required|string|max:255';
        }
        return Validator::make($data, $rules, [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'integer' => 'Поле обязательно для заполнения.',
            'exists' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'min' => 'Пароль должен содержать мин 8 символов.',
            'mail' => 'Недействительный адрес эл.почты.',
            'phone' => 'Недействительный номер телефона.',
            'confirmed' => 'Пароль и подверждение не совпадают.',
            'unique' => 'Эл.почта уже существует.',
        ]);
    }

    public function showRegistrationForm()
    {
        $data = [];
        $data['banners'] = Banner::get('auth');
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        $data['types'] = [
            'individual' => User::INDIVIDUAL,
            'entity' => User::ENTITY,
        ];
        return view('site.pages.auth.register', $data);
    }

    public function register(Request $request) {
        $inputs = $request->all();
        if (isset($inputs['type']) && $inputs['type']!=User::ENTITY) $inputs['type']=User::INDIVIDUAL;
        $this->validator($inputs)->validate();
        $verification_token = Str::random(32);
        $user = User::register($inputs, $verification_token);
        $user->sendRegisteredNotification($verification_token, $this->shared['email']?:null);
        return redirect()->route('login')->with(['action'=>'registered'])->withInput(['email'=>$inputs['email']]);
    }

}
