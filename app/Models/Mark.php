<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function fullAdminList(){
        return self::select('id', 'name')->with(['models'=>function($q){
            $q->select('id', 'name', 'mark_id')->with(['generations'=>function($q){
                return $q->select('id', 'name', 'model_id');
            }]);
        }])->sort()->get();
    }

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
            $model['sort'] = $model->sortValue();
            $action='add';
        }
        else $action='edit';
        $model['name'] = $inputs['name'];
        $model['image_alt'] = $inputs['image_alt'];
        $model['image_title'] = $inputs['image_title'];
        $resizes = [
            [
                'method'=>'resize',
                'width'=>null,
                'height'=>56,
                'aspectRatio'=>true,
            ]
        ];
        if($image = upload_image('image', 'u/marks/', $resizes, ($action=='edit' && !empty($model->image))?$model->image:false)) $model->image = $image;
        $model['active'] = (int) array_key_exists('active', $inputs);
        return $model->save();
    }

    public static function adminList(){
        return self::withCount('models')->sort()->get();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public function models(){
        return $this->hasMany('App\Models\Model', 'mark_id', 'id')->sort();
    }


}
