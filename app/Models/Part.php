<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Part extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function adminList(){
        return self::sort()->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $model['sort'] = $model->sortValue();
            $action='add';
        }
        else $action='edit';
        $model['name'] = $inputs['name'];
        $model['code'] = $inputs['code'];
        $model['part_catalog_id'] = $inputs['part_catalog_id'];
        $model['brand_id'] = $inputs['brand_id'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        if($image = upload_file('image', 'u/parts/', ($action=='edit' && !empty($model->image))?$model->image:false)) $model->image = $image;
        $model->save();
        PartCar::sync($model->id, $inputs['mark_id']??[], $inputs['model_id']??[], $inputs['generation_id']??[], $action=='edit');
        return true;
    }

    public static function deleteItem($model){
        if ($model->image) File::delete('u/parts/'.$model->image);
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
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
}
