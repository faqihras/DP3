<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class PendidikanController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Pendidikan();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('pendKode','like','%'.$search.'%')
                    ->orwhere('pendNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}