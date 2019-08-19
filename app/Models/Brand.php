<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Brand extends Model
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
            $action = 'add';
        } else { $action='edit'; }
        $model['name'] = $inputs['name'];
        $model['code'] = $inputs['code'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        if($image = upload_file('image', 'u/brands/', ($action=='edit' && !empty($model->image))?$model->image:false)) $model->image = $image;

        return $model->save();
    }

    public static function deleteItem($model){
        if ($model->image) File::delete(public_path('u/brands/').$model->image);
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }
}
