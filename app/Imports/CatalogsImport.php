<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Mark;
use App\Models\Model;
use App\Models\PartCatalog;

class CatalogsImport extends AbstractImport
{
    protected $keys = [
        'cid'=>0,
        'name'=>1,
        'group'=>2,
    ];
    protected $rules = [
        'cid' => 'required|integer|digits_between:1,255',
        'name' => 'required|string|max:255',
        'group' => 'required|string|max:255',
    ];
    protected $names = [
        'cid'=>'id',
        'name'=>'категория',
        'group'=>'группа',
    ];

    protected function filter($data) {
        if ($this->rows->where('cid', $data['cid'])->count()) return $this->skip('duplicate', ['name'=>'id']);
        if ($this->rows->filter(function($item) use ($data){
            return mb_strtolower($item['name']) == mb_strtolower($data['name']);
        })->count()) return $this->skip('duplicate', ['name'=>'категория']);
        return $this->add($data);
    }

    protected function callback(){
        $groups = $this->rows->pluck('group');
        $result_groups = Group::selectRaw('`id`, LOWER(`name`) as name')->whereIn('name', $groups)->get();
        $result_names = PartCatalog::selectRaw('`id`, LOWER(`name`) as name')->whereIn('name', $this->rows->pluck('name'))->whereNotIn('cid', $this->rows->pluck('cid'))->get();
        $final = [];
        foreach($this->rows as $row) {
            $name = $result_names->where('name', mb_strtolower($row['name']))->first();
            if ($name) {
                $this->addError($row['_row'], 'duplicate', ['name'=>'категория']);
                continue;
            }
            $find_group = $result_groups->where('name', mb_strtolower($row['group']))->first();
            if (!$find_group) {
                $this->addError($row['_row'], 'not_found', ['name'=>'группа']);
                continue;
            }
            $final[] = [
                'cid' => $row['cid'],
                'group_id' => $find_group->id,
                'name' => $row['name'],
                'url' => to_url($row['name']),
            ];
        }
        if(count($final)) PartCatalog::insertOrUpdate($final, ['name', 'group_id', 'url']);
    }
}
