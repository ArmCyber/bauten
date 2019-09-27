<?php
return [
    'table_name' => 'banners',
    'cache_prefix' => 'banners',
    'upload_dir' => 'u/banners/',
    'controller_class' => App\Http\Controllers\Admin\BannersController::class,
    'ignore_exceptions_if_empty' => true,
];
