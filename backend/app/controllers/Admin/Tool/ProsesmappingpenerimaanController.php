<?php
namespace Admin\Tool;

use BasicController;
use DB;
use Lang;
use Input;

class ProsesmappingpenerimaanController extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Tukd\Tukdterima();
     }
     public function index(){
         $param=Input::all();        

            // DB::table('tukdju')
            //   ->where('klrOtomatis','=',1)
            //   ->delete();

       try {
            $query = DB::table($this->model->getTable())
                    ->select('*')
                    // ->where('trmNoTetap','=','')
                    ->where('trmNoTerima','<>','')
                    ->get();

            foreach ($query as $key => $val) {

                  $data=$val;

                  // $rek5=trim($data->trmRekKd);
                  $rek5=$data->trmRekKd;
                  $nilai=$data->trmNilaiPenerimaan;
                  $ket=$data->trmKeterangan;
                  $noterima=$data->trmNoTerima;
                  $tanggal=$data->trmTglTerima;
                  $ref='No Penerimaan : '.$data->trmNoTerima;
                  // if(trim($data->trmNoTetap)==''){
                  // if($data->trmNoTetap==''){
                  //   $notetap=$data->trmNoTerima;
                  //   $tanggal=$data->trmTglTerima;
                  //   $ref='No Penetapan : '.$data->trmNoTerima;              
                  // }

                  // $rekjurnal=$this->getRekJurnal($rek5);
                  // $mapp=new \Admin\Tukd\Tukdju();
                  // $mapp->klrNoJU=$noterima;
                  // $mapp->klrTglJU=$tanggal;
                  // $mapp->klrRef=$ref;
                  // $mapp->klrRekDebet=$rekjurnal['kddebet'];
                  // $mapp->klrRekKredit=$rekjurnal['kdkredit'];
                  // $mapp->klrNilaiDebet=$nilai;
                  // $mapp->klrNilaiKredit=$nilai;
                  // $mapp->klrKeterangan=$ket;
                  // $mapp->klrOtomatis=1;
                  // $mapp->save();


                  // $rekjurnal=$this->getRekJurnal($rek5);
                  $rekjurnal=$this->getRekCair($rek5);
                  $mapp=new \Admin\Tukd\Tukdju();
                  $mapp->klrNoJU=$noterima;
                  $mapp->klrTglJU=$tanggal;
                  $mapp->klrRef=$ref;
                  $mapp->klrRekDebet=$rekjurnal['kddebet1'];
                  $mapp->klrRekKredit=$rekjurnal['kdkredit1'];
                  $mapp->klrNilaiDebet=$nilai;
                  $mapp->klrNilaiKredit=$nilai;
                  $mapp->klrKeterangan=$ket;
                  $mapp->klrOtomatis=1;
                  $mapp->klrSumberDana=2;
                  $mapp->save();

                  $rekjurnal=$this->getRekCair($rek5);
                  $mapp=new \Admin\Tukd\Tukdju();
                  $mapp->klrNoJU=$noterima;
                  $mapp->klrTglJU=$tanggal;
                  $mapp->klrRef=$ref;
                  $mapp->klrRekDebet=$rekjurnal['kddebet2'];
                  $mapp->klrRekKredit=$rekjurnal['kdkredit2'];
                  $mapp->klrNilaiDebet=$nilai;
                  $mapp->klrNilaiKredit=$nilai;
                  $mapp->klrKeterangan=$ket;
                  $mapp->klrOtomatis=1;
                  $mapp->klrSumberDana=2;
                  $mapp->save();

                  // echo $notetap." -> ".$rek5;
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
                    ->where('kdkredit2','=',$rek)
                    ->limit(1)
                    ->get(); 
            $res=array(
                          "kddebet1"=>!empty($query[0]->kddebet1)?$query[0]->kddebet1:'xxxxxxx',
                          "kdkredit1"=>!empty($query[0]->kdkredit1)?$query[0]->kdkredit1:'yyyyyyy',

                          "kddebet2"=>!empty($query[0]->kddebet2)?$query[0]->kddebet2:'xxxxxxx',
                          "kdkredit2"=>!empty($query[0]->kdkredit2)?$query[0]->kdkredit2:'yyyyyyy',
                      );                    
           return $res;

     }



}