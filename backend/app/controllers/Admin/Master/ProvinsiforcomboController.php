<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class ProvinsiforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Provinsi();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('provKode as id','provKode as kode','provNama as nama','provNama as text')
                        ->where('provNama','like','%'.$param['term'].'%')
                        ->where('provKode','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}