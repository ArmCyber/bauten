<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $model['model_id'] = $inputs['model_id'];
        }
        $model['name'] = $inputs['name'];
        $model['active'] = (int)array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public static function deleteItem($model) {
        return $model->delete();
    }

    public function model() {
        return $this->belongsTo('App\Models\Model', 'model_id', 'id');
    }

    public function scopeSort($q){
        $q->orderBy('name', 'asc');
    }
}
