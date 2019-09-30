<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class HomeSlide extends Model
{
    use Sortable;

    protected $table='home_slider';
    private const CACHE_KEY = 'home_slider';

    public static function clearCaches(){
        Cache::forget(self::CACHE_KEY);
    }

    public static function adminList(){
        return self::sort()->get();
    }

    public static function action($model, $inputs) {
        self::clearCaches();
        if (!$model) {
            $model = new self;
            $action = 'add';
        } else { $action='edit'; }
        $model['title'] = $inputs['title'];
        $model['description'] = $inputs['description'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        $model['image_alt'] = $inputs['image_alt'];
        $model['image_title'] = $inputs['image_title'];
        if($image = upload_file('image', 'u/home_slider/', ($action=='edit' && !empty($model->image))?$model->image:false)) $model->image = $image;
        return $model->save();
    }
}
