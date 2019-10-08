<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function adminList($group_id=null){
        return self::where('group_id', $group_id)->sort()->withCount('criteria')->get();
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public static function action($model, $inputs, $group_id=null) {
        if (!$model) {
            $model = new self;
            $model['group_id'] = $group_id;
            $model['sort'] = $model->sortValue();
        }
        $model['title'] = $inputs['title'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function deleteItem($model) {
        return $model->delete();
    }

    public function group(){
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    public function criteria(){
        return $this->hasMany('App\Models\Criterion', 'filter_id', 'id')->sort();
    }
}
