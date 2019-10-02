<?php

namespace App\Http\Controllers\Site;

use App\Models\Country;
use App\Models\HomeSlide;
use App\Models\PartCatalog;
use App\Services\PageManager\StaticPages;
use Illuminate\Http\Request;
use Zakhayko\Banners\Models\Banner;

class AppController extends BaseController
{
    use StaticPages;

    private function static_home($page) {
        $data = [];
        $data['logged_in'] = request()->has('logged_in');
        $data['banners'] = Banner::get('home');
        $data['home_slider'] = HomeSlide::siteList();
        return view('site.pages.home', $data);
    }

    //Temporary
    public function register(){
        $data = [];
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        return view('site.temp.register', $data);
    }
}
