<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class EselonController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Eselon();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('eselonKd','like','%'.$search.'%')
                    ->orwhere('eselonNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}