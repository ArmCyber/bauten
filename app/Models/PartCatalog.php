<?php

namespace App\Models;

use App\Http\Traits\InsertOrUpdate;
use App\Http\Traits\Sortable;
use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PartCatalog extends Model
{
    use UrlUnique, Sortable, InsertOrUpdate;

    public static function adminList(){
        return self::withCount('parts')->with('group')->sort()->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $ignore = false;
            $model->sort = $model->sortValue();
        }
        else $ignore = $model->id;
        $model['url'] = self::actionUrl($inputs, $ignore);
        $model['name'] = $inputs['name'];
        $model['image_alt'] = $inputs['image_alt'];
        $model['image_title'] = $inputs['image_title'];
        $model['in_home'] = (int) array_key_exists('in_home', $inputs);
        if (Gate::check('admin')) {
            $model['cid'] = $inputs['cid'];
            $model['group_id'] = $inputs['group_id'];
        }
        $resizes = [
            [
                'method'=>'resize',
                'width'=>124,
                'height'=>null,
                'aspectRatio'=>true,
                'upsize'=>true,
            ]
        ];
        if($image = upload_image('image', 'u/part_catalogs/', $resizes, ($ignore && !empty($model->image))?$model->image:false)) $model->image = $image;
        return $model->save();
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function siteList(){
        return self::whereHas('parts', function($q){
            $q->where('active', 1)->brandAllowed();
        })->sort()->get()->mapToGroups(function($item, $key) {
            return [mb_strtoupper(mb_substr($item->name,0,1))=>$item];
        });
    }

    public static function homeList(){
        return self::whereHas('parts', function($q){
            $q->where('active', 1)->brandAllowed();
        })->where('in_home', 1)->withCount(['parts as parts_min_price'=>function($q){
            $q->select(DB::raw('MIN(`price`)'))->where('active', 1)->brandAllowed();
        }])->with('group')->sort()->get()->values();
    }

    public static function getItemSite($url) {
        return self::where('url', $url)->whereHas('parts', function($q){
            $q->where('active', 1)->brandAllowed();
        })->firstOrFail();
    }

    public function group() {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    public function parts() {
        return $this->hasMany('App\Models\Part', 'part_catalog_id', 'id')->sort();
    }
}
