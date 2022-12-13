<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;

class Pegawai3forcomboController extends BasicController {
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

           try {
                $query = DB::table($this->model->getTable())
                        ->select('pegId as id','pegNip as kode','pegNama as nama','pegNama as text')
                        ->where('pegNama','like','%'.$param['term'].'%')
                        // ->where(function ($q, $param) {
                        //       $q->where('pegId','like','%'.$param['kode'].'%')
                        //         ->orwhere('pegNip','like','%'.$param['kode'].'%');
                        //   })
                        ->where('pegNip','like','%'.$param['kode'].'%')
                        // ->where('pegId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();

               return $query;
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}
