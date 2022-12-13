<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class AgamaController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Agama();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('agamaNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}