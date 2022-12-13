<?php
namespace Admin\Master;
use BasicController;
use DB;
use Lang;
use Input;

class PegawaiController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Pegawai();
     }
     public function index(){
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';

            $query = DB::table($this->model->getTable())
                    ->select('*')
                   ->leftjoin('ms_satuankerja','satkerId','=','pegUnit')
                   ->leftjoin('ms_instansi','instId','=','pegId')
                    ->where('pegNama','like','%'.$search.'%')
                    ->orderby('pegId','asc')
                    ;
            
           return $this->getDataGrid($query);                

     }
      public function reversdate($tanggal){
        if((substr($tanggal, 2,1)=='/') or (substr($tanggal, 1,1)=='/')){
            $a=explode("/",$tanggal);
            $result=$a[2].'-'.$a[0].'-'.$a[1];
        }else{
            $a=explode("-",$tanggal);
            $result=$a[2].'-'.$a[1].'-'.$a[0];
        }
        return $result;
     }
}