<?php

namespace App\Http\Controllers\Admin;

use App\Models\EngineFilter;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EngineFiltersController extends Controller
{
    public function main(){
        $data = [];
        $data['title'] = 'Фильтры Двигателя';
        $data['items'] = EngineFilter::adminList();
        return view('admin.pages.engine_filters.main', $data);
    }

    public function add(){
        $data = ['edit'=>false];
        $data['title'] = 'Добовление фильтра двигаетеля';
        $data['back_url'] = route('admin.engine_filters.main');
        return view('admin.pages.engine_filters.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
        if(EngineFilter::action(null, $inputs)) {
            Notify::success('Фильтр добавлен.');
            return redirect()->route('admin.engine_filters.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit'=>true];
        $data['item'] = EngineFilter::getItem($id);
        $data['title'] = 'Редактирование фильтра двигателя';
        $data['back_url'] = route('admin.engine_filters.main');
        return view('admin.pages.engine_filters.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = EngineFilter::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(EngineFilter::action($item, $inputs)) {
            Notify::success('Фильтр редактирован.');
            return redirect()->route('admin.engine_filters.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function sort(){ return EngineFilter::sortable(); }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = EngineFilter::where('id',$id)->first();
            if ($item && EngineFilter::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore){
        $unique = $ignore===false?null:','.$ignore;
        return Validator::make($inputs, [
            'title' => 'required|string|max:255|unique:engine_filters,title'.$unique,
        ]);
    }
}
