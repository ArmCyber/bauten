<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
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
        $model['active'] = (int) array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function deleteItem($model){
        return $model->delete();
    }
}
