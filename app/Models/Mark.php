<?php

namespace App\Models;

use App\Http\Traits\InsertOrUpdate;
use App\Http\Traits\Sortable;
use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Mark extends Model
{
    use UrlUnique, InsertOrUpdate, Sortable;

    public $timestamps=false;

    protected $sortableDesc = false;

    private const CACHE_KEY = 'marks';
    private const CACHE_KEY_HOME = 'marks_home';

    public static function clearCaches() {
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::CACHE_KEY_HOME);
    }

    public static function homeList(){
        return Cache::rememberForever(self::CACHE_KEY_HOME, function(){
            return self::where(['in_home'=>1, 'active'=>1])->sort()->get();
        });
    }

    public static function siteList(){
        return Cache::rememberForever(self::CACHE_KEY, function(){
            return self::where('active',1)->sort()->get();
        });
    }

    public static function searchList(){
        return self::where('active', 1)->orderBy('name', 'asc')->get()->mapToGroups(function($item, $key) {
            return [mb_strtoupper(mb_substr($item->name,0,1))=>$item];
        });
    }

    public static function fullAdminList(){
        return self::select('id', 'name', 'cid')->with(['models'=>function($q){
            $q->select('id', 'name', 'mark_id')->with(['generations'=>function($q){
                return $q->select('id', 'cid', 'name', 'model_id', 'engine', 'year', 'year_to');
            }]);
        }])->sort()->get();
    }

//    public static function engineAdminList(){
//        return self::select('id', 'name', 'cid')->whereHas('engines')->with(['engines'=>function($q){
//            $q->select('id', 'name', 'mark_id');
//        }])->sort()->get();
//    }

    public static function getApplicabilityKeys($marks, $models, $generations) {
        return self::select('id')->whereIn('id', array_unique($marks))->with(['models'=>function($q) use ($models, $generations){
            $q->select('id', 'mark_id')->whereIn('id', array_unique($models))->with(['generations' => function($q) use ($generations){
                $q->select('id', 'model_id')->whereIn('id', array_unique($generations));
            }]);
        }])->get()->mapWithKeys(function($mark){
            return [$mark->id => $mark->models->mapWithKeys(function($model){
                return [$model->id => $model->generations->mapWithKeys(function($generation){
                    return [$generation->id => true];
                })];
            })];
        })->toArray();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $ignore=false;
            $model->sort = $model->sortValue();
        }
        else $ignore = $model->id;
        $model['cid'] = $inputs['cid'];
        $model['name'] = $inputs['name'];
        $model['image_alt'] = $inputs['image_alt'];
        $model['image_title'] = $inputs['image_title'];
        $model['url'] = self::actionUrl($inputs, $ignore);
        $resizes = [
            [
                'method'=>'resize',
                'width'=>null,
                'height'=>56,
                'aspectRatio'=>true,
            ]
        ];
        if($image = upload_image('image', 'u/marks/', $resizes, ($ignore && !empty($model->image))?$model->image:false)) $model->image = $image;
        $model['active'] = (int) array_key_exists('active', $inputs);
        $model['show_image'] = (int) array_key_exists('show_image', $inputs);
        $model['in_home'] = (int) array_key_exists('in_home', $inputs);
        self::clearCaches();
        return $model->save();
    }

    public static function adminList(){
        return self::withCount('models')->sort()->get();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function deleteItem($model){
        if ($model->image) File::delete(public_path('u/marks/'.$model->image));
        self::clearCaches();
        return $model->delete();
    }

    public function models(){
        return $this->hasMany('App\Models\Model', 'mark_id', 'id')->sort();
    }

//    public function engines(){
//        return $this->hasMany('App\Models\Engine', 'mark_id', 'id')->sort();
//    }

}
