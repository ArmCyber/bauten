<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

class CabinetController extends BaseController
{
    public function main(){
        return view('site.pages.cabinet.main');
    }
}
