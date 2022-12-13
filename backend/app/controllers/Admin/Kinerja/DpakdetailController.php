<?php
namespace Admin\Kinerja;

use BasicController;
use DB;
use Lang;
use Input;
use Session;

class DpakndetailController extends BasicController {

     public function index()
     {
           $param=Input::all();        
           $notrans=!empty($param['id'])? $param['id'] :'xxxxx';
           $cunit=!empty($param['unit'])? $param['unit'] :'';
           $skpd = Session::get('skpd');

           $query = DB::table('trStokDetail')
                    ->select('*',
                        DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-times-circle\" onclick=\"deleteData(",stokId,",\'",stokBrgBatchSistem,"\')\"></i></a>") as del'))
                    ->leftjoin('msbarang','barangKode','=','stokBrgKode')
                    ->where('stokNoTrans','=',$notrans)
                    ->where('stokSkpd','=',$skpd)
                    ->where('barangSkpd','=',$skpd)
                    ->get();

                  
            $i=0;
            foreach ($query as $key => $val) {
                $stokid=$val->stokId;
                $idbarang=trim($val->stokBrgKode);
                $nmbarang=$val->stokBrgNama;
                $harga=$val->stokBrgHarga;//jualdHarga
                $total=$val->stokBrgHarga * $val->stokBrgKoreksi;
                $satuan=$val->stokBrgSatuan;
                $permintaan=$val->stokBrgKoreksi;
                $batchsistem = $val->stokBrgBatchSistem;

                $query2 = DB::connection('mysql2')->table('rptPerfaktual')
                        ->select(DB::raw('SUM(masukunit) as total'))
                        ->where('skpd','=',$skpd)
                        ->where('kode','=',$idbarang)
                        ->get();

                $total_penerimaan=!empty(number_format($query2[0]->total,2)) ? number_format($query2[0]->total,2) : 0;

                $query3 = DB::connection('mysql2')->table('rptPerfaktual')
                        ->select(DB::raw('SUM(keluarunit) as total'))
                        ->where('skpd','=',$skpd)
                        ->where('kode','=',$idbarang)
                        ->get();

                $total_pemakaian=!empty(number_format($query3[0]->total,2)) ? number_format($query3[0]->total,2) : 0;

                $query[$i]->nomor=($i+1).'<input type="hidden" name="nomor'.$i.'" id="nomor'.$i.'" value="'.($i+1).'"><input type="hidden" name="stokId'.$i.'" id="stokId'.$i.'" value="'.$stokid.'">';
                $query[$i]->batch_sistem=$batchsistem.'<input type="hidden" name="batch_sistem'.$i.'" id="batch_sistem'.$i.'" value="'.$batchsistem.'">';
                $query[$i]->id_barang=$idbarang.'<input type="hidden" name="id_barang'.$i.'" id="id_barang'.$i.'" value="'.$idbarang.'">';
                $query[$i]->nama_barang=$nmbarang.'<input type="hidden" name="nama_barang'.$i.'" id="nama_barang'.$i.'" value="'.$nmbarang.'">';
                $query[$i]->qty=$permintaan.'<input type="hidden" name="qty'.$i.'" id="qty'.$i.'" value="'.$permintaan.'">';
                $query[$i]->satuan_kecil=$satuan.'<input type="hidden" name="satuan_kecil'.$i.'" id="satuan_kecil'.$i.'" value="'.$satuan.'">';
                $query[$i]->harga=number_format($harga,2).'<input type="hidden" name="harga'.$i.'" id="harga'.$i.'" value="'.$harga.'">';
                // $query[$i]->total=number_format($total).'<input type="hidden" name="total'.$i.'" id="total'.$i.'" value="'.$total.'">';
 
                $query[$i]->total='<input type="text" class="form-control" name="total'.$i.'" id="total'.$i.'" value="'.$total.'" style="text-align:right" readonly="true"/>';
                // $query[$i]->pemberian='<input type="text" class="form-control" name="pemberian_'.$i.'" id="pemberian_'.$i.'" value="'.$permintaan.'" style="text-align:right" onkeypress="return(numbersonly(event))" onkeyup="cekInput(this)"/>';
                $query[$i]->pemberian='
                <input type="hidden" class="form-control" name="koreksi'.$i.'" id="koreksi'.$i.'" value="" style="text-align:right" onkeyup="cekInput(this)"/>
                <input type="text" class="form-control" name="pemberian_'.$i.'" id="pemberian_'.$i.'" value="'.$permintaan.'" style="text-align:right" onkeyup="cekInput(this)"/>';

                $query[$i]->stok_penerimaan=$total_penerimaan.'<input type="hidden" name="stok_penerimaan'.$i.'" id="stok_penerimaan'.$i.'" value="'.$total_penerimaan.'">';
                $query[$i]->stok_pemakaian=$total_pemakaian.'<input type="hidden" name="stok_pemakaian'.$i.'" id="stok_pemakaian'.$i.'" value="'.$total_pemakaian.'">';

                $i++;
            }        

           return array("data"=>$query);                
     }
    
}