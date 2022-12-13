<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;

class PendidikanforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Pendidikan();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('pendId as id','pendId as kode','pendNama as nama','pendNama as text')
                        ->where('pendNama','like','%'.$param['term'].'%')
                        ->where('pendId','like','%'.$param['kode'].'%')
                        ->get();

               return $query;
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}
