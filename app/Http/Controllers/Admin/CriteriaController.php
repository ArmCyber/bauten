<?php

namespace App\Http\Controllers\Admin;

use App\Models\Criterion;
use App\Models\Filter;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CriteriaController extends BaseController
{
    public function main($id){
        $data = [];
        $data['filter'] = Filter::getItem($id);
        $data['title'] = 'Критерии фильтра "'.$data['filter']->title.'"';
        $data['back_url'] = route('admin.filters.main', ['id'=>$data['filter']->group_id]);
        $data['items'] = $data['filter']->criteria;
        return view('admin.pages.criteria.main', $data);
    }

    public function add($id){
        $data = ['edit'=>false];
        $data['filter'] = Filter::getItem($id);
        $data['title'] = 'Добовление критерий фильтра "'.$data['filter']->title.'"';
        $data['back_url'] = route('admin.criteria.main', ['id'=>$data['filter']->id]);
        return view('admin.pages.criteria.form', $data);
    }

    public function add_put($id, Request $request){
        $filter = Filter::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $filter->id, false)->validate();
        if(Criterion::action(null, $inputs, $filter->id)) {
            Notify::success('Критерий добавлен.');
            return redirect()->route('admin.criteria.main', ['id'=>$filter->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['edit' => true];
        $data['item'] = Criterion::getItem($id);
        $data['filter'] = $data['item']->filter;
        $data['title'] = 'Редактирование критерий фильтра "'.$data['filter']->title.'"';
        $data['back_url'] = route('admin.criteria.main', ['id'=>$data['filter']->id]);
        return view('admin.pages.criteria.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Criterion::getItem($id);
        $filter = $item->filter;
        $inputs = $request->all();
        $this->validator($inputs, $filter->id, $item->id)->validate();
        if(Criterion::action($item, $inputs)) {
            Notify::success('Критерий редактирован.');
            return redirect()->route('admin.criteria.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function sort(){ return Criterion::sortable(); }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Filter::where('id',$id)->first();
            if ($item && Filter::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $filter_id, $ignore){
        return Validator::make($inputs, [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('criteria')->where(function($q) use ($filter_id, $ignore){
                    if ($ignore) $q->where('id', '<>', $ignore);
                    return $q->where('filter_id', $filter_id);
                })
            ],
        ]);
    }
}