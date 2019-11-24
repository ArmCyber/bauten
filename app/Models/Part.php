<?php

namespace App\Models;

use App\Http\Traits\GetIncrement;
use App\Http\Traits\InsertOrUpdate;
use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class Part extends Model
{
    use UrlUnique, GetIncrement, InsertOrUpdate;

    public $timestamps = false;

    private $mutedAttributes = [];

    public static function adminList(){
        return self::with(['catalogue', 'brand'])->sort()->get();
    }

    public static function catalogsList($ids, $criteria = [], $sort = []){
        return self::whereIn('part_catalog_id', $ids)->brandAllowed()->where('active', 1)->filtered($criteria)->sort($sort)->paginate(settings('pagination'));
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
        $model['description'] = $inputs['description'];
        if($image = upload_file('image', 'u/parts/', ($ignore && !empty($model->image))?$model->image:false)) $model->image = $image;
        $model['show_image'] = (int) array_key_exists('show_image', $inputs);
        $model['url'] = self::actionUrl($inputs, $ignore);
        if (Gate::check('admin')) {
            $model['code'] = $inputs['code'];
            $model['price'] = $inputs['price'];
            $model['sale'] = $inputs['sale'];
            $model['count_sale_count'] = $inputs['count_sale_count'];
            $model['count_sale_percent'] = $inputs['count_sale_percent'];
            $model['available'] = $inputs['available'];
            $model['min_count'] = $inputs['min_count'];
            $model['multiplication'] = $inputs['multiplication'];
            $model['oem'] = $inputs['oem'];
            $model['part_catalog_id'] = $inputs['part_catalog_id'];
            $model['brand_id'] = $inputs['brand_id'];
            $model['application_only'] = (int) array_key_exists('application_only', $inputs);
            $model['active'] = (int) array_key_exists('active', $inputs);
        }
        $model->save();
        if (Gate::check('admin')) {
            PartCar::sync($model->id, $inputs['mark_id']??[], $inputs['model_id']??[], $inputs['generation_id']??[], (bool) $ignore);
            if (array_key_exists('engine_id', $inputs) && is_array($inputs['engine_id'])) {
                $engines = Engine::whereIn('id', $inputs['engine_id'])->pluck('id')->toArray();
            }
            else $engines = [];
            $model->engines()->sync($engines);
        }
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

    public static function getItemFromCode($code){
        return self::where('code', $code)->firstOrFail();
    }

    public static function getItemForFilters($id) {
        return self::where('id', $id)->withCount(['catalogue as group_id'=>function($q){
            $q->select('group_id');
        }])->with(['criteria' => function($q){
            $q->select('criteria.id', 'criteria.filter_id');
        }])->firstOrFail();
    }

//    public static function getItemForEngineFilters($id) {
//        return self::where('id', $id)->with(['engine_criteria' => function($q){
//            $q->select('engine_criteria.id', 'engine_criteria.engine_filter_id');
//        }])->firstOrFail();
//    }

    public static function getItemSite($url) {
        return self::where(['url'=>$url, 'active'=>1])->brandAllowed()->whereHas('catalogue')->whereHas('brand')->with(['catalogue', 'brand', 'cars', 'criteria'=>function($q){
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

//    public function engine_criteria(){
//        return $this->belongsToMany('App\Models\EngineCriterion');
//    }

    public function engines(){
        return $this->belongsToMany('App\Models\Engine')->sort();
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

    public function getMinCountCeilAttribute() {
        if (!array_key_exists('min_count_ceil', $this->mutedAttributes)) {
            $minCount = $this->min_count;
            $basket_part = $this->basket_part;
            if ($basket_part) {
                if ($basket_part->count>=$minCount) $minCount = 1;
                else $minCount = $minCount-$basket_part->count;
            }
            $this->mutedAttributes['min_count_ceil'] = ceil($minCount/$this->multiplication)*$this->multiplication;
        }
        return $this->mutedAttributes['min_count_ceil'];
    }

    public function getMaxCountAttribute(){
        if (!array_key_exists('max_count', $this->mutedAttributes)) {
            $available = $this->available;
            if ($available===null) $available = 9999;
            $basket_part = $this->basket_part;
            if ($basket_part) $available-=$basket_part->count;
            if ($available<$this->min_count_ceil) return 0;
            $this->mutedAttributes['max_count'] = floor($available/$this->multiplication)*$this->multiplication;
        }
        return $this->mutedAttributes['max_count'];
    }

    public function getMaxCountWoBasketAttribute(){
        if (!array_key_exists('max_count_wo_basket', $this->mutedAttributes)) {
            $available = $this->available;
            if ($available===null) $available = 9999;
            if ($available<$this->min_count_ceil) return 0;
            $this->mutedAttributes['max_count_wo_basket'] = floor($available/$this->multiplication)*$this->multiplication;
        }
        return $this->mutedAttributes['max_count_wo_basket'];
    }

    public function getBasketPartAttribute() {
        if (!array_key_exists('basket_part', $this->mutedAttributes)) {
            $basket_parts = view()->shared('basket_parts');
            if ($basket_parts) {
                $part = $basket_parts->where('part_id', $this->id)->first();
                if ($part) $this->mutedAttributes['basket_part'] = $part;
                else $this->mutedAttributes['basket_part'] = false;
            }
            else $this->mutedAttributes['basket_part'] = false;
        }
        return $this->mutedAttributes['basket_part'];
    }

//    public function getPriceSaleAttribute(){
//        if (!array_key_exists('price_sale', $this->mutedAttributes)) {
//            $this->mutedAttributes['price_sale'] = $this->price*(100 - auth()->user()->sale)/100;
//        }
//        return $this->mutedAttributes['price_sale'];
//    }

    public function getCountSaleCountBasketAttribute(){
        if (!array_key_exists('count_sale_count_basket', $this->mutedAttributes)) {
            $result = $this->count_sale_count;
            if ($result) {
                $basket_part = view()->shared('basket_parts')->where('part_id', $this->id)->first();
                if ($basket_part) {
                    $result-=$basket_part->count;
                    if ($result<0) $result = 0;
                }
            }
            $this->mutedAttributes['count_sale_count_basket'] = $result;
        }
        return $this->mutedAttributes['count_sale_count_basket'];
    }

    public static function getActiveItem($id) {
        return self::where(['id'=>$id, 'active'=>1])->brandAllowed()->first();
    }

    public function attached_parts(){
        return $this->belongsToMany('App\Models\Part', 'attached_parts', 'part_id', 'attached_part_id')->sort();
    }

    public function scopeBrandAllowed($q) {
        $q->whereDoesntHave('brand', function($q){
            $q->restricted();
        });
    }

    public function attached_parts_site(){
        return $this->belongsToMany('App\Models\Part', 'attached_parts', 'part_id', 'attached_part_id')->where('active', 1)->sort();
    }
}
