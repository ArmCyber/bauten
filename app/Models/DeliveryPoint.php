<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class DeliveryPoint extends Model
{
    use Sortable;

    public static function adminList(){
        return self::with(['region'=>function($q){
            $q->with('country');
        }])->sort()->get();
    }

    public function region(){
        return $this->belongsTo('App\Models\Region');
    }
}
