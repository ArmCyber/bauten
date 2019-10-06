<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
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
        }
        $model['title'] = $inputs['title'];
        $model['description'] = $inputs['description'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function siteList(){
        return self::where('active',1)->sort()->get();
    }
}
