<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Services\Sync\Sync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends BaseController
{
    public function main(){
        $data = [
            'title' => 'Панель администратора',
            'user' => Auth::user(),
            'roles' => Admin::ROLES,
        ];
        return view('admin.pages.general.main', $data);
    }

    public function soapTest(){
        $goods = Sync::get_goods();
        if ($goods['success']) {
            echo $goods->good[0]['UID'];
        }
        else echo '<p style="color:red">'.$goods['error'].'</p>';
        die;
    }
}
