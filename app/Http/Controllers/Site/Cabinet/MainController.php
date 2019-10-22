<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\PartnerGroup;
use Illuminate\Http\Request;

class MainController extends BaseController
{
    public function main(){
        $data = [];
        $data['partner_group'] = $this->shared['user']->partner_group;
        $data['next_partner_group'] = PartnerGroup::getNextStatus($data['partner_group']);
        return view('site.pages.cabinet.main', $data);
    }
}
