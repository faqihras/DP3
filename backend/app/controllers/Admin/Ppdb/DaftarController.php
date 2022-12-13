<?php
namespace Admin\Ppdb;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
class DaftarController extends BasicController {
     public function index()
     {
           $param=Input::all();
           $tgawal=!empty($param['tgawal'])?$this->reversdate($param['tgawal']):'0000-00-00';
           $tgahir=!empty($param['tgahir'])?$this->reversdate($param['tgahir']):'0000-00-00';
           $jenis =$param['jenis'];

           $res = array();
           if($jenis==''){
               $query = DB::table('data_siswa_daftar')
                      ->select('*')
                      //->leftjoin('mobile_user','userId','=','abUserId')
                      ->where(DB::raw('left(dataCreateTime,10)'),'>=',$tgawal)
                      ->where(DB::raw('left(dataCreateTime,10)'),'<=',$tgahir)
                      ->get();
            }else{
               $query = DB::table('data_siswa_daftar')
                      ->select('*')
                     // ->leftjoin('mobile_user','userId','=','abUserId')
                      ->where(DB::raw('left(dataCreateTime,10)'),'>=',$tgawal)
                      ->where(DB::raw('left(dataCreateTime,10)'),'<=',$tgahir)
                      ->where('jenjang1','=',$jenis)
                      ->get();
            }

            foreach ($query as $key => $val) {
                // if($val->abJenis==0){
                //   $jenis='Absen Masuk';
                // }else{
                //   $jenis='Absen Keluar';
                // }
                $res[]=array(
                        'nama_siswa'=>$val->nama_siswa,
                        'ttl'=>$val->ttl,
                        'jeniskel'=>$val->jeniskel,
                        'nama_ayah'=>$val->nama_ayah,
                        'alamat1'=>$val->alamat1,
                        'hp_ayah'=>$val->hp_ayah,
                        'nama_ibu'=>$val->nama_ibu,
                        'alamat2'=>$val->alamat2,
                        'hp_ibu'=>$val->hp_ibu,
                        'dataCreateTime'=>$val->dataCreateTime
                        // 'abKet'=>$val->abKet,
                        // // 'abPhoto'=> "<a class='fancybox' rel='gallery1' title='' href=".$val->abPhoto."><img class='img-responsive' src=".$val->abPhoto." ></a>",
                        // 'abPhoto'=> "<a class='fancybox' rel='gallery1' title='' href=".$val->abPhoto."><img class='img-responsive' src=".$val->abPhoto." ></a>",
                        // 'abMap'=> "<button type='button' class='btn btn-default' onclick=\"window.open('http://maps.google.com/maps?z=12&t=m&q=loc:".$val->abLat."+".$val->abLng."','_blank')\" >Gmap</button>",
                      );

            }

            return $res;
     }

     // public function beforeStore(){
     // 		$param=Input::all();
     //    Input::merge(array(
     //                'abWaktuAbsen' => date('Y-m-d H:i:s')
     //                 ));
     //
     // }


     public function reversdate($tanggal){
        if(substr($tanggal, 2,1)=="/"){
            $a=explode("/",$tanggal);
            $result=$a[2].'-'.$a[0].'-'.$a[1];
        }else{
            $a=explode("-",$tanggal);
            $result=$a[2].'-'.$a[1].'-'.$a[0];
        }
        return $result;
     }


}
