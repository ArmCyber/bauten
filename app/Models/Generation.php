<?php

namespace App\Models;

use App\Http\Traits\InsertOrUpdate;
use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use InsertOrUpdate;

    public $timestamps=false;

    protected $appends = [
        'years',
    ];

    protected $hidden = [
        'year', 'year_to',
    ];

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $model['model_id'] = $inputs['model_id'];
        }
        $model['cid'] = $inputs['cid'];
        $model['name'] = $inputs['name'];
        $model['engine'] = $inputs['engine'];
        $range_data = get_range_data($inputs['year'], $inputs['year_to']);
        $model['year'] = $range_data[0];
        $model['year_to'] = $range_data[1];
        $model['active'] = (int)array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public static function deleteItem($model) {
        return $model->delete();
    }

    public function model() {
        return $this->belongsTo('App\Models\Model', 'model_id', 'id');
    }

    public function scopeSort($q){
        $q->orderBy('name', 'asc');
    }

    public function getYearsAttribute(){
        $years = $this['year'];
        if ($this['year_to']) {
            $years.=' - '.$this['year_to'];
        }
        return $years;
    }
}
