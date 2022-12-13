<?php
namespace Admin\Kinerja;

use BasicController;
use DB;
use Lang;
use Input;
use Date;
use Session;

class DpakforcomboController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
        $param=Input::all();
        $this->model = new \Admin\Kinerja\Stokheader();
     }

     public function index(){
         $param=Input::all();
         $param['term']=!empty($param['term'])? $param['term'] :'';
         $param['kode']=!empty($param['kode'])? $param['kode'] :'';
         $skpd    = Session::get('skpd');

           try {
                $query = DB::table($this->model->getTable())
                        ->select('stokhNoTrans as id', 'stokhNoTrans as kode', 'stokhNota as nama','stokhSuplier as pasien','stokhTglTerima as tglretur',
                        // DB::raw("CONCAT('NOTA: ', IFNULL(`stokhNota`, 0), ' | KONTRAK: ', IFNULL(`stokhNoKontrak`, '-'),' | KWITANSI: ',IFNULL(`stokhNoKwitansi`,'-'),' | NO. TERIMA: ',IFNULL(`stokhNoPenerimaanGudang`, '-')) as text")
                          // DB::raw("CONCAT('No Transaksi: ', IFNULL(`stokhNoTrans`, 0)) as text")
                          DB::raw('CONCAT("No/Nota Pembelian : ", IF(stokhNota = "",IF(stokhNoKontrak = "",IF(stokhNoKwitansi = "",IF(stokhNoPenerimaanGudang = "",IF(stokhNoPemeriksaan = "","",stokhNoPemeriksaan),stokhNoPenerimaanGudang),stokhNoKwitansi),stokhNoKontrak),stokhNota)) as text')
                      )
                        ->where('stokhSkpd','=',$skpd)
                        ->where('stokhNoTrans','LIKE','%'.$param['term'].'%')
                        ->orderby('stokhTglTerima','desc')->get();
           return $query;

           } catch( Exception $e ){
               return Response::exception($e);
           }
     }


     public function beforeStore(){
        $param=Input::all();
        $skpd= Session::get('skpd');
        $ppnnilai   = 0;

        $param['tgl_faktur']=!empty($param['tgl_faktur'])?$param['tgl_faktur']:'00-00-0000';
        // $param['tgl_jatuh_tempo']=!empty($param['tgl_jatuh_tempo'])?$param['tgl_jatuh_tempo']:'00-00-0000';
        $param['tgl_pengadaan']=!empty($param['tgl_pengadaan'])?$param['tgl_pengadaan']:'00-00-0000';

        $param['otomatis']=!empty($param['otomatis'])?$param['otomatis']:'0';
        $nopemeriksaan=$param['nopemeriksaan'];
        $nokontrak=$param['nokontrak'];
        $nokwitansi=$param['nokwitansi'];
        $nopenerimaangudang=$param['nopenerimaangudang'];

        if($param['otomatis']==1){
              $q2=DB::table('trFakturHeader')
                  ->where('hmutasiNoTrans','=',$param['nota'])
                  ->update(array('hmutasiStatus' => 1));
        }

        $idppn=$param['jenis_ppn'];
        // $idppn=1;

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
            $qty=!empty($param['qty'.$i])?$param['qty'.$i]:0;

            $no_batch=!empty($param['no_batch'.$i])?$param['no_batch'.$i]:'-';
            $expired_date=!empty($param['expired_date'.$i])? $this->reversdate($param['expired_date'.$i]):'0000-00-00';
            $harga=!empty($param['harga'.$i])?$param['harga'.$i]:0;
            $diskon_item=!empty($param['diskon_item'.$i])?$param['diskon_item'.$i]:0;
            $total=! empty($param['total'.$i])?$param['total'.$i]:0;

            if($idbarang!=''){
                $detailbarang = new \Admin\Gudang\Stokdetail();

                $detailbarang->stokNoTrans = $idTrans;//
                $detailbarang->stokTanggal = $this->reversdate($param['tgl_pengadaan']);//
                $detailbarang->stokBrgId = 0;//
                $detailbarang->stokBrgKode = $idbarang;//
                $detailbarang->stokBrgNama = $nama_barang;//
                $detailbarang->stokBrgVolume = $qty;//
                $detailbarang->stokBrgSatuan = $satuan;//
                $detailbarang->stokBrgHarga = $harga;//
                $detailbarang->stokPpnJenis = $jnsppn;//
                $detailbarang->stokPpnNilai = $ppnnilai;//
                $detailbarang->stokBrgBatch = $no_batch;//
                // $detailbarang->stokBrgExp = $expired_date;//
                // $detailbarang->stokBrgDiskon = $diskon_item;//
                $detailbarang->stokTotal = $total;//
                $detailbarang->stokKeterangan = $param['supplier'];//
                $detailbarang->stokSkpd = $skpd;//

                $detailbarang->save();

                $jumlah=$jumlah+$total;
            }
        }

        $x=$ppnnilai/100*$jumlah;
        $jumlahAhir=$jumlah+$x;

        Input::merge(array(
            'stokhNota'=>$param['nota'],
            'stokhNoTrans'=>$idTrans,
            'stokhSuplier'=>$param['supplier'],
            'stokhTglTerima'=>$this->reversdate($param['tgl_pengadaan']),
            'stokhDiskonFaktur'=>0,
            'stokhPpnNilai'=>$x,
            'stokhTotal'=>$jumlahAhir,
            'stokhSkpd'=>$skpd,
          ));

     }

     public function getNoTrans($gudang){
            $query = DB::table('trconfnomor')
                    ->select('noKo','noFs')
                    ->limit(1)
                    ->get();
            if($gudang==1){
                $nomor=$query[0]->noKo;
                $nomor ++;
                $q2=DB::table('trconfnomor')
                    ->update(array('noKo' => $nomor));
            }else{
                $nomor=$query[0]->noFs;
                $nomor ++;
                $q2=DB::table('trconfnomor')
                    ->update(array('noFs' => $nomor));
            }

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
