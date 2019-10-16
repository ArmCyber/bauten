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
            Route::get('import', $c.'import')->name('import');
            Route::post('import', $c.'import_post');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
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
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
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
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
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
        //region Years
        Route::middleware('can:admin')->prefix('years')->name('years.')->group(function() { $c = 'YearsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
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
            Route::patch('change-status', $c.'changeStatus')->name('change_status');
//            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
    });
});
//endregion

Route::middleware('auth')->group(function(){
    Route::get('cabinet', function(){
        return response('HELLO WORLD');
    });
    Route::get('logout', function(){
        \Illuminate\Support\Facades\Auth::logout();
        return redirect(url()->current());
    });
});

//region Auth
Route::get('login', 'Site\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Site\Auth\LoginController@login');
Route::get('register', 'Site\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Site\Auth\RegisterController@register');
Route::get('verify/{email}/{token}', 'Site\Auth\RegisterController@verify')->name('verification');
//endRegion

Route::post(r('contacts').'/send-message', 'Site\InnerController@sendContactsMessage')->name('contacts.send_message');

Route::get('product/{url}', 'Site\PartsController@show')->name('part');
Route::get(r('news').'/{url}', 'Site\InnerController@news_item')->name('news');
Route::get(r('catalogs').'/{url}', 'Site\CatalogueController@group')->name('group');
Route::get('category/{url}', 'Site\CatalogueController@category')->name('catalogue');
Route::get('{url?}', 'Site\AppController@pageManager')->name('page');
