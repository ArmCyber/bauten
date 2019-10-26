<?php

namespace App\Http\Controllers\Site;

use App\Models\Filter;
use App\Models\Group;
use App\Models\Part;
use App\Models\PartCatalog;
use Illuminate\Http\Request;

class CatalogueController extends BaseController
{
    private function getFilters(){
        $request = request();

    }

    public function group($url) {
        $data = [];
        $group = Group::getItemSite($url);
        $catalog_ids = $group->catalogs->pluck('id')->toArray();
        $filters = $this->getFilters();
        $data['items'] = Part::catalogsList($catalog_ids);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['catalogue_title'] = $group->name;
        $data['filters'] = Filter::siteListForGroup($group->id);
        return view('site.pages.catalogue', $data);
    }

    public function category($url) {
        $data = [];
        $catalogue = PartCatalog::getItemSite($url);
        $data['catalogue_title'] = $catalogue->name;
        $filters = $this->getFilters();
        $data['items'] = Part::catalogsList([$catalogue->id]);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['filters'] = Filter::siteListForCategory($catalogue->group_id, $catalogue->id);
        return view('site.pages.catalogue', $data);
    }
}
