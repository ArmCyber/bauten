<?php

namespace App\Http\Controllers\Site;

use App\Models\Admin;
use App\Models\Basket;
use App\Models\Group;
use App\Models\Page;
use App\Models\PartCatalog;
use App\Services\PageManager\Facades\PageManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Zakhayko\Banners\Models\Banner;

class BaseController extends Controller
{
    protected $shared;

    public function __construct()
    {
        $this->middleware('user_logged_in');
        $this->middleware(function($request, $next){
            $this->view_share();
            return $next($request);
        });
    }

    public function view_share(){
        if ($this->shared) return false;
        $this->shared = [];
        $this->shared['info'] = Banner::get('info');
        $this->shared['email'] = $this->shared['info']->data->email;
        $this->shared['default_images'] = Banner::get('images');
        $this->shared['requisites'] = $this->shared['info']->requisites->flip();
//        $this->shared['catalogs'] = PartCatalog::siteList();
        $this->shared['groups'] = Group::siteList();
        $this->shared['homepage'] = get_page(PageManager::getHomePage());
        $this->shared['menu'] = Page::getMenu();
        $this->shared['footer_pages'] = Page::footerList();
        $this->shared['home_catalogs'] = PartCatalog::homeList();
        $this->shared['user'] = Auth::user();
        $this->shared['suffix'] = $this->shared['info']->data->seo_suffix;
        if ($this->shared['user']){
            $this->shared['user_manager'] = $this->shared['user']->manager?:Admin::getSeniorManager();
            $this->shared['basket_parts'] = Basket::getUserParts();
            $this->shared['basket_part_ids'] = $this->shared['basket_parts']->pluck('part_id');
            $this->shared['favourite_ids'] = $this->shared['user']->favourites->pluck('id')->toArray();
        }
        view()->share($this->shared);
        return true;
    }

    protected function renderSEO($item, $title_field='title') {
        $seo = [
            'title' => $item->seo_title,
            'keywords' => $item->seo_keywords,
            'description' => $item->seo_description,
        ];
        if (!$seo['title']) {
            $title = $item->{$title_field};
            if ($this->shared['suffix']) {
                if ($title) $title.= ' - ';
                $title.=$this->shared['suffix'];
            }
            $seo['title'] = $title;
        }
        return $seo;
    }

    protected function staticSEO($title){
        $seo = ['title' => $title];
        if ($this->shared['suffix']) {
            if ($seo['title']) $seo['title'] .= ' - ';
            $seo['title'].= $this->shared['suffix'];
        }
        return $seo;
    }
}
