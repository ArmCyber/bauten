<?php

namespace App\Http\Controllers\Admin;

use App\Models\PartCatalog;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PartCatalogsController extends Controller
{
    public function main(){
        $data = ['title'=>'Каталог запчастей'];
        $data['items'] = PartCatalog::adminList();
        return view('admin.pages.part_catalogs.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление каталога запчастей', 'edit'=>false];
        $data['back_url'] = route('admin.part_catalogs.main');
        return view('admin.pages.part_catalogs.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
        if(PartCatalog::action(null, $inputs)) {
            Notify::success('Каталог запчастей добавлен.');
            return redirect()->route('admin.part_catalogs.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование каталога запчастей', 'edit'=>true];
        $data['back_url'] = route('admin.part_catalogs.main');
        $data['item'] = PartCatalog::getItem($id);
        return view('admin.pages.part_catalogs.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = PartCatalog::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(PartCatalog::action($item, $inputs)) {
            Notify::success('Каталог запчастей редактирован.');
            return redirect()->route('admin.part_catalogs.edit', ['id'=>$item->id]);
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
            $item = PartCatalog::where('id',$id)->first();
            if ($item && PartCatalog::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'name' => 'required|string|max:255|unique:part_catalogs,name'.($ignore?','.$ignore:null),
        ]);
    }
}
