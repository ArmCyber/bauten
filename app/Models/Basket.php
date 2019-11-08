<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'basket';
    public $timestamps = false;

    protected $casts = [
        'part_id' => 'integer',
    ];

    public static function getPart($part_id){
        $user_id = auth()->user()->id;
        $result = self::where(['part_id'=>$part_id, 'user_id'=>$user_id])->first();
        if ($result) return $result;
        $model = new self;
        $model['part_id'] = $part_id;
        $model['user_id'] = $user_id;
        $model['count'] = 0;
        return $model;
    }

    public static function getUserParts(){
        return self::where('user_id', auth()->user()->id)->with('part')->get();
    }

    public static function getPartsForUser($id){
        return self::where('user_id', $id)->with('part')->get();
    }

    public static function clear(){
        return self::where('user_id', auth()->user()->id)->delete();
    }

    public function part(){
        return $this->belongsTo('App\Models\Part');
    }
}
