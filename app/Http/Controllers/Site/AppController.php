<?php

namespace App\Http\Controllers\Site;

use App\Models\Brand;
use App\Models\EngineCriterion;
use App\Models\Gallery;
use App\Models\HomeSlide;
use App\Models\Mark;
use App\Models\News;
use App\Models\Term;
use App\Services\PageManager\StaticPages;
use Zakhayko\Banners\Models\Banner;

class AppController extends BaseController
{
    use StaticPages;

    private function static_home($page) {
        $data = ['active_page'=>$page->id];
        $data['banners'] = Banner::get('home');
        $data['home_slider'] = HomeSlide::siteList();
        $data['news'] = News::homeList();
        $data['marks'] = Mark::homeList();
        $data['brands'] = Brand::homeList();
        $data['seo'] = $this->renderSEO($page);
        if($this->shared['user']) {
            $data['search_brands'] = Brand::searchList();
            $data['search_marks'] = Mark::searchList();
            $data['engine_criteria'] = EngineCriterion::searchList();
            $data['recommended_parts'] = $this->shared['user']->recommended_parts_site;
        }
        else $data['skip_inner_css'] = true;
        return view('site.pages.home', $data);
    }

    private function static_terms($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['items'] = Term::siteList();
        $data['seo'] = $this->renderSEO($page);
        $data['gallery'] = Gallery::get('terms');
        return view('site.pages.terms', $data);
    }

    private function static_contacts($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['banners'] = Banner::get('contacts');
        $data['seo'] = $this->renderSEO($page);
        $data['gallery'] = Gallery::get('contacts');
        return view('site.pages.contacts', $data);
    }

    private function static_marks($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['items'] = Mark::siteList();
        $data['seo'] = $this->renderSEO($page);
        $data['gallery'] = Gallery::get('marks');
        return view('site.pages.marks', $data);
    }

    private function static_brands($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['items'] = Brand::siteList();
        $data['seo'] = $this->renderSEO($page);
        $data['gallery'] = Gallery::get('brands');
        return view('site.pages.brands', $data);
    }

    private function static_news($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['items'] = News::siteList();
        $data['seo'] = $this->renderSEO($page);
        $data['gallery'] = Gallery::get('news');
        return view('site.pages.news', $data);
    }

    private function dynamic_page($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['page'] = $page;
        $data['seo'] = $this->renderSEO($page);
        $data['gallery'] = Gallery::get('pages', $page->id);
        return view('site.pages.dynamic_page', $data);
    }

}
