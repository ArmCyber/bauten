<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait GetIncrement {
    public static function getIncrement(){
        $model = new self();
        $database = $model->getConnection()->getDatabaseName();
        $table = $model->getTable();
        return DB::select("SELECT `AUTO_INCREMENT` as `increment` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table'")[0]->increment;
    }
}
