<?php

namespace App\Models;

use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;

class PartCatalog extends Model
{
    use UrlUnique;
    public static function adminList(){
        return self::withCount('parts')->sort()->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $ignore = false;
        }
        else $ignore = $model->id;
        $model['url'] = self::actionUrl($inputs, $ignore);
        $model['name'] = $inputs['name'];
        return $model->save();
    }

    public static function deleteItem($model){
        return $model->delete();
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

    public function scopeSort($q){
        return $q->orderBy('name')->orderBy('id');
    }

    public static function siteList(){
        return self::whereHas('parts', function($q){
            $q->where('active', 1);
        })->sort()->get()->mapToGroups(function($item, $key) {
            return [mb_strtoupper(mb_substr($item->name,0,1))=>$item];
        });
    }

    public static function getItemSite($url) {
        return self::where('url', $url)->whereHas('parts', function($q){
            $q->where('active', 1);
        })->with(['parts'=>function($q){
            $q->where('active', 1);
        }])->firstOrFail();
    }

    public function parts() {
        return $this->hasMany('App\Models\Part', 'part_catalog_id', 'id')->sort();
    }
}
