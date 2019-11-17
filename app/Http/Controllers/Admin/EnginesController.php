<?php

namespace App\Http\Controllers\Admin;

use App\Models\Engine;
use App\Models\Mark;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EnginesController extends BaseController
{
    public function main($id){
        $data = [];
        $data['mark'] = Mark::getItem($id);
        $data['mark']->load('engines');
        $data['items'] = $data['mark']->engines;
        $data['title'] = 'Двигатели марки "'.$data['mark']->name.'"';
        $data['back_url'] = route('admin.marks.main');
        return view('admin.pages.engines.main', $data);
    }

    public function add($id){
        $data = ['edit'=>false];
        $data['mark'] = Mark::getItem($id);
        $data['title'] = 'Добавление двигателя марки "'.$data['mark']->name.'"';
        $data['back_url'] = route('admin.engines.main', ['id'=>$id]);
        return view('admin.pages.engines.form', $data);
    }

    public function add_put($id, Request $request){
        $mark = Mark::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Engine::action(null, $inputs, $mark->id)) {
            Notify::success('Двигатель добавлен.');
            return redirect()->route('admin.engines.main', ['id'=>$mark->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit'=>true];
        $data['item'] = Engine::getItem($id);
        $data['mark'] = $data['item']->mark;
        $data['title'] = 'Редактирование двигателя марки "'.$data['mark']->name.'"';
        $data['back_url'] = route('admin.engines.main', ['id'=>$data['item']->mark_id]);
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
        $unique=$ignore?','.$ignore:null;
        return Validator::make($inputs, [
            'number' => 'required|numeric|min:0|unique:engines,number'.$unique,
            'name' => ['required','string','max:255', 'unique:engines,name'.$unique],
            'year' => 'nullable|integer|digits:4',
            'year_to' => 'nullable|integer|digits:4',
        ]);
    }
}
