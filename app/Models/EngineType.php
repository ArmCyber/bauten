<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngineType extends Model
{
    public static function adminList(){
        return self::sort()->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
        }
        $model['name'] = $inputs['name'];
        return $model->save();
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public function engines(){
        return $this->hasMany('App\Models\Engine', 'engine_type_id', 'id');
    }

    public function scopeSort($q){
        return $q->orderBy('name', 'asc');
    }
}
