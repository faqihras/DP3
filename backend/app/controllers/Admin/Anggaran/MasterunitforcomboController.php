<?php
namespace Admin\Anggaran;

use BasicController;
use DB;
use Lang;
use Response;
use Input;

class MasterunitforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Master\Unit();
     }

     public function index(){
      $param=Input::all();
      $param['term']=!empty($param['term'])? $param['term'] :'';
      $param['kode']=!empty($param['kode'])? $param['kode'] :'';


       try {
            $query = DB::table($this->model->getTable())
                    // ->select('msuKdSkpd as id','msuKode as kode','msuNama as nama',
                    //           DB::raw('concat(msuKode," | ",msuNama) as text'))
                    // // ->leftjoin('msskpd','msuKdSkpd','=','skpdKd')
                    // ->where('msuNama','like','%'.$param['term'].'%')
                    // ->orwhere('msuKode','like',$param['term'].'%')
                    // ->limit(100)
                    // ->get();

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
