<?php

namespace App\Http\Controllers\Site;

use App\Models\PartCatalog;
use Illuminate\Http\Request;

class CatalogueController extends BaseController
{
    public function show($url) {
        $data = [];
        $data['catalogue'] = PartCatalog::getItemSite($url);
        $data['items'] = $data['catalogue']->parts;
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        return view('site.pages.catalogue', $data);
    }
}
