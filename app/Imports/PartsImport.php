<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Generation;
use App\Models\Part;
use App\Models\PartCar;
use App\Models\PartCatalog;
use Illuminate\Support\Facades\DB;

class PartsImport extends AbstractImport
{
    protected $keys = [
        'ref'=>0,
        'code'=>1,
        'brand'=>2,
        'generations'=>3,
        'engine'=>4,
        'priority'=>5,
        'catalogue'=>6,
        'name'=>7,
        'price'=>8,
        'available'=>9,
    ];
    protected $rules = [
        'ref' => 'required|string|max:255',
        'code' => 'required|string|max:255',
        'brand' => 'required|string',
        'generations' => 'nullable|string',
        'engine' => 'nullable|string',
        'priority' => 'nullable|string',
        'catalogue' => 'required|string',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|between:1,10000000000',
        'available' => 'nullable|integer|digits_between:1,10',
    ];
    protected $names = [
        'ref' => 'ref',
        'code' => 'артикул',
        'brand' => 'производитель',
        'generations' => 'модификация авто',
        'engine' => 'двигатель',
        'priority' => 'приоритет',
        'catalogue' => 'запчасть',
        'name' => 'полное наименование',
        'price' => 'цена',
        'available' => 'столбец',

    ];

    private $all_generations = [];
    private $all_brands = [];
    private $all_catalogue = [];

    protected function filter($data) {
        if ($this->rows->filter(function($item) use ($data){
            return mb_strtolower($item['ref']) == mb_strtolower($data['ref']);
        })->count()) return $this->skip('duplicate_in_file');
//        if ($data['generations']) {
//            $data['generations'] = array_map('trim', explode(',',$data['generations']));
//            $this->all_generations = array_merge($this->all_generations, $data['generations']);
//        } else $data['generations'] = [];
        $thisBrand = mb_strtolower($data['brand']);
        if (!in_array($thisBrand, $this->all_brands)) $this->all_brands[] = $thisBrand;
        $thisCatalogue = mb_strtolower($data['catalogue']);
        if (!in_array($thisCatalogue, $this->all_catalogue)) $this->all_catalogue[] = $thisCatalogue;

        return $this->add($data);
    }

    protected function callback(){
        $refs = $this->rows->pluck('ref');
//        $generations = array_unique($this->all_generations);
        $result_parts = Part::select('id', 'ref')->whereIn('ref', $refs)->get();
//        $result_generations = Generation::select('id', 'cid', 'model_id')->whereIn('cid', $generations)->with(['model'=>function($q){
//            $q->select('id', 'mark_id')->with(['mark'=>function($q){
//                $q->select('id');
//            }]);
//        }])->get();
        $result_brands = Brand::selectRaw('`id`, LOWER(`name`) as `name`')->whereIn('name', $this->all_brands)->get();
        $result_catalogue = PartCatalog::selectRaw('`id`, LOWER(`name`) as `name`')->whereIn('name', $this->all_catalogue)->get();
        $increment = Part::getIncrement();
        $inserts = [];
        $updates = [];
        $removeCars = [];
        $insertCars = [];
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

            $part = $result_parts->where('ref', $row['ref'])->first();
            if ($part) {
                $this_id = $part->id;
                $edit = true;
            }
            else {
                $this_id = $increment;
                $edit = false;
            }
            $continue = false;
            $thisInsertCars = [];
//            foreach($row['generations'] as $generation) {
//                $this_generation = $result_generations->where('cid', $generation)->first();
//                if (!$this_generation) {
//                    $this->addError($row['_row'], 'not_found', ['name'=>'модификация "'.$generation.'"']);
//                    $continue = true;
//                    break;
//                }
//                $thisInsertCars[] = [
//                    'part_id' => $this_id,
//                    'mark_id' => $this_generation->model->mark->id,
//                    'model_id' => $this_generation->model->id,
//                    'generation_id' => $this_generation->id,
//                ];
//            }
            if ($continue) continue;
            else $insertCars = array_merge($insertCars, $thisInsertCars);
            if ($edit) {
                $removeCars[] = $this_id;
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
        DB::transaction(function() use ($removeCars, $insertCars, $inserts, $updates){
            if (count($removeCars)) PartCar::whereIn('part_id', $removeCars)->delete();
            if (count($inserts)) Part::insert($inserts);
            if (count($updates)) Part::insertOrUpdate($updates, ['brand_id', 'part_catalog_id', 'name', 'price', 'code', 'available']);
            if (count($insertCars)) PartCar::insert($insertCars);
        });
    }
}
