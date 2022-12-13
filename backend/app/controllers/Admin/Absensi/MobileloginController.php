<?php
namespace Admin\Absensi;

use BasicController;
use DB;
use Lang;
use Input;
use Response;
use Hash;
use Eloquent;


class MobileloginController extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Master\Mobileuser();
     }


     public function index(){
          $param=Input::all();
          $pass = $param['userPassword'];

           $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('userEmail','=',$param['userEmail'])
                    ->orwhere('userName','=',$param['userEmail'])
                    ->get();
           if(count($query)>0){
               $data = $query[0];
               if(!Hash::check($pass, $data->userPassword)){
                  return array();
               }else{
                  return $query;
               }
           }else{
                  return array();
           }
     }

}
