<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Models\Order;
use App\Models\Part;
use App\Models\User;
use App\Services\Notify\Facades\Notify;
use App\Services\Sync\SyncClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Spatie\ArrayToXml\ArrayToXml;

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
        public function exportOrder($id){
        $order=Order::where('id',$id)->firstOrFail();
        $orderName='order-'.$id.'-'.$order->created_at->format('d-m-Y').'.xlsx';
            return \Maatwebsite\Excel\Facades\Excel::download(new OrderExport($id),$orderName );
        }
    public function Pending1cOrders() {


        $data = [
            'title' => 'Заказы ожидаюшие потверждения 1С',
        ];
        $data['items'] = Order::getOrdersWithStatus(Order::STATUS_PENDING_1C);
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
        $data['items'] = Order::getOrdersWithStatus(Order::STATUS_DECLINED);
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

        $user=User::where('id',$order->user_id)->first();
            $date=implode('T',explode(' ',Carbon::now()->toDateTimeString()));
            $arrayToxml=[];
            $arrayToxml['UID']='7504bb0c-0e2b-11e4-9b00-00259021f781';
            $arrayToxml['TYPE']='CREATE_ORDER';
            $arrayToxml['ORDER']=[
                'ORDER_ID'=>$order->id,
                'DATA'=>$date,
                'USER_REF'=>$user->ref,
                'TOTAL'=>$order->sum,
                'KOMMENT'=>$order->comment??'NO COMMENT',
            ];
            $products=[];
            $total=0;
            foreach ($order->order_parts as $part){
                $ref= Part::where('id',$part->part_id)->firstOrFail();
                array_push($products,['PRODUCT_ID'=>$ref->ref,'COUNT'=>$part->count,'PRICE'=>$part->price]);
            }
            $arrayToxml['ORDER']['PRODUCTS']['PRODUCT']=$products;
            $response=ArrayToXml::convert($arrayToxml) ;
            $sync=new SyncClient();
            $result=$sync->set_order($response);
        if(!$result){
                $order = Order::getItem($order->id);
                    $order->status = Order::STATUS_DECLINED;
                    $order->save();
                    return redirect()->route('admin.orders.declined');
            }else{
                $order_ref = (string) $result->ORDER_REF;
//                $check=$sync->check_order($order_ref);
                $order =Order::where('id',$order->id)->first();
                $order->order_ref=$order_ref;
                $order->status=Order::STATUS_PENDING_1C;
//                $check=$sync->check_order($order_ref);
            }
            $message = 'Заказ принят';
            $order->order_parts->load('part');
            foreach($order->order_parts as $order_part) {
                if ($order_part->part) {
                    $new_count = $order_part->part->available - $order_part->count;
                    if ($new_count<0) $new_count = 0;
                    $order_part->part->available = $new_count;
                    $order_part->part->save();
                }
            }
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

