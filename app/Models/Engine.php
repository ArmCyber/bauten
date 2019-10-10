<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    public static function adminList(){
        return self::with('engine_type')->sort()->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
        }
        $model['name'] = $inputs['name'];
        $model['engine_type_id'] = $inputs['engine_type_id'];
        return $model->save();
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public function engine_type() {
        return $this->belongsTo('App\Models\EngineType', 'engine_type_id', 'id');
    }

    public function scopeSort($q){
        return $q->orderBy('name', 'asc');
    }
}
