<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;

class OrdersController extends BaseController
{
    public function pending() {
        $data = [
            'title' => 'Заказы в ожидании',
        ];
        $data['items'] = Order::getPendingOrders();
        return view('admin.pages.orders.main', $data);
    }

    public function view($id) {
        $data = [];
        $data['item'] = Order::getItem($id);
        $data['title'] = 'Заказ N'.$data['item']->id;
        return view('admin.pages.orders.view', $data);
    }

    public function delete(Request $request) {
        $model = Order::getItem($request->input('id'));
        Order::deleteItem($model);
        Notify::success('Заказ удален.');
        return redirect()->route('admin.orders.'.$model->status_type);
    }
}
