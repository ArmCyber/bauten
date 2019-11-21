<?php

namespace App\Models;

use App\Http\Traits\InsertOrUpdate;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    public $timestamps=false;

    use InsertOrUpdate;
    public static function action($model, $inputs, $mark_id=null) {
        if (!$model) {
            $model = new self;
            $model['mark_id'] = $mark_id;
        }
        $model['name'] = $inputs['name'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public function mark(){
        return $this->belongsTo('App\Models\Mark', 'mark_id', 'id');
    }

    public function generations(){
        return $this->hasMany('App\Models\Generation', 'model_id', 'id')->sort();
    }

    public function scopeSort($q){
        $q->orderBy('name', 'asc');
    }

    public static function getSearchData($mark_ids) {
        return self::where('active',1)->whereIn('mark_id', $mark_ids)->sort()->get()->mapToGroups(function($item, $key) {
            return [mb_strtoupper(mb_substr($item->name,0,1))=>$item];
        });
    }
}
