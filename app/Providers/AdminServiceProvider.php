<?php

namespace App\Providers;

use App\Services\PageManager\Facades\PageManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //region Components
        Blade::component('admin.components.modal', 'modal');
        Blade::component('admin.components.input', 'input');
        Blade::component('admin.components.zselect', 'zselect');
        Blade::component('admin.components.labelauty', 'labelauty');
        Blade::component('admin.components.file', 'file');
        Blade::component('admin.components.alink', 'alink');
        Blade::component('admin.components.banner_block', 'bannerBlock');
        Blade::component('admin.components.card', 'card');
        Blade::component('admin.components.seo', 'seo');
        //endregion
        //region Directives
        Blade::directive('css', function ($expression) {
            return "<?php echo newCss($expression) ?>";
        });
        Blade::directive('js', function ($expression) {
            return "<?php echo newJs($expression) ?>";
        });
        //endregion
        //region Includes
        Blade::include('admin.includes.ckeditor', 'ckeditor');
        //endregion
        //region Validator rules
        Validator::extend('is_url', function ($attribute, $value, $parameters, $validator) {
            return to_url($value, false) == $value;
        });
        Validator::extend('not_in_routes', function ($attribute, $value, $parameters, $validator) {
            return !PageManager::inUsedRoutes($value);
        });
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\+?([0-9][- ]*){8,}$/', $value);
        });
        Validator::extend('mail', function ($attribute, $value, $parameters, $validator) {
            return is_email($value);
        });
        //endregion
    }
}
