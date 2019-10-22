<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerGroup extends Model
{
    public static function adminList(){
        return self::withCount('users')->sort()->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $action='add';
        } else $action = 'edit';
        $model['title'] = $inputs['title'];
        if($action=='add' || $model->id!=1) {
            $model['sale'] = $inputs['sale'];
            $model['terms'] = $inputs['terms'];
        }
        return $model->save();
    }

    public static function getNextStatus($item) {
        return self::where('sale', '>', $item->sale)->sort()->first();
    }

    public static function deleteItem($model, $move=null){
        if ($move) $model->users()->update(['partner_group_id'=>$move]);
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public function scopeSort($q){
        return $q->orderBy('sale', 'asc');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
