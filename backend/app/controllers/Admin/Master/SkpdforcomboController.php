<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class SkpdforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Skpd();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('instId as id','instId as kode','instNama as nama','instNama as text')
                        ->where('instNama','like','%'.$param['term'].'%')
                        ->where('instId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}