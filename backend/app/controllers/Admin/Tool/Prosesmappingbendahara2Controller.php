<?php
namespace Admin\Tool;

use BasicController;
use DB;
use Lang;
use Input;

class Prosesmappingbendahara2Controller extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Tukd\Tukdbendaharadetail();
     }
     public function index(){
     	 $param=Input::all();        

       try {
            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->leftjoin('tukdbendahara','klrId','=','klrDetHeadId')
                    ->where('klrNoSPP','<>','')
                    ->where('klrDetNilai','>',0)
                    ->where('klrJnsSPP','<>','LS')
                    ->get();

            foreach ($query as $key => $val) {

                $data=$val;
                // $rek5=trim($data->klrDetRek5Kd);
                $rek5 = $data->klrDetRek5Kd;
                $nilai=$data->klrDetNilai;
                $nobendahara=$data->klrNoSPP;
                $tanggal=$data->klrTglSPP;
                $ket=$data->klrKeterangan;

                $rekcair=$this->getRekBendahara($rek5);
                
                $mapp=new \Admin\Tukd\Tukdju();
                $mapp->klrNoJU=$nobendahara;
                $mapp->klrTglJU=$tanggal;
                $mapp->klrRef='No. Bendahara : '.$nobendahara;
                $mapp->klrRekDebet=$rekcair['kddebet1'];
                $mapp->klrRekKredit=$rekcair['kdkredit1'];
                $mapp->klrNilaiDebet=$nilai;
                $mapp->klrNilaiKredit=$nilai;
                $mapp->klrKeterangan=$ket;
                $mapp->klrOtomatis=1;
                $mapp->save();        

                $mapp=new \Admin\Tukd\Tukdju();
                $mapp->klrNoJU=$nobendahara;
                $mapp->klrTglJU=$tanggal;
                $mapp->klrRef='No. Bendahara : '.$nobendahara;
                $mapp->klrRekDebet=$rekcair['kddebet2'];
                $mapp->klrRekKredit=$rekcair['kdkredit2'];
                $mapp->klrNilaiDebet=$nilai;
                $mapp->klrNilaiKredit=$nilai;
                $mapp->klrKeterangan=$ket;
                $mapp->klrOtomatis=1;
                $mapp->save();  

                // echo $nobendahara." -> ".$rek5."<br>";            

            }        

            $query = DB::table('tukdterimacpdetail')
                      ->select('trmNoSts','trmTglSts','trmDetRek5Kd','trmDetNilai','trmJenis','trmKeterangan')
                      ->leftjoin('tukdterimacp','trmNoSts','=','trmDetNoSts')
                      ->get();

            foreach ($query as $key => $val) {

                $nokas=$val->trmNoSts;
                $tanggal=$val->trmTglSts;
                $rek=$val->trmDetRek5Kd;
                $nilai=$val->trmDetNilai;
                $ket=$val->trmKeterangan;

                if($val->trmJenis==1){
                    $mapp=new \Admin\Tukd\Tukdju();
                    $mapp->klrNoJU='SISA/'.$nokas;
                    $mapp->klrTglJU=$tanggal;
                    $mapp->klrRef='No. Kas Sisa : '.$nokas;
                    $mapp->klrRekDebet='1110401';
                    $mapp->klrRekKredit=$rek;
                    $mapp->klrNilaiDebet=$nilai;
                    $mapp->klrNilaiKredit=$nilai;
                    $mapp->klrKeterangan=$ket;
                    $mapp->klrOtomatis=1;
                    $mapp->save();                    
                }elseif($val->trmJenis==2){
                    $mapp=new \Admin\Tukd\Tukdju();
                    $mapp->klrNoJU='SISA/'.$nokas;
                    $mapp->klrTglJU=$tanggal;
                    $mapp->klrRef='No. Kas Sisa : '.$nokas;
                    $mapp->klrRekDebet='1110301';
                    $mapp->klrRekKredit=$rek;
                    $mapp->klrNilaiDebet=$nilai;
                    $mapp->klrNilaiKredit=$nilai;
                    $mapp->klrKeterangan=$ket;
                    $mapp->klrOtomatis=1;
                    $mapp->save();                                        
                }elseif($val->trmJenis==3){
                    $mapp=new \Admin\Tukd\Tukdju();
                    $mapp->klrNoJU='SISA/'.$nokas;
                    $mapp->klrTglJU=$tanggal;
                    $mapp->klrRef='No. Kas Sisa : '.$nokas;
                    $mapp->klrRekDebet='1110401';
                    $mapp->klrRekKredit='1110301';
                    $mapp->klrNilaiDebet=$nilai;
                    $mapp->klrNilaiKredit=$nilai;
                    $mapp->klrKeterangan=$ket;
                    $mapp->klrOtomatis=1;
                    $mapp->save();                                        
                }


            }        


            return 1;

           // return $param['limit'];                

       }catch(Exception $e){
           return Response::exception($e);
       }    
     }


     public function getRekBendahara($rek){

            $query = DB::table('jurnalbendahara')
                    ->select('*')
                    ->where('kdbelanja','=',$rek)
                    ->limit(1)
                    ->get(); 
            $res=array(
                          "kddebet1"=>!empty($query[0]->kddebet1)?$query[0]->kddebet1:'xxx'.$rek,
                          "kddebet2"=>!empty($query[0]->kddebet2)?$query[0]->kddebet2:'xxx'.$rek,
                          "kdkredit1"=>!empty($query[0]->kdkredit1)?$query[0]->kdkredit1:'yyy'.$rek,
                          "kdkredit2"=>!empty($query[0]->kdkredit2)?$query[0]->kdkredit2:'yyy'.$rek,
                      );                    
           return $res;

     }



}