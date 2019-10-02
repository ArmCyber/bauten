<?php

namespace App\Models;

use App\Http\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use Sortable;
    public const TYPES = [
        'range' => 1,
        'checkbox' => 2,
        'select' => 3,
//        'radio' => 4,
    ];
    public const HAS_VALUES = [
        self::TYPES['checkbox'], self::TYPES['select']
    ];

    public static function adminList(){
        return self::sort()->get();
    }
}
