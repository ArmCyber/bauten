<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Zakhayko\Banners\Models\Banner;

class Order extends Model
{
    public const STATUS_DECLINED = -1;
    public const STATUS_PENDING = 0;

    public const STATUSES = [
        self::STATUS_PENDING => 'pending',
        self::STATUS_DECLINED => 'declined',
    ];

    public const STATUS_NAMES = [
        self::STATUS_PENDING => 'Ожидаемый',
        self::STATUS_DECLINED => 'Откланенный',
    ];

    public static function getItem($id) {
        return self::where('id', $id)->with('order_parts')->firstOrFail();
    }

    public static function getPendingOrders(){
        return self::where('status', self::STATUS_PENDING)->with('parts')->with('user')->get();
    }

    public static function makeOrder($inputs) {
        $basket_parts = view()->shared('basket_parts');
        $basket_parts->load('part');
        $user = auth()->user();
        $parts = [];
        $all_sum = 0;
        $sale_sum = 0;
        foreach($basket_parts as $basket_part) {
            $sum = $basket_part->count * $basket_part->part->price;
            if ($basket_part->part->count_sale_count && $basket_part->part->count_sale_percent && $basket_part->count>=$basket_part->part->count_sale_count) {
                $sum = $sum*(1 - $basket_part->part->count_sale_percent/100);
            }
            elseif ($user->sale) {
                $sale_sum += $sum*$user->sale/100;
            }
            $parts[] = [
                'part_id' => $basket_part->part_id,
                'price' => $basket_part->part->price,
                'real_price' => $basket_part->part->sale,
                'count' => $basket_part->count,
                'sum' => $sum,
                'name' => $basket_part->part->name,
            ];
            $all_sum+=$sum;
        }
        $real_sum = $all_sum;
        if ($sale_sum) {
            $all_sum-=$sale_sum;
        }
        $delivery = (int) $inputs['delivery']??0 != 0;
        $settings = Banner::get('settings');
        if ($all_sum<($settings->minimum->shop??0) || ($delivery && $all_sum<($settings->mimimum->delivery??0))) return false;
        $city = DeliveryCity::getItem($inputs['city_id']);
        $order = new self;
        $order['user_id'] = $user->id;
        $order['name'] = $inputs['name'];
        $order['phone'] = $inputs['phone'];
        $order['delivery'] = $delivery;
        $order['real_sum'] = $real_sum;
        $order['sum'] = $all_sum;
        if ($order['delivery']) {
            $order['region_id'] = $city->region->id;
            $order['region_name'] = $city->region->title;
            $order['city_id'] = $city->id;
            $order['city_name'] = $city->title;
            $order['address'] = $inputs['address'];
            $order['delivery_price'] = $city->price;
        }
        $order['total'] = $all_sum + ($order['delivery_price']??0);
        $order['status'] = 0;
        $order['sale'] = $user->sale??0;
        $order->save();
        $order->parts()->attach($parts);
        return true;
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part')->withPivot('count', 'price', 'real_price', 'name');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function order_parts(){
        return $this->hasMany('App\Models\OrderPart')->with('part');
    }

    public function getStatusNameAttribute() {
        return self::STATUS_NAMES[$this->status]??null;
    }

    public function getStatusTypeAttribute(){
        return self::STATUSES[$this->status]??null;
    }

    public static function deleteItem($model) {
        return $model->delete();
    }
}
