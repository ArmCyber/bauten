<?php

namespace App\Http\Controllers\Admin;

use App\Models\PartnerGroup;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartnerGroupsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Группы партнеров'];
        $data['items'] = PartnerGroup::adminList();
        return view('admin.pages.partner_groups.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление группы партнеров', 'edit'=>false];
        $data['back_url'] = route('admin.partner_groups.main');
        return view('admin.pages.partner_groups.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(PartnerGroup::action(null, $inputs)) {
            Notify::success('Группа партнеров добавлена.');
            return redirect()->route('admin.partner_groups.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование Года', 'edit'=>true];
        $data['back_url'] = route('admin.partner_groups.main');
        $data['item'] = PartnerGroup::getItem($id);
        return view('admin.pages.partner_groups.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = PartnerGroup::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(PartnerGroup::action($item, $inputs)) {
            Notify::success('Группа партнеров редактирован.');
            return redirect()->route('admin.partner_groups.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request) {
        $id = $request->input('id');
        $move = $request->input('move');
        $item = PartnerGroup::withCount('users')->find($id);
        if (!$item) {
            Notify::get('error_occurred');
            return redirect()->back();
        }
        if ($item->users_count!=0) {
            $new_group = PartnerGroup::find($move);
            if (!$new_group || $new_group->id == $item->id) {
                Notify::get('error_occurred');
                return redirect()->back();
            }
        }
        if (PartnerGroup::deleteItem($item, $new_group->id??null)) {
            Notify::success('Группа партнеров удалена');
            return redirect()->route('admin.partner_groups.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back();
        }
    }

    private function validator($inputs, $ignore=false) {
        return Validator::make($inputs, [
            'title' => 'required|string|max:255|unique:partner_groups,title'.($ignore?','.$ignore:null),
            'sale' => 'required|numeric|min:0|max:100|unique:partner_groups,sale'.($ignore?','.$ignore:null),
            'terms' => 'nullable|string',
        ]);
    }
}
