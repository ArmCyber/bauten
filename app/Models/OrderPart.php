<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPart extends Model
{
    public $timestamps = false;
    protected $table = 'order_part';

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function part(){
        return $this->belongsTo('App\Models\Part');
    }
}
