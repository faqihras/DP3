<?php
namespace Admin\Tool;

use BasicController;
use DB;
use Lang;
use Input;

class Prosesmappingtagihan2Controller extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Tukd\Tukdkeluardetail();
     }
     public function index(){
     	 $param=Input::all();        

       try {
            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->leftjoin('tukdkeluar','klrId','=','klrDetHeadId')
                    ->where('klrDetNilai','>',0)
                    ->where('klrNoKas','<>','')
                    ->get();

            foreach ($query as $key => $val) {
                  $data=$val;

                  $jenis=$data->klrJnsSPP;
                  // $rek5=trim($data->klrDetRek5Kd);
                  $rek5=$data->klrDetRek5Kd;
                  $nilai=$data->klrDetNilai;
                  $notagihan=$data->klrNoTagih;
                  $nosp2d=$data->klrNoSp2d;
                  $tanggal=$data->klrTglTagih;
                  $ket=$data->klrKeterangan;
                  $tanggalSp2d=$data->klrTglSp2d;

                  if($jenis=='LS'){
                      $ref='Tagihan : '.$notagihan;
                      if(trim($notagihan)=='') {
                        if($nosp2d=='') $nosp2d="xxxxx";
                        $notagihan=$nosp2d;
                        $ref='SPM : '.$nosp2d;
                        $tanggal=$data->klrTglSp2d;            
                      }

                      $rekjurnal=$this->getRekJurnal($rek5);
                      $mapp=new \Admin\Tukd\Tukdju();
                      $mapp->klrNoJU=$notagihan;
                      $mapp->klrTglJU=$tanggal;
                      $mapp->klrRef=$ref;
                      $mapp->klrRekDebet=$rekjurnal['kddebet'];
                      $mapp->klrRekKredit=$rekjurnal['kdkredit'];
                      $mapp->klrNilaiDebet=$nilai;
                      $mapp->klrNilaiKredit=$nilai;
                      $mapp->klrKeterangan=$ket;
                      $mapp->klrOtomatis=1;
                      $mapp->klrSumberDana=2;
                      $mapp->save();        


                      $rekcair=$this->getRekCair($rek5);
                      
                      $mapp=new \Admin\Tukd\Tukdju();
                      $mapp->klrNoJU=$nosp2d;
                      $mapp->klrTglJU=$tanggalSp2d;
                      $mapp->klrRef='SPM : '.$nosp2d;
                      $mapp->klrRekDebet=$rekcair['kddebet1'];
                      $mapp->klrRekKredit=$rekcair['kdkredit1'];
                      $mapp->klrNilaiDebet=$nilai;
                      $mapp->klrNilaiKredit=$nilai;
                      $mapp->klrKeterangan=$ket;
                      $mapp->klrOtomatis=1;
                      $mapp->klrSumberDana=2;
                      $mapp->save();        

                      $mapp=new \Admin\Tukd\Tukdju();
                      $mapp->klrNoJU=$nosp2d;
                      $mapp->klrTglJU=$tanggalSp2d;
                      $mapp->klrRef='SPM : '.$nosp2d;
                      $mapp->klrRekDebet=$rekcair['kddebet2'];
                      $mapp->klrRekKredit=$rekcair['kdkredit2'];
                      $mapp->klrNilaiDebet=$nilai;
                      $mapp->klrNilaiKredit=$nilai;
                      $mapp->klrKeterangan=$ket;
                      $mapp->klrOtomatis=1;
                      $mapp->klrSumberDana=2;
                      $mapp->save();        
                  }else{

                      $nokas=$data->klrNoKas;
                      $tgkas=$data->klrTglKas;
                      $ref='No Kas : '.$data->klrNoKas;
                      // if($nokas==''){
                      //   $nokas=$data->klrNoTagih;
                      //   $tgkas=$data->klrTglTagih;
                      // }

                      $mapp=new \Admin\Tukd\Tukdju();
                      $mapp->klrNoJU=$nokas;
                      $mapp->klrTglJU=$tgkas;
                      $mapp->klrRef=$ref;
                      $mapp->klrRekDebet='1110301';
                      $mapp->klrRekKredit='1110401';
                      $mapp->klrNilaiDebet=$nilai;
                      $mapp->klrNilaiKredit=$nilai;
                      $mapp->klrKeterangan=$ket;
                      $mapp->klrOtomatis=1;
                      $mapp->klrSumberDana=2;
                      $mapp->save();        

                  }

                  // echo $notagihan." -> ".$rek5."<br>";
            }                    


            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->leftjoin('tukdkeluar','klrId','=','klrDetHeadId')
                    ->where('klrDetNilai','>',0)
                    ->where('klrNoKas','=','')
                    ->where('klrJnsSPP','=','')                    
                    ->where('klrNoTagih','<>','')                    
                    ->get();

            foreach ($query as $key => $val) {
                  $data=$val;

                  $jenis='LS';
                  // $rek5=trim($data->klrDetRek5Kd);
                  $rek5=$data->klrDetRek5Kd;
                  $nilai=$data->klrDetNilai;
                  $notagihan=$data->klrNoTagih;
                  $nosp2d=$data->klrNoTagih;
                  $tanggal=$data->klrTglTagih;
                  $ket=$data->klrKeterangan;
                  $tanggalSp2d=$data->klrTglTagih;

                  $ref='Tagihan : '.$notagihan;
                  // if(trim($notagihan)=='') {
                  //   if($nosp2d=='') $nosp2d="xxxxx";
                  //   $notagihan=$nosp2d;
                  //   $ref='SP2D : '.$nosp2d;
                  //   $tanggal=$data->klrTglSp2d;            
                  // }

                  $rekjurnal=$this->getRekJurnal($rek5);
                  $mapp=new \Admin\Tukd\Tukdju();
                  $mapp->klrNoJU=$notagihan;
                  $mapp->klrTglJU=$tanggal;
                  $mapp->klrRef=$ref;
                  $mapp->klrRekDebet=$rekjurnal['kddebet'];
                  $mapp->klrRekKredit=$rekjurnal['kdkredit'];
                  $mapp->klrNilaiDebet=$nilai;
                  $mapp->klrNilaiKredit=$nilai;
                  $mapp->klrKeterangan=$ket;
                  $mapp->klrOtomatis=1;
                  $mapp->klrSumberDana=2;
                  $mapp->save();        


                  $rekcair=$this->getRekCair($rek5);
                  
                  $mapp=new \Admin\Tukd\Tukdju();
                  $mapp->klrNoJU=$nosp2d;
                  $mapp->klrTglJU=$tanggalSp2d;
                  $mapp->klrRef='Tagihan : '.$nosp2d;
                  $mapp->klrRekDebet=$rekcair['kddebet1'];
                  $mapp->klrRekKredit=$rekcair['kdkredit1'];
                  $mapp->klrNilaiDebet=$nilai;
                  $mapp->klrNilaiKredit=$nilai;
                  $mapp->klrKeterangan=$ket;
                  $mapp->klrOtomatis=1;
                  $mapp->klrSumberDana=2;
                  $mapp->save();        

                  $mapp=new \Admin\Tukd\Tukdju();
                  $mapp->klrNoJU=$nosp2d;
                  $mapp->klrTglJU=$tanggalSp2d;
                  $mapp->klrRef='Tagihan : '.$nosp2d;
                  $mapp->klrRekDebet=$rekcair['kddebet2'];
                  $mapp->klrRekKredit=$rekcair['kdkredit2'];
                  $mapp->klrNilaiDebet=$nilai;
                  $mapp->klrNilaiKredit=$nilai;
                  $mapp->klrKeterangan=$ket;
                  $mapp->klrOtomatis=1;
                  $mapp->klrSumberDana=2;
                  $mapp->save();        
            }       

            return 1;

       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

     public function getRekJurnal($rek){

            $query = DB::table('jurnaltagihan')
                    ->select('*')
                    ->where('kdbelanja','=',$rek)
                    ->limit(1)
                    ->get(); 
            $res=array(
                          "kddebet"=>!empty($query[0]->kddebet)?$query[0]->kddebet:'xxxxxxx',
                          "nmdebet"=>!empty($query[0]->kddebet)?$query[0]->nmdebet:'xxxxxxx',
                          "kdkredit"=>!empty($query[0]->kdkredit)?$query[0]->kdkredit:'yyyyyyy',
                          "nmkredit"=>!empty($query[0]->nmkredit)?$query[0]->nmkredit:'yyyyyyy',
                      );                    
           return $res;

     }

     public function getRekCair($rek){

            $query = DB::table('jurnalcair')
                    ->select('*')
                    ->where('kddebet2','=',$rek)
                    ->limit(1)
                    ->get(); 
            $res=array(
                          "kddebet1"=>!empty($query[0]->kddebet1)?$query[0]->kddebet1:'xxxxxxx',
                          "kddebet2"=>!empty($query[0]->kddebet2)?$query[0]->kddebet2:'xxxxxxx',
                          "kdkredit1"=>!empty($query[0]->kdkredit1)?$query[0]->kdkredit1:'yyyyyyy',
                          "kdkredit2"=>!empty($query[0]->kdkredit2)?$query[0]->kdkredit2:'yyyyyyy',
                      );                    
           return $res;

     }

}