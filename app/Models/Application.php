<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public static function adminList(){
        return self::sort()->get();
    }

    public function scopeSort($q){
        return $q->orderBy('id', 'desc');
    }

    public static function getItem($id) {
        return self::findOrFail($id);
    }

    public static function getUserItems($id) {
        return self::where('user_id', $id)->sort()->get();
    }

    public static function getCount() {
        return self::count();
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function part(){
        return $this->belongsTo('App\Models\Part');
    }
}
