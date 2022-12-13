<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class AreaController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Area();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('areaNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}