<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Criterion;
use App\Models\Engine;
use App\Models\Modification;
use App\Models\Part;
use App\Models\PartCatalog;
use Illuminate\Support\Facades\DB;

class PartsImport extends AbstractImport
{
    protected $rules = [
        'ref' => 'required|string|max:255',
        'code' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'brand' => 'required|string',
        'available' => 'nullable|integer|digits_between:1,10',
        'price' => 'required|numeric|between:1,10000000000',
        'catalogue' => 'required|string',
        'engines' => 'nullable|string',
        'modifications' => 'nullable|string',
        'criteria' => 'nullable|string',
    ];
    protected $names = [
        'ref' => 'уид',
        'code' => 'артикул',
        'name' => 'наименование',
        'brand' => 'бренд',
        'available' => 'остаток',
        'price' => 'цена',
        'catalogue' => 'категория',
        'engines' => 'двигатель',
        'modifications' => 'модификация',
        'criteria' => 'фильтры',
    ];

    private $all_brands = [];
    private $all_catalogue = [];
    private $all_engines = [];
    private $all_modifications = [];
    private $all_criteria = [];
    private $refs = [];

//public $ok = [];
    protected function filter($data) {
        if (array_key_exists($data['brand'], $this->ok)) $this->ok[$data['brand']]++;
        else $this->ok[$data['brand']] = 1;

        $data['ref'] = mb_strtolower($data['ref']);
        if (in_array($data['ref'], $this->refs)) return $this->skip('duplicate_in_file');
        $this->refs[] = $data['ref'];
        $thisBrand = mb_strtolower($data['brand']);
        if (!in_array($thisBrand, $this->all_brands)) $this->all_brands[] = $thisBrand;
        $thisCatalogue = mb_strtolower($data['catalogue']);
        if (!in_array($thisCatalogue, $this->all_catalogue)) $this->all_catalogue[] = $thisCatalogue;
        if (!$data['available']) $data['available'] = 0;
        $this_engines = [];
        if ($data['engines']) {
            $engines = explode(',', $data['engines']);
            foreach ($engines as $engine) {
                $engine = (int) trim($engine);
                if (!in_array($engine, $this_engines)) $this_engines[] = $engine;
                if (!in_array($engine, $this->all_engines)) $this->all_engines[] = $engine;
            }
        }
        $data['engines'] = $this_engines;
        $this_modifications = [];
        if ($data['modifications']) {
            $modifications = explode(',', $data['modifications']);
            foreach ($modifications as $modification) {
                $modification = (int) trim($modification);
                if (!in_array($modification, $this_modifications)) $this_modifications[] = $modification;
                if (!in_array($modification, $this->all_modifications)) $this->all_modifications[] = $modification;
            }
        }
        $data['modifications'] = $this_modifications;
        $this_criteria = [];
        if ($data['criteria']) {
            $criteria = explode(',', $data['criteria']);
            foreach ($criteria as $criterion) {
                $criterion = (int) trim($criterion);
                if (!in_array($criterion, $this_criteria)) $this_criteria[] = $criterion;
                if (!in_array($criterion, $this->all_criteria)) $this->all_criteria[] = $criterion;
            }
        }
        $data['criteria'] = $this_criteria;
        return $this->add($data);
    }

