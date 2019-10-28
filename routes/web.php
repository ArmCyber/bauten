<?php
use Illuminate\Support\Facades\Route;

//region Admin
//region Login
Route::group(['prefix' => config('admin.prefix'), 'middleware'=>'guest:cms'], function (){
    Route::get('login', 'Admin\AuthController@login')->name('admin.login');
    Route::post('login', 'Admin\AuthController@attemptLogin');
    Route::get('password/reset', 'Admin\AuthController@reset')->name('admin.password.reset');
    Route::post('password/reset', 'Admin\AuthController@attemptReset');
    Route::get('password/recover/{email}/{token}', 'Admin\AuthController@recover')->where(['email'=>'[^\/]+', 'token'=>'[^\/]+'])->name('admin.password.recover');
    Route::post('password/recover/{email}/{token}', 'Admin\AuthController@attemptRecover')->where(['email'=>'[^\/]+', 'token'=>'[^\/]+']);
});
//endregion
Route::group(['prefix' => config('admin.prefix'), 'middleware' => ['auth:cms', 'admin.active']], function () {
    //region CKFinder
    Route::any('file_browser/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
    Route::any('file_browser/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');
    //endregion
    Route::name('admin.')->namespace('Admin')->group(function() {
        //region Logout
        Route::post('logout', 'AuthController@logout')->name('logout');
        //endregion
        //region Home Page Redirect
        Route::get('/', 'AuthController@redirectToHomepage');
        //endregion
        //region Banners
        Route::middleware('can:admin')->match(['get', 'post'], 'banners/{page}', 'BannersController@render')->name('banners');
        //endregion
        //region Main Page
        Route::get('main', 'AppController@main')->name('main');
        //endregion
        //region Profile
        Route::prefix('profile')->name('profile.')->group(function() { $c = 'ProfileController@';
            Route::get('', $c.'main')->name('main');
            Route::patch('', $c.'patch');
        });
        //endregion
        //region Galleries
        Route::prefix('gallery')->group(function(){ $c='GalleriesController@';
            Route::get('{gallery}/{id?}', $c.'show')->name('gallery');
            Route::put('add', $c.'add')->name('gallery.add');
            Route::patch('edit', $c.'edit')->middleware('ajax')->name('gallery.edit');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('gallery.sort');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('gallery.delete');
        });
        //endregion
        //region Pages
        Route::middleware('can:admin')->prefix('pages')->name('pages.')->group(function() { $c='PagesController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'addPage')->name('add');
            Route::put('add', $c.'addPage_put');
            Route::get('edit/{id}', $c.'editPage')->name('edit');
            Route::patch('edit/{id}', $c.'editPage_patch');
            Route::delete('delete', $c.'deletePage_delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Admins
        Route::middleware('can:admin')->prefix('admins')->name('admins.')->group(function() { $c = 'AdminsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region Marks
        Route::middleware('can:admin')->prefix('marks')->name('marks.')->group(function() { $c = 'MarksController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region Models
        Route::middleware('can:admin')->prefix('models')->name('models.')->group(function() { $c = 'ModelsController@';
            Route::get('{id}', $c.'main')->name('main');
            Route::get('add/{id}', $c.'add')->name('add');
            Route::put('add/{id}', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region Generations
        Route::middleware('can:admin')->prefix('generations')->name('generations.')->group(function() { $c = 'GenerationsController@';
            Route::get('{id}', $c.'main')->name('main');
            Route::get('add/{id}', $c.'add')->name('add');
            Route::put('add/{id}', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region Countries
        Route::middleware('can:admin')->prefix('countries')->name('countries.')->group(function() { $c = 'CountriesController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Regions
        Route::middleware('can:admin')->prefix('regions')->name('regions.')->group(function() { $c = 'RegionsController@';
            Route::get('{id}', $c.'main')->name('main');
            Route::get('add/{id}', $c.'add')->name('add');
            Route::put('add/{id}', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Parts
        Route::middleware('can:admin')->prefix('parts')->name('parts.')->group(function() { $c = 'PartsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::get('filters/{id}', $c.'filters')->name('filters');
            Route::patch('filters/{id}', $c.'filters_patch')->name('filters');
            Route::get('engine-filters/{id}', $c.'engineFilters')->name('engine_filters');
            Route::patch('engine-filters/{id}', $c.'engineFilters_patch')->name('engine_filters');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region Parts
        Route::middleware('can:admin')->prefix('brands')->name('brands.')->group(function() { $c = 'BrandsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Part Catalogs
        Route::middleware('can:admin')->prefix('part-catalogs')->name('part_catalogs.')->group(function() { $c = 'PartCatalogsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region Home Slider
        Route::middleware('can:admin')->prefix('home-slider')->name('home_slider.')->group(function() { $c = 'HomeSliderController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Filters
        Route::middleware('can:admin')->prefix('filters')->name('filters.')->group(function() { $c = 'FiltersController@';
            Route::get('{id?}', $c.'main')->name('main');
            Route::get('add/{id?}', $c.'add')->name('add');
            Route::put('add/{id?}', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Filter Criteria
        Route::middleware('can:admin')->prefix('criteria')->name('criteria.')->group(function() { $c = 'CriteriaController@';
            Route::get('{id}', $c.'main')->name('main');
            Route::get('add/{id}', $c.'add')->name('add');
            Route::put('add/{id}', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Terms
        Route::middleware('can:admin')->prefix('terms')->name('terms.')->group(function() { $c = 'TermsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region News
        Route::middleware('can:admin')->prefix('news')->name('news.')->group(function() { $c = 'NewsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region News
        Route::middleware('can:admin')->prefix('groups')->name('groups.')->group(function() { $c = 'GroupsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Partner Groups
        Route::middleware('can:admin')->prefix('partner-groups')->name('partner_groups.')->group(function() { $c = 'PartnerGroupsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->name('delete');
        });
        //endregion
        //region Engine Filters
        Route::middleware('can:admin')->prefix('engine-filters')->name('engine_filters.')->group(function() { $c = 'EngineFiltersController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Filter Criteria
        Route::middleware('can:admin')->prefix('engine-criteria')->name('engine_criteria.')->group(function() { $c = 'EngineCriteriaController@';
            Route::get('{id}', $c.'main')->name('main');
            Route::get('add/{id}', $c.'add')->name('add');
            Route::put('add/{id}', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion
        //region Users
        Route::middleware('can:admin')->prefix('users')->name('users.')->group(function() { $c = 'UsersController@';
            Route::get('', $c.'main')->name('main');
            Route::get('view/{id}', $c.'view')->name('view');
            Route::patch('change-manager', $c.'changeManager')->name('change_manager');
            Route::patch('change-partner-group', $c.'changePartnerGroup')->name('change_partner_group');
            Route::patch('change-status', $c.'changeStatus')->name('change_status');
            Route::patch('change-password', $c.'changePassword')->name('change_password');
            Route::delete('delete', $c.'delete')->name('delete');
        });
        //endregion
        //region Import
        Route::match(['get','post'], 'import/{page}', 'ImportController@render')->name('import');
        //endregion
    });
});
//endregion

//region Site
Route::namespace('Site')->group(function() {
    Route::middleware('auth')->group(function(){
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('product/{url}', 'PartsController@show')->name('part');
        Route::get(r('catalogs').'/{url}', 'CatalogueController@group')->name('group');
        Route::get('category/{url}', 'CatalogueController@category')->name('catalogue');

        Route::get('get-search-data', 'SearchController@getSearchData')->middleware('ajax')->name('search.get_data');
        Route::post('get-filter-data', 'CatalogueController@getFilterData')->middleware('ajax')->name('filter.get_data');

        Route::prefix('cabinet')->namespace('Cabinet')->name('cabinet.')->group(function(){
            Route::get('', 'MainController@main')->name('main');
            Route::get('profile', 'ProfileController@main')->name('profile');
            Route::get('profile/settings', 'ProfileController@settings')->name('profile.settings');
            Route::post('profile/settings', 'ProfileController@settings_post');
            Route::get('profile/change-password', 'ProfileController@changePassword')->name('profile.change_password');
            Route::post('profile/change-password', 'ProfileController@changePassword_post');
            Route::get('profile/change-email', 'ProfileController@changeEmail')->name('profile.change_email');
            Route::post('profile/change-email', 'ProfileController@changeEmail_post');
            Route::get('profile/change-email/cancel', 'ProfileController@cancelChangeEmail')->name('profile.change_email.cancel');
        });
    });
    Route::get('profile/change-email/{token}', 'Cabinet\ProfileController@verifyNewEmail')->name('profile.verify_new_email');
    //region Auth
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('verify/{email}/{token}', 'Auth\RegisterController@verify')->name('verification');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{email}/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset/{email}/{token}', 'Auth\ResetPasswordController@reset');
    //endregion

    Route::post(r('contacts').'/send-message', 'InnerController@sendContactsMessage')->name('contacts.send_message');
    Route::get(r('news').'/{url}', 'InnerController@news_item')->name('news');
    Route::get(r('brands').'/{url}', 'InnerController@brand_item')->name('brand');
    Route::get('{url?}', 'AppController@pageManager')->name('page');
});
//endregion
