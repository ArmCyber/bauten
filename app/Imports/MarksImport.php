<?php

namespace App\Imports;

use App\Models\Mark;

class MarksImport extends AbstractImport
{
    protected $keys = [
        'cid'=>0,
        'name'=>1,
    ];
    protected $rules = [
        'cid' => 'required|integer|digits_between:1,255',
        'name' => 'required|string|max:255',
    ];
    protected $names = [
        'cid' => 'id',
        'name' => 'название марок',
    ];

    protected function filter($data) {
        if ($this->rows->where('cid', $data['cid'])->count()) return $this->skip('duplicate', ['name'=>'id']);
        if ($this->rows->filter(function($item) use ($data) {
            return mb_strtolower($data['name'])==mb_strtolower($item['name']);
        })->count()) return $this->skip('duplicate', ['name'=>'название марок']);
        return $this->add($data);
    }

    protected function callback(){
        $cids = $this->rows->pluck('cid');
        $names = $this->rows->pluck('name');
        $result_names = array_map('mb_strtolower', Mark::whereIn('name', $names)->whereNotIn('cid', $cids)->pluck('name')->toArray());
        $final = [];
        foreach($this->rows as $row) {
            if (in_array(mb_strtolower($row['name']), $result_names)) {
                $this->addError($row['_row'], 'duplicate', ['name'=>'название марок']);
                continue;
            }
            $final[] = [
                'cid' => $row['cid'],
                'name' => $row['name'],
                'url' => to_url($row['name']),
            ];
        }
        Mark::clearCaches();
        if(count($final)) Mark::insertOrUpdate($final, ['name', 'url']);
    }
}
