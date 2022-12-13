<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class TunjanganController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Tunjangan();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*',
                            DB::raw('FORMAT(tunjGaPok,2) as gaji_pokok')
                        )
                    ->leftjoin('ms_pegawai','tunjNip','=','pegNip')
                    ->where('tunjNip','like','%'.$search.'%')
                    ->where('pegNama','like','%'.$search.'%')
                    ->orderby('tunjId','desc')
                    ;
            
           return $this->getDataGrid($query);                

     }
}