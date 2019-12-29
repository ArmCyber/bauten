<?php

namespace App\Http\Controllers\Site;

use App\Http\Traits\GetFilters;
use App\Models\Filter;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\Part;
use App\Models\PartCatalog;
use Illuminate\Http\Request;

class CatalogueController extends BaseController
{
    use GetFilters;

    public function group($url) {
        $data = [];
        $group = Group::getItemSite($url);
        $data['type'] = 'group';
        $data['group'] = $group;
//        $catalog_ids = $group->catalogs->pluck('id')->toArray();
        $data['filters'] = Filter::siteListForGroup($group->id);
        $data['filtered'] = $this->getFilters();
        $data['currentPaginationPage'] = (int) request()->get('page', 1);
        if ($data['currentPaginationPage']<1) $data['currentPaginationPage'] = 1;
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
//        $data['items'] = Part::catalogsList($catalog_ids, $criteriaGrouped, [$data['filtered']['sort']]);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['catalogue_title'] = $group->name;
        $data['seo'] = $this->staticSEO($data['catalogue_title']);
//        $appends = [
//            'filters' => request()->get('filters'),
//            'sort' => $data['filtered']['sort'],
//            'sort_type' => $data['filtered']['sort_type']=='asc'?0:1,
//        ];
//        $data['items']->appends($appends);
        return view('site.pages.catalogue', $data);
    }

    public function groupAjax($url, Request $request){
        $data = [];
        $group = Group::getItemSite($url);
        $data['type'] = 'group';
        $data['group'] = $group;
        $catalog_ids = $group->catalogs->pluck('id')->toArray();
        $data['filters'] = Filter::siteListForGroup($group->id);
        $data['filtered'] = $this->getFilters();
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
        $data['items'] = Part::catalogsList($catalog_ids, $criteriaGrouped, [$data['filtered']['sort'], $data['filtered']['sort_type']]);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['catalogue_title'] = $group->name;
        $data['view_type'] = $request->get('view_type')=='grid'?'grid':'list';
        session(['view_type' => $data['view_type']]);
        $data['seo'] = $this->staticSEO($data['catalogue_title']);
//        $appends = [
//            'filters' => request()->get('filters'),
//            'sort' => $data['filtered']['sort'],
//            'sort_type' => $data['filtered']['sort_type']=='asc'?0:1,
//        ];
//        $data['items']->appends($appends);
        return view('site.ajax.parts', $data);
    }

    public function category($url) {
        $data = [];
        $catalogue = PartCatalog::getItemSite($url);
        $data['type'] = 'catalogue';
        $data['catalogue'] = $catalogue;
        $data['catalogue_title'] = $catalogue->name;
        $data['filters'] = Filter::siteListForCategory($catalogue->group_id, $catalogue->id);
        $data['filtered'] = $this->getFilters();
//        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
//        $data['items'] = Part::catalogsList([$catalogue->id], $criteriaGrouped, [$data['filtered']['sort']]);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['seo'] = $this->staticSEO($data['catalogue_title']);
        $data['currentPaginationPage'] = (int) request()->get('page', 1);
        if ($data['currentPaginationPage']<1) $data['currentPaginationPage'] = 1;
//        $appends = [
//            'filters' => request()->get('filters'),
//            'sort' => $data['filtered']['sort'],
//            'sort_type' => $data['filtered']['sort_type']=='asc'?0:1,
//        ];
//        $data['items']->appends($appends);
        return view('site.pages.catalogue', $data);
    }

    public function categoryAjax($url, Request $request) {
        $data = [];
        $catalogue = PartCatalog::getItemSite($url);
        $data['type'] = 'catalogue';
        $data['filters'] = Filter::siteListForCategory($catalogue->group_id, $catalogue->id);
        $data['filtered'] = $this->getFilters();
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
        $data['items'] = Part::catalogsList([$catalogue->id], $criteriaGrouped, [$data['filtered']['sort'], $data['filtered']['sort_type']]);
        $data['view_type'] = $request->get('view_type')=='grid'?'grid':'list';
        session(['view_type' => $data['view_type']]);
        return view('site.ajax.parts', $data);
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
        $data['item_analogs'] = $data['item']->analogs;
        $data['seo'] = $this->staticSEO($data['item']->name);
        return view('site.pages.part', $data);
    }
}
