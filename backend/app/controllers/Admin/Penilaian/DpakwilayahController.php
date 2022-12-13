<?php
namespace Admin\Penilaian;

use BasicController;
use DateTime;
use DB;
use Lang;
use Input;
use Session;

class DpakwilayahController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new Dpak();
     }
     public function index()
     {
           $param=Input::all();        

           $kel=!empty($param['dpakPegUnit'])?$param['dpakPegUnit']:'';
           
           $res = array();

           $search=!empty($param['search']['value'])?$param['search']['value']:'';
           $date_now=date('Y',strtotime("1999"));
           $query = DB::table($this->model->getTable())
                  ->select('*'
                  
                  )

                   ->leftjoin('ms_satuankerja','satkerId','=','dpakId')
                    ->where('dpakPegUnit','=',$kel)
                    ->get();
            // $result=$this->getDataGrid($query);
            // asort($query);

            $i=0;
            // $j=1;
            foreach ($query as $key => $val) {
                $date1  = $val->tanggallahir; // Your date of birth
                $date2  = date('Y-m-d');
                $diff   = abs(strtotime($date2) - strtotime($date1));
                $years  = floor($diff / (365*60*60*24));
                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
          
                if($date1=="0000-00-00"){
                  $resdate="-";
                }else{
                  $resdate=date("d-m-Y", strtotime($date1)).' : '.$years.' Tahun ';
                }

                // $result['data'][$i]->no=$j;
                // $result['data'][$i]->tgl_lahir_umur = $resdate;

                $res[]=array(
                       'dpakId' => $val->dpakId,
                        'dpakPegNip'=>$val->dpakPegNip,
                        'dpakPegNama'=>$val->dpakPegNama,
                      
                        'detail'=>$val->detail,
                      );

                $i++;
                // $j++;
            }     

            return $res;
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