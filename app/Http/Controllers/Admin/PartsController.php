<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Mark;
use App\Models\Part;
use App\Models\PartCar;
use App\Models\PartCatalog;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PartsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Запчасти'];
        $data['items'] = Part::adminList();
        return view('admin.pages.parts.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление запчаста', 'edit'=>false];
        $data['back_url'] = route('admin.parts.main');
        $data['part_catalogs'] = PartCatalog::adminList();
        $data['brands'] = Brand::adminList();
        $data['marks'] = Mark::fullAdminList();
        return view('admin.pages.parts.form', $data);
    }

    /**
     * @throws ValidationException
     */
    public function add_put(Request $request){
        $inputs = $this->validateRequest($request, false);
        if(Part::action(null, $inputs)) {
            Notify::success('Запчаст добавлен.');
            return redirect()->route('admin.parts.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование запчаста', 'edit'=>true];
        $data['back_url'] = route('admin.parts.main');
        $data['item'] = Part::getItem($id);
        $data['part_catalogs'] = PartCatalog::adminList();
        $data['brands'] = Brand::adminList();
        $data['marks'] = Mark::fullAdminList();
        $data['part_cars'] = PartCar::adminList($data['item']->id);
        return view('admin.pages.parts.form', $data);
    }

    /**
     * @throws ValidationException
     */
    public function edit_patch($id, Request $request){
        $item = Part::getItem($id);
        $inputs = $this->validateRequest($request, $item->id);
        if(Part::action($item, $inputs)) {
            Notify::success('Запчаст редактирован.');
            return redirect()->route('admin.parts.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Part::where('id',$id)->first();
            if ($item && Part::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    /**
     * @throws ValidationException
     */
    private function validateRequest($request, $ignore=false) {
        $inputs = $request->all();
        $unique = $ignore===false?null:','.$ignore;
        if(!empty($inputs['url'])) $inputs['url'] = mb_strtolower($inputs['url']);
        $inputs['generated_url'] = !empty($inputs['name'])?to_url($inputs['name']):null;
        $request->merge(['url' => $inputs['url']]);
        $rules = [
            'name' => 'nullable|string|max:255',
            'code' => 'required|string|max:255|unique:parts,code'.$unique,
            'image' => ($ignore?'nullable':'required').'|image',
            'part_catalog_id' => 'required|integer|exists:part_catalogs,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'generated_url'=>'required_with:generate_url|string|nullable',
            'price' => 'required|numeric|between:1,10000000000',
            'articule' => 'required|string|max:255|unique:parts,articule'.$unique,
            'oem' => 'required|string|max:255|unique:parts,oem'.$unique,
            'description' => 'nullable|string',
        ];
        if (empty($inputs['generate_url'])) {
            $rules['url'] = 'required|is_url|string|max:255|unique:part_catalogs,url'.$unique;
        }
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            if (!empty($inputs['mark_id'])) {
                $old_cars = [];
                foreach($inputs['mark_id'] as $i=>$e){
                    if ($e==0) continue;
                    $old_cars[] = [
                        'mark_id' => $e,
                        'model_id' => $inputs['model_id'][$i],
                        'generation_id' => $inputs['generation_id'][$i],
                    ];
                }
                if (count($old_cars)) session()->flash('old_cars', $old_cars);
            }
            throw new ValidationException($validator);
        }
        return $inputs;
    }
}
