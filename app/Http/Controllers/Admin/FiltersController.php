<?php

namespace App\Http\Controllers\Admin;

use App\Models\Filter;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FiltersController extends Controller
{
    public function main(){
        $data = ['title'=>'Глобальные фильтры'];
        $data['items'] = Filter::adminList();
        return view('admin.pages.filters.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добовление глобального фильтра', 'edit'=>false];
        $data['back_url'] = route('admin.filters.main');
        $data['types'] = Filter::TYPES;
        return view('admin.pages.filters.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs, false)->validate();
        if(Filter::action(null, $inputs)) {
            Notify::success('Фильтр добавлен.');
            return redirect()->route('admin.filters.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    private function validator($inputs, $ignore){
        $unique = $ignore===false?null:','.$ignore;
        return Validator::make($inputs, [
            'name' => 'required|string|max:255|unique:part_catalogs,name'.$unique,
            'type' => [
                'required',
                'string',
//                function($attribute, $value, $fail){
//                    if (!in_array($value)) $fail('Неправильный текуший пароль');
//                }
            ]
        ]);
    }
}
