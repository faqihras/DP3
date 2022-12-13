<?php
namespace Admin\Master;

use BasicController;
use DB;
use Lang;
use Input;
use Useradmin;

class UserforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Config\Adminuser();
     }
     public function index(){
          $param=Input::all();
          $param['term']=!empty($param['term'])? $param['term'] :'';
          $param['kode']=!empty($param['kode'])? $param['kode'] :'';

           try {
                $query = DB::table($this->model->getTable())
                        ->select('ausrId as id','ausrId as kode','ausrUsername as nama','ausrUsername as text')
                        ->where('ausrUsername','like','%'.$param['term'].'%')
                        ->where('ausrId','like','%'.$param['kode'].'%')
                        ->limit(100)
                        ->get();
                
               return $query;                
           }catch(Exception $e){
               return Response::exception($e);
           }

     }
}