<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends BaseController
{
    public function main(){
        $data = [
            'title' => 'Панель администратора',
            'user' => Auth::user(),
            'roles' => Admin::ROLES,
        ];
        return view('admin.pages.general.main', $data);
    }

    public function soapTest(){
//        ini_set('soap.wsdl_cache_enabled', 0 );
//        ini_set('soap.wsdl_cache_ttl', 0);
//        $soap = new \SoapClient('http://78.46.18.25:88/bauten2016/ws/exchange_2_0_1_6.1cws?wsdl', [
//            'login' => "robot", //логин пользователя к базе 1С
//            'password' => "Qq123456789", //пароль пользователя к базе 1С
//            'soap_version' => SOAP_1_2, //версия SOAP
//            'cache_wsdl' => WSDL_CACHE_NONE,
//            'trace' => true,
//            'features' => SOAP_USE_XSI_ARRAY_TYPE
//        ]);
//        $r = $soap->getGoods(['uid' => 'ok']);
//        dd($r);
//        $request = post_request('http://78.46.18.25:88/bauten2016/hs/mysite/exchange/', [
/*            'body' => '<?xml version="1.0"?> <root> <UID>7504bb0c-0e2b-11e4-9b00-00259021f781</UID> <TYPE>GET_GOODS</TYPE> </root>',*/
//        ]);
//        dd($request);
    }
}
