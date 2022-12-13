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
     // public function __construct() {
     //     $this->model = new \Admin\Anggaran\Rkasusun();
     // }

     public function index()
     {

       try {

             $res=array(); 
 
            // $ang1 = DB::table('ms_pegawai')
            //         ->leftjoin('msjenis','mappRekLra','=','msjenisKd')
            //         ->select('mappRekLra','msjenisNm',DB::raw('sum(mapNilaiTrans) as angTotal'))
            //         ->where('mappRekLra','like','5%')
            //         ->orwhere('mappRekLra','like','62%')
            //         ->get();
            //         ;
            // $total=$ang1[0]->angTotal; 
       

            // $ang1 = DB::table('ms_pegawai')
            //         ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
            //         ->select(DB::raw('count(pegUnit) as angTotal'))
            //         // ->where('pegUnit','like','1%')
            //         ->get();
            //         ;
            // $='angTotal';      

            $ang = DB::table('ms_pegawai')
                    ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal1'))
                    ->where('pegUnit','like','1%')
                    ->get();
                    ;
            $a=$ang;

            $ang2 = DB::table('ms_pegawai')
                    ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal2'))
                    ->where('pegUnit','like','2%')
                    ->get();
                    ;
            $b=$ang2;      


          $ang3 = DB::table('ms_pegawai')
                    ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal3'))
                    ->where('pegUnit','like','3%')
                    ->get();
                    ;
            $c=$ang3;     


            $ang4 = DB::table('ms_pegawai')
                    ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal4'))
                    ->where('pegUnit','like','4%')
                    ->get();
                    ;
            $d=$ang4;    

            $ang5 = DB::table('ms_pegawai')
                    ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal5'))
                    ->where('pegUnit','like','5%')
                    ->get();
                    ;
            $e=$ang5;

             $ang6 = DB::table('ms_pegawai')
                    ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal6'))
                    ->where('pegUnit','like','6%')
                    ->get();
                    ;
            $f=$ang6;    

             $ang7 = DB::table('ms_pegawai')
                    ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal7'))
                    ->where('pegUnit','like','7%')
                    ->get();
                    ;
            $g=$ang7;    

             $ang8 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal8'))
                    ->where('pegUnit','like','8%')
                    ->get();
                    ;
            $h=$ang8;    

             $ang9 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal9'))
                    ->where('pegUnit','like','9%')
                    ->get();
                    ;
            $i=$ang9;

            $ang10 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal10'))
                    ->where('pegUnit','like','10%')
                    ->get();
                    ;
            $j=$ang10;

            $ang11 = DB::table('ms_pegawai')
                  // ->leftjoin('ms_satuankerja','pegUnit','=','satkerId')
                    ->select(DB::raw('count(pegUnit) as angTotal11'))
                    ->where('pegUnit','like','11%')
                    ->get();
                    ;
            $k=$ang11;
        


             
            // if  ($total>0){
            //   $aa=($a/$total)*100;
            // }
            // if  ($total>0){
            //   $bb=($b/$total)*100;
            // }
            // if  ($total>0){
            //   $cc=($c/$total)*100;
            // }
            // if  ($total>0){
            //   $dd=($d/$total)*100;
            // }
            // if  ($total>0){
            //   $ee=($e/$total)*100;
            // } 
            //  if  ($total>0){
            //   $ff=($f/$total)*100;
            // } 
            //  if  ($total>0){
            //   $gg=($g/$total)*100;
            // } 
            //  if  ($total>0){
            //   $hh=($h/$total)*100;
            // } 
            //  if  ($total>0){
            //   $ii=($i/$total)*100;
            // } 


             foreach ($ang as $val) {
               
                $nilai1[]=($val->angTotal1)*1;
                
            }
             foreach ($ang2 as $val) {
               
                $nilai2[]=($val->angTotal2)*1;
                
            }
             foreach ($ang3 as $val) {
               
                $nilai3[]=($val->angTotal3)*1;
                
            }
              foreach ($ang4 as $val) {
               
                $nilai4[]=($val->angTotal4)*1;
                
            }
             foreach ($ang5 as $val) {
               
                $nilai5[]=($val->angTotal5)*1;
                
            }

            foreach ($ang6 as $val) {
               
                $nilai6[]=($val->angTotal6)*1;
               
            }

             foreach ($ang7 as $val) {
                
                $nilai7[]=($val->angTotal7)*1;
               
            }

            //  foreach ($ang8 as $val) {
                
            //     $nilai8[]=($val->angTotal8)*1;
               
            // }

            //  foreach ($ang9 as $val) {
                
            //     $nilai9[]=($val->angTotal9)*1;
               
            // }

            //  foreach ($ang10 as $val) {
                
            //     $nilai10[]=($val->angTotal10)*1;
               
            // }

            //  foreach ($ang11 as $val) {
                
            //     $nilai11[]=($val->angTotal11)*1;
               
            // }

            // foreach ($ang7 as $val) {
            //     // $skpd[]=$val->adrkaSkpdKd;
            //     // $anggaran[]=($val->adrkaNilai)*1;
            //     // $realisasi[]=($val->adrkaRealNilai)*1;
            //     // $sisa[]=($val->adrkaSisa)*1;
            //     // $nilai[]=($val->angTotal1)*1;
            //     $nilai3[]=($val->angTotal7)*1;
            //     // $tgl[]=($val->trmTglSts)*1;
            //     // $ok[]=$val->trmTglSts;
            // }

            // foreach ($ang5 as $val) {
            //     // $skpd[]=$val->adrkaSkpdKd;
            //     // $anggaran[]=($val->adrkaNilai)*1;
            //     // $realisasi[]=($val->adrkaRealNilai)*1;
            //     // $sisa[]=($val->adrkaSisa)*1;
            //     // $nilai[]=($val->angTotal1)*1;
            //     $nilai1[]=($val->angTotal5)*1;
            //     // $tgl[]=($val->trmTglSts)*1;
            //     // $ok[]=$val->trmTglSts;
            // }
            // $sisa=100-($persenGaji+$persenPpkd+$persenpegawai+$persenbarangj+$persenmodal+$persenkeluar);

            $skpd=array();  
            $seriesdata=array(
                    // array('Pegawai Esselon : 511',$aa),
                   array(
                      "name" => "KB Yaa Bunayaa",
                      "data" => $nilai1,
                    ),
                   array(
                      "name" => "TK Yaa Bunayaa",
                      "data" => $nilai2,
                    ),
                    array(
                      "name" => "SDIT Luqman Al Hakim Reguler",
                      "data" => $nilai3,
                    ),
                     array(
                      "name" => "SDIT Luqman Al Hakim Tahfizh",
                      "data" => $nilai4,
                    ),
                    array(
                      "name" => "SMPII Luqman Al Hakim",
                      "data" => $nilai5,
                    ),array(
                      "name" => "SMK Luqman Al Hakim",
                      "data" => $nilai6,
                    ),array(
                      "name" => "Pesantren",
                      "data" => $nilai7,
                    ),
                    // array(
                    //   "name" => "III-B",
                    //   "data" => $nilai6,
                    // ),
                    // array(
                    //   "name" => "III-A",
                    //   "data" => $nilai7,
                    // ),
                    // array(
                    //   "name" => "II-B",
                    //   "data" => $nilai8,
                    // ),
                    // array(
                    //   "name" => "II-A",
                    //   "data" => $nilai9,
                    // ),

                    // array(
                    //   "name" => "I-B",
                    //   "data" => $nilai10,
                    // ),
                    // array(
                    //   "name" => "I-A",
                    //   "data" => $nilai11,
                    // ),
                );
              $res['data']=$seriesdata;
              $res['skpd']=$skpd;

           return $res;                

       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

}