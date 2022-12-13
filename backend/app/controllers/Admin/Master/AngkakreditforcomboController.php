<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class AngkakreditforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Angkakredit();
     }

     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('akId as id','akId as kode','akNamaKegiatan as nama','akNamaKegiatan as text','akKredit')
                        ->where('akNamaKegiatan','like','%'.$param['term'].'%')
                        ->where('akId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}