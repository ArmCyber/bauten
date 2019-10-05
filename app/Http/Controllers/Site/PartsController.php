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
        $data['gallery'] = Gallery::get('parts', $data['item']->id);
        $data['page_title'] = get_page('catalogs')->title;
        return view('site.pages.part', $data);
    }
}
