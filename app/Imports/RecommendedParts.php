<?php

namespace App\Imports;

use Illuminate\Support\Collection;

class RecommendedParts extends AbstractImport
{
    protected $keys = [
        'cid'=>0,
    ];
    protected $rules = [
        'cid' => 'required|integer|digits_between:1,255',
        'mark' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'years' => 'nullable|string|max:16',
        'name' => 'nullable|string|max:255',
        'engine' => 'nullable|integer|digits_between:1,10',
    ];
    protected $names = [
        'cid' => 'id',
        'mark' => 'марка',
        'model' => 'модель',
        'years' => 'период продаж',
        'name' => 'модификация',
        'engine' => 'объем двигателя, см3',
    ];

    private $cids = [];
    private $marks = [];
    private $models = [];
    protected function filter($data) {
        if ($this->rows->where('cid', $data['cid'])->count()) return $this->skip('duplicate', ['name'=>'id']);
        $year = null;
        $year_to = null;
        if(!empty($data['years'])) {
            $years = explode('-', $data['years']);
            $year = (int) isset($years[0])?trim($years[0]):0;
            $year_to = (int) isset($years[1])?trim($years[1]):0;
            $years = get_range_data($year, $year_to);
            $year = $years[0];
            $year_to = $years[1];
        }
        $data['year'] = $year;
        $data['year_to'] = $year_to;
        unset($data['years']);
        $mark = mb_strtolower($data['mark']);
        $model = mb_strtolower($data['model']);
        if(!in_array($mark, $this->marks)) $this->marks[] = $mark;
        if(!in_array($model, $this->models)) $this->models[] = $model;
        return $this->add($data);
    }

    protected function callback(){
        $final = [];
        $marks = Mark::selectRaw('`id`, LOWER(`name`) as `name`')->whereIn('name', $this->marks)->get();
        $models = Model::selectRaw('`id`, `mark_id`, LOWER(`name`) as `name`')->whereIn('name', $this->models)->get();
        foreach($this->rows as $row) {
            $mark = $marks->where('name', mb_strtolower($row['mark']))->first();
            if (!$mark) {
                $this->addError($row['_row'], 'not_found', ['name'=>'марка']);
                continue;
            }
            $model = $models->where('name', mb_strtolower($row['model']))->where('mark_id', $mark->id)->first();
            if (!$model) {
                $this->addError($row['_row'], 'not_found', ['name'=>'модель']);
                continue;
            }
            $final[] = [
                'cid' => $row['cid'],
                'name' => $row['name'],
                'engine' => $row['engine'],
                'year' => $row['year'],
                'year_to' => $row['year_to'],
                'model_id' => $model->id,
            ];
        }
        if(count($final)) Generation::insertOrUpdate($final, ['name', 'engine', 'year', 'year_to', 'model_id']);
    }
}
