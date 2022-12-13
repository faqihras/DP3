<?php
namespace Admin\Kinerja;

use BasicController;
use DB;
use Lang;
use Input;
use Date;
use Session;

class RppController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
        $param=Input::all();
        $this->model = new \Admin\Gudang\Rppheader();
     }

     public function index(){
           $param=Input::all();
           $search=!empty($param['search']['value'])?$param['search']['value']:'';
           $gudang=!empty($param['stokhGudang'])?$param['stokhGudang']:'1';
           $skpd=Session::get('skpd');

           try {
                $query = DB::table($this->model->getTable())
                        ->select('*',
                              DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-print\" onclick=\"printData(\'",stokhNoTrans,"\')\"></i></a>") as print'),
                              DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-print\" onclick=\"printDataBA(\'",stokhNoTrans,"\')\"></i></a>") as print2'),
                              DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-times-circle\" onclick=\"deleteData(",stokhId,")\"></i></a>") as del')
                          )
                        ->where('stokhNoFaktur','like','%'.$search.'%')
                        ->where('stokhGudang','=',$gudang)
                        ->where('stokhSkpd','=',$skpd)
                        ->orderby('stokhTglTerima','desc');
          
           $res=$this->getDataGrid($query);
            $i=0;
            foreach ($res['data'] as $key => $val) {
                $nota=$val->stokhNota;
                $transaksi=$val->stokhNoTrans;
                $tanggal=$val->stokhTglTerima;
                $i++;
            }     

           return $res;                
                 
           }catch(Exception $e){
               return Response::exception($e);
           }

     }


     public function beforeStore(){
        $param=Input::all();
         $skpd=Session::get('skpd');

        $param['tgl_faktur']=!empty($param['tgl_faktur'])?$param['tgl_faktur']:'00-00-0000';
        $param['tgl_jatuh_tempo']=!empty($param['tgl_jatuh_tempo'])?$param['tgl_jatuh_tempo']:'00-00-0000';
        $param['tgl_pengadaan']=!empty($param['tgl_pengadaan'])?$param['tgl_pengadaan']:'00-00-0000';

        //$idppn=$param['jenis_ppn'];
        $idppn=1;
        
        if($idppn==1){
          $jnsppn='PPn Include';
          $ppnnilai=0;          
        }elseif($idppn==2){
          $jnsppn='PPn Exclude';
          $ppnnilai=10;
        }elseif($idppn==3){
          $jnsppn='Tanpa PPn';
          $ppnnilai=0;
        }

        $idTrans=$param['stokhGudang'].'-'.$this->getNoTrans($param['stokhGudang']).'-'.date('Y');

        $rec=$param['jumRecord'];
        $jumlah=0;
        for($i=1;$i<=$rec;$i++){

            $idbarang=!empty($param['id_barang'.$i])?$param['id_barang'.$i]:'';
            $nama_barang=!empty($param['nama_barang'.$i])?$param['nama_barang'.$i]:'';
            $satuan=!empty($param['satuan_besar'.$i])?$param['satuan_besar'.$i]:'';
            $qty=!empty($param['qty'.$i])?$param['qty'.$i]:'';

            $no_batch=!empty($param['no_batch'.$i])?$param['no_batch'.$i]:'';
            $expired_date=!empty($param['expired_date'.$i])? $this->reversdate($param['expired_date'.$i]):'0000-00-00';


            if($idbarang!=''){
                $detailbarang = new \Admin\Gudang\Rppdetail();

                $detailbarang->stokNoTrans = $idTrans;
                $detailbarang->stokTanggal = $this->reversdate($param['tgl_pengadaan']);
                $detailbarang->stokBrgId = '';
                $detailbarang->stokBrgKode = $idbarang;
                $detailbarang->stokBrgNama = $nama_barang;
                $detailbarang->stokBrgVolume = $qty;
                $detailbarang->stokBrgSatuan = $satuan;
                $detailbarang->stokBrgBatch = $no_batch;
                $detailbarang->stokBrgExp = $expired_date;         
                $detailbarang->stokSkpd = $skpd;         


                $detailbarang->save();

                // $jumlah=$jumlah+$total;
            }
        }   

        $x=$ppnnilai/100*$jumlah;          
        $jumlahAhir=$jumlah+$x;

        Input::merge(array( 
                            'stokhSkpd'=>$skpd,                
                            'stokhNota'=>$param['nota'],                
                            'stokhNoTrans'=>$idTrans,
                            'stokhTglTerima'=>$this->reversdate($param['tgl_pengadaan']),
                          ));                    

     }
     public function getNoTrans($gudang){
            $query = DB::table('trconfnomor')
                    ->select('noOpname')
                    ->limit(1)
                    ->get();            
                $nomor=$query[0]->noOpname;
                $nomor ++;
                $q2=DB::table('trconfnomor')
                    ->update(array('noOpname' => $nomor)); 
            
            return $this->tambahNol($nomor);
     }

     public function tambahNol($nomor){
        $res=$nomor;
        if(strlen($nomor)==1){
            $res='00000'.$nomor;
        }elseif(strlen($nomor)==2){
            $res='0000'.$nomor;
        }elseif(strlen($nomor)==3){
            $res='000'.$nomor;
        }elseif(strlen($nomor)==4){
            $res='00'.$nomor;
        }elseif(strlen($nomor)==5){
            $res='0'.$nomor;
        }elseif(strlen($nomor)==6){
            $res=$nomor;
        }
        return $res;
     }


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