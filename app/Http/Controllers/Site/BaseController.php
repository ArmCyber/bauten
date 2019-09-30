<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zakhayko\Banners\Models\Banner;

class BaseController extends Controller
{
    protected $shared;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->view_share();
            return $next($request);
        });
    }

    public function view_share(){
        if ($this->shared) return false;
        $this->shared['info'] = Banner::get('info');
        $this->shared['requisites'] = $this->shared['info']->requisites->flip();
        view()->share($this->shared);
        return true;
    }
}
