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

    public static function siteListForGroup($group_id) {
        return self::where(function($q) use ($group_id){
            $q->whereNull('group_id')->orWhere('group_id', $group_id);
        })->where('active', 1)->whereHas('criteria', function($q) use ($group_id){
            $q->whereHas('parts', function($q) use ($group_id){
                $q->where('active', 1)->whereHas('catalogue', function($q) use ($group_id){
                    $q->where('group_id', $group_id);
                });
            });
        })->with(['criteria'=>function($q) use ($group_id){
            $q->whereHas('parts', function($q) use ($group_id){
                $q->where('active', 1)->whereHas('catalogue', function($q) use ($group_id){
                    $q->where('group_id', $group_id);
                });
            });
        }])->sort()->get();
    }

    public static function siteListForCategory($group_id, $category_id) {
        return self::where(function($q) use ($group_id, $category_id){
            $q->whereNull('group_id')->orWhere('group_id', $group_id);
        })->where('active', 1)->whereHas('criteria', function($q) use ($category_id){
            $q->whereHas('parts', function($q) use ($category_id){
                $q->where('active', 1)->where('part_catalog_id', $category_id);
            });
        })->with(['criteria'=>function($q) use ($category_id){
            $q->whereHas('parts', function($q) use ($category_id){
                $q->where('active', 1)->where('part_catalog_id', $category_id);
            });
        }])->sort()->get();
    }

    public static function adminGroupList($group_id) {
        return self::select('id', 'title')->whereHas('criteria')->where(function($q) use($group_id){
            $q->whereNull('group_id')->orWhere('group_id', $group_id);
        })->with(['criteria' => function($q){
            $q->select('id', 'title', 'filter_id');
        }])->orderBy('group_id')->sort()->get();
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
