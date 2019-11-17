<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use App\Models\User;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;

class ApplicationsController extends BaseController
{
    public function main(){
        $data = [
            'title' => 'Заявки',
        ];
        $data['items'] = Application::adminList();
        return view('admin.pages.applications.main', $data);
    }

    public function view($id) {
        $data = [];
        $data['item'] = Application::getItem($id);
        $data['title'] = 'Заявка N'.$data['item']->id;
        return view('admin.pages.applications.view', $data);
    }

    public function delete(Request $request) {
        $id = $request->id;
        $item = Application::getItem($id);
        $item->delete();
        Notify::success('Заявка удалена.');
        return redirect()->route('admin.applications.main');
    }

    public function userApplications($id) {
        $data = [];
        $data['user'] = User::getItem($id);
        $data['items'] = Application::getUserItems($id);
        $data['back_url'] = route('admin.users.view', ['id'=>$id]);
        $data['title'] = 'Заявки пользователя "'.$data['user']->email.'"';
        return view('admin.pages.applications.main', $data);
    }
}
