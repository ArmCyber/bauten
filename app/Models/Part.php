<?php

namespace App\Models;

use App\Http\Traits\GetIncrement;
use App\Http\Traits\InsertOrUpdate;
use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Part extends Model
{
    use UrlUnique, GetIncrement, InsertOrUpdate;

    public $timestamps = false;

    public static function adminList(){
        return self::sort()->get();
    }

    public static function catalogsList($ids, $criteria = [], $sort = []){
        return self::whereIn('part_catalog_id', $ids)->where('active', 1)->filtered($criteria)->sort($sort)->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $ignore = false;
        }
        else {
            $ignore = $model->id;
        }
        $model['name'] = $inputs['name'];
        $model['code'] = $inputs['code'];
        $model['price'] = $inputs['price'];
        $model['available'] = $inputs['available'];
        $model['min_count'] = $inputs['min_count'];
        $model['multiplication'] = $inputs['multiplication'];
        $model['oem'] = $inputs['oem'];
        $model['description'] = $inputs['description'];
        $model['part_catalog_id'] = $inputs['part_catalog_id'];
        $model['brand_id'] = $inputs['brand_id'];
        $model['url'] = self::actionUrl($inputs, $ignore);
        $model['active'] = (int) array_key_exists('active', $inputs);
        $model['show_image'] = (int) array_key_exists('show_image', $inputs);
        if($image = upload_file('image', 'u/parts/', ($ignore && !empty($model->image))?$model->image:false)) $model->image = $image;
        $model->save();
        PartCar::sync($model->id, $inputs['mark_id']??[], $inputs['model_id']??[], $inputs['generation_id']??[], (bool) $ignore);
        return true;
    }

    public static function deleteItem($model){
        if ($model->image) File::delete('u/parts/'.$model->image);
        Gallery::clear('parts', $model->id);
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function getItemForFilters($id) {
        return self::where('id', $id)->withCount(['catalogue as group_id'=>function($q){
            $q->select('group_id');
        }])->with(['criteria' => function($q){
            $q->select('criteria.id', 'criteria.filter_id');
        }])->firstOrFail();
    }

    public static function getItemForEngineFilters($id) {
        return self::where('id', $id)->with(['engine_criteria' => function($q){
            $q->select('engine_criteria.id', 'engine_criteria.engine_filter_id');
        }])->firstOrFail();
    }

    public static function getItemSite($url) {
        return self::where(['url'=>$url, 'active'=>1])->whereHas('catalogue')->whereHas('brand')->with(['catalogue', 'brand', 'cars', 'criteria'=>function($q){
            $q->with('filter')->orderBy('id');
        }])->firstOrFail();
    }

    public function catalogue(){
        return $this->belongsTo('App\Models\PartCatalog', 'part_catalog_id', 'id');
    }

    public function brand() {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }

    public function marks(){
        return $this->belongsToMany('App\Models\Mark', 'part_cars', 'part_id', 'mark_id');
    }

    public function models(){
        return $this->belongsToMany('App\Models\Model', 'part_cars', 'part_id', 'model_id');
    }

    public function generations(){
        return $this->belongsToMany('App\Models\Generation', 'part_cars', 'part_id', 'generation_id');
    }

    public function cars(){
        return $this->hasMany('App\Models\PartCar', 'part_id', 'id')->withInfo()->sort();
    }

    public function criteria(){
        return $this->belongsToMany('App\Models\Criterion');
    }

    public function engine_criteria(){
        return $this->belongsToMany('App\Models\EngineCriterion');
    }

    public function scopeFiltered($q, array $criteria) {
        if (count($criteria)) {
            foreach($criteria as $group) {
                $q->whereHas('criteria', function($q) use ($group){
                    $q->whereIn('criteria.id', $group);
                });
            }
        }
        return $q;
    }

    public function scopeSort($q, $sort=[]) {
        return $q->orderBy($sort[0]??'price', $sort[1]??'asc');
    }
}
