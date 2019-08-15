<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use Sortable;

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $model['sort'] = $model->sortValue();
            $model['country_id'] = $inputs['country_id'];
        }
        $model['title'] = $inputs['title'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public function country(){
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public static function deleteItem($model){
        return $model->delete();
    }
}
