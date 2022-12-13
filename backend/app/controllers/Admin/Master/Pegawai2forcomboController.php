<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;
use Session;

class Pegawai2forcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Pegawai();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';
          $param['bidang']=!empty($param['bidang'])? $param['bidang'] :'';
          $bidang =!empty($param['bidang'])? $param['bidang'] :'';
          $unit         = Session::get('unit');

           try {
            if ($unit == 0){
                 $query = DB::table($this->model->getTable())
                        ->select('pegId as id','pegNip as kode','pegNama as nama','pegNama as text')

                         // ->where('pegUnit', '=',$unit)
                        // ->where('pegUnit','like','%'.$param['term'].'%')
                        ->where('pegNama','like','%'.$param['kode'].'%')
                        // ->where('pegId','like','%'.$param['kode'].'%')
                        ->where('pegNama','like','%'.$param['term'].'%')
                        ->get();
                    }elseif($unit!=0){
                         $query = DB::table($this->model->getTable())
                        ->select('pegId as id','pegNip as kode','pegNama as nama','pegNama as text')

                         ->where('pegUnit', '=',$unit)
                        // ->where('pegUnit','like','%'.$param['term'].'%')
                        // ->where('pegNama','like','%'.$param['kode'].'%')
                        // ->where('pegId','like','%'.$param['kode'].'%')
                        ->where('pegNama','like','%'.$param['term'].'%')
                        ->get();
                    }
               

               return $query;
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}
