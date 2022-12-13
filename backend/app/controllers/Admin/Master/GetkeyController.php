<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;

class GetkeyController extends BasicController {
     // public function __construct() {
     //     $this->model = new Pegawai();
     // }
     public function index(){
        $param=Input::all();        
        $user=!empty($param['user']) ? $param['user']:'';

        $client = new \GuzzleHttp\Client;
        // $response = $client->get('http://192.168.147.50/appRegister/backend/public/api/admin/master/register?user='.$user, []);
        $response = $client->get('optimasolution.co.id/appRegister/backend/public/api/admin/master/register?user='.$user, []);
        $response = json_decode($response->getBody(), true);

        return $response[0]['regKey'];     
     }
}