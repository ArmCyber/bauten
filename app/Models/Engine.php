<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    public $timestamps = false;

    public function scopeSort($q){
        return $q->orderBy('name', 'asc');
    }

    public static function action($model, $inputs, $mark_id=null) {
        if (!$model) {
            $model = new self;
            $model['mark_id'] = $mark_id;
        }
        $model['number'] = $inputs['number'];
        $model['name'] = $inputs['name'];
        $range_data = get_range_data($inputs['year'], $inputs['year_to']);
        $model['year'] = $range_data[0];
        $model['year_to'] = $range_data[1];
        return $model->save();
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public function mark(){
        return $this->belongsTo('App\Models\Mark', 'mark_id', 'id');
    }

    public static function deleteItem($model) {
        return $model->delete();
    }
}
