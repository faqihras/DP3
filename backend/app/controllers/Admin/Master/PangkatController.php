<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class PangkatController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Pangkat();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('pangkatKode','like','%'.$search.'%')
                    ->orwhere('pangkatNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}