<?php
namespace Admin\Dashboard;

use BasicController;
use DB;
use Lang;
use Input;

class JenisbelanjaController extends BasicController {
    /**
     * Set Model's Repository
     */
     public function __construct() {
         $this->model = new \Admin\Anggaran\Rkasusun();
     }

     public function index()
     {

       try {

            $res=array();

            $ang1 = DB::table($this->model->getTable())
                    ->select(DB::raw('sum('.$this->fieldAnggaran().') as angTotal'))
                    ->where('adrkaRek5Kd','like','5%')
                    ->orwhere('adrkaRek5Kd','like','62%')
                    ->get();
                    ;
            $total=$ang1[0]->angTotal;        

            $ang2 = DB::table($this->model->getTable())
                    ->select(DB::raw('sum('.$this->fieldAnggaran().') as angTotal'))
                    ->where('adrkaRek5Kd','like','511%')
                    ->get();
                    ;
            $gaji=$ang2[0]->angTotal;        


            $ang3 = DB::table($this->model->getTable())
                    ->select(DB::raw('sum('.$this->fieldAnggaran().') as angTotal'))
                    ->where('adrkaRek5Kd','not like','511%')
                    ->where('adrkaRek5Kd','like','51%')
                    ->get();
                    ;
            $ppkd=$ang3[0]->angTotal;        


            $ang4 = DB::table($this->model->getTable())
                    ->select(DB::raw('sum('.$this->fieldAnggaran().') as angTotal'))
                    ->where('adrkaRek5Kd','like','521%')
                    ->get();
                    ;
            $pegawai=$ang4[0]->angTotal;        


            $ang5 = DB::table($this->model->getTable())
                    ->select(DB::raw('sum('.$this->fieldAnggaran().') as angTotal'))
                    ->where('adrkaRek5Kd','like','522%')
                    ->get();
                    ;
            $barangj=$ang5[0]->angTotal;        


            $ang5 = DB::table($this->model->getTable())
                    ->select(DB::raw('sum('.$this->fieldAnggaran().') as angTotal'))
                    ->where('adrkaRek5Kd','like','523%')
                    ->get();
                    ;
            $modal=$ang5[0]->angTotal;        


            $ang6 = DB::table($this->model->getTable())
                    ->select(DB::raw('sum('.$this->fieldAnggaran().') as angTotal'))
                    ->where('adrkaRek5Kd','like','62%')
                    ->get();
                    ;
            $keluar=$ang6[0]->angTotal;        

            $persenGaji=($gaji/$total)*100;
            $persenPpkd=($ppkd/$total)*100;
            $persenpegawai=($pegawai/$total)*100;
            $persenbarangj=($barangj/$total)*100;
            $persenmodal=($modal/$total)*100;
            $persenkeluar=($keluar/$total)*100;



            // $sisa=100-($persenGaji+$persenPpkd+$persenpegawai+$persenbarangj+$persenmodal+$persenkeluar);


            $res=array(
                    array('Gaji Pegawai',$persenGaji),
                    array('BTL PPKD',$persenPpkd),
                    array('BL Pegawai',$persenpegawai),
                    array(
                      'name' =>'BL Barang & Jasa',
                      'y' => $persenbarangj,
                      'sliced'=> true,
                      'selected'=> true
                      ),
                    array('BL Modal',$persenmodal),
                    array('Pengeluaran',$persenkeluar),
                );

           return $res;                

       }catch(Exception $e){
           return Response::exception($e);
       }    
     }

}