<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function main(){
        $data = [
            'title' => 'Панель администратора'
        ];
        return view('admin.pages.main', $data);
    }
}
