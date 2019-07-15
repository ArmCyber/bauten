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
Route::group(['prefix' => config('admin.prefix'), 'middleware' => 'auth:cms'], function () {
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
        //region Dashboard
        Route::get('main', 'BaseController@main')->name('main');
        //endregion
        //region Profile
        Route::prefix('profile')->name('profile.')->group(function() { $c = 'ProfileController@';
            Route::get('', $c.'main')->name('main');
            Route::patch('', $c.'patch');
        });
        //endregion
        //region Pages
        Route::prefix('pages')->name('pages.')->group(function() { $c='PagesController@';
            Route::get('', $c.'main')->name('main');
            Route::get('add', $c.'addPage')->name('add');
            Route::put('add', $c.'addPage_put');
            Route::get('edit/{id}', $c.'editPage')->name('edit');
            Route::patch('edit/{id}', $c.'editPage_patch');
            Route::delete('delete', $c.'deletePage_delete')->middleware('ajax')->name('delete');
            Route::patch('sort', $c.'sort')->middleware('ajax')->name('sort');
        });
        //endregion

    });
});
//endregion

Route::any('file-browser/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
Route::any('file-browser/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');

Route::get('{url?}', 'Site\AppController@pageManager')->name('page');
