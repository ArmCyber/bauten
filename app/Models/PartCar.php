<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartCar extends Model
{
    public static function collect($part_id, $marks, $models, $generations) {
        $keys = Mark::getApplicabilityKeys($marks, $models, $generations);
        $result = collect();
        foreach($marks as $key=>$mark) {
            $mark = (int) $mark;
            $model = (int) $models[$key];
            if ($mark==0 ||
                !isset($keys[$mark]) ||
                !isset($models[$key]) ||
                !isset($generations[$key]) ||
                $result->where('mark_id', $mark)->where('model_id', 0)->count()
            ) continue;
            $generation = (int) $generations[$key];
            $row = ['mark_id'=>(int) $mark];
            if ($model==0) {
                $result = $result->filter(function($item) use($mark){
                    return $item['mark_id'] != $mark;
                });
                $row['model_id'] = null;
                $row['generation_id'] = null;
            }
            else {
                if (!isset($keys[$mark][$model]) ||
                    $result->where('model_id', $model)->where('generation_id', 0)->count()
                ) continue;
                $row['model_id'] = $model;
                if ($generation==0) {
                    $generation=null;
                    $result = $result->filter(function($item) use($model){
                        return $item['model_id'] != $model;
                    });
                }
                else if (!isset($keys[$mark][$model][$generation]) || $result->where('generation_id', $generation)->count()) continue;
                $row['generation_id'] = $generation;
            }
            $row['part_id'] = $part_id;
            $result->push($row);
        }
        return $result;
    }

    public static function sync($part_id, $marks, $models, $generations, $edit){
        $new_data = self::collect($part_id, $marks, $models, $generations)->toArray();
        if ($edit) {
            $old_data = self::adminList($part_id)->toArray();
            if (count($new_data) === count($old_data)) foreach($old_data as $key => $data) {
                $thisVal = $new_data[$key];
                if ($thisVal['mark_id'] != $data['mark_id'] || $thisVal['model_id'] != $data['model_id'] || $thisVal['generation_id'] != $data['generation_id']) {
                    $changed = true;
                    break;
                }
            }
            else $changed=true;
            if (empty($changed)) return ;
            self::where('part_id', $part_id)->delete();
        }
        self::insert($new_data);
        return ;
    }

    public static function adminList($part_id){
        return self::select('mark_id', 'model_id', 'generation_id')->where('part_id', $part_id)->sort()->get();
    }

    public function scopeSort($q){
        return $q->orderBy('id');
    }

    public function scopeWithInfo($q){
        return $q->with(['mark', 'model', 'generation']);
    }

    public function part(){
        return $this->belongsTo('App\Models\Part', 'part_id', 'id');
    }

    public function mark(){
        return $this->belongsTo('App\Models\Mark', 'mark_id', 'id');
    }

    public function model() {
        return $this->belongsTo('App\Models\Model', 'model_id', 'id');
    }

    public function generation() {
        return $this->belongsTo('App\Models\Generation', 'generation_id', 'id');
    }

    public function getModelIdAttribute($value) {
        if ($value==null) return 0;
        return $value;
    }

    public function getGenerationIdAttribute($value) {
        if ($value==null) return 0;
        return $value;
    }
}
