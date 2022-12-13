<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class KelurahanforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Kelurahan();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('kelKode as id','kelKode as kode','kelNama as nama','kelNama as text')
                        ->where('kelNama','like','%'.$param['term'].'%')
                        ->where(function($query) use($param){
                                    $query->where('kelId', 'like','%'.$param['kode'].'%')
                                          ->orwhere('kelKode', 'like', '%'.$param['kode'].'%');
                                })
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}