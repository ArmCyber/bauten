<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class EngineFilter extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function adminList(){
        return self::sort()->withCount('criteria')->get();
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public static function action($model, $inputs, $group_id=null) {
        if (!$model) {
            $model = new self;
            $model['sort'] = $model->sortValue();
        }
        $model['title'] = $inputs['title'];
        return $model->save();
    }

    public static function deleteItem($model) {
        return $model->delete();
    }

    public function criteria(){
        return $this->hasMany('App\Models\EngineCriterion')->sort();
    }

    public static function adminGroupList() {
        return self::select('id', 'title')->whereHas('criteria')->with(['criteria' => function($q){
            $q->select('id', 'title', 'engine_filter_id');
        }])->sort()->get();
    }
}
