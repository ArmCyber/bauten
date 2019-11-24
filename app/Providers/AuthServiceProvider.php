<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->role >= config('roles.admin')) return true;
        });

        Gate::define('operator_manager', function($user){
            return in_array($user->role, [config('roles.operator'), config('roles.manager'), config('roles.senior_manager')]);
        });

        Gate::define('operator', function ($user) {
            return $user->role == config('roles.operator');
        });

        Gate::define('content', function ($user) {
            return $user->role == config('roles.content');
        });

        Gate::define('manager', function ($user) {
            return in_array($user->role, [config('roles.manager'), config('roles.senior_manager')]);
        });

        Gate::define('admin', function ($user) {
            return false;
        });
    }
}
