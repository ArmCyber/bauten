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

    public static function filterCriteriaRequest($criteria) {
        if (!$criteria) return [];
        return self::whereIn('id', $criteria)->pluck('id')->toArray();
    }

    public static function searchList(){
        return self::whereHas('parts', function($q){
            $q->where('active', 1);
        })->get();
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
        return $this->belongsTo('App\Models\EngineFilter', 'engine_filter_id', 'id');
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part', 'engine_criterion_part', 'engine_criterion_id', 'part_id');
    }
}
