<?php 


namespace App\API;


class ApiMessage{
    public function setMessage($type,$message, $code){
        return [
            'data'=>[
                $type => $message,
                'code_interno' => $code
            ]
        ];
    }
}