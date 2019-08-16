<?php

namespace App\Http\Controllers\Site;

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
}
