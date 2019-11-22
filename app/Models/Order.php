<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Zakhayko\Banners\Models\Banner;

class Order extends Model
{
    public const STATUS_DECLINED = -1;
    public const STATUS_NEW = 0;
    public const STATUS_PENDING = 1;
    public const STATUS_DONE = 2;

    public const STATUSES = [
        self::STATUS_DECLINED => 'declined',
        self::STATUS_NEW => 'new',
        self::STATUS_PENDING => 'pending',
        self::STATUS_DONE => 'done',
    ];

    public const PROCESS = [
        0 => 'Заказ принят',
        1 => 'Собирается на складе',
        2 => 'Доставляется',
        3 => 'Доставлен',
    ];

    public static function getItem($id) {
        return self::where('id', $id)->with('order_parts')->firstOrFail();
    }

    public static function getItemSite($id) {
        return self::where(['id'=>$id, 'user_id'=>auth()->user()->id])->where('status', '<>', self::STATUS_DECLINED)->firstOrFail();
    }

    public static function getOrdersWithStatus($status, $user_id=null){
        $result = self::where('status', $status);
        if($user_id!==null) $result->where('user_id', $user_id);
        return $result->with(['parts', 'user'])->sort()->get();
    }

    public static function userPendingOrdersCount($user_id) {
        return self::where('user_id', $user_id)->whereIn('status', [self::STATUS_NEW, self::STATUS_PENDING])->count();
    }

    public static function userPendingOrders($user_id) {
        return self::where('user_id', $user_id)->whereIn('status', [self::STATUS_NEW, self::STATUS_PENDING])->with('parts')->sort()->get();
    }

    public static function userDoneOrders($user_id) {
        return self::where('user_id', $user_id)->where('status', self::STATUS_DONE)->with('parts')->sort()->get();
    }

    public static function getUserOrdersCount($user_id){
        $result = self::select('status')->where('user_id',$user_id)->get();
        $all = count($result);
        $result = $result->groupBy('status')->toArray();
        return [
            'all' => $all,
            self::STATUS_DECLINED => count($result[self::STATUS_DECLINED]??[]),
            self::STATUS_NEW => count($result[self::STATUS_NEW]??[]),
            self::STATUS_PENDING => count($result[self::STATUS_PENDING]??[]),
            self::STATUS_DONE => count($result[self::STATUS_DONE]??[]),
        ];
    }

    public static function getCount($status) {
        return self::where('status', $status)->count();
    }

    public static function getOrderData(){
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
                'code' => $basket_part->part->code,
            ];
            $all_sum+=$sum;
        }
        $real_sum = $all_sum;
        if ($sale_sum) {
            $all_sum-=$sale_sum;
        }
        $settings = Banner::get('settings');
        if ($all_sum<($settings->minimum->shop??0)) return false;
        return [
            'all_sum' => $all_sum,
            'user' => $user,
            'real_sum' => $real_sum,
            'parts' => $parts,
            'settings' => $settings,
        ];
    }

    public static function makeOrder($inputs) {
        $data = Order::getOrderData();
        if (!$data) return false;
        $delivery = (int) $inputs['delivery']??0 != 0;
        if ($delivery && $data['all_sum']<($data['settings']->minimum->delivery??0)) return false;
        $city = DeliveryCity::getItem($inputs['city_id']);
        $order = new self;
        $order['user_id'] = $data['user']->id;
        $order['name'] = $inputs['name'];
        $order['phone'] = $inputs['phone'];
        $order['delivery'] = $delivery;
        $order['real_sum'] = $data['real_sum'];
        $order['sum'] = $data['all_sum'];
        if ($order['delivery']) {
            $order['region_id'] = $city->region->id;
            $order['region_name'] = $city->region->title;
            $order['city_id'] = $city->id;
            $order['city_name'] = $city->title;
            $order['address'] = $inputs['address'];
            $order['delivery_price'] = $city->price;
        }
        $order['total'] = $data['all_sum'] + ($order['delivery_price']??0);
        $order['status'] = self::STATUS_NEW;
        $order['sale'] = $user->sale??0;
        $order->save();
        $order->parts()->attach($data['parts']);
        return $order->id;
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part')->withPivot('count', 'price', 'real_price', 'name', 'code', 'sum');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function order_parts(){
        return $this->hasMany('App\Models\OrderPart')->with('part');
    }

    public function getStatusHtmlAttribute() {
        switch($this->status){
            case self::STATUS_DECLINED: $result = '<span class="text-warning">Откланенный</span>'; break;
            case self::STATUS_PENDING: $result = '<span class="text-danger">Невыполненный</span>'; break;
            case self::STATUS_DONE: $result = '<span class="text-success">Выполненный</span>'; break;
            default: $result = '<span class="text-info">Новый</span>';
        }
        return $result;
    }

    public function getStatusSiteHtmlAttribute() {
        switch($this->status){
            case self::STATUS_DECLINED: $result = '<span class="text-warning">Откланенный</span>'; break;
            case self::STATUS_DONE: $result = '<span class="text-success">Выполненный</span>'; break;
            default: $result = '<span class="text-danger">Невыполненный</span>';
        }
        return $result;
    }

    public function getStatusTypeAttribute(){
        return self::STATUSES[$this->status]??null;
    }

    public function scopeSort($q){
        return $q->orderBy('id', 'desc');
    }

    public static function deleteItem($model) {
        return $model->delete();
    }
}
