<?php

namespace App\Http\Controllers\Site;

use App\Models\Page;
use App\Models\PartCatalog;
use App\Services\PageManager\Facades\PageManager;
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
        $this->shared['catalogs'] = PartCatalog::siteList();
        $this->shared['homepage'] = get_page(PageManager::getHomePage());
        $this->shared['menu'] = Page::getMenu();
        $this->shared['footer_pages'] = Page::footerList();
        $this->shared['home_catalogs'] = PartCatalog::homeList();
        view()->share($this->shared);
        return true;
    }
}
