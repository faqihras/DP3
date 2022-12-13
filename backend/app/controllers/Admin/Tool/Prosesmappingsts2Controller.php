<?php
namespace Admin\Tool;

use BasicController;
use DB;
use Lang;
use Input;

class Prosesmappingsts2Controller extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Tukd\Tukdterimadetail();
     }
     public function index(){
       $param=Input::all();        

       try {
            $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->leftjoin('tukdterima','trmNoSts','=','trmDetNoSts')
                    ->where('trmNoSts','<>','')
                    ->where('trmNoTetap','=','')
                    ->get();

            foreach ($query as $key => $val) {

                $data=$val;
                // $rek5=trim($data->trmDetRek5Kd);
                $rek5=$data->trmDetRek5Kd;
                $nilai=$data->trmDetNilai;
                $ket=$data->trmKeterangan;
                $nosts=$data->trmNoSts;
                $tanggal=$data->trmTglSts;
                $ref='No STS : '.$data->trmNoSts;

                $rekcair=$this->getRekCair($rek5);
                $mapp=new \Admin\Tukd\Tukdju();
                $mapp->klrNoJU=$nosts;
                $mapp->klrTglJU=$tanggal;
                $mapp->klrRef='STS : '.$nosts;
                $mapp->klrRekDebet=$rekcair['kddebet'];
                $mapp->klrRekKredit=$rekcair['kdkredit'];
                $mapp->klrNilaiDebet=$nilai;
                $mapp->klrNilaiKredit=$nilai;
                $mapp->klrKeterangan=$ket;
                $mapp->klrOtomatis=1;
                $mapp->klrSumberDana=2;
                $mapp->save();        

                // $mapp=new \Admin\Tukd\Tukdju();
                // $mapp->klrNoJU=$nosts;
                // $mapp->klrTglJU=$tanggal;
                // $mapp->klrRef='STS : '.$nosts;
                // $mapp->klrRekDebet=$rekcair['kddebet2'];
                // $mapp->klrRekKredit=$rekcair['kdkredit2'];
                // $mapp->klrNilaiDebet=$nilai;
                // $mapp->klrNilaiKredit=$nilai;
                // $mapp->klrKeterangan=$ket;
                // $mapp->klrOtomatis=1;
                // $mapp->save();        

                // echo $ref." -> ".$rek5;
            }        
            return 1;


       }catch(Exception $e){
           return Response::exception($e);
       }    
     }


     public function getRekCair($rek){

            // $query = DB::table('jurnalcair')
            //         ->select('*')
            //         ->where('kdkredit2','=',$rek)
            //         ->limit(1)
            //         ->get(); 
            // $res=array(
            //               "kddebet1"=>!empty($query[0]->kddebet1)?$query[0]->kddebet1:'xxxxxxx',
            //               "kddebet2"=>!empty($query[0]->kddebet2)?$query[0]->kddebet2:'xxxxxxx',
            //               "kdkredit1"=>!empty($query[0]->kdkredit1)?$query[0]->kdkredit1:'yyyyyyy',
            //               "kdkredit2"=>!empty($query[0]->kdkredit2)?$query[0]->kdkredit2:'yyyyyyy',
            //           );   
            $query = DB::table('jurnalSetoran')
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

}