<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mark;
use App\Models\Model;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelsController extends BaseController
{
    public function main($id){
        $data = [];
        $data['mark'] = Mark::getItem($id);
        $data['mark']->load(['models'=>function($q){
            $q->withCount('generations');
        }]);
        $data['items'] = $data['mark']->models;
        $data['title'] = 'Модели марки "'.$data['mark']->name.'"';
        $data['back_url'] = route('admin.marks.main');
        return view('admin.pages.models.main', $data);
    }

    public function add($id){
        $data = ['title'=>'Добавление модели', 'edit'=>false];
        $data['mark'] = Mark::getItem($id);
        $data['marks'] = Mark::adminList();
        $data['back_url'] = route('admin.models.main', ['id'=>$id]);
        return view('admin.pages.models.form', $data);
    }

    public function add_put($id, Request $request){
        Mark::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Model::action(null, $inputs)) {
            Notify::success('Модель добавлен.');
            return redirect()->route('admin.models.main', ['id'=>(int) $inputs['mark_id']]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование модели', 'edit'=>true];
        $data['item'] = Model::getItem($id);
        $data['marks'] = Mark::adminList();
        $data['back_url'] = route('admin.models.main', ['id'=>$data['item']->mark_id]);
        return view('admin.pages.models.form', $data);
    }

    public function sort() { return Model::sortable(); }

    public function edit_patch($id, Request $request){
        $item = Model::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Model::action($item, $inputs)) {
            Notify::success('Модель редактирован.');
            return redirect()->route('admin.models.edit', ['id'=>$item->id]);
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
            $item = Model::where('id',$id)->first();
            if ($item && Model::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'mark_id'=>'required|integer|exists:marks,id',
        ]);
    }
}
