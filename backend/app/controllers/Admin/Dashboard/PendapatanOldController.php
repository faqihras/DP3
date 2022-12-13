<?php
namespace Admin\Dashboard;

use BasicController;
use DB;
use Lang;
use Input;

class PendapatanController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Anggaran\Rkasusun();
     }

     public function index()
     {

       try {

            $res=array();

            $query = DB::table($this->model->getTable())
                    ->select('adrkaSkpdKd',
                      DB::raw('sum('.$this->fieldAnggaran().') as adrkaNilai'),
                      DB::raw('sum(adrkaRealNilai) as adrkaRealNilai'),
                      DB::raw('sum('.$this->fieldAnggaran().'-adrkaRealNilai) as adrkaSisa'))
                    ->where('adrkaRek5Kd','like','4%')
                    ->orwhere('adrkaRek5Kd','like','61%')
                    ->groupby('adrkaSkpdKd')
                    ->get();
                    ;

            $skpd=array();  
            $anggaran=array();  
            $realisasi=array();  
            $sisa=array();  
            foreach ($query as $val) {
                $skpd[]=$val->adrkaSkpdKd;
                $anggaran[]=($val->adrkaNilai)*1;
                $realisasi[]=($val->adrkaRealNilai)*1;
                $sisa[]=($val->adrkaSisa)*1;
            }

            $seriesdata=array(
                  array(
                      "name" => "Anggaran",
                      "data" => $anggaran,
                    ),
                  array(
                      "name" => "Realisasi",
                      "data" => $realisasi,
                    ),
                  array(
                      "name" => "Sisa",
                      "data" => $sisa,
                    ),

              );

            $res['skpd']=$skpd;
            $res['data']=$seriesdata;

           return $res;                

       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

}