    protected function callback(){
//        arsort($this->ok);
//        dd($this->ok);
        $result_parts = Part::select('id', 'ref')->whereIn('ref', $this->refs)->get()->mapWithKeys(function($item){
            return [$item->ref => $item];
        });
        $result_brands = Brand::selectRaw('`id`, LOWER(`name`) as `name`')->whereIn('name', $this->all_brands)->get();
        $result_catalogue = PartCatalog::selectRaw('`id`, `group_id`, LOWER(`name`) as `name`')->whereIn('name', $this->all_catalogue)->get();
        $result_criteria = Criterion::select('id', 'filter_id')->whereIn('id', $this->all_criteria)->with(['filter' => function($q){
            $q->select('id', 'group_id');
        }])->get();
        $result_modifications = Modification::select('id', 'cid')->whereIn('cid', $this->all_modifications)->orderBy('id', 'asc')->get();
        $result_engines = Engine::select('id', 'number')->whereIn('number', $this->all_engines)->orderBy('id', 'asc')->get();
        $increment = Part::getIncrement();
        $inserts = [];
        $updates = [];
        $insert_criteria = [];
        $insert_modifications = [];
        $insert_engines = [];
        $remove_ids = [];

        foreach($this->rows as $row) {
            $brand = $result_brands->where('name', mb_strtolower($row['brand']))->first();
            if (!$brand) {
                $this->addError($row['_row'], 'not_found', ['name'=>'Бренд']);
                continue;
            }
            $catalogue = $result_catalogue->where('name', mb_strtolower($row['catalogue']))->first();
            if (!$catalogue) {
                $this->addError($row['_row'], 'not_found', ['name'=>'Каталог']);
                continue;
            }

            $part = $result_parts[$row['ref']]??null;
            if ($part) {
                $this_id = $part->id;
                $edit = true;
            }
            else {
                $this_id = $increment;
                $edit = false;
            }
            $continue = false;
            $this_insert_criteria = [];
            if (count($row['criteria'])) {
                foreach($row['criteria'] as $criterion) {
                    $find_criterion = $result_criteria->where('id', $criterion)->first();
                    if (!$find_criterion) {
                        $this->addError($row['_row'], 'not_found', ['name'=>'фильтр "'.$criterion.'"']);
                        $continue = true;
                        break;
                    }
                    if ($find_criterion->filter->group_id != null && $find_criterion->filter->group_id!=$catalogue->group_id) {
                        $this->addError($row['_row'], 'invalid_filter', ['name'=>$criterion]);
                        $continue = true;
                        break;
                    }
                    $this_insert_criteria[] = [
                        'criterion_id' => $find_criterion->id,
                        'part_id' => $this_id,
                    ];
                }
            }
            if ($continue) continue;
            $this_insert_modifications = [];
            if (count($row['modifications'])) {
                foreach($row['modifications'] as $modification) {
                    $find_modification = $result_modifications->where('cid', $modification)->first();
                    if (!$find_modification) {
                        $this->addError($row['_row'], 'not_found', ['name'=>'модификация']);
                        $continue = true;
                        break;
                    }
                    $this_insert_modifications[] = [
                        'modification_id' => $find_modification->id,
                        'part_id' => $this_id,
                    ];
                }
            }
            if ($continue) continue;
            $this_insert_engines = [];
            if (count($row['engines'])) {
                foreach($row['engines'] as $engine) {
                    $find_engine = $result_engines->where('number', $engine)->first();
                    if (!$find_engine) {
                        $this->addError($row['_row'], 'not_found', ['name'=>'двигатель']);
                        $continue = true;
                        break;
                    }
                    $this_insert_engines[] = [
                        'engine_id' => $find_engine->id,
                        'part_id' => $this_id,
                    ];
                }
            }
            if ($continue) continue;
            $insert_criteria = array_merge($insert_criteria, $this_insert_criteria);
            $insert_modifications = array_merge($insert_modifications, $this_insert_modifications);
            $insert_engines = array_merge($insert_engines, $this_insert_engines);
            if ($edit) {
                $remove_ids[] = $this_id;
                $updates[] = [
                    'id' => $this_id,
                    'ref' => $row['ref'],
                    'code' => $row['code'],
                    'brand_id' => $brand->id,
                    'part_catalog_id' => $catalogue->id,
                    'name' => $row['name'],
                    'price' => $row['price'],
                    'available' => $row['available'],
                ];
            }
            else {
                $increment++;
                $inserts[] = [
                    'id' => $this_id,
                    'ref' => $row['ref'],
                    'code' => $row['code'],
                    'brand_id' => $brand->id,
                    'part_catalog_id' => $catalogue->id,
                    'name' => $row['name'],
                    'price' => $row['price'],
                    'url' => to_url_suf($row['name']),
                    'available' => $row['available'],
                ];
            }
        }
        DB::transaction(function() use ($inserts, $updates, $remove_ids, $insert_engines, $insert_modifications, $insert_criteria){
            if (count($inserts)) Part::insert($inserts);
            if (count($updates)) Part::insertOrUpdate($updates, ['brand_id', 'part_catalog_id', 'name', 'price', 'code', 'available']);
            if (count($remove_ids)) {
                DB::table('criterion_part')->whereIn('part_id', $remove_ids)->delete();
                DB::table('modification_part')->whereIn('part_id', $remove_ids)->delete();
                DB::table('engine_part')->whereIn('part_id', $remove_ids)->delete();
            }
            if (count($insert_criteria)) DB::table('criterion_part')->insert($insert_criteria);
            if (count($insert_modifications)) DB::table('modification_part')->insert($insert_modifications);
            if (count($insert_engines)) DB::table('engine_part')->insert($insert_engines);
        });
    }
}
