<?php
namespace Admin\Penilaian;

use BasicController;
use DateTime;
use DB;
use Lang;
use Input;
use Session;

class DpakController extends BasicController {
    /**
     * Set Model's Repository
     * 
     */
        public function __construct() {
         $this->model = new \Admin\Penilaian\Dpak();
     }
     public function index(){
           $param   = Input::all();
           $search  = !empty($param['search']['value'])?$param['search']['value']:'';
           // $skpd    = Session::get('skpd');
           $unit   = Session::get('unit');

           try {
                $query = DB::table('trdpakdetail')
                        ->select('*',
                              // DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-print\" onclick=\"printData(\'",stokhNoTrans,"\')\"></i></a>") as print'),
                             DB::raw('concat("<a href=\"#\"><i class=\"fa  fa-times-circle\" onclick=\"deleteData(",dpakdId,")\"></i></a>") as del')
                          )
                        // ->whereRaw("YEAR(stokhTglTerima) = $tahun")
                        ->where('dpakdC1','like','%'.$search.'%')
                        ->where('dpakdId','like','%'.$search.'%')
                        ->orderby('dpakdId','asc')
                        ->get();

                return $query;
                 
           }catch(Exception $e){
               return Response::exception($e);
           }

     }

      

     //   public function beforeStore(){
     //    $param=Input::all();

     //    // $$tglRetur=!empty($param['tgl_retur'])? $this->reversdate($param['tgl_retur']):'0000-00-00';
     //    // // $date_now=date('Y',strtotime("1999"));
     //    // $dpakId=!empty($param['dpakId'])?$param['dpakId']:'';
     //    // $skpd= Session::get('skpd');
     //    // $ppnnilai   = 0;

     //    // $param['tgl_faktur']    = !empty($param['tgl_faktur']) ? $param['tgl_faktur'] : '00-00-0000';
     //    // $param['tgl_pengadaan'] = !empty($param['tgl_pengadaan']) ? $param['tgl_pengadaan'] : '00-00-0000';
     //    // $param['otomatis']      = !empty($param['otomatis'])?$param['otomatis']:'0';
     //    // $nopemeriksaan          = $param['nopemeriksaan'];
     //    // $nokontrak              = $param['nokontrak'];
     //    // $nokwitansi             = $param['nokwitansi'];
     //    // $nopenerimaangudang     = $param['nopenerimaangudang'];
     //    // $jenis                  = $param['jenis'];
     //    // $noid                   = $param['noid'];

     //    $jadwalkbm                      = $param['jadwalkbm'];
     //    $kalender                       = $param['kalender'];
     //    $pekanefektif                   = $param['pekanefektif'];
     //    $analisa                        = $param['analisa'];
     //    $distibusi                      = $param['distibusi'];
     //    $analisis                       = $param['analisis'];

     //    $ki                             = $param['ki'];
     //    $kd                             = $param['kd'];
     //    $mp                             = $param['mp'];
     //    $kp                             = $param['kp'];
     //    $indika                         = $param['indika'];
     //    $nilai                          = $param['nilai'];
     //    $alokasi                        = $param['alokasi'];
     //    $sumber                         = $param['sumber'];

     //    $alokasiwaktu                   = $param['alokasiwaktu'];
     //    $komin                          = $param['komin'];
     //    $komdas                         = $param['komdas'];
     //    $indikatorpembelajaran          = $param['indikatorpembelajaran'];
     //    $tujuanpel                      = $param['tujuanpel'];
     //    $mapel                          = $param['mapel'];
     //    $metode                         = $param['metode'];
     //    $kegiatan                       = $param['kegiatan'];
     //    $sumberbelajar                  = $param['sumberbelajar'];
     //    $bahanbelajar                   = $param['bahanbelajar'];
     //    $alatbelajar                    = $param['alatbelajar'];
     //    $penilaian                      = $param['penilaian'];

     //    $materipembelajaran             = $param['materipembelajaran'];
     //    $presensi                       = $param['presensi'];
     //    $catatan                        = $param['catatan'];
     //    $bentukkbm                      = $param['bentukkbm'];

     //    $butirsoal                      = $param['butirsoal'];
     //    $pelaksanaanpenilaian           = $param['pelaksanaanpenilaian'];
     //    $hasilpenilaian                 = $param['hasilpenilaian'];
     //    $atl                            = $param['atl'];

