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
         $this->model = new \Admin\Anggaran\Rkasusun();
     }

     public function index()
     {

       try {
            $query = DB::table($this->model->getTable())
                    ->select('adrkaSkpdKd',
                      DB::raw('sum('.$this->fieldAnggaran().') as adrkaNilai'),
                      DB::raw('sum(adrkaRealNilai) as adrkaRealNilai'),
                      DB::raw('sum('.$this->fieldAnggaran().'-adrkaRealNilai) as adrkaSisa'))
                    ->where('adrkaRek5Kd','like','5%')
                    ->orwhere('adrkaRek5Kd','like','62%')
                    ->groupby('adrkaSkpdKd')
                    ->get();
                    ;
            
           // return $this->getDataGrid($query);                
           return $query;                
       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

}