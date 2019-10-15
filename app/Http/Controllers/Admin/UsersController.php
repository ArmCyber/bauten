<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
    public function main(){
        $data = ['title'=>'Клиентская база'];
        $data['items'] = User::adminList();
        $data['types'] = User::getTypes();
        return view('admin.pages.users.main', $data);
    }

    public function view($id){
        $data = [];
        $data['item'] = User::getItem($id);
        $data['managers'] = Admin::getManagers();
        $data['title'] = 'Пользователь "'.$data['item']->email.'"';
        $data['back_url'] = route('admin.users.main');
        return view('admin.pages.users.view', $data);
    }

    public function changeManager(Request $request) {
        $user = User::getItem($request->input('id'));
        $manager_id = $request->input('manager_id');
        if ($manager_id) {
            $manager_exists = Admin::managerExists($manager_id);
        } else $manager_id = null;
        if (isset($manager_exists) && $manager_exists===false ) {
            Notify::error('Менеджер не найден.');
        }
        else {
            $user->manager_id = $manager_id;
            $user->save();
            Notify::get('changes_saved');
        }
        return redirect()->route('admin.users.view', ['id'=>$user->id]);
    }

    public function changeStatus(Request $request) {
        $user = User::getItem($request->input('id'));
        $user->status = $request->input('status')==1?1:0;
        $user->save();
        Notify::get('changes_saved');
        return redirect()->route('admin.users.view', ['id'=>$user->id]);
    }
//    public function delete(Request $request) {
//        $result = ['success'=>false];
//        $id = $request->input('item_id');
//        if ($id && is_id($id)) {
//            $item = User::where('id',$id)->where('role', '<', 4)->first();
//            if ($item && User::deleteItem($item)) $result['success'] = true;
//        }
//        return response()->json($result);
//    }
}
