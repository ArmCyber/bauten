<?php

namespace App\Http\Controllers\Site;

use App\Models\Gallery;
use App\Models\Part;
use Illuminate\Http\Request;

class PartsController extends BaseController
{
    public function show($url) {
        $data = [];
        $data['item'] = Part::getItemSite($url);
        $data['item_filters'] = $data['item']->criteria->sortBy('sort')->sortBy('filter_id')->sortBy(function ($item){
            return $item->filter->sort;
        })->groupBy('filter_id');
        $data['gallery'] = Gallery::get('parts', $data['item']->id);
        $data['page_title'] = get_page('catalogs')->title;
        return view('site.pages.part', $data);
    }
}
