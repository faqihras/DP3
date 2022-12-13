<?php
namespace Admin\Dashboard;

use BasicController;
use DB;
use Lang;
use Input;

class RekapController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Master\Pegawai();
     }

     public function index()
     {

       try {

            $res=array();

            $ang1 = DB::table('ms_instansi')
                    // ->leftjoin('ms_eselon','pegEselon','=','eselonKd')
                    ->select(DB::raw('count(instId) as angTotal'))
                    // ->where('pegEselon','like','2%')
                    ->get();
                    ;
            $angTotal=$ang1[0]->angTotal;   

             $ang2 = DB::table('ms_satuankerja')
                    // ->leftjoin('ms_eselon','pegEselon','=','eselonKd')
                    ->select(DB::raw('count(satkerId) as satTotal'))
                    // ->where('pegEselon','like','2%')
                    ->get();
                    ;
            $unitTotal=$ang2[0]->satTotal; 

            $ang3 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_eselon','pegEselon','=','eselonKd')
                    ->select(DB::raw('count(pegId) as pegTotal'))
                    ->where('pegJab','like','1%')
                    ->get();
                    ;
            $pegawaiTotal=$ang3[0]->pegTotal;   

            $ang4 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_eselon','pegEselon','=','eselonKd')
                    ->select(DB::raw('count(pegId) as pegTotal1'))
                    ->where('pegJab','like','2%')
                    ->get();
                    ;
            $pegawaiTotal1=$ang4[0]->pegTotal1;    
            // $realTotal=$ang1[0]->realTotal;        
            // $sisabelanja=$angTotal-$realTotal;        

            // $ang2 = DB::table('ms_satuankerja')
            //          ->select(DB::raw('count(satkerId) as angTotal1'))
            //         ->get();
            //         ;
            // $xangTotal=$ang2[0]->angTotal;        
            // $xrealTotal=$ang2[0]->realTotal;        
            // $xsisadapat=$angTotal-$realTotal;        

            $res=array(
                  'belanja'=>number_format($angTotal),
                  // 'rbelanja'=>number_format($realTotal),
                  // 'sbelanja'=>number_format($sisabelanja),
                  'pendapatan'=>number_format($unitTotal),
                  'pegawai'=>number_format($pegawaiTotal),
                  'nonpegawai'=>number_format($pegawaiTotal1),
                  // 'rpendapatan'=>number_format($xrealTotal),
                  // 'spendapatan'=>number_format($xsisadapat),
              );


           return $res;                

       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

}