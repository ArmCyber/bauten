<?php

namespace App\Http\Controllers\Admin;

use App\Models\Generation;
use App\Models\Model;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenerationsController extends Controller
{
    public function main($id){
        $data = [];
        $data['model'] = Model::getItem($id);
        $data['items'] = $data['model']->generations;
        $data['title'] = 'Поколении моделя "'.$data['model']->name.'"';
        $data['back_url'] = route('admin.models.main', ['id'=>$data['model']->mark_id]);
        return view('admin.pages.generations.main', $data);
    }

    public function add($id){
        $data = ['edit'=>false];
        $data['model'] = Model::getItem($id);
        $data['title'] = 'Добавление поколении в модель "'.$data['model']->mark->name.' '.$data['model']->name.'"';
        $data['back_url'] = route('admin.generations.main', ['id'=>$id]);
        return view('admin.pages.generations.form', $data);
    }

    public function add_put($id, Request $request){
        $data['model'] = Model::getItem($id);
        $inputs = $request->all();
        $inputs['model_id'] = $data['model']->id;
//        $this->validator($inputs)->validate();
        if(Generation::action(null, $inputs)) {
            Notify::success('Поколения добавлено.');
            return redirect()->route('admin.generations.main', ['id'=>$data['model']->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit'=>true];
        $data['item'] = Generation::getItem($id);
        $data['model'] = $data['item']->model;
        $mark = $data['model']->mark;
        $data['title'] = 'Редактирование поколении модели "'.$mark->name.' '.$data['model']->name.'"';
        $data['back_url'] = route('admin.generations.main', ['id'=>$data['model']->id]);
        return view('admin.pages.generations.form', $data);
    }

    public function sort() { return Generation::sortable(); }

    public function edit_patch($id, Request $request){
        $item = Generation::getItem($id);
        $inputs = $request->all();
//        $this->validator($inputs, $item->id)->validate();
        if(Generation::action($item, $inputs)) {
            Notify::success('Модель редактирован.');
            return redirect()->route('admin.generations.edit', ['id'=>$item->id]);
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
            $item = Generation::where('id',$id)->first();
            if ($item && Generation::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

//    private function validator($inputs, $ignore=false) {
//    }
}
