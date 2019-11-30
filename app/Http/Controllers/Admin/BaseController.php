<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Order;
use App\Models\PriceApplication;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::check('admin')) {
            $this->shared['pending_users_count'] = User::getPendingUsersCount();
        }
        else $this->shared['pending_users_count'] = 0;
        if (Gate::check('operator_manager')) {
            $this->shared['new_orders_count'] = Order::getCount(Order::STATUS_NEW);
            $this->shared['pending_orders_count'] = Order::getCount(Order::STATUS_PENDING);
            $this->shared['declined_orders_count'] = Order::getCount(Order::STATUS_DECLINED);
            $this->shared['applications_count'] = Application::getCount();
            $this->shared['price_applications_count'] = PriceApplication::getCount();
        }
        else {
            $this->shared['new_orders_count'] = 0;
            $this->shared['pending_orders_count'] = 0;
            $this->shared['declined_orders_count'] = 0;
            $this->shared['applications_count'] = 0;
            $this->shared['price_applications_count'] = 0;
        }
        view()->share($this->shared);
        return true;
    }
}
