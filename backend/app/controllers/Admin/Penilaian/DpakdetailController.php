<?php
namespace Admin\Penilaian;

use BasicController;
use DB;
use Lang;
use Input;
use Session;

class DpakdetailController extends BasicController {

     public function index()
     {
           $param=Input::all();
           $notrans=!empty($param['id'])? $param['id'] :'xxxxx';      
           $search=!empty($param['search']['value'])?$param['search']['value']:'';
           $unit=!empty($param['dpakUnit'])?$param['dpakUnit']:''; 
           $date_now=date('Y',strtotime("1999"));
           $i = 1;


           $query = DB::table('ms_pegawai')
                    ->select('*',
                       DB::raw('
                            concat("<button type=\'button\' data-toggle=\'modal\' data-target=\'#myModal1\' id=\'btpopup\' onclick=\'(1,",pegId,")\'><i class=\'fa fa-search\'></i></button>") AS detail2'))
                   ->leftjoin('ms_satuankerja','satkerId','=','pegUnit')
                  ->where('pegUnit','=',$notrans)
                  ->where('pegJab','=',1)      
                  ->get();


                  
            $i=0;
            foreach ($query as $key => $val) {
                $dpakId= $val->pegId;
                $dpakNip=$val->pegNip;
                $detail2=$val->detail2;
                // $idbarang=trim($val->stokBrgKode);
                // $nmbarang=$val->stokBrgNama;
                // $harga=$val->stokBrgHarga;//jualdHarga
                // $total=$val->stokBrgHarga * $val->stokBrgKoreksi;
                // $satuan=$val->stokBrgSatuan;
                // $permintaan=$val->stokBrgKoreksi;
                // $batchsistem = $val->stokBrgBatchSistem;

                // // $query2 = DB::connection('mysql2')->table('rptPerfaktual')
                // //         ->select(DB::raw('SUM(masukunit) as total'))
                // //         ->where('skpd','=',$skpd)
                // //         ->where('kode','=',$idbarang)
                // //         ->get();

                // // $total_penerimaan=!empty(number_format($query2[0]->total,2)) ? number_format($query2[0]->total,2) : 0;

                // // $query3 = DB::connection('mysql2')->table('rptPerfaktual')
                // //         ->select(DB::raw('SUM(keluarunit) as total'))
                // //         ->where('skpd','=',$skpd)
                // //         ->where('kode','=',$idbarang)
                // //         ->get();

                // // $total_pemakaian=!empty(number_format($query3[0]->total,2)) ? number_format($query3[0]->total,2) : 0;

                $query[$i]->nomor=($i+1).'<input type="hidden" name="nomor'.$i.'" id="nomor'.$i.'" value="'.($i+1).'"><input type="hidden" name="dpakId'.$i.'" id="dpakId'.$i.'" value="'.$dpakId.'">';
                // $query[$i]->batch_sistem=$batchsistem.'<input type="hidden" name="batch_sistem'.$i.'" id="batch_sistem'.$i.'" value="'.$batchsistem.'">';
                // $query[$i]->id_barang=$idbarang.'<input type="hidden" name="id_barang'.$i.'" id="id_barang'.$i.'" value="'.$idbarang.'">';
                // $query[$i]->nama_barang=$nmbarang.'<input type="hidden" name="nama_barang'.$i.'" id="nama_barang'.$i.'" value="'.$nmbarang.'">';
                // $query[$i]->qty=$permintaan.'<input type="hidden" name="qty'.$i.'" id="qty'.$i.'" value="'.$permintaan.'">';
                // $query[$i]->satuan_kecil=$satuan.'<input type="hidden" name="satuan_kecil'.$i.'" id="satuan_kecil'.$i.'" value="'.$satuan.'">';
                // $query[$i]->harga=number_format($harga,2).'<input type="hidden" name="harga'.$i.'" id="harga'.$i.'" value="'.$harga.'">';
                // // $query[$i]->total=number_format($total).'<input type="hidden" name="total'.$i.'" id="total'.$i.'" value="'.$total.'">';
 
                // $query[$i]->total='<input type="text" class="form-control" name="total'.$i.'" id="total'.$i.'" value="'.$total.'" style="text-align:right" readonly="true"/>';
                // // $query[$i]->pemberian='<input type="text" class="form-control" name="pemberian_'.$i.'" id="pemberian_'.$i.'" value="'.$permintaan.'" style="text-align:right" onkeypress="return(numbersonly(event))" onkeyup="cekInput(this)"/>';
                $query[$i]->jadwalkbm='
                <input type="checkbox" class="form-control" name="jadwalkbm_'.$i.'" id="jadwalkbm_'.$i.'" value="1" style="text-align:right"/>';
                $query[$i]->pekanefektif='
                <input type="checkbox" class="form-control" name="pekanefektif_'.$i.'" id="jadwalkbm_'.$i.'" value="1" style="text-align:right"/>';

                // $query[$i]->stok_penerimaan=$total_penerimaan.'<input type="hidden" name="stok_penerimaan'.$i.'" id="stok_penerimaan'.$i.'" value="'.$total_penerimaan.'">';
                // $query[$i]->stok_pemakaian=$total_pemakaian.'<input type="hidden" name="stok_pemakaian'.$i.'" id="stok_pemakaian'.$i.'" value="'.$total_pemakaian.'">';

                $i++;
            }        

           return array("data"=>$query);                
     }

     public function Store(){
      $param=Input::all();
      // $skpd= Session::get('skpd');
      // $ppnnilai   = 0;

      // if($param['otomatis']==1){
      //       $q2=DB::table('trFakturHeader')
      //           ->where('hmutasiNoTrans','=',$param['nota'])
      //           ->update(array('hmutasiStatus' => 1));
      // }

      // // $idppn  = $param['jenis_ppn'];
      // $idppn=1;

      // if($idppn==1){
      //   $jnsppn='PPn Include';
      //   $ppnnilai=0;
      // }elseif($idppn==2){
      //   $jnsppn='PPn Exclude';
      //   $ppnnilai=10;
      // }elseif($idppn==3){
      //   $jnsppn='Tanpa PPn';
      //   $ppnnilai=0;
      // }

      // $idTrans='AWAL-'.$this->getNoTrans('1').'-'.date('Y');

      $rec=$param['jumRecord'];
      $jumlah=0;

      $total   = $param['total1'];;
      $total2    =$param['total2'];
      $total3     = $param['total3'];
      $total4        = $param['total4'];

      $total5      = $param['total5'];
      // $total      = !empty($param['total'])?$param['total']:0;
      // $ket        = !empty($param['keterangan'])?$param['keterangan']:'';

      //batch-sistem
      // $batch_sistem = str_replace(" ","",$idbarang) . str_replace("-","","2017-12-31") . substr($harga,0,2) . $skpd;

      if($total!=''){
          $detailbarang = new \Admin\Penilaian\Dpakdetail();

          $detailbarang->dpakdC1 = $total;//
          $detailbarang->dpakdC2 = $total2;//
          $detailbarang->dpakdC3 = $total3;//
          $detailbarang->dpakdC4 = $total4;//
          $detailbarang->dpakdC5 = $total5;//

          $detailbarang->save();
      }

      Input::merge(array(
            'dpakdC1'             => $param['total'],
            'dpakdC2'             => $param['total2'],
            'dpakdC3'             => $param['total3'],
            'dpakdC4'             => $param['total4'],
            'dpakdC5'             => $param['total5'],

          ));

   }
    
}