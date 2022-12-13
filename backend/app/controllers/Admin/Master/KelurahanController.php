<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class KelurahanController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Kelurahan();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->leftjoin('msKec','kecId','=','kelKec')
                    ->leftjoin('msKab','kabId','=','kecKab')
                    ->leftjoin('msProv','provId','=','kabProv')
                    ->where('kelNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}