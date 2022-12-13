<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class UnitController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Unit();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->leftjoin('ms_instansi','satkerSkpd','=','instId')
                    ->where('satkerNama','like','%'.$search.'%')
                    ->where('instNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}