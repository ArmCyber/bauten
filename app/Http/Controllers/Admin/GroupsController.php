<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Группы'];
        $data['items'] = Group::adminList();
        return view('admin.pages.groups.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление группы', 'edit'=>false];
        $data['back_url'] = route('admin.groups.main');
        return view('admin.pages.groups.form', $data);
    }

    public function add_put(Request $request){
        $validator = $this->validator($request, false);
        $validator['validator']->validate();
        if(Group::action(null, $validator['inputs'])) {
            Notify::success('Группа добавлена.');
            return redirect()->route('admin.groups.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование группы', 'edit'=>true];
        $data['back_url'] = route('admin.groups.main');
        $data['item'] = Group::getItem($id);
        return view('admin.pages.groups.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Group::getItem($id);
        $validator = $this->validator($request, $item->id);
        $validator['validator']->validate();
        if(Group::action($item, $validator['inputs'])) {
            Notify::success('Группа редактирована.');
            return redirect()->route('admin.groups.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function sort(){ return Group::sortable(); }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Group::where('id',$id)->withCount('catalogs')->first();
//            dd($item);
            if ($item && $item->catalogs_count==0 && Group::deleteItem($item)) $result['success'] = true;
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
            'name' => 'required|string|max:255|unique:groups,name'.$unique,
//            'generated_url'=>'required_with:generate_url|string|nullable',
        ];
        if (empty($inputs['generate_url'])) {
            $rules['url'] = 'required|is_url|string|max:255|unique:groups,url'.$unique;
        }
        $result = [];
        $result['validator'] = Validator::make($inputs, $rules);
        $result['inputs'] = $inputs;
        return $result;
    }
}
