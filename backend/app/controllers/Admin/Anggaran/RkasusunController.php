<?php
namespace Admin\Anggaran;

use BasicController;
use DB;
use Lang;
use Input;

class RkasusunController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Rkasusun();
     }
     public function index()
     {
     	 $param=Input::all();        
       $search=!empty($param['search']['value']) ? $param['search']['value'] : '' ;
       $kdskpd=!empty($param['kdskpd']) ? $param['kdskpd'] : '';
       $kdkeg =!empty($param['kdkeg']) ? $param['kdkeg'] : '';
       //$search='';

       try {
            $query = DB::table($this->model->getTable())
                    ->select('adrkaId','adrkaRek5Kd','adrkaRek5Nm',
                      DB::raw('FORMAT(adrkaNilai,2) as adrkaNilai'),
                      DB::raw('FORMAT(adrkaRevisi1,2) as adrkaRevisi1'),
                      DB::raw('FORMAT(adrkaRevisi2,2) as adrkaRevisi2'),
                      DB::raw('FORMAT(adrkaNilaiUbah,2) as adrkaNilaiUbah'))
                    ->where('adrkaRek5Nm','like','%'.$search.'%')
                    ->where('adrkaSkpdKd','=',$kdskpd)
                    ->where('adrkaKegKd','=',$kdkeg)
                    ->orderby('adrkaRek5Kd','ASC');
                    ;
            
           return $this->getDataGrid($query);                
       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

   public function beforeStore(){
        $param     =Input::all();        
        $kdskpd    =$param['adrkaSkpdKd'];
        $kdurusan  =substr($kdskpd,0,4);

        $kdkegiatan=$param['adrkaKegKd'];
        $kdprogram =substr($kdkegiatan,0,strlen($kdkegiatan)-3);

        $kdrek=$param['adrkaRek5Kd'];

        $kdgab =$kdurusan.'.'.$kdkegiatan;

        Input::merge(array(
                            'adrkaKdGab' => $kdgab,
                          ));
   }

   public function beforeUpdate(){

        $param     =Input::all();        
        $adrkaNilai=!empty($param['adrkaNilai'])?$param['adrkaNilai']:0;
        $adrkaNilai=str_replace(",", "", $adrkaNilai);

        $adrkaRevisi1=!empty($param['adrkaRevisi1'])?$param['adrkaRevisi1']:0;
        $adrkaRevisi1=str_replace(",", "", $adrkaRevisi1);

        $adrkaNilaiUbah=!empty($param['adrkaNilaiUbah'])?$param['adrkaNilaiUbah']:$adrkaNilai;
        $adrkaNilaiUbah=str_replace(",", "", $adrkaNilaiUbah);

        $adrkaRevisi2=!empty($param['adrkaRevisi2'])?$param['adrkaRevisi2']:0;
        $adrkaRevisi2=str_replace(",", "", $adrkaRevisi2);

        Input::merge(array(
                            'adrkaNilai' => $adrkaNilai,
                            // 'adrkaRevisi1' => $adrkaRevisi1,
                            // 'adrkaNilaiUbah' => $adrkaNilaiUbah,
                            // 'adrkaRevisi2' => $adrkaRevisi2,
                            'adrkaRevisi1' => $adrkaNilai,
                            'adrkaNilaiUbah' => $adrkaNilai,
                            'adrkaRevisi2' => $adrkaNilai,
                          ));
   }

}