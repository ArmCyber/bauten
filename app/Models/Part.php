<?php

namespace App\Models;

use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Part extends Model
{
    use UrlUnique;

    public static function adminList(){
        return self::sort()->get();
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
        $model['articule'] = $inputs['articule'];
        $model['oem'] = $inputs['oem'];
        $model['description'] = $inputs['description'];
        $model['part_catalog_id'] = $inputs['part_catalog_id'];
        $model['brand_id'] = $inputs['brand_id'];
        $model['url'] = self::actionUrl($inputs, $ignore);
        $model['active'] = (int) array_key_exists('active', $inputs);
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

    public static function getItemSite($url) {
        return self::where(['url'=>$url, 'active'=>1])->whereHas('catalogue')->whereHas('brand')->with(['catalogue', 'brand', 'cars'])->firstOrFail();
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


    public function scopeSort($q) {
        return $q->orderBy('id', 'asc');
    }
}
