<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mark;
use App\Models\Modification;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModificationsController extends BaseController
{
    public function main(){
        $data = [];
        $data['items'] = Modification::adminList();
        $data['title'] = 'Модификации';
        return view('admin.pages.modifications.main', $data);
    }

    public function add(){
        $data = ['edit'=>false];
        $data['title'] = 'Добавление модификации';
        $data['back_url'] = route('admin.modifications.main');
        $data['marks'] = Mark::fullAdminList();
        if (!count($data['marks'])) {
            Notify::error('У вас нет кузовов');
            return redirect()->back();
        }
        return view('admin.pages.modifications.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Modification::action(null, $inputs)) {
            Notify::success('Модификация добавлена.');
            return redirect()->route('admin.modifications.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit'=>true];
        $data['item'] = Modification::getItem($id);
        $data['title'] = 'Редактирование модификации';
        $data['back_url'] = route('admin.modifications.main');
        $data['marks'] = Mark::fullAdminList();
        return view('admin.pages.modifications.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Modification::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(Modification::action($item, $inputs)) {
            Notify::success('Модификация редактирован.');
            return redirect()->route('admin.modifications.edit', ['id'=>$item->id]);
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
            $item = Modification::where('id',$id)->first();
            if ($item && Modification::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore=null) {
        $unique = $ignore===false?null:','.$ignore;
        return Validator::make($inputs, [
            'cid' => 'required|integer|digits_between:1,255|unique:modifications,cid'.$unique,
            'generation_id' => 'required|integer|exists:generations,id',
        ]);
    }
}
