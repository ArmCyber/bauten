<?php

namespace App\Models;

use App\Http\Traits\InsertOrUpdate;
use Illuminate\Database\Eloquent\Model;

class Modification extends Model
{
    use InsertOrUpdate;
    public $timestamps = false;
    public static function action($model, $inputs){
        if (!$model) $model=new self;
        $model->cid = $inputs['cid'];
        $model->generation_id = $inputs['generation_id'];
        $model->save();
        return true;
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public static function adminList(){
        return self::withCars()->sort()->get();
    }

    public function scopeSort($q){
        return $q->orderBy('cid','asc');
    }

    public function generation(){
        return $this->belongsTo('App\Models\Generation');
    }

    public function getMarkAttribute(){
        return $this->generation->model->mark;
    }

    public function getModelAttribute(){
        return $this->generation->model;
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part');
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public function scopeWithCars($q){
        return $q->with(['generation' => function($q){
            $q->with(['model' => function($q){
                $q->with('mark');
            }]);
        }]);
    }
}
