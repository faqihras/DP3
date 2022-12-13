<?php
namespace Admin\Absensi;

use BasicController;
use DB;
use Lang;
use Input;
use Response;
use Hash;
use Eloquent;


class MobileuserController extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Master\Mobileuser();
     }


     public function index(){
          $param=Input::all();

           $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('userEmail','=',$param['userEmail'])
                    ->get();
           return $query;
     }


   public function beforeStore(){

   		$param=Input::all();
      $pass = Hash::make($param['userPassword']);
      Input::merge(array(
                  'userPassword' => $pass
                   ));

   }

   public function beforeUpdate(){
      $param=Input::all();

      if(!empty($param['userPassword'])){
        $pass = Hash::make($param['userPassword']);
        Input::merge(array(
                    'userPassword' => $pass

                     ));
      }

   }

}
