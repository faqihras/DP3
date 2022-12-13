<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;

class PegawaiforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Mobileuser();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('userId as id','userId as kode','userName as nama','userName as text')
                        ->where('userName','like','%'.$param['term'].'%')
                        ->where('userId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();

               return $query;
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}
