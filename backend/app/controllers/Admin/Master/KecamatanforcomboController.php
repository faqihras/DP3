<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class KecamatanforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Kecamatan();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('kecId as id','kecKode as kode','kecNama as nama','kecNama as text')
                        ->where('kecNama','like','%'.$param['term'].'%')
                        ->where(function($query) use($param){
                                    $query->where('kecId', 'like','%'.$param['kode'].'%')
                                          ->orwhere('kecKode', 'like', '%'.$param['kode'].'%');
                                })
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}