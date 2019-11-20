<?php

namespace App\Http\Controllers\Site;

use App\Models\Brand;
use App\Models\Engine;
use App\Models\Generation;
use App\Models\Model;
use App\Models\PartCatalog;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    public function getSearchData(Request $request) {
        $type = $request->get('type');
        $key = $request->get('key');
        if (!$key || !is_id($key)) abort(404);
        switch($type) {
            case 'mark': return $this->searchDataModels($key);
            case 'model': return $this->searchDataGenerations($key);
            default: abort(404);
        }
        return null;
    }

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
}
