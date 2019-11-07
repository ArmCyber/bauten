<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Part;
use Illuminate\Http\Request;

class FavouritesController extends BaseController
{
    public function main(){
        $data = [
            'seo' => $this->staticSEO('Сохраненные товары'),
        ];
        return view('site.pages.cabinet.favourites', $data);
    }

    public function add(Request $request) {
        $id = $request->input('itemId');
        if (!is_id($id) || !($item = Part::getActiveItem($id))) abort(404);
        $is_favourite = in_array($id, $this->shared['favourite_ids']);
        if ($request->input('action')=='delete'){
            if ($is_favourite) $this->shared['user']->favourites()->detach($id);
        }
        else {
            if (!$is_favourite) $this->shared['user']->favourites()->attach($id);
        }
        return response('1');
    }
}
