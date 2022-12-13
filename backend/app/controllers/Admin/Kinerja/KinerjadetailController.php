<?php
namespace Admin\Kinerja;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
class KinerjadetailController extends BasicController {
  public function __construct() {
         $this->model = new \Admin\Kinerja\Kinerja();
     }
     public function index()
     {
           $param=Input::all();
           $search=!empty($param['search']['value'])?$param['search']['value']:'';
           $tgawal=!empty($param['lkTglAwal'])?$this->reversdate($param['lkTglAwal']):'0000-00-00';
           $tgahir=!empty($param['lkTglAkhir'])?$this->reversdate($param['lkTglAkhir']):'0000-00-00';
           $pegawai    = !empty($param['lkIdPeg']) ? $param['lkIdPeg']:'1' ;
           $status =!empty($param['abStatus']) ? $param['abStatus']:'' ;
            $nama    = !empty($param['lkIdPeg']) ? $param['lkIdPeg']:'' ;
            // $lkId    = !empty($param['lkId']) ? $param['lkId']:'1' ;
            $id      = $nama == 1  ;

             $query = DB::table($this->model->getTable())
                    ->select('*',
                        DB::raw('
                            concat("<button type=\'button\' data-toggle=\'modal\' data-target=\'#myModal\' id=\'btpopup\' onclick=\'detail_data(1,",lkId,")\'><i class=\'fa fa-search\'></i></button>") AS detail
                        '),
                         DB::raw('(CASE 
                                WHEN trlapkinerja.lkStatus = "1" THEN "SELESAI"
                                WHEN trlapkinerja.lkStatus = "2" THEN "OG"
                                ELSE "PENDING"
                                END) as status')
                    )
                    // ->leftjoin('admin_users', 'ausrId', '=', 'lkIdPeg')
                      ->leftjoin('ms_angkakredit', 'akId', '=', 'lkId')
                      ->leftjoin('admin_users', 'ausrId', '=', 'lkIdPeg')
                      ->leftjoin('ms_pegawai', 'pegId', '=', 'lkIdPeg')
                      ->where('lkIdPeg','=',$pegawai)
                     
                      ->where(DB::raw('left(lkTglAwal,10)'),'>=',$tgawal)
                      ->where(DB::raw('left(lkTglakhir,10)'),'<=',$tgahir)
                      // ->where('lkId','=',$nama)
                      ->get();

                     $res        = array();
                    $i=0;

            foreach ($query as $key => $val) {
                //  if($val->lkStatus==0){
                //   $status="<p style=\"background-color:#003049;color:#fff;padding-left:2px;padding-right:2px;padding-bottom:2px;margin-top:12px;font-size:10px;font-style:italic;\">Pending</p>";
                // }else if($val->lkStatus==1){
                //   $status="<p style=\"background-color:#f77f00;color:#fff;padding-left:2px;padding-right:2px;padding-bottom:2px;margin-top:12px;font-size:10px;font-style:italic;\">On Going</p>";
                // }else {
                //   $status="<p style=\"background-color:#3a86ff;color:#fff;padding-left:2px;padding-right:2px;padding-bottom:2px;margin-top:16px;font-size:10px;font-style:italic;\">Selesais</p>";
                // }
                
                $res[]=array(
                        'pegNama'=>$val->pegNama,
                        'lkSkpTahun'=>$val->lkSkpTahun,
                        
                        'akNamaKegiatan'=>$val->akNamaKegiatan,
                        'lkKeterangan'=>$val->lkKeterangan,
                        // 'lkBiaya'=>$val->lkBiaya,
                        'lkStatus'=>$status,
                        'detail'=>$val->detail,
                      );

                $i++;
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
