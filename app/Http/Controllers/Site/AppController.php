<?php

namespace App\Http\Controllers\Site;

use App\Services\PageManager\StaticPages;
use Illuminate\Http\Request;

class AppController extends BaseController
{
    use StaticPages;

    private function static_home($page) {
        return view('site.pages.home');
    }
}
