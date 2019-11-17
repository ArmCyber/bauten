<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;

class OrdersController extends BaseController
{
    public function newOrders() {
        $data = [
            'title' => 'Новые заказы',
        ];
        $data['items'] = Order::getOrdersWithStatus(Order::STATUS_NEW);
        return view('admin.pages.orders.main', $data);
    }

    public function pendingOrders() {
        $data = [
            'title' => 'Невыполненные заказы',
        ];
        $data['items'] = Order::getOrdersWithStatus(Order::STATUS_PENDING);
        return view('admin.pages.orders.main', $data);
    }

    public function doneOrders() {
        $data = [
            'title' => 'Выполненные заказы',
        ];
        $data['items'] = Order::getOrdersWithStatus(Order::STATUS_DONE);
        return view('admin.pages.orders.main', $data);
    }

    public function declinedOrders() {
        $data = [
            'title' => 'Откланенные заказы',
        ];
        $data['items'] = Order::getOrdersWithStatus(Order::STATUS_NEW);
        return view('admin.pages.orders.main', $data);
    }

    public function view($id) {
        $data = [];
        $data['item'] = Order::getItem($id);
        $data['title'] = 'Заказ N'.$data['item']->id;
        $data['process'] = Order::PROCESS;
        return view('admin.pages.orders.view', $data);
    }

    public function delete(Request $request) {
        $model = Order::getItem($request->input('id'));
        if ($model->status != Order::STATUS_NEW && $model->status != Order::STATUS_DECLINED) return redirect()->back();
        Order::deleteItem($model);
        Notify::success('Заказ удален.');
        return redirect()->route('admin.orders.'.$model->status_type);
    }

    public function respond(Request $request, $id) {
        $order = Order::getItem($id);
        if ($order->status!==Order::STATUS_NEW) return redirect()->back();
        if($request->input('status') == Order::STATUS_PENDING) {
            $newStatus = Order::STATUS_PENDING;
            $message = 'Заказ принят';
            //TODO:: QANAKNER
        }
        else {
            $newStatus = Order::STATUS_DECLINED;
            $message = 'Заяказ откланен';
        }
        $order->status = $newStatus;
        $order->save();
        Notify::success($message);
        return redirect()->back();
    }

    public function changeProcess(Request $request, $id) {
        $order = Order::getItem($id);
        if ($order->status!= Order::STATUS_PENDING) return redirect()->back();
        $process = (int) $request->input('process');
        $paid = (int) $request->has('paid');
        if ($process<0 || $process>3) return redirect()->back();
        $order->process = $process;
        $order->paid = $paid;
        if ($process == 3 && $paid) {
            $order->status = Order::STATUS_DONE;
        }
        $order->save();
        Notify::get('changes_saved');
        return redirect()->back();
    }

    public function userOrders($id, $status_type) {
        $user = User::getItem($id);
        $status = array_search($status_type, Order::STATUSES);
        if ($status===false) abort(404);
        switch($status) {
            case Order::STATUS_DECLINED: $type = 'Откланенные'; break;
            case Order::STATUS_NEW: $type = 'Новые'; break;
            case Order::STATUS_PENDING: $type = 'Невыполненные'; break;
            default: $type = 'Выполненные';
        }
        $data = [
            'title' => $type.' заказы пользователя "'.$user->email.'"',
        ];
        $data['items'] = Order::getOrdersWithStatus($status, $user->id);
        return view('admin.pages.orders.main', $data);
    }
}
