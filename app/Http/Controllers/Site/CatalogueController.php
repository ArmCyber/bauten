<?php

namespace App\Http\Controllers\Site;

use App\Models\Group;
use App\Models\PartCatalog;
use Illuminate\Http\Request;

class CatalogueController extends BaseController
{
    public function group($url) {
        $data = [];
        $group = Group::getItemSite($url);
        $catalog_ids = $group->catalogs->pluck('id')->toArray();
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['catalogue_title'] = $group->name;
        return view('site.pages.catalogue', $data);
    }

    public function category($url) {
        $data = [];
        $catalogue = PartCatalog::getItemSite($url);
        $data['catalogue_title'] = $catalogue->name;
        $data['items'] = $catalogue->parts;
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        return view('site.pages.catalogue', $data);
    }
}
