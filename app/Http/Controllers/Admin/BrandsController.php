<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BrandsController extends Controller
{
    public function main(){
        $data = ['title'=>'Бренды'];
        $data['items'] = Brand::adminList();
        return view('admin.pages.brands.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление бренда', 'edit'=>false];
        $data['back_url'] = route('admin.brands.main');
        return view('admin.pages.brands.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
        if(Brand::action(null, $inputs)) {
            Notify::success('Бренд добавлен.');
            return redirect()->route('admin.brands.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование бренда', 'edit'=>true];
        $data['back_url'] = route('admin.brands.main');
        $data['item'] = Brand::getItem($id);
        return view('admin.pages.brands.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Brand::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(Brand::action($item, $inputs)) {
            Notify::success('Бренд редактирован.');
            return redirect()->route('admin.brands.edit', ['id'=>$item->id]);
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
            $item = Brand::where('id',$id)->first();
            if ($item && Brand::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    public function sort() { return Brand::sortable(); }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'name' => 'nullable|string|max:255',
            'code' => 'required|string|max:255|unique:parts,code'.($ignore?','.$ignore:null),
            'image' => 'nullable|image|mimes:jpeg,png,gif,svg'
        ]);
    }}
