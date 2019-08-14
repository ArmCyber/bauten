<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $model['sort'] = $model->sortValue();
        }
        $model['name'] = $inputs['name'];
        $model['active'] = (int) array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function adminList(){
        return self::withCount('models')->sort()->get();
    }

    public static function getItem($id){

        return self::where('id', $id)->firstOrFail();
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public function models(){
        return $this->hasMany('App\Models\Model', 'mark_id', 'id')->sort();
    }

}
