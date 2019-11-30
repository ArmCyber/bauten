<?php

namespace App\Http\Controllers\Admin;

use App\Models\PriceApplication;
use App\Models\User;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;

class PriceApplicationsController extends BaseController
{
    public function main(){
        $data = [
            'title' => 'Уточнении цены',
        ];
        $data['items'] = PriceApplication::adminList();
        return view('admin.pages.price_applications.main', $data);
    }

    public function view($id) {
        $data = [];
        $data['item'] = PriceApplication::getItem($id);
        $data['title'] = 'Уточнение цены N'.$data['item']->id;
        return view('admin.pages.price_applications.view', $data);
    }

    public function delete(Request $request) {
        $id = $request->id;
        $item = PriceApplication::getItem($id);
        $item->delete();
        Notify::success('Заявка удалена.');
        return redirect()->route('admin.price_applications.main');
    }

    public function userApplications($id) {
        $data = [];
        $data['user'] = User::getItem($id);
        $data['items'] = PriceApplication::getUserItems($id);
        $data['back_url'] = route('admin.users.view', ['id'=>$id]);
        $data['title'] = 'Уточнении цены пользователя "'.$data['user']->email.'"';
        return view('admin.pages.price_applications.main', $data);
    }

}
