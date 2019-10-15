<?php

namespace App\Http\Controllers\Admin;

use App\Models\EngineCriterion;
use App\Models\EngineFilter;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EngineCriteriaController extends BaseController
{
    public function main($id){
        $data = [];
        $data['filter'] = EngineFilter::getItem($id);
        $data['title'] = 'Критерии фильтра двигателя "'.$data['filter']->title.'"';
        $data['back_url'] = route('admin.engine_filters.main');
        $data['items'] = $data['filter']->criteria;
        return view('admin.pages.engine_criteria.main', $data);
    }

    public function add($id){
        $data = ['edit'=>false];
        $data['filter'] = EngineFilter::getItem($id);
        $data['title'] = 'Добовление критерий фильтра двигателя "'.$data['filter']->title.'"';
        $data['back_url'] = route('admin.engine_criteria.main', ['id'=>$data['filter']->id]);
        return view('admin.pages.engine_criteria.form', $data);
    }

    public function add_put($id, Request $request){
        $filter = EngineFilter::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $filter->id, false)->validate();
        if(EngineCriterion::action(null, $inputs, $filter->id)) {
            Notify::success('Критерий добавлен.');
            return redirect()->route('admin.engine_criteria.main', ['id'=>$filter->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit' => true];
        $data['item'] = EngineCriterion::getItem($id);
        $data['filter'] = $data['item']->filter;
        $data['title'] = 'Редактирование критерий фильтра двигателя "'.$data['filter']->title.'"';
        $data['back_url'] = route('admin.engine_criteria.main', ['id'=>$data['filter']->id]);
        return view('admin.pages.engine_criteria.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = EngineCriterion::getItem($id);
        $filter = $item->filter;
        $inputs = $request->all();
        $this->validator($inputs, $filter->id, $item->id)->validate();
        if(EngineCriterion::action($item, $inputs)) {
            Notify::success('Критерий редактирован.');
            return redirect()->route('admin.engine_criteria.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function sort(){ return EngineCriterion::sortable(); }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = EngineCriterion::where('id',$id)->first();
            if ($item && EngineCriterion::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $filter_id, $ignore){
        return Validator::make($inputs, [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('engine_criteria')->where(function($q) use ($filter_id, $ignore){
                    if ($ignore) $q->where('id', '<>', $ignore);
                    return $q->where('engine_filter_id', $filter_id);
                })
            ],
        ]);
    }
}
