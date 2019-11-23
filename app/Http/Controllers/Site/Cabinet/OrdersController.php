<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Basket;
use App\Models\DeliveryRegion;
use App\Models\Order;
use App\Models\PickupPoint;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Zakhayko\Banners\Models\Banner;

class OrdersController extends BaseController
{
    public function order(){
        $data = [];
        $data['orderData'] = Order::getOrderData();
        $data['seo'] = $this->staticSEO('Оформления заказа');
        $data['settings'] = Banner::get('settings');
        $data['regions'] = DeliveryRegion::siteList();
        $data['delivery_prices'] = count($data['regions'])?$data['regions']->pluck('cities')->flatten()->mapWithKeys(function($item){
            return [$item->id => $item->price];
        }):collect();
        $data['cant_delivery'] = $data['orderData']['all_sum'] < $data['settings']->minimum->delivery;
        $data['shown_delivery'] = (!$data['cant_delivery'] && old('delivery')==1);
        $data['texts'] = Banner::get('texts');
        $data['pickup_points'] = PickupPoint::siteList();
        if (!$data['orderData']) return redirect()->route('cabinet.basket');
        return view('site.pages.cabinet.order_form', $data);
    }

    public function order_post(Request $request){
        $inputs = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
            'pickup_point_id' => ['required','integer',Rule::exists('pickup_points', 'id')->where('active', 1)]
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
            'integer' => 'Поле обязательно для заполнения.',
        ])->validate();
        if (!count($this->shared['basket_parts'])) return redirect()->route('cabinet.basket');
        if (! $order_id = Order::makeOrder($inputs)) return redirect()->route('cabinet.order');
        Basket::clear();
        return redirect()->route('cabinet.orders.view', ['id'=>$order_id]);
    }

    public function pending(){
        $data = [];
        $data['seo'] = $this->staticSEO('Заказы');
        $data['page_title'] = 'Заказы';
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
        $data['texts'] = Banner::get('texts');
        $data['item'] = Order::getItemSite($id);
        $data['seo'] = $this->staticSEO('Заказ N'.$data['item']->id);
        $data['process'] = Order::PROCESS;
        return view('site.pages.cabinet.order', $data);
    }

    public function confirmPayment(Request $request) {
        $orderId = $request->input('order_id');
        if (!$orderId) abort(404);
        $order = Order::getItemSite($orderId);
        if ($order->paid==0 && $order->paid_request==0 && $order->payment_method=='bank') {
            $order->paid_request = 1;
            $order->save();
        }
        return redirect()->route('cabinet.orders.view', ['id'=>$order->id]);
    }
}
