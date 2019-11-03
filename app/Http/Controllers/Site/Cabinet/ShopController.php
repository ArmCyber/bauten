<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Basket;
use App\Models\DeliveryRegion;
use App\Models\Order;
use App\Models\Part;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends BaseController
{
    public function addToBasket(Request $request) {
        $inputs = $request->only(['part', 'count']);
        $validator = Validator::make($inputs, [
            'part' => 'required|integer',
            'count' => 'required|integer',
        ]);
        if ($validator->fails()) abort(404);
        $part = Part::getActiveItem($inputs['part']);
        if (!$part) abort(404);
        $part_in_basket = Basket::getPart($part->id);
        $count = $inputs['count'];
        $min_count = $part->min_count_ceil;
        $max_count = $part->max_count;
        $multiplication = $part->multiplication;
        if ($count<$min_count || $count>$max_count || $count%$multiplication!=0) abort(404);
        $part_in_basket->count = $part_in_basket->count+$count;
        $part_in_basket->save();
        return response()->json([
            'max_count' => $max_count-$count
        ]);
    }

    public function basket() {
        $data = [];
        $this->shared['basket_parts']->load('part');
        if ($this->shared['basket_parts']) {
            $data['regions'] = DeliveryRegion::siteList();
            $data['delivery_prices'] = count($data['regions'])?$data['regions']->pluck('cities')->flatten()->mapWithKeys(function($item){
                return [$item->id => $item->price];
            }):collect();
        }
        return view('site.pages.cabinet.basket', $data);
    }

    public function deleteFromBasket(Request $request) {
        $item_id = (int) $request->input('item_id', 0);
        if ($item_id==0) abort(404);
        $basket_item = Basket::where('part_id', $item_id)->first();
        if (!$basket_item) abort(404);
        $basket_item->delete();
        return response('1');
    }

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
}
