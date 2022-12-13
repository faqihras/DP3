<?php
namespace Admin\Tool;

use BasicController;
use DB;
use Lang;
use Input;

class Prosesmapping2Controller extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Anggaran\Rkasusun();
     }
     public function index(){
       $param=Input::all();        

       try {
            DB::table('mappreal')->truncate();
            $queryjukredit = DB::table('tukdju')
                    ->select(DB::raw('CONCAT("1.02.01") AS adrkaSkpdKd'),
                      DB::raw('CONCAT(" ") AS adrkaKegKd'),
                        'klrRekKredit AS adrkaRek5Kd',
                      DB::raw('concat("") as rkaNilai')
                      ,'klrNoJU as nomor'
                    )
                    ->wherein('klrRekKredit',['8230401','8210408','8141804'])
                    ->groupby('klrRekKredit')
                    ;

            $queryjudebet = DB::table('tukdju')
                    ->select(DB::raw('CONCAT("1.02.01") AS adrkaSkpdKd'),
                      DB::raw('CONCAT("") AS adrkaKegKd'),
                        'klrRekDebet AS adrkaRek5Kd',
                      DB::raw('concat("") as rkaNilai')
                      ,'klrNoJU as nomor'
                    )
                    ->wherein('klrRekDebet',['5210101','5210102','5210106','5210104','5210108','5210204','5210301','5210302','5210202','5220401','5221502','5222103','5222102','9120309','5220102','5222005','9130103','5234906'])
                    ->groupby('klrRekDebet')
                    ;
            $pembayarankredit = DB::table('tukdju')
                    ->select(DB::raw('CONCAT("1.02.01") AS adrkaSkpdKd'),
                      DB::raw('CONCAT("A") AS adrkaKegKd'),
                        'klrRekKredit AS adrkaRek5Kd',
                      DB::raw('concat("") as rkaNilai')
                      ,'klrNoJU as nomor'
                    )
                    ->wherein('klrRekKredit',['2210102'])
                    ->groupby('klrRekKredit')
                    ;
            $pembayarandebet = DB::table('tukdju')
                    ->select(DB::raw('CONCAT("1.02.01") AS adrkaSkpdKd'),
                      DB::raw('CONCAT("B") AS adrkaKegKd'),
                        'klrRekDebet AS adrkaRek5Kd',
                      DB::raw('concat("") as rkaNilai')
                      ,'klrNoJU as nomor'
                    )
                    ->wherein('klrRekDebet',['2210102'])
                    ->groupby('klrRekDebet')
                    ;

            $query = DB::table($this->model->getTable())
                    ->select('adrkaSkpdKd','adrkaKegKd','adrkaRek5Kd',$this->fieldAnggaran().' as rkaNilai'
                      ,DB::raw('concat("") as nomor')
                    )
                    ->orderby('adrkaSkpdKd','asc')
                    ->orderby('adrkaKegKd','asc')
                    ->orderby('adrkaRek5Kd','asc')
                    ->union($queryjukredit)
                    ->union($queryjudebet)
                    ->union($pembayarankredit)
                    ->union($pembayarandebet)
                    ->get();

            foreach ($query as $key => $val) {
                if ($val->adrkaRek5Kd == '5233401') {
                  if ($val->adrkaKegKd == '1.02.01.02.34.94') {
                    $nreal=$this->realKeluarMap2($val->adrkaRek5Kd);
                  }else{
                    $nreal = 0;
                  }
                }else 
                if(substr($val->adrkaRek5Kd, 0,1)=='5' || substr($val->adrkaRek5Kd, 0,2)=='62'){
                      // $sisa=$this->realSisaMap($val->adrkaSkpdKd,$val->adrkaKegKd,$val->adrkaRek5Kd);
                      // $nreal=$this->realKeluarMap($val->adrkaSkpdKd,$val->adrkaKegKd,$val->adrkaRek5Kd)-$sisa;
                  if ($val->adrkaKegKd != '') {
                      $nreal=$this->realKeluarMap($val->adrkaSkpdKd,$val->adrkaKegKd,$val->adrkaRek5Kd);
                  }else{
                      $nreal = $this->sumkdebet($val->adrkaRek5Kd);                   
                  }
                }
                elseif(substr($val->adrkaRek5Kd, 0,1)=='8'){
                  if (substr($val->adrkaRek5Kd, 0,2)=='81') {
                    $nreal=$this->sumkredit($val->adrkaRek5Kd,0,1);
                  }else{
                    $nreal=$this->sumkredit($val->adrkaRek5Kd,0,2);
                  }
                }elseif(substr($val->adrkaRek5Kd, 0,1)=='9'){
                      $nreal = $this->sumkdebet($val->adrkaRek5Kd);
                }elseif(substr($val->adrkaRek5Kd, 0,1)=='2'){
                  if ($val->adrkaKegKd=='A') {
                    $nreal = $this->sumkreditA($val->adrkaRek5Kd);
                  }else{
                    $nreal = $this->sumkreditB($val->adrkaRek5Kd);
                  }
                }else{
                      $nreal=$this->realMasukMap($val->adrkaSkpdKd,$val->adrkaKegKd,$val->adrkaRek5Kd)+$this->koreksipendapatan($val->adrkaRek5Kd);              
                }        
                $mapp=new \Admin\Tool\Mappreal();
                $mapp->mappSkpdKd=$val->adrkaSkpdKd;
                $mapp->mappKegKd=$val->adrkaKegKd;
                $mapp->mappRekLra=$val->adrkaRek5Kd;
                $mapp->mappRekLo=$this->getRek64($val->adrkaRek5Kd);
                $mapp->mapNilaiAng=$val->rkaNilai;
                $mapp->mapNilaiTrans=!empty($nreal)? $nreal : 0;
                $mapp->save();        
            }                    


            $this->hitPotongan();

            return 1;
       }catch(Exception $e){
           return Response::exception($e);
       }    
     }


     public function hitPotongan(){
          $lsmasukpot  = DB::table('tukdkeluardetailpot')
                  ->select(DB::raw('concat("in") as jenis'),'klrDetRek5Kd','klrDetNilai')
                  ->leftjoin('tukdkeluar','klrId','=','klrDetHeadId')
                  ->where('klrNoKas','<>','')
                  ->where('klrDetNilai','>',0)
                  ->where('klrJnsSPP','=','LS')
                  ->where('klrTglKas','<>','')
                  ->where('klrTglKas','<>','0000-00-00')
                  ;

           $lskeluarpot  = DB::table('tukdkeluardetailpot')
                  ->select(DB::raw('concat("out") as jenis'),'klrDetRek5Kd','klrDetNilai')
                  ->leftjoin('tukdkeluar','klrId','=','klrDetHeadId')
                  ->where('klrNoKas','<>','')
                  ->where('klrDetNilai','>',0)
                  ->where('klrJnsSPP','=','LS')
                  ->where('klrTglKas','<>','')
                  ->where('klrTglKas','<>','0000-00-00')
                  ;


           $lspajakmasuk  = DB::table('tukdbendaharapotongan')
                  ->select(DB::raw('concat("in") as jenis'),'klrDetRek5Kd','klrDetNilai')
                  ->leftjoin('tukdbendahara','klrId','=','klrDetHeadId')
                  ->where('klrTglSPP','<>','')
                  ->where('klrTglSPP','<>','0000-00-00')
                  ;

           $queryjukredit = DB::table('tukdju')
                  ->select(DB::raw('concat("in") as jenis'),'klrRekKredit AS klrDetRek5Kd','klrNilaiKredit as klrDetNilai')
                  ->where('klrRekKredit','=','8141804')
                  ->where('klrOtomatis','=','0')
                  ->where('klrTglJU','<>','0000-00-00')
                  ;

           $queryjudebet = DB::table('tukdju')
                  ->select(DB::raw('concat("out") as jenis'),'klrRekDebet AS klrDetRek5Kd','klrNilaiDebet as klrDetNilai')
                  ->where('klrRekDebet','=','9130103')
                  ->where('klrOtomatis','=','0')
                  ->where('klrTglJU','<>','0000-00-00')
                  ;

           $pajak  = DB::table('tukdbendaharapotongan')
                  ->select(DB::raw('concat("out") as jenis'),'klrDetRek5Kd','klrDetNilai')
                  ->leftjoin('tukdbendahara','klrId','=','klrDetHeadId')
                  ->where('klrTglSetorPot','<>','')
                  ->where('klrTglSetorPot','<>','0000-00-00')
                  ->unionall($lsmasukpot)
                  ->unionall($lskeluarpot)
                  ->unionall($lspajakmasuk)
                  ->unionall($queryjukredit)
                  ->unionall($queryjudebet)
                  ->get()
                  ;

            DB::table('mapprealpot')->truncate();
           
           foreach($pajak as $key=>$val){
                $jenis=$val->jenis;

                if($jenis=='in'){
                  $in=$val->klrDetNilai;
                  $out=0;
                }else{
                  $out=$val->klrDetNilai;
                  $in=0;                
                }
                  $mapp=new \Admin\Tool\Mapprealpot();
                  $mapp->mappRekPot=$val->klrDetRek5Kd;
                  $mapp->mapNilaiIn=$in;
                  $mapp->mapNilaiOut=$out;
                  $mapp->save();        

           }

     }


     public function getRek64($rek){

            $query = DB::table('msrincianobjek')
                    ->select('robj64Kd')
                    ->where('robjKd','=',$rek)
                    ->limit(1)
                    ->get(); 

           return !empty($query[0]->robj64Kd)?$query[0]->robj64Kd:'xxxxxxx';

     }

     public function sumkreditA($rek){

          $kredit = DB::table('tukdju')
              ->select(DB::raw('sum(klrNilaiKredit) as nilaikredit'))
              ->where('klrRekKredit','=',$rek)
              ->where('klrNoJU','NOT LIKE','%SA%')
              ->get();

          return $kredit[0]->nilaikredit;
      }

      public function sumkreditB($rek){

          $debet = DB::table('tukdju')
              ->select(DB::raw('sum(klrNilaiDebet) as nilaidebet'))
              ->where('klrRekDebet','=',$rek)
              ->where('klrNoJU','NOT LIKE','%SA%')
              ->get();

          return $debet[0]->nilaidebet;
      }

    public function sumkredit($rek,$oto,$kode){

          $debet = DB::table('tukdju')
              ->select(DB::raw('sum(klrNilaiDebet) as nilaidebet'))
              ->where('klrRekDebet','=',$rek)
              ->where('klrOtomatis','=',$oto)
              ->get();
          $kredit = DB::table('tukdju')
              ->select(DB::raw('sum(klrNilaiKredit) as nilaikredit'))
              ->where('klrRekKredit','=',$rek)
              ->where('klrOtomatis','=',$oto)
              ->get();
          if ($kode == '2') {
            return $kredit[0]->nilaikredit - $debet[0]->nilaidebet;
          }else{
            return $kredit[0]->nilaikredit ;
          }
      }

    public function sumkdebet($rek){

        $debet = DB::table('tukdju')
            ->select(DB::raw('sum(klrNilaiDebet) as nilaidebet'))
            ->where('klrRekDebet','=',$rek)
            ->get();
        $kredit = DB::table('tukdju')
            ->select(DB::raw('sum(klrNilaiKredit) as nilaikredit'))
            ->where('klrRekKredit','=',$rek)
            ->get();

        return $debet[0]->nilaidebet - $kredit[0]->nilaikredit;
    }


   public function realSisaMap($skpd,$keg,$rek){

           $sisa = DB::table('tukdterimacpdetail')
                    ->select(DB::raw('sum(trmDetNilai) as realNilai'))
                    ->leftjoin('tukdterimacp','trmNoSts','=','trmDetNoSts')
                    ->leftjoin('msrincianobjek','robjKd','=','trmDetRek5Kd')
                    ->where('trmDetSkpdKd','=',$skpd)
                    ->where('trmDetKegKd','=',$keg)
                    ->where('trmDetRek5Kd','=',$rek)
                    ->get()
                    ;
            $res=!empty($qr[0]->realNilai)?$qr[0]->realNilai:0;

            return $res;
   }  



   public function realMasukMap($skpd,$keg,$rek){

            $qr = DB::table('tukdterima')
                    ->select(DB::raw('sum(trmNilai) as realNilai'))
                    ->leftjoin('tukdterimadetail','trmNoSts','=','trmDetNoSts')
                    // ->where('trmDetSkpdKd','=',$skpd)
                    // ->where('trmDetKegKd','=',$keg)
                    ->where('trmRekKd','=',$rek)
                    ->where('trmNoTerima','<>','')
                    ->get()
                    ;
            $res=!empty($qr[0]->realNilai)?$qr[0]->realNilai:0;

            return $res;
   }  

   public function koreksipendapatan($rek){
        $aa  = DB::table('tukdju')
              ->select('klrRekDebet','klrRekKredit',DB::raw('sum(klrNilaiDebet) as klrNilaiDebet'),DB::raw('sum(klrNilaiKredit) as klrNilaiKredit'))
              ->where('klrRekKredit','=',$rek)
              ->where('klrNoJU','like','%koreksi-pendapatan%');

        $qy  = DB::table('tukdju')
              ->select('klrRekDebet','klrRekKredit',DB::raw('sum(klrNilaiDebet) as klrNilaiDebet'),DB::raw('sum(klrNilaiKredit) as klrNilaiKredit'))
              ->where('klrRekDebet','=',$rek)
              ->where('klrNoJU','like','%koreksi-pendapatan%')
              ->union($aa)
              ->get();

        if (strlen($rek) == 7) {
            if($rek==$qy[0]->klrRekDebet)
            {
              $nilai=0-$qy[0]->klrNilaiDebet;
            }else{
              $nilai=$qy[0]->klrNilaiKredit;                      
            }
        } else if (strlen($rek) == 5) {
            if ($rek==substr($qy[0]->klrRekDebet, 0,5)) {
                $nilai =0-$qy[0]->klrNilaiDebet;
            }else{
              $nilai=$qy[0]->klrNilaiKredit; 
            }
        } else if (strlen($rek) == 3) {
            if ($rek==substr($qy[0]->klrRekDebet, 0,3)) {
                $nilai =0-$qy[0]->klrNilaiDebet;
            }else{
              $nilai=$qy[0]->klrNilaiKredit; 
            }
        } else if (strlen($rek) == 2) {
            if ($rek==substr($qy[0]->klrRekDebet, 0,2)) {
                $nilai =0-$qy[0]->klrNilaiDebet;
            }else{
              $nilai=$qy[0]->klrNilaiKredit; 
            }
        } else if (strlen($rek) == 1) {
            if ($rek==substr($qy[0]->klrRekDebet, 0,1)) {
                $nilai =0-$qy[0]->klrNilaiDebet;
            }else{
              $nilai=$qy[0]->klrNilaiKredit; 
            }
        }

        $res = $nilai;


        return $res;
        
     }

     public function realKeluarMap($kdskpd,$kdkeg,$kdrek5){
      
          // $query1 = DB::table('tukdbendaharadetail')
          //          ->select(DB::raw('sum(klrDetNilai) as nilaiReal'))
          //          ->leftjoin('tukdbendahara','klrId','=','klrDetHeadId')
          //          ->where('klrDetSkpdKd','=',$kdskpd)
          //          ->where('klrDetKegKd','=',$kdkeg)
          //          ->where('klrDetRek5Kd','=',$kdrek5)
          //          ->where('klrJnsSpp','<>','LS')
          //          ->where('klrJnsSpp','<>','')
          //          ->where('klrNoSPP','<>','')
          //          ->where('klrTglSPP','<>','0000-00-00')
          //          ->get();

          // $query2 = DB::table('tukdkeluardetail')
          //          ->select(DB::raw('sum(klrDetNilai) as nilaiReal'))
          //          ->leftjoin('tukdkeluar','klrId','=','klrDetHeadId')
          //          ->where('klrJnsSpp','=','LS')
          //          ->where('klrNoKas','<>','')
          //          ->where('klrDetSkpdKd','=',$kdskpd)
          //          ->where('klrDetKegKd','=',$kdkeg)
          //          ->where('klrDetRek5Kd','=',$kdrek5)
          //          ->get();

                   
          //     $nreal=!empty($query1[0]->nilaiReal)?$query1[0]->nilaiReal:0;
          //     $nreal2=!empty($query2[0]->nilaiReal)?$query2[0]->nilaiReal:0;

          // return $nreal+$nreal2;
          // // return $nreal;

      $query1 = DB::table('tukdbendaharadetail')
                 ->select(DB::raw('sum(klrDetNilai) as nilaiReal'))
                 ->leftjoin('tukdbendahara','klrId','=','klrDetHeadId')
                 ->leftJoin('angkegiatan','angkgKegKd','=','klrDetKegKd')
                 ->where('klrTglSPP','<>','0000-00-00')
                 ->where('klrDetRek5Kd','=',$kdrek5)
                 ->where('klrJnsSpp','<>','LS')
                 ->where('klrJnsSpp','<>','')
                 ->where('klrNoSPP','<>','')
                 ->get();

        $query2 = DB::table('tukdkeluardetail')
                 ->select(DB::raw('sum(klrJumlah) as nilaiReal'))
                 ->leftjoin('tukdkeluar','klrId','=','klrDetHeadId')
                 ->leftJoin('angkegiatan','angkgKegKd','=','klrDetKegKd')
                 ->where('klrJnsSpp','=','LS')
                 ->where('klrNoSp2d','<>','')
                 ->where('klrStatusSelesai', '=', 1 )
                 ->where('klrDetRek5Kd','=',$kdrek5)
                 ->get();

      $query3 = DB::table('tukdterimacpdetail')
                ->select(DB::raw('sum(trmDetNilai) as sisaBelanja'))
                ->leftjoin('tukdterimacp','trmNoSts','=','trmDetNoSts')
                ->where('trmDetRek5Kd','=',$kdrek5)
                ->get();

      // $query4 = DB::table('tukdju')
      //            ->select(DB::raw('sum(klrNilaiDebet) as nilaiJu'))
      //            ->where('klrOtomatis','=',0)
      //            ->where('klrRekDebet','=',$kdrek5.'%')
      //            ->get();

        $sisa=!empty($query3[0]->sisaBelanja)?$query3[0]->sisaBelanja:0;

        $nreal=!empty($query1[0]->nilaiReal)?$query1[0]->nilaiReal:0;
        $nreal2=!empty($query2[0]->nilaiReal)?$query2[0]->nilaiReal:0;
        $nreal3=!empty($query4[0]->nilaiJu)?$query4[0]->nilaiJu:0;
        // return $nreal+$nreal2+$nreal3-$sisa;
        return $nreal+$nreal2-$sisa;
     }

     public function realKeluarMap2($kdrek5) {
          $qy = DB::table('tukdju')
                   ->select(DB::raw('sum(klrNilaiDebet) as nilaiJu'))
                   ->where('klrOtomatis','=',0)
                   ->where('klrRekDebet','=',$kdrek5)
                   ->get();

          $real=!empty($qy[0]->nilaiJu)?$qy[0]->nilaiJu:0;

          return $real;
     }


}