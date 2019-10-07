<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mark;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarksController extends BaseController
{
    public function main(){
        $data = ['title'=>'Марки'];
        $data['items'] = Mark::adminList();
        return view('admin.pages.marks.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление марок', 'edit'=>false];
        $data['back_url'] = route('admin.marks.main');
        return view('admin.pages.marks.form', $data);
    }

    public function add_put(Request $request){
        $validator = $this->validator($request);
        $validator['validator']->validate();
        if(Mark::action(null, $validator['inputs'])) {
            Notify::success('Марка добавлена.');
            return redirect()->route('admin.marks.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование марок', 'edit'=>true];
        $data['back_url'] = route('admin.marks.main');
        $data['item'] = Mark::getItem($id);
        return view('admin.pages.marks.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Mark::getItem($id);
        $validator = $this->validator($request, true);
        $validator['validator']->validate();
        if(Mark::action($item, $validator['inputs'])) {
            Notify::success('Марка редактирована.');
            return redirect()->route('admin.marks.edit', ['id'=>$item->id]);
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
            $item = Mark::where('id',$id)->first();
            if ($item && Mark::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    public function sort() { return Mark::sortable(); }

    private function validator($request, $ignore=false) {
        $inputs = $request->all();
        $unique = $ignore===false?null:','.$ignore;
        if(!empty($inputs['url'])) $inputs['url'] = mb_strtolower($inputs['url']);
        $inputs['generated_url'] = !empty($inputs['name'])?to_url($inputs['name']):null;
        $request->merge(['url' => $inputs['url']]);
        $rules = [
            'name' => 'required|string|max:255|unique:part_catalogs,name'.$unique,
            'image' => ($ignore?'nullable':'required').'|image|mimes:jpeg,png',
            'image_alt' => 'nullable|string|max:255',
            'image_title' => 'nullable|string|max:255',
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
