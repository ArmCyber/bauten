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

    private function validator($inputs, $edit=false) {
        return Validator::make($inputs, [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => ($edit?'nullable':'required').'|image|mimes:jpeg,png,gif',
            'image_alt' => 'nullable|string|max:255',
            'image_title' => 'nullable|string|max:255',
        ]);
    }

}
