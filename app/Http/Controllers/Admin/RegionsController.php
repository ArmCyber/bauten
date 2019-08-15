<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Region;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegionsController extends BaseController
{
    public function main($id){
        $data = [];
        $data['country'] = Country::getItem($id);
        $data['items'] = $data['country']->regions;
        $data['title'] = 'Области страны "'.$data['country']->title.'"';
        $data['back_url'] = route('admin.countries.main');
        return view('admin.pages.regions.main', $data);
    }

    public function add($id){
        $data = ['edit'=>false];
        $data['country'] = Country::getItem($id);
        $data['title'] = 'Добавление области страны "'.$data['country']->title.'"';
        $data['back_url'] = route('admin.regions.main', ['id'=>$data['country']->id]);
        return view('admin.pages.regions.form', $data);
    }

    public function add_put($id, Request $request){
        $country = Country::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $country->id)->validate();
        $inputs['country_id'] = $country->id;
        if(Region::action(null, $inputs)) {
            Notify::success('Область добавлена.');
            return redirect()->route('admin.regions.main', ['id'=>$country->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit'=>true];
        $data['item'] = Region::getItem($id);
        $data['country'] = $data['item']->country;
        $data['title'] = 'Редактирование области "'.$data['item']->title.'"';
        $data['back_url'] = route('admin.regions.main', ['id'=>$data['country']->id]);
        return view('admin.pages.regions.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Region::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->country->id, $item->id)->validate();
        $inputs['country_id'] = $item->country->id;
        if(Region::action($item, $inputs)) {
            Notify::success('Область редактирована.');
            return redirect()->route('admin.regions.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }
    
    public function sort() { return Region::sortable(); }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Region::where('id',$id)->first();
            if ($item && Region::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    public function validator($inputs, $country, $ignore = false){
        $unique = Rule::unique('regions')->where(function($q) use ($country){
            return $q->where('country_id', $country);
        });
        if ($ignore) $unique->ignore($country);
        return Validator::make($inputs, [
            'title' => [
                'required',
                'string',
                'max:255',
                $unique,
            ]
        ]);
    }
}
