<?php

namespace App\Services\Sync;

use Illuminate\Support\Facades\Facade;

/**
 * @method static get_goods();
*/

class Sync extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Sync\SyncClient';
    }
}
