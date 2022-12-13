<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class ProvinsiController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Provinsi();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('provNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}