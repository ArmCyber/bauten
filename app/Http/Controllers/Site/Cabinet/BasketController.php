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
use Zakhayko\Banners\Models\Banner;

class BasketController extends BaseController
{
    public function addToBasket(Request $request) {
        $inputs = $request->only(['part', 'count']);
        $validator = Validator::make($inputs, [
            'part' => 'required|integer',
            'count' => 'required|integer',
        ]);
        if ($validator->fails()) abort(404);
        $part = Part::getActiveItem($inputs['part']);
        if (!$part || $part->application_only) abort(404);
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
        $data['seo'] = $this->staticSEO('Корзина');
        $data['settings'] = Banner::get('settings');
        $this->shared['basket_parts']->load('part');
        return view('site.pages.cabinet.basket', $data);
    }

    public function updateItem(Request $request) {
        $item_id = (int) $request->input('itemId', 0);
        $user_id = $this->shared['user']->id;
        if ($item_id==0) abort(404);
        $basket_item = Basket::where(['part_id' => $item_id, 'user_id'=>$user_id])->first();
        if (!$basket_item) abort(404);
        $count = $request->input('count');
        if (!$count || !is_numeric($count) || $count<$basket_item->part->min_count || $count>($basket_item->part->available??9999) || $count%$basket_item->part->multiplication!=0) abort(404);
        $basket_item->count = $count;
        $basket_item->save();
        return response(1);
    }

    public function deleteFromBasket(Request $request) {
        $item_id = (int) $request->input('itemId', 0);
        $user_id = $this->shared['user']->id;
        if ($item_id==0) abort(404);
        $basket_item = Basket::where(['part_id' => $item_id, 'user_id'=>$user_id])->first();
        if (!$basket_item) abort(404);
        $basket_item->delete();
        return response('1');
    }

    public function check(Request $request) {
        $item_id = (int) $request->input('itemId', 0);
        $user_id = $this->shared['user']->id;
        $newStatus = $request->input('status', false)?1:0;
        if ($item_id==0) {
            Basket::where('user_id',$user_id)->update(['checked' => $newStatus]);
        }
        else {
            $basket_item = Basket::where(['part_id' => $item_id, 'user_id'=>$user_id])->first();
            if (!$basket_item) abort(404);
            $basket_item->checked = $newStatus;
            $basket_item->save();
        }
        return response(1);
    }
}
