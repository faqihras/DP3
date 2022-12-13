<?php
namespace Agape\Report;

use Fpdf;
use Input;
use DB;
use Session;
class Xpdf2 extends FPDF {

  function header() {


        $input=Input::all();
        $mulaihal=$input['halaman2'];
        $konf=$this->getConfig();
        $thnang=Session::get('tahun');

        if($this->PageNo()==1){
            $this -> SetY(0.8);
            $this -> SetFont('Arial','B',10);
            $this -> Cell(0,0.5,'PEMERINTAH DESA '.strtoupper($konf['hpNamaDesa']),0,0,'C');
            $this -> Ln();
            $this -> Cell(0,0.5,'ANGGARAN PENDAPATAN DAN BELANJA DESA',0,0,'C');
            $this -> Ln();
            $this -> Cell(0,0.5,'TAHUN ANGGARAN '.$thnang,0,0,'C');
            $this -> Ln();
            $this -> Ln();
        }

        $this-> Setx(0.5);
        $this -> SetFont('Arial','B',8);
        $this-> Cell(2,0.7,'REKENING','BTLR',0,'C');
        $this-> Cell(8.5,0.7,'URAIAN','BTLR',0,'C');
        $this-> Cell(2.5,0.7,'ANGGARAN','BTLR',0,'C');
        $this-> Cell(2.5,0.7,'PERUBAHAN','BTLR',0,'C');
        $this-> Cell(2.5,0.7,'SELISIH','BTLR',0,'C');
        $this-> Cell(2.5,0.7,'KETERANGAN','BTLR',0,'C');
        $this -> Ln();

  }


  function footer() {

        $input=Input::all();
        $mulaihal=is_numeric($input['halaman2'])? $input['halaman2'] :1;
        $mulaihal--;

        $this -> Ln();
        $this -> Setx(0.5);
        $this -> SetFont('Arial','I',8);
        $this -> Cell(17.5,0.4,'',0,0,'L');
        $this -> SetFont('Arial','',8);
        $this -> Cell(3,0.4,'HALAMAN '.(($this->PageNo())+$mulaihal),0,0,'R');

  }


     function getConfig(){
            $query = DB::table('homepage')
                    ->select('*')
                    ->get();
                    ;
           if(count($query)>0){
                $array = (array) $query[0];

                $kepala=$array['hpKepalaDesa'];
                $sekre=$array['hpSekreDesa'];

                $nmkepala=$this->getTTD($kepala);        
                $nmsekre=$this->getTTD($sekre);        

                $array['kepalaDesa']=$nmkepala;
                $array['sekreDesa'] =$nmsekre;
  
                return  $array;
           }else{
              return array();
           }
     }

     function getTTD($kode){
            $query2 = DB::table('mspenandatangan')
                    ->select('*')
                    ->where('mspenandatanganNIP','=',$kode)
                    ->get();            
            if(count($query2)>0){
                $res=$query2[0]->mspenandatanganNm;        
            }else{
                $res='';                        
            }
            return $res;
     }



}