<?php

namespace App\Http\Controllers\Site;

use App\Models\Country;
use App\Services\PageManager\StaticPages;
use Illuminate\Http\Request;

class AppController extends BaseController
{
    use StaticPages;

    private function static_home($page) {
        $data = [];
        $data['logged_in'] = request()->has('logged_in');
        return view('site.pages.home', $data);
    }



    //Temporary
    public function catalogue(){
        return view('site.temp.catalogue');
    }

    public function register(){
        $data = [];
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        return view('site.temp.register', $data);
    }

    public function product(){
        return view('site.temp.product');
    }
}
