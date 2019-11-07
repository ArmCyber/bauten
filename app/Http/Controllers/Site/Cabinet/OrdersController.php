<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Basket;
use App\Models\Order;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends BaseController
{
    public function order(Request $request){
        $inputs = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
//            'payment_method' => 'required|in:'
        ];
        if ($inputs['delivery']??0 != 0) {
            $rules['city_id'] = 'required|integer|exists:delivery_cities,id';
            $rules['address'] = 'required|string|max:255';
        }
        Validator::make($inputs, $rules, [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'exists' => 'Поле обязательно для заполнения.',
            'phone' => 'Недействительный номер телефона.',
        ])->validate();
        if (!count($this->shared['basket_parts'])) return redirect()->route('cabinet.basket');
        Order::makeOrder($inputs);
        Basket::clear();
        Notify::success('Ваш заказ отправлен.');
        return redirect()->route('cabinet.main');
    }

    public function pending(){
        $data = [];
        return view('site.pages.cabinet.orders', $data);
    }
}
