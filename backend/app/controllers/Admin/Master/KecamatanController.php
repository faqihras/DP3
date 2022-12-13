<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class KecamatanController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Kecamatan();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->leftjoin('msKab','kabId','=','kecKab')
                    ->leftjoin('msProv','provId','=','kabProv')
                    ->where('kecNama','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}