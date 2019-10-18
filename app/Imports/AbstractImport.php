<?php

namespace App\Imports;

use App\Models\Mark;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;

abstract class AbstractImport implements ToCollection
{
    protected $errors;
    protected $keys = [];
    protected $rules = [];
    protected $count = 0;
    public $response = [];
    protected $rows;

    abstract protected function filter($data);
    abstract protected function handle();

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
        foreach($collection as $key=>$row) {
            if($key==0) {
                if(count($row)<count($this->keys)) {
                    $this->response['status'] = 0;
                    break;
                }
                else {
                    foreach($this->keys as $name => $key) {
                        if (mb_strtolower($row[$key])!=$name) {
                            $this->response['status'] = 0;
                            break;
                        }
                    }
                }
                continue;
            }
            $data = [];
            $anyExist = false;
            foreach($this->keys as $name => $row_key) {
                if($row[$row_key]!==null) $anyExist = true;
                $data[$name] = $row[$row_key];
            }
            if(!$anyExist) continue;
            $this->count++;
            if(Validator::make($data, [
                'cid' => 'required|integer|digits_between:1,255',
                'name' => 'required|string|max:255',
            ])->fails()) {
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
        $this->handle();
        $this->response = [
            'status' => 1,
            'errors' => $this->errors->sortBy('row'),
            'count' => $this->count,
        ];
        $this->response['failed'] = count($this->errors);
        $this->response['imported'] = $this->count - $this->response['failed'];
        return;
    }

    public static function import($file){
        $class_name = get_called_class();
        $object = new $class_name;
        try {
            Excel::import($object, $file);
        } catch (\Exception $e) {
            return [
                'status'=>0,
            ];
        }
        return $object->response;
    }
}
