<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends BaseController
{
    public function main(){
        $data = ['title'=>'Страны'];
        $data['items'] = Country::adminList();
        return view('admin.pages.countries.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление страны', 'edit'=>false];
        $data['back_url'] = route('admin.countries.main');
        return view('admin.pages.countries.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
        if(Country::action(null, $inputs)) {
            Notify::success('Страна добавлена.');
            return redirect()->route('admin.countries.main');
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
        $inputs = $request->all();
//        $this->validator($inputs, $item->id)->validate();
        if(Mark::action($item, $inputs)) {
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

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'title' => 'required|string|unique:countries,title'.($ignore?','.$ignore:null)
        ]);
    }
}
