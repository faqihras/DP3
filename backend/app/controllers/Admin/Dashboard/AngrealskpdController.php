<?php
namespace Admin\Dashboard;

use BasicController;
use DB;
use Lang;
use Input;

class AngrealskpdController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Master\Pegawai();
     }

     public function index()
     {

       try {
            $query = DB::table('ms_pegawai')
                    ->leftjoin('ms_eselon','pegEselon','=','eselonKd')
                    ->select(DB::raw('sum(pegEselon) as angTotal'))
                    ->where('pegEselon','like','2%')
                    ->get();
                    ;
           // return $this->getDataGrid($query);                
           return $query;                
       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

}