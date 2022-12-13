<?php
namespace Admin\Absensi;

use BasicController;
use DB;
use Lang;
use Input;
use Response;
use Hash;
use Eloquent;
use Session;

class AbsenmobileController extends BasicController {

     public function __construct() {
         $this->model = new \Admin\Master\Absen();
     }


     public function index(){
          // $param=Input::all();
           $param=Input::all();        
           $search=!empty($param['search']['value'])?$param['search']['value']:'';
           $data = Session::get('userIdAdmin');
           $role = Session::get('userRolhId');
           if ($role == 1) {
                $raw = $data;
           }else{
                $raw = "lkIdPeg = '$data' ";
           }

           $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('abUserId','=',$param['uid'])
                    ->orderby('abCreateTime','desc')
                    ->limit(5)
                    ->get();

                    return response()->json($query);

           $res=array();
           $i=0;
           foreach ($query as $key => $val) {
              $tanggal=substr($val->abCreateTime,0,10);
              $waktu=substr($val->abCreateTime,11,10);
              $query[$i]->abCreateTime=$this->reverseDate($tanggal).' '.$waktu;
              if($query[$i]->abKet==''){
                  $query[$i]->abKet='Ket : -';
              }else{
                  $query[$i]->abKet='Ket : '.$query[$i]->abKet;
              }
              $i++;
           }
           return $query;
     }

     public function beforeStore(){
         $param      =Input::all();
         //$data['abUserLoc']=!empty($data['abUserLoc']) ? $data['abUserLoc']:'x';
        $time =date('H:i:s');
        $ses = !empty($param['abUserId']) ? $param['abUserId'] : Session::get('userIdAdmin');
        $content         = $param['content'];
        $tgl =date('Y-m-d');
        // $lat         = $param['lat'];
        
        // $result_code = !empty($param['result']) ? $param['result'] :'';
        $namapeg = !empty($nama[0]->satkerNama) ? $nama[0]->satkerNama : '-';
        $query = DB::table($this->model->getTable())
                    ->select('*')
                    ->where('abUserId')
                   // ->leftjoin('mobile_users','userLoc','=','abUserLoc')
                    //->leftjoin('ms_area','areaId','=','userLoc')
                  //  ->where('userLoc','=','abUserLoc')
                    ->orderby('abCreateTime','desc')
                    ->limit(5)
                    ->get();
         $id = !empty($query[0]->abId) ? $query[0]->abId : '-';
         $Jenis = !empty($query[0]->abJenis) ? $query[0]->abJenis : '-';
         $plg = !empty($query[0]->abJamMasuk) ? $query[0]->abJamMasuk : '-';   
                   
        if ($plg == 0 && $Jenis == 0 ) {
             $times = 1;
                Input::merge(array(
                   'abUserId'           =>$ses,
                   'abLoc'           =>$content,
                    'abJenis'           =>$times,
                     // 'abLat'           =>$content,
                      // 'abLng'           =>$long,
                    'abJamMasuk' => date('Y-m-d H:i:s'),
                    'abLat' => date('Y-m-d H:i:s')

                     ));

              
                
           }
           elseif ($plg !=0  && $Jenis == 1) {

                $q2=DB::table('absen')
                ->where('abCreateTime','=',$plg) 
                ->update(array('abJamPulang' => date('Y-m-d H:i:s')));
           }

        $latKantor = "-6.797151086860508";
        $longKantor = "110.80261418355411";

      
          
        
         return ('dashboard.html');

     }

     // public function beforeStore(){
     //     $param      =Input::all();
     //    // $session    = session::all();
     //    $ses = !empty($param['abUserId']) ? $param['abUserId'] : Session::get('userIdAdmin');
     //    $query = DB::table($this->model->getTable())
     //                ->select('*')
     //                ->where('abUserId')
     //                ->orderby('abCreateTime','desc')
     //                ->limit(5)
     //                ->get();

     //    // $latKantor = "-6.797151086860508";
     //    // $longKantor = "110.80261418355411";

     //    Input::merge(array(
     //               'abUserId'           =>$ses,
     //                'abWaktuAbsen' => date('Y-m-d H:i:s')
     //                 ));
     //     redirect('dashboard');

     // }
     

   // public function create(Request $request){
   //   $data = [];
   //   $data = [
   //       'lat' => $request->lat,
   //       'lng' => $request->lng,
   //       'photo' => $request->photo,
   //       // 'jenis' => $request->jenis,
   //       'userId' => $request->userId,
   //       'siswa_id' => $request->siswa_id,
   //       'kelas_id' => $request->kelas_id,
   //       'jenjang_id' => $request->jenjang_id,
   //       'date' => date_format(date_create(), 'Y-m-d'),
   //       'status' => $request->status,
   //       'note' => $request->note,
   //       'abCreateTime' => date_format(date_create(), 'Y-m-d H:i:s')
   //   ];
   
   //       AbsenSiswa::insert($data);
   
   //    return $data;
   
   // }
    public function distance($lat1,$lon1,$lat2,$lon2,$unit){
        $theata = $lon1-$lon2;
        $dist   = sin(deg2rad($lat1))*sin(deg2rad($lat2)) + cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($theta));
        $dist   = acos($dist);
        $dist   =  rad2deg($dist);
        $miles  = $dist *60 * 1.1515;
        $unit   = strtoupper($unit);
        
        if($unit=="K"){
            return($miles * 1.609344);
        }else if ($unit== "N"){
            return($miles * 0.8684);
        } else{
            return $miles;
        }
    }

   public function reverseDate($tanggal){
        $a=explode("-", $tanggal);
        return $a[2].'-'.$a[1].'-'.$a[0];
   }

   

}
