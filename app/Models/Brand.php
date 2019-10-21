<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Brand extends Model
{
    use Sortable, UrlUnique;

    protected $sortableDesc = false;

    private const CACHE_KEY = 'brands';
    private const CACHE_KEY_HOME = 'brands_home';
    private const CACHE_KEY_SEARCH = 'brands_search';

    public static function clearCaches(){
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::CACHE_KEY_HOME);
        Cache::forget(self::CACHE_KEY_SEARCH);
    }

    public static function homeList(){
        return Cache::rememberForever(self::CACHE_KEY_HOME, function(){
            return self::where(['active'=>1, 'in_home'=>1])->sort()->get();
        });
    }

    public static function siteList(){
        return Cache::rememberForever(self::CACHE_KEY, function (){
            return self::where('active', 1)->sort()->get();
        });
    }

    public static function searchList(){
        return Cache::rememberForever(self::CACHE_KEY_SEARCH, function (){
            return self::where('active', 1)->orderBy('name', 'asc')->get()->mapToGroups(function($item, $key) {
                return [mb_strtoupper(mb_substr($item->name,0,1))=>$item];
            });
        });
    }

    public static function adminList(){
        return self::sort()->get();
    }

    public static function action($model, $inputs) {
        self::clearCaches();
        if (!$model) {
            $model = new self;
            $model['sort'] = $model->sortValue();
            $ignore = false;
        } else { $ignore=$model->id; }
        $model['name'] = $inputs['name'];
        $model['short'] = $inputs['short'];
        $model['description'] = $inputs['description'];
        $model['code'] = $inputs['code'];
        $model['image_alt'] = $inputs['image_alt'];
        $model['image_title'] = $inputs['image_title'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        $model['in_home'] = (int) array_key_exists('in_home', $inputs);
        $model['url'] = self::actionUrl($inputs, $ignore);
        $resizes = [
            [
                'method'=>'resize',
                'width'=>null,
                'height'=>50,
                'aspectRatio'=>true,
            ]
        ];
        if($image = upload_image('image', 'u/brands/', $resizes,($ignore && !empty($model->image))?$model->image:false)) $model->image = $image;
        return $model->save();
    }

    public static function deleteItem($model){
        self::clearCaches();
        if ($model->image) File::delete(public_path('u/brands/').$model->image);
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function getItemSite($url) {
        return self::where(['url'=>$url, 'active'=>1])->firstOrFail();
    }
}
