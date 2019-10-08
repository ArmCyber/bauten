<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
    use UrlUnique, Sortable;

    protected $sortableDesc = false;

    public static function adminList($onlyGroups = false){
        $query = self::query();
        if (!$onlyGroups) $query->withCount('catalogs');
        return $query->sort()->get();
    }

    public static function getItemSite($url) {
        return self::where('url', $url)->whereHas('catalogs', function($q){
            $q->whereHas('parts', function($q){
                $q->where('active', 1);
            });
        })->with(['catalogs' => function($q){
            $q->whereHas('parts', function($q){
                $q->where('active', 1);
            });
        }])->firstOrFail();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $ignore = false;
            $model['sort'] = $model->sortValue();
        }
        else $ignore = $model->id;
        $model['url'] = self::actionUrl($inputs, $ignore);
        $model['name'] = $inputs['name'];
        return $model->save();
    }

    public static function siteList() {
        return self::whereHas('catalogs', function($q){
            $q->whereHas('parts', function($q){
                $q->where('active', 1);
            });
        })->with(['catalogs' => function ($q){
            $q->whereHas('parts', function($q){
                $q->where('active', 1);
            });
        }])->sort()->get();
    }

    public function catalogs() {
        return $this->hasMany('App\Models\PartCatalog', 'group_id', 'id')->sort();
    }

    public static function deleteItem($model){
        $model->catalogs()->update(['group_id'=>null]);
        return true;
    }

    public static function getItem($id){
        return self::findOrFail($id);
    }

}
