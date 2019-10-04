<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Gallery extends Model
{
    public $timestamps = false;
    use Sortable;

    public function image($thumb = false){
        $path = 'u/gallery/';
        if ($thumb) $path .= 'thumbs/';
        return asset($path.$this->image);
    }

    public static function addImages($gallery, $key, $images, $settings) {
        $result = true;
        $inserts = [];
        $resizes = [
            [
                'method'=>$settings['method'],
                'width'=>$settings['width'],
                'height'=>$settings['height'],
                'upsize'=>$settings['upsize'],
                'aspectRatio'=>$settings['aspectRatio'],
            ],
        ];
        if (!empty($settings['use_thumbs'])) {
            $resizes[] = [
                'method'=>$settings['thumb_method'],
                'width'=>$settings['thumb_width'],
                'height'=>$settings['thumb_height'],
                'upsize'=>$settings['thumb_upsize'],
                'aspectRatio'=>$settings['thumb_aspectRatio'],
                'dir'=>'thumbs/',
            ];
        }
        foreach($images as $image){
            $name = upload_image($image, 'u/gallery/', $resizes);
            if($name) {
                $inserts[] = [
                    'gallery'=>$gallery,
                    'key'=>$key,
                    'image'=>$name,
                ];
            }
            else $result = false;
        }
        self::insert($inserts);
        return $result;
    }

    public static function get($gallery, $key=null){
        return self::where(['gallery'=>$gallery, 'key'=>$key])->sort()->get();
    }

    public static function updateSeo($model, $values) {
        $model['alt'] = $values['alt'];
        $model['title'] = $values['title'];
        return $model->save();
    }

    public static function clear($gallery, $key){
        $query = self::where(['gallery'=>$gallery, 'key'=>$key]);
        $items = (clone $query)->get();
        if (count($items)) {
            foreach($items as $item) {
                if ($item->image) {
                    File::delete(public_path('u/gallery/').$item->image);
                    File::delete(public_path('u/gallery/thumbs/').$item->image);
                }
            }
            $query->delete();
        }
    }

    public static function deleteItem($model) {
        File::delete(public_path('u/gallery/').$model->image);
        File::delete(public_path('u/gallery/thumbs/').$model->image);
        return $model->delete();
    }

    public static function adminList($gallery, $key=null){
        return self::where(['gallery'=>$gallery, 'key'=>$key])->sort()->get();
    }

}
