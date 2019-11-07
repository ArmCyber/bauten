<?php

namespace App\Http\Controllers\Site;

use App\Models\Generation;
use App\Models\Model;
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
}
