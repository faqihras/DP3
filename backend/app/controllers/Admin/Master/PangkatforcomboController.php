<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class PangkatforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Pangkat();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('pangkatId as id','pangkatId as kode','pangkatNama as nama',
                              DB::raw('CONCAT(pangkatKode," --> ",pangkatNama) as text')
                            )
                        ->where(function($query) use($param){
                                    $query->where('pangkatNama', 'like','%'.$param['term'].'%')
                                          ->orwhere('pangkatKode', 'like', '%'.$param['term'].'%');
                                })
                        // ->where('pangkatNama','like','%'.$param['term'].'%')
                        ->where('pangkatId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}