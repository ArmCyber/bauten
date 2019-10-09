<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YearsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Годы'];
        $data['items'] = Year::adminList();
        return view('admin.pages.years.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление года', 'edit'=>false];
        $data['back_url'] = route('admin.years.main');
        return view('admin.pages.years.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Year::action(null, $inputs)) {
            Notify::success('Год добавлен.');
            return redirect()->route('admin.years.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование Года', 'edit'=>true];
        $data['back_url'] = route('admin.years.main');
        $data['item'] = Year::getItem($id);
        return view('admin.pages.years.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Year::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(Year::action($item, $inputs)) {
            Notify::success('Год редактирован.');
            return redirect()->route('admin.years.edit', ['id'=>$item->id]);
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
            $item = Year::where('id',$id)->first();
            if ($item && Year::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'year' => 'required|numeric|min:1800|max:3000|unique:years,year'.($ignore?','.$ignore:null),
        ]);
    }
}
