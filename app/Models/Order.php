<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_DECLINED = -1;
    public const STATUS_PENDING = 0;

    public static function makeOrder($inputs) {
        $basket_parts = view()->shared('basket_parts');
        $basket_parts->load('part');
        $user = auth()->user();
        $parts = [];
        $all_price = 0;
        foreach($basket_parts as $basket_part) {
            $parts[] = [
                'part_id' => $basket_part->part_id,
                'price' => $basket_part->part->price_sale,
                'real_price' => $basket_part->part->price,
                'count' => $basket_part->count,
                'name' => $basket_part->part->name,
            ];
            $all_price+= ($basket_part->count * $basket_part->part->price_sale);
        }
        $city = DeliveryCity::getItem($inputs['city_id']);
        $order = new self;
        $order['user_id'] = $user->id;
        $order['name'] = $inputs['name'];
        $order['phone'] = $inputs['phone'];
        $order['delivery'] = (int) $inputs['delivery']??0 != 0;
        $order['sum'] = $all_price;
        if ($order['delivery']) {
            $order['region_id'] = $city->region->id;
            $order['region_name'] = $city->region->title;
            $order['city_id'] = $city->id;
            $order['city_name'] = $city->title;
            $order['address'] = $inputs['address'];
            $order['delivery_price'] = $city->price;
        }
        $order['total'] = $order['sum'] + $order['delivery_price']??0;
        $order['status'] = 0;
        $order['sale'] = $user->sale;
        $order->save();
        $order->parts()->attach($parts);
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part');
    }
}
