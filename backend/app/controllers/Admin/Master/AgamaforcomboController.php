<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class AgamaforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Agama();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('agamaId as id','agamaId as kode','agamaNama as nama','agamaNama as text')
                        ->where('agamaNama','like','%'.$param['term'].'%')
                        ->where('agamaId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}