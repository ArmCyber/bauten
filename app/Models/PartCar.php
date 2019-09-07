<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartCar extends Model
{
    public static function collect($marks, $models, $generations) {
        $keys = Mark::getApplicabilityKeys($marks, $models, $generations);
        $result = collect();
        foreach($marks as $key=>$mark) {
            $mark = (int) $mark;
            if ($mark==0 ||
                !isset($keys[$mark]) ||
                !isset($models[$key]) ||
                !isset($generations[$key]) ||
                $result->where('mark_id', $mark)->where('model_id', 0)->count()
            ) continue;
            $model = (int) $models[$key];
            $generation = (int) $generations[$key];
            $row = ['mark_id'=>(int) $mark];
            if ($model==0) {
                $result = $result->filter(function($item) use ($mark) {
                    return $item->mark!==
                });
                $row['model_id'] = 0;
                $row['generation_id'] = 0;
            }
            else {
                if (!isset($keys[$mark][$model])) continue;
                $row['model_id'] = $model;
                if ($generation!=0 && !isset($keys[$mark][$model][$generation])) continue;
                $row['generation_id'] = $generation;
            }
            $result->push($row);
        }
        dd($result->toArray());
    }
}
