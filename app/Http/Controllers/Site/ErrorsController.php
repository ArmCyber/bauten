<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

class ErrorsController extends BaseController
{
    public function __construct() {}

    public function show($code){
        $this->view_share();
        $t = __('errors.'.$code);
        if (!is_array($t)) $t=[];
        $data = [
            'error' => [
                'code'=>$code,
                'title'=>$t['title']??null,
                'message'=>$t['message']??null,
            ],
//            'seo'=>$this->staticSEO($t['title']??null),
            'main_class'=>'error-page',
        ];
        return response()->view('site.pages.error', $data)->setStatusCode($code);
    }
}
