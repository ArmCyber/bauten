<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class EngineCriterion extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function action($model, $inputs, $filter_id=null) {
        if (!$model) {
            $model = new self;
            $model['engine_filter_id'] = $filter_id;
            $model['sort'] = $model->sortValue();
        }
        $model['title'] = $inputs['title'];
        return $model->save();
    }

    public static function deleteItem($model) {
        return $model->delete();
    }

    public function filter() {
        return $this->belongsTo('App\Models\EngineFilter');
    }
}
