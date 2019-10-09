<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function filterCriteriaRequest($criteria, $group_id) {
        if (!$criteria) return [];
        return self::whereIn('id', $criteria)->whereHas('filter', function($q) use($group_id){
            $q->whereNull('group_id')->orWhere('group_id', $group_id);
        })->pluck('id')->toArray();
    }

    public static function action($model, $inputs, $filter_id=null) {
        if (!$model) {
            $model = new self;
            $model['filter_id'] = $filter_id;
            $model['sort'] = $model->sortValue();
        }
        $model['title'] = $inputs['title'];
        return $model->save();
    }

    public function filter() {
        return $this->belongsTo('App\Models\Filter', 'filter_id', 'id');
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part');
    }
}
