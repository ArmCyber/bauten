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
        if (! $order_id = Order::makeOrder($inputs)) return redirect()->back();
        Basket::clear();
        return redirect()->route('cabinet.orders.view', ['id'=>$order_id]);
    }

    public function pending(){
        $data = [];
        $data['seo'] = $this->staticSEO('Невыполненные заказы');
        $data['page_title'] = 'Невыполненные заказы';
        $data['orders'] = Order::userPendingOrders($this->shared['user']->id);
        $data['empty_text'] = 'У вас нет невыполненных заказов';
        return view('site.pages.cabinet.orders', $data);
    }

    public function done(){
        $data = [];
        $data['seo'] = $this->staticSEO('Покупки');
        $data['page_title'] = 'Покупки';
        $data['orders'] = Order::userDoneOrders($this->shared['user']->id);
        $data['empty_text'] = 'У вас нет покупок';
        return view('site.pages.cabinet.orders', $data);
    }

    public function view($id) {
        $data = [];
        $data['item'] = Order::getItemSite($id);
        $data['seo'] = $this->staticSEO('Заказ N'.$data['item']->id);
        $data['process'] = Order::PROCESS;
        return view('site.pages.cabinet.order', $data);
    }
}
