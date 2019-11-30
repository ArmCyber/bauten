<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PriceApplication extends Model
{
    public static function adminList(){
        return self::filterManager()->sort()->get();
    }

    public function scopeSort($q){
        return $q->orderBy('id', 'desc');
    }

    public static function getItem($id) {
        return self::filterManager()->findOrFail($id);
    }

    public static function getUserItems($id) {
        return self::filterManager()->where('user_id', $id)->sort()->get();
    }

    public static function getCount() {
        return self::filterManager()->count();
    }

    public function scopeFilterManager($q){
        $admin = Auth::guard('cms')->user();
        if ($admin) {
            return $q->whereHas('user', function($q){
                $q->filterManager();
            });
        }
        return $q;
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function part(){
        return $this->belongsTo('App\Models\Part');
    }
}
