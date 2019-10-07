<?php

namespace App\Http\Controllers\Site;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InnerController extends BaseController
{
    public function sendContactsMessage(Request $request){
        if(!is_active('contacts')) abort(404);
        $inputs = $request->except('_token');
        Validator::make($inputs, [
            'name'=>'required|string|max:200',
            'email'=>'required|string|email|max:200',
            'phone'=>'required|string|phone|max:200',
            'message'=>'required|string|max:1000',
        ], [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'email' => 'Адрес эл.почты недействителен.',
            'phone' => 'Номер телефона недействительный.',
            'max' => 'Количество символов не может превышать :max.',
        ])->validate();
        $redirect = redirect(page('contacts'));
        $email = $this->shared['info']->data->email;
        if (!$email || !is_email($email)) return $redirect->withErrors(['global' => __('app.internal error')])->withInput();
        try {
            Mail::to($email)->send(new Contact($request->only('name', 'email', 'phone', 'message')));
        }
        catch (\Exception $exception) {
            return $redirect->withErrors(['global'=>__('app.internal error')])->withInput();
        }
        return $redirect->with(['message_sent'=>true]);
    }
}
