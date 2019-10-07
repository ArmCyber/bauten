<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Бренды'];
        $data['items'] = Brand::adminList();
        return view('admin.pages.brands.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление бренда', 'edit'=>false];
        $data['back_url'] = route('admin.brands.main');
        return view('admin.pages.brands.form', $data);
    }

    public function add_put(Request $request){
        $validator = $this->validator($request, false);
        $validator['validator']->validate();
        if(Brand::action(null, $validator['inputs'])) {
            Notify::success('Бренд добавлен.');
            return redirect()->route('admin.brands.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование бренда', 'edit'=>true];
        $data['back_url'] = route('admin.brands.main');
        $data['item'] = Brand::getItem($id);
        return view('admin.pages.brands.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Brand::getItem($id);
        $validator = $this->validator($request, $item->id);
        $validator['validator']->validate();
        if(Brand::action($item, $validator['inputs'])) {
            Notify::success('Бренд редактирован.');
            return redirect()->route('admin.brands.edit', ['id'=>$item->id]);
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
            $item = Brand::where('id',$id)->first();
            if ($item && Brand::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    public function sort() { return Brand::sortable(); }

    private function validator($request, $ignore=false) {
        $inputs = $request->all();
        $unique = $ignore===false?null:','.$ignore;
        if(!empty($inputs['url'])) $inputs['url'] = mb_strtolower($inputs['url']);
        $inputs['generated_url'] = !empty($inputs['name'])?to_url($inputs['name']):null;
        $request->merge(['url' => $inputs['url']]);
        $rules = [
            'name' => 'nullable|string|max:255',
            'image' => ($ignore?'nullable':'required').'|image|mimes:jpeg,png',
            'image_alt' => 'nullable|string|max:255',
            'image_title' => 'nullable|string|max:255',
            'code' => 'required|string|max:255|unique:brands,code'.$unique,
        ];
        if (empty($inputs['generate_url'])) {
            $rules['url'] = 'required|is_url|string|max:255|unique:marks,url'.$unique;
        }
        $result = [];
        $result['validator'] = Validator::make($inputs, $rules);
        $result['inputs'] = $inputs;
        return $result;
    }
}
