<?php

namespace App\Imports;

use App\Models\Mark;
use App\Models\Model;

class ModelsImport extends AbstractImport
{
    protected $keys = [
        'mark'=>0,
        'model'=>1,
    ];
    protected $rules = [
        'mark' => 'required|string|max:255',
        'model' => 'required|string|max:255',
    ];
    protected $names = [
        'mark' => 'марка',
        'model' => 'модель',
    ];

    protected function filter($data) {
        if ($this->rows->filter(function($item) use ($data){
            return mb_strtolower($item['mark']) == mb_strtolower($data['mark']) && mb_strtolower($item['model']) == mb_strtolower($data['model']);
        })->count()) return $this->skip('duplicate_in_file');
        return $this->add($data);
    }

    protected function callback(){
        $marks = $this->rows->pluck('mark');
        $result_marks = Mark::selectRaw('`id`, LOWER(`name`) as name')->whereIn('name', $marks)->get();
        $final = [];
        foreach($this->rows as $row) {
            $find_mark = $result_marks->where('name', mb_strtolower($row['mark']))->first();
            if (!$find_mark) {
                $this->addError($row['_row'], 'not_found', ['name'=>'марка']);
                continue;
            }
            $final[] = [
                'mark_id' => $find_mark->id,
                'name' => $row['model'],
            ];
        }
        if(count($final)) Model::insertOrUpdate($final, ['name']);
    }
}