     //    $rec=$param['jumRecord'];
     //    $jumlah=0;
        
     //    for($i=0;$i<=$rec-1;$i++){
     //    $jadwalkbm                      = !empty($param['jadwalkbm'.$i])?$param['jadwalkbm'.$i]:'';
     //    // $kalender                       = !empty($param['kalender'.$i])?$param['kalender'.$i]:'';
     //    // $pekanefektif                   = !empty($param['pekanefektif'.$i])?$param['pekanefektif'.$i]:'';
     //    // $analisa                        = !empty($param['analisa'.$i])?$param['analisa'.$i]:'';
     //    // $distibusi                      = !empty($param['distibusi'.$i])?$param['distibusi'.$i]:'';
     //    // $analisis                       = !empty($param['analisis'.$i])?$param['analisis'.$i]:'';

     //    // $ki                             = !empty($param['ki'.$i])?$param['ki'.$i]:'';
     //    // $kd                             = !empty($param['kd'.$i])?$param['kd'.$i]:'';
     //    // $mp                             = !empty($param['mp'.$i])?$param['mp'.$i]:'';
     //    // $kp                             = !empty($param['kp'.$i])?$param['kp'.$i]:'';
     //    // $indika                         = !empty($param['indika'.$i])?$param['indika'.$i]:'';
     //    // $nilai                          = !empty($param['nilai'.$i])?$param['nilai'.$i]:'';
     //    // $alokasi                        = !empty($param['alokasi'.$i])?$param['alokasi'.$i]:'';
     //    // $sumber                         = !empty($param['sumber'.$i])?$param['sumber'.$i]:'';

     //    // $alokasiwaktu                   = !empty($param['alokasiwaktu'.$i])?$param['alokasiwaktu'.$i]:'';
     //    // $komin                          = !empty($param['komin'.$i])?$param['komin'.$i]:'';
     //    // $komdas                         = !empty($param['komdas'.$i])?$param['komdas'.$i]:'';
     //    // $indikatorpembelajaran          = !empty($param['indikatorpembelajaran'.$i])?$param['indikatorpembelajaran'.$i]:'';
     //    // $tujuanpel                      = !empty($param['tujuanpel'.$i])?$param['tujuanpel'.$i]:'';
     //    // $mapel                          = !empty($param['mapel'.$i])?$param['mapel'.$i]:'';
     //    // $metode                         = !empty($param['metode'.$i])?$param['metode'.$i]:'';
     //    // $kegiatan                       = !empty($param['kegiatan'.$i])?$param['kegiatan'.$i]:'';
     //    // $sumberbelajar                  = !empty($param['sumberbelajar'.$i])?$param['sumberbelajar'.$i]:'';
     //    // $bahanbelajar                   = !empty($param['bahanbelajar'.$i])?$param['bahanbelajar'.$i]:'';
     //    // $alatbelajar                    = !empty($param['alatbelajar'.$i])?$param['alatbelajar'.$i]:'';
     //    // $penilaian                      = !empty($param['penilaian'.$i])?$param['penilaian'.$i]:'';

     //    // $materipembelajaran             = !empty($param['materipembelajaran'.$i])?$param['materipembelajaran'.$i]:'';
     //    // $presensi                       = !empty($param['presensi'.$i])?$param['presensi'.$i]:'';
     //    // $catatan                        = !empty($param['catatan'.$i])?$param['catatan'.$i]:'';
     //    // $bentukkbm                      = !empty($param['bentukkbm'.$i])?$param['bentukkbm'.$i]:'';

     //    // $butirsoal                      = !empty($param['butirsoal'.$i])?$param['butirsoal'.$i]:'';
     //    // $pelaksanaanpenilaian           = !empty($param['pelaksanaanpenilaian'.$i])?$param['pelaksanaanpenilaian'.$i]:'';
     //    // $hasilpenilaian                 = !empty($param['hasilpenilaian'.$i])?$param['hasilpenilaian'.$i]:'';
     //    // $atl                            = !empty($param['atl'.$i])?$param['atl'.$i]:'';
     //    // $dpakdIdPeg                     = !empty($param['dpakdIdPeg'.$i])?$param['dpakdIdPeg'.$i]:'';


