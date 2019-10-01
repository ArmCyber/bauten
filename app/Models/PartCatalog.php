<?php

namespace App\Models;

use App\Http\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Model;

class PartCatalog extends Model
{
    use UrlUnique;
    public static function adminList(){
        return self::sort()->get();
    }

    public static function action($model, $inputs) {
        if (!$model) {
            $model = new self;
            $ignore = false;
        }
        else $ignore = $model->id;

        if (!empty($inputs['generate_url'])) {
            $url = self::url_unique($inputs['generated_url'], $ignore);
        }
        else {
            $url = $inputs['url'];
        }
        $model['url'] = $url;

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
        return self::sort()->get()->mapToGroups(function($item, $key) {
            return [mb_strtoupper(mb_substr($item->name,0,1))=>$item];
        });
    }
}
