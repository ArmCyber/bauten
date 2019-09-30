<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeSlide;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeSliderController extends BaseController
{
    public function main(){
        $data = ['title'=>'Главный слайдер'];
        $data['items'] = HomeSlide::adminList();
        return view('admin.pages.home_slider.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление слайда', 'edit'=>false];
        $data['back_url'] = route('admin.home_slider.main');
        return view('admin.pages.home_slider.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
        if(HomeSlide::action(null, $inputs)) {
            Notify::success('Слайд добавлен.');
            return redirect()->route('admin.home_slider.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование слайда', 'edit'=>true];
        $data['back_url'] = route('admin.home_slider.main');
        $data['item'] = HomeSlide::getItem($id);
        return view('admin.pages.home_slider.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = HomeSlide::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(HomeSlide::action($item, $inputs)) {
            Notify::success('Слайд редактирован.');
            return redirect()->route('admin.home_slider.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function sort(){return HomeSlide::sortable();}

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = HomeSlide::where('id',$id)->first();
            if ($item && HomeSlide::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $edit=false) {
        return Validator::make($inputs, [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => ($edit?'nullable':'required').'|image|mimes:jpeg,png,gif',
        ]);
    }

}
