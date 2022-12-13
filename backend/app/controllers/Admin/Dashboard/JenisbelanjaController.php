<?php
namespace Admin\Dashboard;

use BasicController;
use DB;
use Lang;
use Input;

class JenisbelanjaController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         // $this->model = new \Admin\Anggaran\Rkasusun();
     }

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
       

            $ang1 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    // ->where('pegPangkat','like','1%')
                    ->get();
                    ;
            $total=$ang1[0]->angTotal;      

            $ang = DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','=','1')
                    ->get();
                    ;
            $a=$ang[0]->angTotal;

            $ang2 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','2%')
                    ->get();
                    ;
            $b=$ang2[0]->angTotal;      


          $ang3 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','3%')
                    ->get();
                    ;
            $c=$ang3[0]->angTotal;     


            $ang4 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','4%')
                    ->get();
                    ;
            $d=$ang4[0]->angTotal;    

            $ang5 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','5%')
                    ->get();
                    ;
            $e=$ang5[0]->angTotal;

             $ang6 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','6%')
                    ->get();
                    ;
            $f=$ang6[0]->angTotal;    

             $ang7 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','7%')
                    ->get();
                    ;
            $g=$ang7[0]->angTotal;    

             $ang8 = DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','8%')
                    ->get();
                    ;
            $h=$ang8[0]->angTotal;    

             $ang9 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','9%')
                    ->get();
                    ;
            $i=$ang9[0]->angTotal;     

             $ang10 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','10%')
                    ->get();
                    ;
            $j=$ang10[0]->angTotal;  

             $ang11 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','11%')
                    ->get();
                    ;
            $k=$ang11[0]->angTotal;   

             $ang12 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','12%')
                    ->get();
                    ;
            $l=$ang12[0]->angTotal;

             $ang13 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','13%')
                    ->get();
                    ;
            $m=$ang13[0]->angTotal;   

             $ang14 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','14%')
                    ->get();
                    ;
            $n=$ang14[0]->angTotal;   

             $ang15 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','15%')
                    ->get();
                    ;
            $o=$ang15[0]->angTotal; 

             $ang16 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','16%')
                    ->get();
                    ;
            $p=$ang16[0]->angTotal;   

             $ang17 =  DB::table('ms_pegawai')
                    // ->leftjoin('ms_pangkat','pegPangkat','=','pangkatKode')
                    ->select(DB::raw('count(pegPangkat) as angTotal'))
                    ->where('pegPangkat','like','17%')
                    ->get();
                    ;
            $q=$ang17[0]->angTotal;   


            if  ($total>0){
              $aa=($a);
            }
            if  ($total>0){
              $bb=($b);
            }
            if  ($total>0){
              $cc=($c);
            }
            if  ($total>0){
              $dd=($d);
            }
            if  ($total>0){
              $ee=($e);
            } 
             if  ($total>0){
              $ff=($f);
            } 
             if  ($total>0){
              $gg=($g);
            } 
             if  ($total>0){
              $hh=($h);
            } 
             if  ($total>0){
              $ii=($i);
            } 
             if  ($total>0){
              $jj=($j);
            } 
             if  ($total>0){
              $kk=($k);
            } 
             if  ($total>0){
              $ll=($l);
            } 
             if  ($total>0){
              $mm=($m);
            } 
             if  ($total>0){
              $nn=($n);
            } 
             if  ($total>0){
              $oo=($o);
            } 
             if  ($total>0){
              $pp=($p);
            } 
             if  ($total>0){
              $qq=($p);
            } 



            // $sisa=100-($persenGaji+$persenPpkd+$persenpegawai+$persenbarangj+$persenmodal+$persenkeluar);


            $res=array(
                    // array('Pegawai Esselon : 511',$aa),
                    array('Pegawai I-a',$aa),
                    array('Pegawai I-b',$bb),
                    array('Pegawai I-c',$cc),
                     array('Pegawai I-d',$dd),
                     array('Pegawai II-a',$ee),
                     array('Pegawai II-b',$ff),
                     array('Pegawai II-c',$gg),
                      array('Pegawai II-d',$hh),
                      array('Pegawai III-a',$ii),
                      array('Pegawai III-b',$jj),
                      array('Pegawai III-c',$kk),
                      array('Pegawai III-d',$ll),
                      array('Pegawai IV-a',$mm),
                      array('Pegawai IV-b',$nn),
                      array('Pegawai IV-c',$oo),
                      array('Pegawai IV-d',$pp),
                      array('Pegawai IV-e',$qq),
                );


           return $res;                

       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

}