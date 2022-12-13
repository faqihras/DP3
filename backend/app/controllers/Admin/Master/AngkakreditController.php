<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class AngkakreditController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Angkakredit();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*',
                            DB::raw('FORMAT(akKredit,3) as AngkaKredit')
                        )
                    ->where('akNamaKegiatan','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}