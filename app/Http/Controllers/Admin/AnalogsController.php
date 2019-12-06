<?php

namespace App\Http\Controllers\Admin;

use App\Models\Analog;
use App\Models\Part;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AnalogsController extends BaseController
{
    public function main($id){
        $data = [];
        $data['part'] = Part::getItem($id);
        $data['title'] = 'Аналоги запчаста "'.$data['part']->name.'"';
        $data['items'] = $data['part']->analogs;
        return view('admin.pages.parts.analogs', $data);
    }

    public function add(Request $request, $id) {
        $part = Part::getItem($id);
        $request->validate([
            'brand' => 'required|string|max:255',
            'number' => [
                'required',
                'string',
                'max:255',
//                Rule::unique('analogs')->where('part_id', $id)->where('brand', $request->input('brand')),
            ],
        ], [
            'number.unique' => 'Аналог уже существует'
        ], [
            'brand' => 'Производитель',
            'number' => 'Номер',
        ]);
        $model = new Analog;
        $model['part_id'] = $part->id;
        $model['brand'] = $request->input('brand');
        $model['number'] = $request->input('number');
        $model['sort'] = $model->sortValue();
        $model->save();
        Notify::success('Аналог добавлен.');
        return redirect()->back();
    }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Analog::where('id',$id)->first();
            if ($item && Analog::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    public function sort() {
        return Analog::sortable();
    }
}
