<?php

namespace App\Http\Controllers\Admin;

use App\Models\Part;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('admin.pages.parts.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
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
        return view('admin.pages.parts.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Part::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
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

    public function sort() { return Part::sortable(); }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'name' => 'nullable|string|max:255',
            'code' => 'required|string|max:255|unique:parts,code'.($ignore?','.$ignore:null)
        ]);
    }

}
