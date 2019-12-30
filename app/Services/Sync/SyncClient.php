<?php

namespace App\Services\Sync;

class SyncClient {

    private function getUrl(){
        return 'http://78.46.18.25:88/bauten2016/hs/mysite/exchange/';
    }

    private function getAccessCode(){
        return '7504bb0c-0e2b-11e4-9b00-00259021f781';
    }

    private function sendRequest($content){
        $options = [
            'http' => [
                'header'  => "Content-type: application/xml\r\n",
                'method'  => 'POST',
                'content' => $content,
            ],
        ];
        try {
            return simplexml_load_string(file_get_contents($this->getUrl(), false, stream_context_create($options)));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function get_goods(){
        $result = $this->sendRequest('<?xml version="1.0"?><root><UID>'.$this->getAccessCode().'</UID><TYPE>GET_GOODS</TYPE></root>');
        if (!$result) ['success' => false, 'error'=>'Сервер 1с не отвечает.'];
        if(($result->ACSESS??null)=='ACSESS DENIED') return ['success' => false, 'error'=>'Неправильный код доступа.'];
        $result['success'] = true;
        return $result;
    }
}

