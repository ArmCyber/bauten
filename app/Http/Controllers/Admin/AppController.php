<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
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
        return view('admin.pages.main', $data);
    }
}
