<?php

namespace App\Http\Controllers\Site;

use App\Http\Traits\GetFilters;
use App\Models\Brand;
use App\Models\Engine;
use App\Models\Filter;
use App\Models\Generation;
use App\Models\Mark;
use App\Models\Model;
use App\Models\Part;
use App\Models\PartCatalog;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    use GetFilters;

    public function searchDataModels($mark_id){
        $data = [];
        $data['items'] = Model::getSearchData($mark_id);
        if (!count($data['items'])) return response('');
        return view('site.ajax.search_models', $data);
    }

    public function searchDataGenerations($model_id){
        $data = [];
        $data['items'] = Generation::getSearchData($model_id);
        if (!count($data['items'])) return response('');
        return view('site.ajax.search_generations', $data);
    }

    public function getDisabledBrands(Request $request) {
        $id = $request->input('catalogueId');
        if (!$id || !PartCatalog::where('id', $id)->count()) abort(404);
        $brands = Brand::whereDoesntHave('parts', function ($q) use ($id){
            $q->where('part_catalog_id', $id);
        })->pluck('id');
        return response()->json(['items'=>$brands]);
    }

    public function getEngines(Request $request){
        $query = $request->get('q');
        if (!$query || mb_strlen($query)<3) return response()->json([]);
        $result = Engine::select('id', 'name')->where('name', 'like', '%'.escape_like($query).'%')->get()->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        })->toArray();
        return response()->json(['results'=>$result]);
    }

    public function getModels(Request $request) {
        $markIds = $request->get('marks');
        if (!$markIds || !is_array($markIds)) return response('');
        $items = Model::getSearchData($markIds);
        if (!count($items)) return response('');
        return response()->view('site.ajax.search_data', [
            'items' => $items,
            'class' => 'home-search-model'
        ]);
    }
    public function getGenerations(Request $request) {
        $modelIds = $request->get('models');
        if (!$modelIds || !is_array($modelIds)) return response('');
        $items = Model::getSearchData($modelIds);
        if (!count($items)) return response('');
        return response()->view('site.ajax.search_data', [
            'items' => $items,
            'class' => 'home-search-generation'
        ]);
    }

    public function search(Request $request){
        $names = [];
        $appends = [];
        $catalogue = $request->get('ca');
        $brandsString = $request->get('br');
        $marksString = $request->get('ma');
        $modelsString = $request->get('mo');
        $generationsString = $request->get('ge');
        $enginesString = $request->get('en');
        $query = Part::where('active', 1)->brandAllowed();
        if ($catalogue && is_id($catalogue)) {
            $get_catalogue = PartCatalog::select('id', 'name')->where('id', $catalogue)->first();
            if ($get_catalogue) {
                $appends['ca'] = $get_catalogue->id;
                $names['catalogue'] = $get_catalogue->name;
                $query->where('part_catalog_id', $catalogue);
            }
        }
        if ($brandsString) {
            $brandsUnfiltered = explode('-', $brandsString);
            $get_brands = Brand::select('name', 'id')->where('active', 1)->whereIn('id', $brandsUnfiltered)->allowed()->sort()->limit(5)->get();
            if (count($get_brands)) {
                $brand_ids =$get_brands->pluck('id')->toArray();
                $appends['br'] = implode('-', $brand_ids);
                $names['brands'] = $get_brands->pluck('name')->toArray();
                $query->whereIn('brand_id', $brand_ids);
            }
        }
        if ($marksString) {
            $marksUnfiltered = explode('-', $marksString);
            $get_marks = Mark::select('name', 'id')->where('active', 1)->whereIn('id', $marksUnfiltered)->sort()->limit(5)->get();
            if (count($get_marks)) {
                $names['marks'] = $get_marks->pluck('name')->toArray();
                $mark_ids = $get_marks->pluck('id')->toArray();
                $appends['ma'] = implode('-', $mark_ids);
                $query->whereHas('marks', function($q) use($mark_ids){
                    $q->whereIn('marks.id', $mark_ids);
                });
                $using_marks = true;
            }
        }
        if (isset($mark_ids) && $modelsString) {
            $modelsUnfiltered = explode('-', $modelsString);
            $get_models = Model::select('name', 'id')->where('active', 1)->whereIn('id', $modelsUnfiltered)->whereIn('mark_id', $mark_ids)->sort()->limit(5)->get();
            if (count($get_models)) {
                $names['models'] = $get_models->pluck('name')->toArray();
                $model_ids = $get_models->pluck('id')->toArray();
                $appends['mo'] = implode('-', $model_ids);
                $query->whereHas('models', function($q) use($model_ids){
                    $q->whereIn('models.id', $model_ids);
                });
            }
        }
        if (isset($model_ids) && $generationsString) {
            $generationsUnfiltered = explode('-', $generationsString);
            $get_generations = Generation::select('name', 'id')->where('active', 1)->whereIn('id', $generationsUnfiltered)->whereIn('model_id', $model_ids)->sort()->limit(5)->get();
            if (count($get_generations)) {
                $names['generations'] = $get_generations->pluck('name')->toArray();
                $generation_ids = $get_generations->pluck('id')->toArray();
                $appends['ge'] = implode('-', $generation_ids);
                $query->whereIn('generations.id', $generation_ids);
            }
        }
        if ($enginesString) {
            $enginesUnfiltered = explode('-', $enginesString);
            $get_engines = Engine::select('name', 'id')->whereIn('id', $enginesUnfiltered)->sort()->limit(5)->get();
            if (count($get_engines)) {
                $names['engines'] = $get_engines->pluck('name')->toArray();
                $engine_ids = $get_engines->pluck('id')->toArray();
                $appends['en'] = implode('-', $engine_ids);
                $query->whereHas('engines', function($q) use ($engine_ids){
                    $q->where('engines.id', $engine_ids);
                });
            }
        }
        if (!count($names)) return redirect()->route('page');
        $data = [
            'names' => $names,
            'seo' => self::staticSEO('Результаты поиска'),
            'appends' => $appends,
        ];
        $ids = (clone $query)->pluck('id')->toArray();
        $data['filters'] = Filter::siteListForIds($ids);
        $data['filtered'] = $this->getFilters();
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
        $data['items'] = $query->filtered($criteriaGrouped)->sort([$data['filtered']['sort']])->paginate(settings('pagination'));
        $appends['filters'] = $request->get('filters');
        $appends['sort'] = $data['filtered']['sort'];
//        $appends['sort_type'] = $data['filtered']['sort_type']=='asc'?0:1;
        $data['items']->appends($appends);
        return view('site.pages.search', $data);
    }
}
