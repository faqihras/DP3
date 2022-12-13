<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class GajiController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Gaji();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*',
                                DB::raw('FORMAT(gajiRupiah,2) as gajiRupiah')
                            )
                    ->leftjoin('ms_pangkat','gajiGol','=','pangkatId')
                    ->where('gajiGol','like','%'.$search.'%')
                    ->orwhere('gajiMsKerja','like','%'.$search.'%')
                    ->orwhere('gajiRupiah','like','%'.$search.'%')
                    ;
            
           return $this->getDataGrid($query);                

     }
}