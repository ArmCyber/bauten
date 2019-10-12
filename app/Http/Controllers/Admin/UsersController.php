<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function main(){
        $data = ['title'=>'Клиентская база'];
        $data['items'] = User::adminList();
        return view('admin.pages.users.main', $data);
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
