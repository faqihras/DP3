<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class UnitforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Unit();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';
          

           try {
                $query = DB::table($this->model->getTable())
                        ->select('satkerId as id','satkerId as kode','satkerNama as nama','satkerNama as text')
                        ->where('satkerNama','like','%'.$param['term'].'%')
                        ->where('satkerId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}