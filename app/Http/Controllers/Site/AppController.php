<?php

namespace App\Http\Controllers\Site;

use App\Models\Country;
use App\Models\HomeSlide;
use App\Models\PartCatalog;
use App\Models\Term;
use App\Services\PageManager\StaticPages;
use Illuminate\Http\Request;
use Zakhayko\Banners\Models\Banner;

class AppController extends BaseController
{
    use StaticPages;

    private function static_home($page) {
        $data = ['active_page'=>$page->id];
        $data['logged_in'] = request()->has('logged_in');
        $data['banners'] = Banner::get('home');
        $data['home_slider'] = HomeSlide::siteList();
        return view('site.pages.home', $data);
    }

    private function static_terms($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['items'] = Term::siteList();
        return view('site.pages.terms', $data);
    }

    private function static_contacts($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
//        $data['items'] = Term::siteList();
        return view('site.pages.contacts', $data);
    }

    private function static_about($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
//        $data['items'] = Term::siteList();
        return view('site.pages.about', $data);
    }

    private function static_marks($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
//        $data['items'] = Term::siteList();
        return view('site.pages.marks', $data);
    }

    private function static_brands($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
//        $data['items'] = Term::siteList();
        return view('site.pages.brands', $data);
    }

    private function static_news($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
//        $data['items'] = Term::siteList();
        return view('site.pages.news', $data);
    }

    //Temporary
    public function register(){
        $data = [];
        $data['countries'] = Country::siteList();
        $data['regions'] = Country::jsonForRegions($data['countries']);
        return view('site.temp.register', $data);
    }
}
