<?php

namespace App\Http\Controllers\Site;

use App\Http\Traits\GetFilters;
use App\Models\Filter;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\Part;
use App\Models\PartCatalog;

class CatalogueController extends BaseController
{
    use GetFilters;

    public function group($url) {
        $data = [];
        $group = Group::getItemSite($url);
        $catalog_ids = $group->catalogs->pluck('id')->toArray();
        $data['filters'] = Filter::siteListForGroup($group->id);
        $data['filtered'] = $this->getFilters();
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
        $data['items'] = Part::catalogsList($catalog_ids, $criteriaGrouped, [$data['filtered']['sort']]);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['catalogue_title'] = $group->name;
        $data['seo'] = $this->staticSEO($data['catalogue_title']);
        $appends = [
            'filters' => request()->get('filters'),
            'sort' => $data['filtered']['sort'],
//            'sort_type' => $data['filtered']['sort_type']=='asc'?0:1,
        ];
        $data['items']->appends($appends);
        return view('site.pages.catalogue', $data);
    }

    public function category($url) {
        $data = [];
        $catalogue = PartCatalog::getItemSite($url);
        $data['catalogue_title'] = $catalogue->name;
        $data['filters'] = Filter::siteListForCategory($catalogue->group_id, $catalogue->id);
        $data['filtered'] = $this->getFilters();
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
        $data['items'] = Part::catalogsList([$catalogue->id], $criteriaGrouped, [$data['filtered']['sort']]);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['seo'] = $this->staticSEO($data['catalogue_title']);
        $appends = [
            'filters' => request()->get('filters'),
            'sort' => $data['filtered']['sort'],
//            'sort_type' => $data['filtered']['sort_type']=='asc'?0:1,
        ];
        $data['items']->appends($appends);
        return view('site.pages.catalogue', $data);
    }

    public function showPart($url) {
        $data = [];
        $data['item'] = Part::getItemSite($url);
        $data['item_filters'] = $data['item']->criteria->sortBy('sort')->sortBy('filter_id')->sortBy(function ($item){
            return $item->filter->sort;
        })->groupBy('filter_id');
//        $data['item_engine_filters'] = ->groupBy('engine_filter_id');
        $data['item_engines'] = $data['item']->engines;
        $data['gallery'] = Gallery::get('parts', $data['item']->id);
        $data['page_title'] = get_page('catalogs')->title;
        $data['attached_parts'] = $data['item']->attached_parts_site;
        $data['seo'] = $this->staticSEO($data['item']->name);
        return view('site.pages.part', $data);
    }
}
