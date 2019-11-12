<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\PartnerGroup;
use Illuminate\Http\Request;

class MainController extends BaseController
{
    public function main(){
        $data = [];
        if (!$this->shared['user']->individual_sale) {
            $data['partner_group'] = $this->shared['user']->partner_group;
            $data['next_partner_group'] = PartnerGroup::getNextStatus($data['partner_group']);
        }
        $data['seo'] = $this->staticSEO('Личный кабинет');
        return view('site.pages.cabinet.main', $data);
    }
}
