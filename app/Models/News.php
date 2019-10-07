<?php

namespace App\Models;

use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class News extends Model
{
    use UrlUnique;

    private const CACHE_KEY = 'news';
    private const CACHE_KEY_HOME = 'news_home';

    public static function clearCaches() {
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::CACHE_KEY_HOME);
    }

    public static function adminList(){
        return self::sort()->get();
    }

    public static function action($model, $inputs) {
        self::clearCaches();
        if (!$model) {
            $model = new self;
            $ignore = false;
        }
        else $ignore = $model->id;
        $model['url'] = self::actionUrl($inputs, $ignore);
        merge_model($inputs, $model, ['title', 'image_alt', 'image_title', 'short', 'content', 'seo_title', 'seo_description', 'seo_keywords']);
        $model['active'] = (int) !empty($inputs['active']);
        $resizes = [
            [
                'method'=>'fit',
                'width'=>480,
                'height'=>270,
                'upsize'=>true,
            ]
        ];
        if($image = upload_image('image', 'u/news/', $resizes, ($ignore && !empty($model->image))?$model->image:false)) $model->image = $image;
        return $model->save();
    }

    public static function deleteItem($model){
        self::clearCaches();
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public function scopeSort($q){
        return $q->orderBy('id', 'desc');
    }

    public static function siteList(){
        return Cache::rememberForever(self::CACHE_KEY, function(){
            return self::where('active', 1)->sort()->get();
        });
    }

    public static function homeList(){
        return Cache::rememberForever(self::CACHE_KEY_HOME, function(){
            return self::where('active', 1)->sort()->limit(3)->get();
        });
    }

    public static function getItemSite($url) {
        return self::where(['url'=>$url, 'active'=>1])->firstOrFail();
    }
}
