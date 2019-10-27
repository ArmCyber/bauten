<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Администраторы'];
        $data['items'] = Admin::adminList();
        $data['roles'] = Admin::ROLES;
        return view('admin.pages.admins.main', $data);
    }

    public function add(){
        $data = ['title'=>'Регистрация администратора', 'edit'=>false];
        $data['back_url'] = route('admin.admins.main');
        $data['roles'] = Admin::getAvailableRoles();
        return view('admin.pages.admins.form', $data);
    }

    public function add_put(Request $request){
        $inputs = $request->all();
        $this->validator($inputs)->validate();
        if(Admin::action(null, $inputs)) {
            Notify::success('Администратор зарегистрирован.');
            return redirect()->route('admin.admins.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование профиля администратора', 'edit'=>true];
        $data['back_url'] = route('admin.admins.main');
        $data['item'] = Admin::getItem($id);
        $data['roles'] = Admin::getAvailableRoles($id);
        return view('admin.pages.admins.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Admin::getItem($id);
        $inputs = $request->all();
        $this->validator($inputs, $item->id)->validate();
        if(Admin::action($item, $inputs)) {
            Notify::success('Профиль администратора редактирован.');
            return redirect()->route('admin.admins.edit', ['id'=>$item->id]);
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
            $item = Admin::where('id',$id)->where('role', '<', 4)->first();
            if ($item && Admin::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($inputs, $ignore=false) {
        $unique = $ignore?','.$ignore:null;
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|mail|max:255|unique:admins,email'.$unique,
            'phone'=>'required|string|max:255|phone|unique:admins,phone'.$unique,
            'role' => ['required', 'integer', 'between:1,'.Auth::user()->role],
            'password' => ($ignore?'nullable':'required').'|string|min:8|confirmed',
        ];
        if ($inputs['role']==config('roles.manager')) {
            $rules['code'] = 'required|string|max:255|unique:admins,code'.$unique;
        }
        elseif ($inputs['role']==config('roles.senior_manager')) {
            $rules['role'][] = 'unique:admins,role'.$unique;
        }
        return Validator::make($inputs, $rules,[
            'role.*' => 'Выберите роль.',
        ], [
            'code' => 'Уникальный ID',
        ]);
    }
}
