<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\DeliveryPoint;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryPointsController extends BaseController
{
    public function main(){
        $data = [];
        $data['items'] = DeliveryPoint::adminList();
        $data['title'] = 'Насиленные пункты';
        return view('admin.pages.delivery_points.main', $data);
    }

    public function add(){
        $data = ['edit'=>false];
        $data['countries'] = Country::adminListForDeliveryPoints();
        $data['title'] = 'Добавление насиленного пункта';
        $data['back_url'] = route('admin.delivery_points.main');
        return view('admin.pages.delivery_points.form', $data);
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
