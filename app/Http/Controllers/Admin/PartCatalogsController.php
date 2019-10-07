<?php

namespace App\Http\Controllers\Admin;

use App\Models\PartCatalog;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartCatalogsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Каталог запчастей'];
        $data['items'] = PartCatalog::adminList();
        return view('admin.pages.part_catalogs.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление каталога запчастей', 'edit'=>false];
        $data['back_url'] = route('admin.part_catalogs.main');
        return view('admin.pages.part_catalogs.form', $data);
    }

    public function add_put(Request $request){
        $validator = $this->validator($request, false);
        $validator['validator']->validate();
        if(PartCatalog::action(null, $validator['inputs'])) {
            Notify::success('Каталог запчастей добавлен.');
            return redirect()->route('admin.part_catalogs.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование каталога запчастей', 'edit'=>true];
        $data['back_url'] = route('admin.part_catalogs.main');
        $data['item'] = PartCatalog::getItem($id);
        return view('admin.pages.part_catalogs.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = PartCatalog::getItem($id);
        $validator = $this->validator($request, $item->id);
        $validator['validator']->validate();
        if(PartCatalog::action($item, $validator['inputs'])) {
            Notify::success('Каталог запчастей редактирован.');
            return redirect()->route('admin.part_catalogs.edit', ['id'=>$item->id]);
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
            $item = PartCatalog::where('id',$id)->first();
            if ($item && PartCatalog::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($request, $ignore=false) {
        $inputs = $request->all();
        $unique = $ignore===false?null:','.$ignore;
        if(!empty($inputs['url'])) $inputs['url'] = mb_strtolower($inputs['url']);
        $inputs['generated_url'] = !empty($inputs['name'])?to_url($inputs['name']):null;
        $request->merge(['url' => $inputs['url']]);
        $rules = [
            'name' => 'required|string|max:255|unique:part_catalogs,name'.$unique,
            'generated_url'=>'required_with:generate_url|string|nullable',
            'image' => 'nullable|image|mimes:jpeg,png',
            'image_alt' => 'nullable|string|max:255',
            'image_title' => 'nullable|string|max:255',
        ];
        if (empty($inputs['generate_url'])) {
            $rules['url'] = 'required|is_url|string|max:255|unique:part_catalogs,url'.$unique;
        }
        $result = [];
        $result['validator'] = Validator::make($inputs, $rules);
        $result['inputs'] = $inputs;
        return $result;
    }
}
