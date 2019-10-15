<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class BaseController extends Controller
{
    protected $shared;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->view_share();
            return $next($request);
        });
    }

    public function view_share(){
        if ($this->shared) return false;
        $this->shared = [];
        $this->shared['pending_users_count'] = User::getPendingUsersCount();
        view()->share($this->shared);
        return true;
    }
}
