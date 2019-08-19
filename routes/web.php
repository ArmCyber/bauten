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
    Route::any('file-browser/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
    Route::any('file-browser/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');
    //endregion
    Route::name('admin.')->namespace('Admin')->group(function() {
        //region Logout
        Route::post('logout', 'AuthController@logout')->name('logout');
        //endregion
        //region Home Page Redirect
        Route::get('/', 'AuthController@redirectToHomepage');
        //endregion
        //region Dashboard
        Route::get('main', 'AppController@main')->name('main');
        //endregion
        //region Profile
        Route::prefix('profile')->name('profile.')->group(function() { $c = 'ProfileController@';
            Route::get('', $c.'main')->name('main');
            Route::patch('', $c.'patch');
        });
        //endregion
        //region Pages
        Route::middleware('can:manager')->prefix('pages')->name('pages.')->group(function() { $c='PagesController@';
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
            Route::delete('delete', $c.'delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
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
    });
});
//endregion

//region Temporary
Route::get('catalogue', 'Site\AppController@catalogue');
//endregion

Route::get('{url?}', 'Site\AppController@pageManager')->name('page');
