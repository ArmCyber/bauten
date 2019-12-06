<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Analog extends Model
{
    use Sortable;

    public $timestamps = false;
    protected $sortableDesc = false;

    public function part(){
        return $this->belongsTo('App\Models\Part');
    }

    public static function deleteItem($model){
        return $model->delete();
    }
}
