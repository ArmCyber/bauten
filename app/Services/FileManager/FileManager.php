<?php
namespace App\Services\FileManager;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FileManager {
    public function uploadImage ($key, $path, $sizes, $delete=false) {
//            $sizes = [
//                [
//                    'method'=>'fit',
//                    'width'=>,
//                    'height'=>,
//                    'dir'=>null,
//                    'upsize'=>false,
//                    'skip_delete'=>false,
//                ]
//            ];
        if (is_string($key) && request()->hasFile($key)) {
            $image = request()->file($key);
        }
        else if (is_object($key)) {
            $image = $key;
        }
        if (!empty($image)) {
            if (in_array($image->extension(), ['jpeg', 'jpg', 'png', 'gif']) && $image->isValid()) {
                $ext = $image->extension();
                if ($ext == 'jpeg') $ext = 'jpg';
                $path = public_path($path);
                do {
                    $name = file_name(18, $ext);
                }
                while (file_exists($path.$name));
                $img = Image::make($image->getRealPath());
                foreach ($sizes as $size) {
                    $dir = $path.($size['dir']??null);
                    if (!empty($size['method']) && $size['method'] == 'original') {
                        $this->checkDir($dir);
                        $img->save($dir.$name);
                    }
                    else {
                        $this->checkDir($dir);
                        $img->{$size['method']??'fit'}($size['width'], $size['height'], function($constraint) use ($size) {
                            if (!empty($size['upsize'])) $constraint->upsize();
                            if (!empty($size['aspectRatio'])) $constraint->aspectRatio();
                        })->save($dir.$name);
                    }
                    if (!empty($delete) && empty($size['skip_delete'])) {
                        File::delete($dir.$delete);
                    }
                }
                return $name;
            }
            else return false;
        }
        else return null;
    }

    public function uploadOriginalImage($key, $path, $delete=false)
    {
        if (is_string($key) && request()->hasFile($key)) {
            $image = request()->file($key);
        }
        else if (is_object($key)) {
            $image = $key;
        }
        if (!empty($image)) {
            if (in_array($image->extension(), ['jpeg', 'jpg', 'png', 'gif', 'svg']) && $image->isValid()) {
                $ext = $image->extension();
                $path = public_path($path);
                if ($ext == 'jpeg') $ext = 'jpg';
                do {
                    $name = file_name(18, $ext);
                }
                while (file_exists($path.$name));
                $image->move($path, $name);

                if (!empty($delete)
                ) {
                    File::delete($path.$delete);
                }

                return $name;
            }
            else return false;
        }
        else return null;
    }

    public function uploadFile($key, $path, $delete=false){
        if (is_string($key) && request()->hasFile($key)) {
            $image = request()->file($key);
        }
        else if (is_object($key)) {
            $image = $key;
        }
        if (!empty($image)) {
            $ext = $image->extension();
            $path = public_path($path);
            do {
                $name = file_name(18, $ext);
            }
            while (file_exists($path.$name));
            $image->move($path, $name);

            if (!empty($delete)
            ) {
                File::delete($path.$delete);
            }

            return $name;
        }
        else return null;
    }

    public function checkDir($path) {
        if (!file_exists($path)) mkdir($path, 0755, true);
    }
}
