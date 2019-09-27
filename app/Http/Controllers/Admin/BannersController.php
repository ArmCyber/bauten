<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\Notify\Facades\Notify;
use Zakhayko\Banners\RenderBanners;

class BannersController extends BaseController
{
    //region Private
    use RenderBanners;

    protected function set_image($settings, $input, $banner){
        if (empty($settings['original_file'])) {
            $resize = [];
            if (array_key_exists('resize', $settings)) {
                $resize[] = [
                    'method'=>$settings['resize'][0],
                    'width'=>$settings['resize'][1],
                    'height'=>$settings['resize'][2],
                    'upsize'=>empty($settings['resize'][3])?false:true,
                ];
            }
            else $resize[] = ['method'=>'original'];
            if ($input && $input->isFile() &&
                $image = upload_image($input, config('banners.upload_dir'), $resize, !empty($banner)?$banner:false)

            ) return $image;
        }
        else {
            if ($input && $input->isFile() && $image = upload_original_image($input, config('banners.upload_dir'), !empty($banner)?$banner:false)) return $image;
        }
        return $banner;
    }

    protected function set_labelauty($settings, $input, $banner) {
        return $input?true:false;
    }

    protected function beforeSave($page){
        Notify::get('changes_saved');
    }
    //endregion

    protected $settings = [
        'info' => [
            //
        ]
    ];
}
