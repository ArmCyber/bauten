<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    use Sortable;

    protected $sortableDesc = false;

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $model['sort'] = $model->sortValue();
        }
        $model['name'] = $inputs['name'];
        $model['mark_id'] = $inputs['mark_id'];
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
