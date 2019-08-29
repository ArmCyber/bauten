<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use Sortable;

    protected $sortableDesc = false;

    public static function adminList(){
        return self::withCount('regions')->sort()->get();
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

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public static function siteList(){
        return self::where('active', 1)->whereHas('regions', function($q){
            $q->where('active', 1);
        })->with(['regions'=>function($q){
            $q->where('active', 1);
        }])->sort()->get();
    }

    public static function jsonForRegions($countries){
        return $countries->mapWithKeys(function($item){
            return [
                $item->id => $item->regions->map(function($item){
                    return ['id'=>$item->id, 'title'=>$item->title];
                })
            ];
        });
    }

    public function regions(){
        return $this->hasMany('App\Models\Region', 'country_id', 'id')->sort();
    }
}
