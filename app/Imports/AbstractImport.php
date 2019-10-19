<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;

abstract class AbstractImport implements ToCollection
{
    protected $errors;
    protected $keys = [];
    protected $rules = [];
    protected $count;
    public $response = [];
    protected $rows;

    abstract protected function filter($data);
    abstract protected function callback();

    protected function addError($key, $reason, $attributes=[]) {
        $this->errors->push([
            'row' => $key,
            'reason' => __('excel_import.reasons.'.$reason, $attributes),
        ]);
    }

    protected function skip($reason, $attributes=[]){
        return [
            'status'=>false,
            'reason'=>$reason,
            'attributes'=>$attributes,
        ];
    }

    protected function add($data){
        return [
            'status'=>true,
            'data'=>$data,
        ];
    }

    public function collection(Collection $collection)
    {
        $this->rows = collect();
        $this->errors = collect();
        $this->count = 0;
        foreach($collection as $key=>$row) {
            if($key==0) {
                if(count($row)<count($this->keys)) {
                    $this->addSheet(false);
                    return;
                }
                else {
                    foreach($this->keys as $name => $key) {
                        if (mb_strtolower($row[$key])!=$this->names[$name]) {
                            $this->addSheet(false);
                            return;
                        }
                    }
                }
                continue;
            }
            $data = [];
            $anyExist = false;
            foreach($this->keys as $name => $row_key) {
                if($row[$row_key]) $anyExist = true;
                $data[$name] = $row[$row_key];
            }
            if(!$anyExist) continue;
            $this->count++;
            if(Validator::make($data, $this->rules)->fails()) {
                $this->addError($key+1, 'format');
                continue;
            }
            $response = $this->filter($data);
            if($response['status']) {
                $response['data']['_row'] = $key+1;
                $this->rows->push($response['data']);
            }
            else {
                $this->addError($key+1, $response['reason'], $response['attributes']);
            }
        }
        $this->callback();
        $this->addSheet();
        return;
    }

    public function addSheet($imported = true){
        if (!$imported) {
            $response = [
                'status'=>0,
            ];
        }
        else {
            $response = [
                'status' => 1,
                'errors' => $this->errors->sortBy('row')->values()->toArray(),
                'count' => $this->count,
            ];
            $response['failed'] = count($response['errors']);
            $response['imported'] = $this->count - $response['failed'];
        }
        $this->response[] = $response;
    }

    public static function import($file){
        $class_name = get_called_class();
        $object = new $class_name;
        try {
            Excel::import($object, $file);
        } catch (\Exception $e) {
            return 'failed';
        }
        return $object->response;
    }
}