<?php

namespace App\Models;

use App\Http\Traits\UrlUnique;
use Illuminate\Support\Facades\Cache;
use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use App\Services\PageManager\Facades\PageManager;
use Illuminate\Support\Facades\File;

class Page extends Model
{
    use Sortable, UrlUnique;

    protected $sortableDesc = false;
    public $translatable = ['title', 'content', 'seo_title', 'seo_description', 'seo_keywords'];

    //region Cache
    private const CACHE_KEY_STATIC = 'pages_static';
    private const CACHE_KEY_MENU = 'pages_menu';
    private const CACHE_KEY_FOOTER = 'pages_footer';

    public static function clearCaches(){
        Cache::forget(self::CACHE_KEY_STATIC);
        Cache::forget(self::CACHE_KEY_MENU);
        Cache::forget(self::CACHE_KEY_FOOTER);
    }
    //endregion

    public static function getStaticPages() {
        return Cache::rememberForever(self::CACHE_KEY_STATIC, function(){
            return self::select('id', 'title', 'url', 'static', 'active')->whereNotNull('static')->get();
        });
    }

    public static function getMenu(){
        return Cache::rememberForever(self::CACHE_KEY_MENU, function(){
            return self::select('id', 'url', 'title', 'static')->where(['active'=>1, 'on_menu'=>1])->sort()->get();
        });
    }

    public static function footerList(){
        return Cache::rememberForever(self::CACHE_KEY_FOOTER, function(){
            return self::select('id', 'url', 'title')->where(['active'=>1, 'on_footer'=>1])->sort()->get();
        });
    }

    public static function adminList(){
        return self::sort()->get();
    }

    public static function getStaticPage($static){
        return self::where(['static'=>$static, 'active'=>1])->firstOrFail();
    }

    public static function getPage($id){
        return self::findOrFail($id);
    }

    public static function action($model, $inputs) {
        if (empty($model)) {
            $model = new self;
            $ignore = false;
            $action = 'add';
            $model['sort'] = $model->sortValue();
        }
        else {
            $ignore = $model->id;
            $action = 'edit';
        }
        if ($action == 'add' || $model->static!=\PageManager::getHomepage()) {
            if (!empty($inputs['generate_url'])) {
                $url = self::url_unique($inputs['generated_url'], $ignore);
                if (PageManager::inUsedRoutes($url) && $url!=$model->url) $url = $url.'-2';
                $length = mb_strlen($url, 'UTF-8');
                if($length==1) $url = '-'.$url.'-';
                else if ($length==2) $url=$url.'-';
            }
            else {
                $url = $inputs['url'];
            }
            $model['url'] = $url;
        }
        $model['on_menu'] = (int) !empty($inputs['on_menu']);
        $model['on_footer'] = (int) !empty($inputs['on_footer']);
        $model['show_image'] = (int) !empty($inputs['show_image']);
        $model['active'] = (int) (!empty($inputs['active']) || ($action=='edit' && $model['static'] == PageManager::getHomePage()));
        merge_model($inputs, $model, ['title', 'seo_title', 'seo_description', 'seo_keywords']);
        if (!$ignore || !$model['static']) {
            $model['image_alt'] = $inputs['image_alt'];
            $model['image_title'] = $inputs['image_title'];
            $model['content'] = $inputs['content'];
            $resizes = [
                [
                    'method'=>'resize',
                    'width'=>1440,
                    'height'=>null,
                    'aspectRatio'=>true,
                    'upsize'=>true,
                ]
            ];
            if($image = upload_image('image', 'u/pages/', $resizes, ($action=='edit' && !empty($model->image))?$model->image:false)) $model->image = $image;
        }
        self::clearCaches();
        $model->save();
        return $model->wasChanged();
    }

    public static function deletePage($model){
        self::clearCaches();
        if ($model->image) File::delete(public_path('u/pages/'.$model->image));
        Gallery::clear('pages', $model->id);
        return $model->delete();
    }

    public function getUrlAttribute($value) {
        if ($this->static==PageManager::getHomePage()) return '';
        return $value;
    }

}
