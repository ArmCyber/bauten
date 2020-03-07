<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\InsertOrUpdate;
use App\Models\Admin;
use App\Models\DeliveryCity;
use App\Models\Order;
use App\Models\OrderPart;
use App\Models\Part;
use App\Models\User;
use App\Services\Sync\Sync;
use App\Services\Sync\SyncClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Location;
use Spatie\ArrayToXml\ArrayToXml;
use Zakhayko\Banners\Models\Banner;

class AppController extends BaseController
{
    use InsertOrUpdate;
    public function main(){
//        dd(Cache::get('request_test'));
        $data = [
            'title' => 'Панель администратора',
            'user' => Auth::user(),
            'roles' => Admin::ROLES,
        ];
        return view('admin.pages.general.main', $data);
    }

    public function soapForCron(){
//        Cache::forget('count');
//        dd(1);

        if(Cache::get('count') ===null){

            Cache::put('count',0);
        }else{
            Cache::put('count', ((int) Cache::get('count')+1));
        }
        $count=Cache::get('count');
        $goods= Sync::get_goods();
        $insert_parts=[];
        $items= Part::pluck('ref')->toArray();
        dump($count);
        for ($i=$count*2000;$i<=($count*2000)+2000;$i++){
            if($i == (int) count($goods->good)){
                Part::insertOrUpdate($insert_parts, ['price','available']);
                Cache::forget('count');
                dump(count($insert_parts));
                exit();
            }
            if(in_array($goods->good[$i]['UID'],$items)){

                $insert_parts[] = [
                    'ref' => (string) $goods->good[$i]['UID'],
                    'price' => (int) $goods->good[$i]['Price'],
                    'available' =>  (int) $goods->good[$i]['Qty'],
                ];
            }

        }
        Part::insertOrUpdate($insert_parts, ['price','available']);
        return redirect('/soap/sync/1c/allPriority/getByRef');

    }
    public function soapFromSite(){
//        Cache::forget('count_forSite');
//        dd(1);

        if(Cache::get('count_forSite') ===null){

            Cache::put('count_forSite',0);
        }else{
            Cache::put('count_forSite', ((int) Cache::get('count_forSite')+1));
        }
        $count=Cache::get('count_forSite');
        $goods= Sync::get_goods();
        $insert_parts=[];
        $items= Part::pluck('ref')->toArray();
        dump('Пожалуйста Подождите');
        for ($i=$count*2000;$i<=($count*2000)+2000;$i++){
            if($i == (int) count($goods->good)){
                dump('Синхронизация завершена');
                Part::insertOrUpdate($insert_parts, ['price','available']);
                Cache::forget('count_forSite');
                return redirect()->route('admin.pages.main');
            }
            if(in_array($goods->good[$i]['UID'],$items)){

                $insert_parts[] = [
                    'ref' => (string) $goods->good[$i]['UID'],
                    'price' => (int) $goods->good[$i]['Price'],
                    'available' =>  (int) $goods->good[$i]['Qty'],
                ];
            }

        }
        Part::insertOrUpdate($insert_parts, ['price','available']);
        return redirect('/soap/sync/1c/allPriority/getByRef/fromSite');

    }
    public function checking(Request $request){
        $request= json_decode($request->getContent());
//        Cache::put('test_request', serialize($request));
//        DB::table('test')->insert(
//            ['request' =>simplexml_load_string($request)]
//        );
//        return \GuzzleHttp\json_encode($request);

//        $request='{
//                    "UID": "08cb3cb8-4d6a-11ea-912c-b42e996a7753",
//                    "DocType": "\u0420\u0435\u0430\u043b\u0438\u0437\u0430\u0446\u0438\u044f \u0442\u043e\u0432\u0430\u0440\u043e\u0432 \u0438 \u0443\u0441\u043b\u0443\u0433",
//                    "DocDate": "2012-10-21T23:03:56Z",
//                    "DocNumder": "00000000003",
//                    "DocStatus": "ACCEPTED",
//                    "Goods": [
//                    {
//                    "GoodID": "07ca1453-9b46-11e4-b22a-0002c9e8f1b0",
//                    "Qty": 1,
//                    "Price": 1030
//                    },
//                    {
//                    "GoodID": "07ca1457-9b46-11e4-b22a-0002c9e8f1b0",
//                    "Qty": 2,
//                    "Price": 1545
//                    }
//
//                    ]
//                    }
//                ';
//            $request2 = json_decode($request);

//            $static_ip = Banner::getBanners('profile')->first()[0]['data'];
//            if ($static_ip == $request->IP){
                if($request->DocStatus=='ACCEPTED'){
                    $order=Order::where('order_ref',$request->UID)->with('parts')->firstOrFail();
                    //        $sync=new SyncClient();
                    $last_parts_ids=[];
                    $all_sum = 0;
                    $sale_sum = 0;
                    $real_sum = 0;
                    if( !empty($request->Goods) && count($request->Goods)){

                        foreach ($request->Goods as $item){
                            $current_part=Part::where('ref',(string) $item->GoodID)->first()->id;
                            $current_part_for_order=Part::where('ref',(string) $item->GoodID)->first();
                            if (OrderPart::where(['part_id' => $current_part,'order_id'=>$order->id])->exists()){
                                $orderPart=OrderPart::where(['part_id' => $current_part,'order_id'=>$order->id])->first();
                            }else{
                                $orderPart = new OrderPart();
                                $orderPart->order_id=$order->id;
                                $orderPart->part_id=$current_part;
                                $orderPart->name=$current_part_for_order->name;
                                $orderPart->code=$current_part_for_order->code;
                                $orderPart->price=$current_part_for_order->price;
                                $orderPart->changed_count='new';
                            }
                            $user = User::where('id',$order->user_id)->firstOrFail();


                            if(!empty($current_part) && !empty($orderPart)){
                                array_push($last_parts_ids,$current_part);

                                $sum = ( (int) $item->Qty *  (int) $item->Price) ;

                                if ($current_part_for_order->count_sale_count && $current_part_for_order->count_sale_percent && (int)$item->Qty>=$current_part_for_order->count_sale_count) {
                                    $sum = $sum*(1 - $current_part_for_order->count_sale_percent/100);
                                }
                                elseif ($user->sale) {
                                    $sale_sum += $sum*$user->sale/100;
                                }
                                $all_sum+=$sum;

                                $real_sum = $all_sum;
                                if ($sale_sum) {
                                    $all_sum-=$sale_sum;
                                }
                                if($orderPart->changed_count !='new'){
                                    $orderPart->changed_count=null;
                                    if((int)$item->Qty !=  $orderPart->count){
                                        $orderPart->changed_count = $orderPart->count;
                                    }
                                }

                                $orderPart->count =  (int)$item->Qty;
                                $orderPart->sum= $sum ;
//                            $total+=$orderPart->sum;
                                $orderPart->save();
                            }
                        }

                    }

                    $total=$all_sum;
                    if(!empty($order->city_id)){
                        $city = DeliveryCity::getItem($order->city_id);
                        $city_delivery_price = $city->price;
                        $total = $all_sum + ($city_delivery_price??0);
                    }
                    $order->sum=$all_sum;
                    $order->real_sum=$real_sum;
                    $order->total=$total;
                    $order->status=Order::STATUS_PENDING;
                    $order->process=Order::PROCESS[1];
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

                    $last_order_parts=OrderPart::whereNotIn('part_id',$last_parts_ids)->where('order_id',$order->id)->get();
                    foreach ($last_order_parts as $part){

                        $part->changed_count=$part->count;
                        $part->count=0;
                        $orderPart->sum= 0;
                        $part->save();
                    }

//                    $deleteParts=OrderPart::whereNotIn('part_id',$last_parts_ids)->where('order_id',$order->id)->update(['count',0]);

                    return 'Успешная корректировка заказа';
                }elseif ($request->DocStatus=='DELETED'){
                    $order=Order::where('order_ref',$request->UID)->with('parts')->firstOrFail();
                    $order->status=Order::STATUS_DECLINED;
                    $order->save();
                    return 'Order Deleted';
//                    abort(419);
                }

                return 'Ответ поступил с проблемами';
//                abort(500);
//
//            }
//            return "Auth error. Invalid IP address";
    }
}
