<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Администраторы'];

        return view();
    }
}
