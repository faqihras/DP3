<?php
namespace Admin\Penilaian;

use BasicController;
use DateTime;
use DB;
use Lang;
use Input;
use Session;

class DpskController extends BasicController {
    /**
     * Set Model's Repository
     */
        public function __construct() {
         $this->model = new Dpsk();
     }
     public function index()
     {
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';
           $unit=!empty($param['dpskUnit'])?$param['dpskUnit']:''; 
           $date_now=date('Y',strtotime("1999"));
           $i = 1;
           $query = DB::table('trdpsk')
                  ->select('*' ,DB::raw('
                            concat("<button type=\'button\' data-toggle=\'modal\' data-target=\'#myModal\' id=\'btpopup\' onclick=\'detail_data(1,",dpskId,")\'><i class=\'fa fa-search\'></i></button>") AS detail
                        ')
                  )

                  // DB::raw('IF(tanggallahir="0000-00-00",concat("-"),tanggallahir) as tanggal_lahir')
                  
                  ->leftjoin('ms_satuankerja','satkerId','=','dpskUnit')
                  ->where('dpskUnit','=',$unit)
                
                  ->get();

            
                  foreach ($query as $key => $val) {
                    
              

                    $res[]=array(
                      // 'no'=>$i,
                      // 'dpskId'=> "<input type='hidden' id='myInput' value='$val->dpskId'>",
                      'dpskNip'=>$val->dpskNip,
                      'dpskNama'=>$val->dpskNama,
                      'satkerNama'=>$val->satkerNama,
                      'detail'=>$val->detail,
                      
                     


                    

                    );

              $i++;
         
            }
            return $res;
     }

      public function Store(){
        $param=Input::all();
        $skpd= Session::get('skpd');

        $idTrans    = !empty($param['nomortransaksi'])?$param['nomortransaksi']:'';
        $tglTrans   = !empty($param['tgltransaksi'])?$param['tgltransaksi']:'00/00/0000';
        $idbarang   = !empty($param['kodeBarang'])?$param['kodeBarang']:'';
        $nama_barang= !empty($param['namaBarang'])?$param['namaBarang']:'';
        $satuan     = !empty($param['satuan'])?$param['satuan']:'';
        $ket        = !empty($param['ket'])?$param['ket']:'';
        $qty        = !empty($param['qty'])?$param['qty']:0;

        $no_batch   = !empty($param['no_batch'])?$param['no_batch']:'-';
        // $expired_date=!empty($param['expired_date'])? $this->reversdate($param['expired_date']):'0000-00-00';
        $harga      = !empty($param['hrgbeli'])?$param['hrgbeli']:0;
        $diskon_item= !empty($param['diskon_item'])?$param['diskon_item']:0;
        // $total      = !empty($param['total'])?$param['total']:0;
        $total      = $qty * $harga;

        //batch-sistem
        $batch_sistem = str_replace(" ","",$idbarang) . str_replace("-","",$param['tgltransaksi']) . substr($harga,0,2);

        $ppnnilai   = 0;
        $jnsppn     = 0;
        $total_lama = 0;
        $total_baru = 0;

        if($idbarang!=''){
            $detailbarang = new \Admin\Gudang\Stokdetail();

            $detailbarang->stokNoTrans = $idTrans;//
            $detailbarang->stokTanggal = $tglTrans;//
            $detailbarang->stokBrgId = 0;//
            $detailbarang->stokBrgKode = $idbarang;//
            $detailbarang->stokBrgNama = $nama_barang;//
            $detailbarang->stokBrgVolume = $qty;//
            $detailbarang->stokBrgKoreksi = $qty;//
            $detailbarang->stokBrgSatuan = $satuan;//
            $detailbarang->stokKeterangan= $ket;//
            $detailbarang->stokBrgHarga = $harga;//
            $detailbarang->stokPpnJenis = $jnsppn;//
            $detailbarang->stokPpnNilai = $ppnnilai;//
            $detailbarang->stokBrgBatch = $no_batch;//
            $detailbarang->stokTotal = $total;//
            $detailbarang->stokSkpd = $skpd;//
            $detailbarang->stokBrgBatchSistem = $batch_sistem;//

            $detailbarang->save();

            $query2 = DB::table('trStokHeader')
                    ->select('stokhTotal')
                    ->where('stokhNoTrans','=',$idTrans)
                    ->get();

            $total_lama = $query2[0]->stokhTotal;

        }

        $total_baru = $total_lama + $total;

        //update-total
        DB::table('trStokHeader')
            ->where('stokhNoTrans','=', $idTrans)
            ->update(['stokhTotal' => $total_baru]);

     }


     public function reversdate($tanggal){
        if((substr($tanggal, 2,1)=='/') or (substr($tanggal, 1,1)=='/')){
            $a=explode("/",$tanggal);
            $result=$a[2].'-'.$a[0].'-'.$a[1];
        }else{
            $a=explode("-",$tanggal);
            $result=$a[2].'-'.$a[1].'-'.$a[0];
        }
        return $result;
     }



}