<?php
namespace Agape\Support;

use Illuminate\Support\Facades\Response as IResponse;
use Agape\Support\StatusMessage as AMessage;

class Response extends IResponse
{
    public static function json($data = array(), $status = 200, array $headers = array(), $options = 0){
        $default = array(
            "status" => array(
                "error" => 0,
                "errorCode" => 0,
                "message" => ''
            )
        );
        
        if(isset($data['status'])){
            if(!isset($data['status']["error"])){
                $data['status']["error"] = $default['status']["error"];
            }
            if(!isset($data['status']["errorCode"])){
                $data['status']["errorCode"] = $default['status']["errorCode"];
            }
            if(!isset($data['status']["message"])){
                $data['status']["message"] = $default['status']["message"];
            }
        } else {
            $data = array_merge($data, $default);
        }

        return $data;
    }
    
    public static function exception($message = null){
        $default = array(
            "status" => array(
                "error" => 1,
                "errorCode" => 0,
                "message" => $message
            ),
        );
        return $default;
    }
    
    public static function message($id = 0, $message = null){
        $msg = new AMessage();
        $default = array(
            "status" => array(
                "error" => ($id <= 100) ? 0 : 1,
                "errorCode" => $id,
                "message" => ($message) ? $message : $msg->get($id)
            )
        );
        return $default;
    }
    
}

