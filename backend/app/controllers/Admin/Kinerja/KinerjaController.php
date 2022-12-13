<?php
namespace Admin\Kinerja;

use BasicController;
use DB;
use Lang;
use Input;
use Date;
use Session;

class KinerjaController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
        $param=Input::all();
        $this->model = new \Admin\Kinerja\Kinerjaheader();
     }

     public function index(){
           $param   = Input::all();
           $search  = !empty($param['search']['value'])?$param['search']['value']:'';
           $skpd    = !empty($param['kode'])?$param['kode']:Session::get('skpd');
           $tahun   = Session::get('tahun');

           try {
                $query = DB::table($this->model->getTable())
                        ->select('stokhNoPenerimaanGudang','stokhNoKwitansi','stokhSuplier','stokhNoTrans','stokhTotal',
                              DB::raw('SUM(stokBrgKoreksi * stokBrgHarga) as total'),
                              DB::raw(" DATE_FORMAT(stokhTglTerima, '%d-%b-%Y') as stokhTglTerima "),
                              DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-print\" onclick=\"printData(\'",stokhNoTrans,"\')\"></i></a>") as print'),
                             DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-times-circle\" onclick=\"deleteData(",stokhId,")\"></i></a>") as del'),
                              DB::raw('IF(stokhNota = "",IF(stokhNoPemeriksaan = "",IF(stokhNoKwitansi = "",IF(stokhNoKontrak = "",IF(stokhNoPenerimaanGudang = "","",stokhNoPenerimaanGudang),stokhNoKontrak),stokhNoKwitansi),stokhNoPemeriksaan),stokhNota) as nomor_terima')
                          )
                        ->leftjoin('trStokDetail','stokNoTrans','=','stokhNoTrans')
                        ->whereRaw("YEAR(stokhTglTerima) = $tahun")
                        ->where('stokhSkpd','=',$skpd)
                        // ->where('stokhNoKwitansi','like','%'.$search.'%')
                        ->Where(function($query) use ($skpd,$tahun,$search){
                                $query->whereRaw("YEAR(stokhTglTerima) = $tahun")
                                      ->where('stokhSkpd','=',$skpd)
                                      ->where('stokhNota', 'like', '%'.$search.'%')
                                      ->orwhere('stokhNoPemeriksaan', 'like', '%'.$search.'%')
                                      ->orwhere('stokhNoKwitansi', 'like', '%'.$search.'%')
                                      ->orwhere('stokhNoKontrak', 'like', '%'.$search.'%')
                                      ->orwhere('stokhNoFaktur','like','%'.$search.'%')
                                      ->orwhere('stokhNoPenerimaanGudang', 'like', '%'.$search.'%');
                            })
                        ->orderby('trStokHeader.stokhTglTerima','desc')
                        ->groupby('stokhNoTrans');

            $res=$this->getDataGrid($query);
            $i=0;
            foreach ($res['data'] as $key => $val) {
                
                $supplier=$val->stokhSuplier;
                $transaksi=$val->stokhNoTrans;
                $tanggal=$val->stokhTglTerima;
                // $total=$val->stokhTotal;
                $total=$val->total;
                $res['data'][$i]->stokhTotal=number_format(($total),2);

                $i++;
            }     

           return $res;                 
                 
           }catch(Exception $e){
               return Response::exception($e);
           }

     }



     public function beforeStore(){
        $param=Input::all();
        $skpd= Session::get('skpd');
        $ppnnilai   = 0;

        $param['tgl_faktur']    = !empty($param['tgl_faktur']) ? $param['tgl_faktur'] : '00-00-0000';
        $param['tgl_pengadaan'] = !empty($param['tgl_pengadaan']) ? $param['tgl_pengadaan'] : '00-00-0000';
        $param['otomatis']      = !empty($param['otomatis'])?$param['otomatis']:'0';
        $nopemeriksaan          = $param['nopemeriksaan'];
        // $nokontrak              = $param['nokontrak'];
        // $nokwitansi             = $param['nokwitansi'];
        // $nopenerimaangudang     = $param['nopenerimaangudang'];
        // $jenis                  = $param['jenis'];
        // $noid                   = $param['noid'];

        if($param['otomatis']==1){
              $q2=DB::table('trFakturHeader')
                  ->where('hmutasiNoTrans','=',$param['nota'])
                  ->update(array('hmutasiStatus' => 1));
        }

        $idppn  = $param['jenis_ppn'];
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

            $idbarang   = !empty($param['id_barang'.$i])?$param['id_barang'.$i]:'';
            $nama_barang= !empty($param['nama_barang'.$i])?$param['nama_barang'.$i]:'';
            // $satuan     = !empty($param['satuan_besar'.$i])?$param['satuan_besar'.$i]:'';
            // $ket        = !empty($param['keterangan'.$i])?$param['keterangan'.$i]:'';
            $qty        = !empty($param['qty'.$i])?$param['qty'.$i]:0;

            // $no_batch   = !empty($param['no_batch'.$i])?$param['no_batch'.$i]:'-';
            // $expired_date=!empty($param['expired_date'.$i])? $this->reversdate($param['expired_date'.$i]):'0000-00-00';
            // $harga      = !empty($param['harga'.$i])?$param['harga'.$i]:0;
            // $diskon_item= !empty($param['diskon_item'.$i])?$param['diskon_item'.$i]:0;
            $total      = !empty($param['total'.$i])?$param['total'.$i]:0;

            //batch-sistem
            $batch_sistem = str_replace(" ","",$idbarang) . str_replace("-","",$this->reversdate($param['tgl_pengadaan'])) . substr($harga,0,2) . $skpd;


            if($idbarang!=''){
                $detailbarang = new \Admin\Kinerja\Kinerjadetail();

                $detailbarang->stokNoTrans = $idTrans;//
                $detailbarang->stokTanggal = $this->reversdate($param['tgl_pengadaan']);//
                $detailbarang->stokBrgId = 0;//
                $detailbarang->stokBrgKode = $idbarang;//
                $detailbarang->stokBrgNama = $nama_barang;//
                $detailbarang->stokBrgVolume = $qty;//
                $detailbarang->stokBrgKoreksi = $qty;//
                // $detailbarang->stokBrgSatuan = $satuan;//
                // $detailbarang->stokKeterangan= $ket;//
                // $detailbarang->stokBrgHarga = $harga;//
                // $detailbarang->stokPpnJenis = $jnsppn;//
                // $detailbarang->stokPpnNilai = $ppnnilai;//
                // $detailbarang->stokBrgBatch = $no_batch;//
                $detailbarang->stokTotal = $total;//
                $detailbarang->stokSkpd = $skpd;//
                $detailbarang->stokBrgBatchSistem = $batch_sistem;//

                $detailbarang->save();

                $jumlah=$jumlah+$total;
            }
        }

        $x=$ppnnilai/100*$jumlah;
        $jumlahAhir=$jumlah+$x;

        Input::merge(array(
            // 'stokhNota'             => $param['nota'],
            'stokhNoTrans'          => $idTrans,
            'stokhSuplier'          => $param['lkIdPeg'],
            'stokhTglTerima'        => $this->reversdate($param['tgl_pengadaan']),
            // 'stokhNoKontrak'        => $nokontrak,
            'stokhNoPemeriksaan'    => $nopemeriksaan,
            // 'stokhNoKwitansi'       => $nokwitansi,
            // 'stokhNoPenerimaanGudang'=>$nopenerimaangudang,
            // 'stokhJenisPenerimaan'  => $jenis,
            // 'stokhDiskonFaktur'     => 0,
            // 'stokhPpn'              => $idppn,
            // 'stokhPpnNilai'         => $x,
            // 'stokhTotal'            => $jumlahAhir,
            'stokhSkpd'             => $skpd,
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
