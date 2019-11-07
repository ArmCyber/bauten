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
        $criteriaInput = $request->get('filters');
        $criteriaArray = $criteriaInput?explode('_', $criteriaInput):[];
        $criteria = [];
        foreach($criteriaArray as $criterion) if (is_id($criterion)) $criteria[] = $criterion;
        $sort = $request->get('sort');
        switch($sort) {
            default: $sort = 'price';
        }
        $sort_type = $request->get('sort_type', '0')?'desc':'asc';
        return [
            'criteria' => $criteria,
            'sort' => $sort,
            'sort_type' => $sort_type,
        ];
    }

    private function filterCriteria($filters, $criteria) {
        $result = [];
        if (count($criteria)) {
            $allCriteria = $filters->pluck('criteria')->flatten();
            foreach ($criteria as $criterion) {
                $this_criteria = $allCriteria->where('id', $criterion)->first();
                if ($this_criteria) $result[$this_criteria->filter_id][] = $this_criteria->id;
            }
        }
        return $result;
    }

    public function group($url) {
        $data = [];
        $group = Group::getItemSite($url);
        $catalog_ids = $group->catalogs->pluck('id')->toArray();
        $data['filters'] = Filter::siteListForGroup($group->id);
        $data['filtered'] = $this->getFilters();
        $data['items'] = Part::catalogsList($catalog_ids);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['catalogue_title'] = $group->name;
        $data['seo'] = $this->staticSEO($data['catalogue_title']);
        return view('site.pages.catalogue', $data);
    }

    public function category($url) {
        $data = [];
        $catalogue = PartCatalog::getItemSite($url);
        $data['catalogue_title'] = $catalogue->name;
        $data['filters'] = Filter::siteListForCategory($catalogue->group_id, $catalogue->id);
        $data['filtered'] = $this->getFilters();
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
        $data['items'] = Part::catalogsList([$catalogue->id], $criteriaGrouped, [$data['filtered']['sort'], $data['filtered']['sort_type']]);
        $page = get_page('catalogs');
        $data['active_page'] = $page->id;
        $data['page_title'] = $page->title;
        $data['seo'] = $this->staticSEO($data['catalogue_title']);
        return view('site.pages.catalogue', $data);
    }
}
