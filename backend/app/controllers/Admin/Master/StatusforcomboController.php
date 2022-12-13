<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;

class StatusforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Status();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('stId as id','stId as kode','stNama as nama','stNama as text')
                        ->where('stNama','like','%'.$param['term'].'%')
                        ->where('stId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}