<?php
use Illuminate\Support\Facades\Route;


Route::get('soap-test', 'Admin\AppController@soapTest');

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
        Route::get('/', 'AuthController@redirectToHomepage')->name('root');
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
        });
        //endregion
        //region Engines
        Route::middleware('can:admin')->prefix('engines')->name('engines.')->group(function() { $c = 'EnginesController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
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
        //region Delivery Regions
        Route::middleware('can:admin')->prefix('delivery-regions')->name('delivery_regions.')->group(function() { $c = 'DeliveryRegionsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
        });
        //endregion
        //region Delivery Cities
        Route::middleware('can:admin')->prefix('delivery-cities')->name('delivery_cities.')->group(function() { $c = 'DeliveryCitiesController@';
            Route::get('{id}', $c.'main')->name('main');
            Route::get('add/{id}', $c.'add')->name('add');
            Route::put('add/{id}', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
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
            Route::get('attached-parts/{id}', $c.'attachedParts')->name('attached_parts');
            Route::put('attached-parts/add/{id}', $c.'attachedParts_add')->name('attached_parts.add');
            Route::delete('attached-parts/delete/{id}', $c.'attachedParts_delete')->name('attached_parts.delete');
        });
        //endregion
        //region Brands
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
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
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
        //region Groups
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
            Route::get('recommended-parts/{id}', $c.'recommendedParts')->name('recommended_parts');
            Route::put('recommended-parts/add/{id}', $c.'recommendedParts_add')->name('recommended_parts.add');
            Route::delete('recommended-parts/delete/{id}', $c.'recommendedParts_delete')->name('recommended_parts.delete');
            Route::get('favourites/{id}', $c.'favourites')->name('favourites');
            Route::get('basket-parts/{id}', $c.'basketParts')->name('basket_parts');
            Route::get('restricted-brands/{id}', $c.'restrictedBrands')->name('restricted_brands');
            Route::put('restricted-brands/add/{id}', $c.'restrictedBrands_add')->name('restricted_brands.add');
            Route::delete('restricted-brands/delete/{id}', $c.'restrictedBrands_delete')->name('restricted_brands.delete');
        });
        //endregion
        //region Orders
        Route::middleware('can:admin')->prefix('orders')->name('orders.')->group(function() { $c = 'OrdersController@';
            Route::get('new', $c.'newOrders')->name('new');
            Route::get('pending', $c.'pendingOrders')->name('pending');
            Route::get('done', $c.'doneOrders')->name('done');
            Route::get('declined', $c.'declinedOrders')->name('declined');
            Route::get('view/{id}', $c.'view')->name('view');
            Route::delete('delete', $c.'delete')->name('delete');
            Route::patch('respond/{id}', $c.'respond')->name('respond');
            Route::patch('change-process/{id}', $c.'changeProcess')->name('change_process');
            Route::get('user/{id}/{status}', $c.'userOrders')->name('user');
        });
        //endregion
        //region Applications
        Route::middleware('can:admin')->prefix('applications')->name('applications.')->group(function() { $c = 'ApplicationsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('user/{id}', $c.'userApplications')->name('user');
            Route::get('view/{id}', $c.'view')->name('view');
            Route::delete('delete', $c.'delete')->name('delete');
        });
        //endregion
        //region Pickup Points
        Route::middleware('can:admin')->prefix('pickup-points')->name('pickup_points.')->group(function() { $c = 'PickupPointsController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'add')->name('add');
            Route::put('add', $c.'add_put');
            Route::get('edit/{id}', $c.'edit')->name('edit');
            Route::patch('edit/{id}', $c.'edit_patch');
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
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
        Route::get('product/{url}', 'CatalogueController@showPart')->name('part');
        Route::get(r('catalogs').'/{url}', 'CatalogueController@group')->name('group');
        Route::get('category/{url}', 'CatalogueController@category')->name('catalogue');
        Route::get('search', 'SearchController@search')->name('search');
        Route::middleware('ajax')->prefix('ajax')->group(function(){
            Route::get('search/disabled-brands', 'SearchController@getDisabledBrands')->name('search.get_disabled_brands');
            Route::get('search/get-engines', 'SearchController@getEngines')->name('search.get_engines');
            Route::get('search/get-models', 'SearchController@getModels')->name('search.get_models');
            Route::get('search/get-generations', 'SearchController@getGenerations')->name('search.get_generations');
        });

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
            Route::get('basket', 'BasketController@basket')->name('basket');
            Route::post('basket/add', 'BasketController@addToBasket')->name('basket.add');
            Route::post('basket/delete', 'BasketController@deleteFromBasket')->name('basket.delete');
            Route::post('basket/update', 'BasketController@updateItem')->name('basket.update');
            Route::get('favourites', 'FavouritesController@main')->name('favourites');
            Route::post('favourites/add', 'FavouritesController@add')->middleware('ajax')->name('favourites.add');
            Route::get('order', 'OrdersController@order')->name('order');
            Route::post('order', 'OrdersController@order_post');
            Route::post('order/confirm-payment', 'OrdersController@confirmPayment')->name('order.confirm_payment');
            Route::get('orders/done', 'OrdersController@done')->name('orders.done');
            Route::get('orders/pending', 'OrdersController@pending')->name('orders.pending');
            Route::get('orders/{id}', 'OrdersController@view')->name('orders.view');
            Route::post('send-application/{id}', 'MainController@sendApplication')->name('send_application');
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
