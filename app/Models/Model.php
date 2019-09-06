<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    use Sortable;

    protected $sortableDesc = false;

    public static function action($model, $inputs, $mark_id=null) {
        if (!$model) {
            $model = new self;
            $model['mark_id'] = $mark_id;
            $model['sort'] = $model->sortValue();
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
}
