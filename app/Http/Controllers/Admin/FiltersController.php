<?php

namespace App\Http\Controllers\Admin;

use App\Models\Filter;
use App\Models\Group;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FiltersController extends BaseController
{
    public function main($id=null){
        $data = [];
        if ($id) {
            $data['group'] = Group::getItem($id);
            $data['back_url'] = route('admin.groups.main');
        }
        $data['title'] = $id?'Фильтры группы "'.$data['group']->name.'"':'Глобальные фильтры';
        $data['items'] = Filter::adminList($id);
        return view('admin.pages.filters.main', $data);
    }

    public function add($id=null){
        $data = ['edit'=>false];
        if ($id) $data['group'] = Group::getItem($id);
        $data['title'] = $id?'Добовление фильтра группы "'.$data['group']->name.'"':'Добовление глобального фильтра';
        $data['back_url'] = route('admin.filters.main', ['id'=>$id]);
        return view('admin.pages.filters.form', $data);
    }

    public function add_put(Request $request, $id=null){
        if ($id) $group = Group::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
        if(Filter::action(null, $inputs, $id)) {
            Notify::success('Фильтр добавлен.');
            return redirect()->route('admin.filters.main', ['id'=>$id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit'=>true];
        $data['item'] = Filter::getItem($id);
        $data['group'] = $data['item']->group;
        $data['title'] = $data['group']?'Редактирование фильтра группы "'.$data['group']->name.'"':'Редактирование глобального фильтра';
        $data['back_url'] = route('admin.filters.main', ['id'=>$data['group']->id??null]);
        return view('admin.pages.filters.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Filter::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(Filter::action($item, $inputs)) {
            Notify::success('Фильтр редактирован.');
            return redirect()->route('admin.filters.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function sort(){ return Filter::sortable(); }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Filter::where('id',$id)->first();
            if ($item && Filter::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore){
        $unique = $ignore===false?null:','.$ignore;
        return Validator::make($inputs, [
//            'title' => 'required|string|max:255|unique:filters,title'.$unique,
            'title' => 'required|string|max:255',
        ]);
    }
}
