<?php

namespace App\Imports;

use App\Models\Part;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RecommendedPartsImport extends AbstractImport
{
    protected $keys = [
        'user' => 0,
        'parts' => 1,
    ];
    protected $rules = [
        'user' => 'required|integer|digits_between:1,10',
        'parts' => 'required|string',
    ];
    protected $names = [
        'user' => 'пользователь',
        'parts' => 'запчасти',
    ];

    private $allParts = [];
    protected function filter($data) {
        $data['user'] = (int) $data['user'];
        if ($this->rows->where('user', $data['user'])->count()) return $this->skip('duplicate', ['name'=>'пользователь']);
        $parts = explode(';', $data['parts']);
        $data['parts'] = [];
        foreach ($parts as $key=>$part) {
            $part = trim($part);
            if (!in_array($part, $data['parts'])) $data['parts'][] = $part;
            if (!in_array($part, $this->allParts)) $this->allParts[] = $part;
        }
        return $this->add($data);
    }

    protected function callback(){
        $final = [];
        $removeParts = [];
        $user_ids = $this->rows->pluck('user')->toArray();
        $users = User::whereIn('id', $user_ids)->pluck('id')->toArray();
        $parts = Part::select('id', 'code', 'brand_id')->whereIn('code', $this->allParts)->orderBy('id', 'asc')->get();
        foreach ($this->rows as $row) {
            if (!in_array($row['user'], $users)) {
                $this->addError($row['_row'], 'not_found', ['name'=>'пользователь']);
                continue;
            }
            $thisParts = [];
            foreach($row['parts'] as $part) {
                $findPart = $parts->where('code', $part)->first();
                if (!$findPart) {
                    $this->addError($row['_row'], 'not_found', ['name'=>'запчасть "'.$part.'"']);
                    $thisParts = false;
                    break;
                }
                $thisParts[] = [
                    'user_id' => $row['user'],
                    'part_id' => $findPart->id,
                ];
            }
            if ($thisParts===false) continue;
            $final = array_merge($final, $thisParts);
            $removeParts[] = $row['user'];
        }
        if(count($final)) {
            $table_name = 'recommended_parts';
            DB::table($table_name)->whereIn('user_id', $removeParts)->delete();
            DB::table($table_name)->insert($final);
        }
    }
}
