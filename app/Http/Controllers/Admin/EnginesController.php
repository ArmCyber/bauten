<?php

namespace App\Http\Controllers\Admin;

use App\Models\Engine;
use App\Models\EngineType;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnginesController extends BaseController
{
    public function main(){
        $data = ['title'=>'Двигателы'];
        $data['items'] = Engine::adminList();
        return view('admin.pages.engines.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление двигателя', 'edit'=>false];
        $data['back_url'] = route('admin.engines.main');
        $data['engine_types'] = EngineType::adminList();
        return view('admin.pages.engines.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Engine::action(null, $inputs)) {
            Notify::success('Двигатель добавлен.');
            return redirect()->route('admin.engines.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование двигателя', 'edit'=>true];
        $data['back_url'] = route('admin.engines.main');
        $data['item'] = Engine::getItem($id);
        $data['engine_types'] = EngineType::adminList();
        return view('admin.pages.engines.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Engine::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(Engine::action($item, $inputs)) {
            Notify::success('Двигатель редактирован.');
            return redirect()->route('admin.engines.edit', ['id'=>$item->id]);
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
            $item = Engine::where('id',$id)->first();
            if ($item && Engine::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'name' => 'required|string|max:255|unique:engines,name'.($ignore?','.$ignore:null),
            'engine_type_id' => 'required|integer|exists:engine_types,id',
        ]);
    }
}
