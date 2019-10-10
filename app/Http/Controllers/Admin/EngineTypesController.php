<?php

namespace App\Http\Controllers\Admin;

use App\Models\EngineType;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EngineTypesController extends BaseController
{
    public function main(){
        $data = ['title'=>'Типы двигателей'];
        $data['items'] = EngineType::adminList();
        return view('admin.pages.engine_types.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление типа двигателя', 'edit'=>false];
        $data['back_url'] = route('admin.engine_types.main');
        return view('admin.pages.engine_types.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(EngineType::action(null, $inputs)) {
            Notify::success('Тип двигателя добавлен.');
            return redirect()->route('admin.engine_types.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование типа двигателя', 'edit'=>true];
        $data['back_url'] = route('admin.engine_types.main');
        $data['item'] = EngineType::getItem($id);
        return view('admin.pages.engine_types.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = EngineType::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(EngineType::action($item, $inputs)) {
            Notify::success('Тип двигателя редактирован.');
            return redirect()->route('admin.engine_types.edit', ['id'=>$item->id]);
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
            $item = EngineType::where('id',$id)->first();
            if ($item && EngineType::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'name' => 'required|string|max:255|unique:engine_types,name'.($ignore?','.$ignore:null),
        ]);
    }
}
