<?php

namespace App\Models;

use App\Http\Traits\GetIncrement;
use App\Http\Traits\InsertOrUpdate;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use GetIncrement, InsertOrUpdate;
    public $timestamps = false;

    public static function adminList() {
        return self::sort()->get();
    }

    public function scopeSort($q){
        return $q->orderBy('name', 'asc');
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
        }
        $model['number'] = $inputs['number'];
        $model['name'] = $inputs['name'];
        $range_data = get_range_data($inputs['year'], $inputs['year_to']);
        $model['year'] = $range_data[0];
        $model['year_to'] = $range_data[1];
        $model->save();
        if(array_key_exists('mark_id', $inputs) && is_array($inputs['mark_id'])) {
            $ids = Mark::whereIn('id', $inputs['mark_id'])->pluck('id')->toArray();
        }
        else $ids = [];
        $model->marks()->sync($ids);
        return true;
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public function parts(){
        return $this->belongsToMany('App\Models\Part');
    }

    public function marks(){
        return $this->belongsToMany('App\Models\Mark');
    }

    public function getYearsAttribute(){
        $years = $this['year'];
        if ($this['year'] && $this['year_to']!=$this['year']){
            $years.='-';
        }
        if ($this['year_to'] && $this['year_to']!=$this['year']) {
            $years.=$this['year_to'];
        }
        return $years;
    }

    public static function deleteItem($model) {
        return $model->delete();
    }
}
