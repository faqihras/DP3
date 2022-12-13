<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class JabatanforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Jabatan();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('jabId as id','jabId as kode','jabNama as nama','jabNama as text')
                        ->where('jabNama','like','%'.$param['term'].'%')
                        //->where('jabId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}