     //        if($jadwalkbm!=''){
     //            $detaildpak = new \Admin\Penilaian\Dpakdetail();

     //            // $detaildpak->dpakdIdPeg = $dpakdIdPeg;//
     //           // $detaildpak->dpakdTanggal = $this->reversdate($param['tgl_pengadaan']);//
     //            $detaildpak->jadwalkbm = $jadwalkbm;
     //            $detaildpak->pekanefektif = $pekanefektif;//
     //            // $detaildpak->kalender = $kalender;//
     //            // $detaildpak->pekanefektif = $pekanefektif;//
     //            // $detaildpak->analisa = $analisa;//
     //            // $detaildpak->distribusi = $distribusi;//
     //            // $detaildpak->analisis = $analisis;//
     //            // $detaildpak->ki= $ki;//
     //            // $detaildpak->kd = $kd;//
     //            // $detaildpak->mp = $mp;//
     //            // $detaildpak->kp = $kp;//
     //            // $detaildpak->indika = $indika;//
     //            // $detaildpak->alokasi = $alokasi;//
     //            // $detaildpak->nilai = $nilai;//
     //            // $detaildpak->sumber = $sumber;//
     //            // $detaildpak->alokasiwaktu = $alokasiwaktu;//
     //            // $detaildpak->komin = $komin;//
     //            // $detaildpak->komdas = $komdas;//
     //            // $detaildpak->indikatorpembelajaran = $indikatorpembelajaran;//
     //            // $detaildpak->tujuanpel = $tujuanpel;//
     //            // $detaildpak->mapel = $mapel;//
     //            // $detaildpak->metode = $metode;//
     //            // $detaildpak->kegiatan = $kegiatan;//
     //            // $detaildpak->sumberbelajar = $sumberbelajar;//
     //            // $detaildpak->bahanbelajar = $bahanbelajar;//
     //            // $detaildpak->alatbelajar = $alatbelajar;//
     //            // $detaildpak->penilaian = $penilaian;//
     //            // $detaildpak->materipembelajaran = $materipembelajaran;//
     //            // $detaildpak->presensi = $presensi;//
     //            // $detaildpak->catatan = $catatan;//
     //            // $detaildpak->bentukkbm = $bentukkbm;//
     //            // $detaildpak->butirsoal = $butirsoal;//
     //            // $detaildpak->pelaksanaanpenilaian = $pelaksanaanpenilaian;//
     //            // $detaildpak->hasilpenilaian = $hasilpenilaian;//
     //            // $detaildpak->atl = $atl;//




     //            $detaildpak->save();

     //            // $jumlah=$jumlah+$total;
     //        }
     //    }
        

     //    //$x=$ppnnilai/100*$jumlah;
     //    // $dpakJan1=$jadwalkbm+$kalender+$pekanefektif+$analisa+$distribusi+$analisis;
     //    // $dpakJan2=$ki+$kd+$mp+$kp+$indika+$nilai+$alokasi+$sumber;
     //    // $dpakJan3=$alokasiwaktu+$komin+$komdas+$indikatorpembelajaran+$tujuanpel+$mapel+$metode+$kegiatan+$sumberbelajar+$bahanbelajar+$alatbelajar+$penilaian;
     //    // $dpakJan4=$materipembelajaran+$presensi+$catatan+$bentukkbm;
     //    // $dpakJan5=$butirsoal+$pelaksanaanpenilaian+$hasilpenilaian+$atl;


     //    Input::merge(array(
     //        'dpakCreateTime'=>$tglRetur,

     //        // 'dpakCreateTime' => $date_now,
     //        // 'dpakJan1'           =>$dpakJan1,
     //        // 'dpakJan2'           =>$dpakJan2,
     //        // 'dpakJan3'           =>$dpakJan3,
     //        // 'dpakJan4'           =>$dpakJan4,
     //        // 'dpakJan5'           =>$dpakJan5,
            
     //      ));

     // }

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

        $total   = !empty($param['total'])?$param['total']:0;
        $total2= !empty($param['total2'])?$param['total2']:0;
        $total3     = !empty($param['total3'])?$param['total3']:0;
        $total4        = !empty($param['total4'])?$param['total4']:0;

        $total5      = !empty($param['total5'])?$param['total5']:0;
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

        return $detailbarang;

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