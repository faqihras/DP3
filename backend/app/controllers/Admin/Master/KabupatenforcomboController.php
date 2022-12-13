<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class KabupatenforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Kabupaten();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('kabId as id','kabKode as kode','kabNama as nama','kabNama as text')
                        ->where('kabNama','like','%'.$param['term'].'%')
                        ->where(function($query) use($param){
                                    $query->where('kabId', 'like','%'.$param['kode'].'%')
                                          ->orwhere('kabKode', 'like', '%'.$param['kode'].'%');
                                })
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}