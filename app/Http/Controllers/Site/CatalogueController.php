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
        return view('site.pages.catalogue', $data);
    }
}
