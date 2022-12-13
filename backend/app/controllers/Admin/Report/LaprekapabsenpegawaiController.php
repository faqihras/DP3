<?php
namespace Admin\Report;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
use Fpdf;

class LaprekapabsenpegawaiController extends BasicController {

		public function index(){
				$param      = Input::all();
				$data       = json_decode($_GET['data']);
				$tgawal     = $this->reversdate($data->tgawal);
				$tgahir     = $this->reversdate($data->tgahir);
				$pegid      = $data->pegawai;

				$today      =  date("Y-m-d");

				// $pdf = new Fpdf('P','mm','A4');
				$pdf = new Fpdf('P','mm',array('240','297'));
				$pdf->AddPage();

				$no=1;
				$imgX = 118.2;
				$imgY = 38;
				$rectY = 36;
				$current_y=36;

				$pdf->SetFont('Arial','B',16);

				$nama = DB::table('mobile_user')
						->select('userName')
						->where('userId','=',$pegid)
						->get();

				$namapeg = !empty($nama[0]->userName) ? $nama[0]->userName : '-';

				$pdf->cell(220 ,  6,'REKAP ABSENSI PER PEGAWAI',0,1,'C');
				$pdf->SetFont('Arial','B',12);
				$pdf->cell(220 ,  5,'Periode ' . $this->formatTgl($tgawal) . ' s/d ' . $this->formatTgl($tgahir),0,1,'C');
				$pdf->SetFont('Arial','B',12);
				$pdf->cell(220 ,  5,'Nama : ' . $namapeg,0,1,'C');
				$pdf->Ln();
				
				$pdf->SetFont('Arial','B',8);
				$pdf->cell(5 ,  5,'NO',1,0,'C');
				$pdf->cell(24 ,  5,'TANGGAL',1,0,'C');
				$pdf->cell(25 ,  5,'JAM MASUK',1,0,'C');
				$pdf->cell(25 ,  5,'JAM KELUAR',1,0,'C');
				$pdf->cell(24 ,  5,'STATUS',1,0,'C');
				$pdf->cell(40 ,  5,'FOTO',1,0,'C');
				$pdf->cell(78 ,  5,'KETERANGAN',1,1,'C');
				$pdf->SetFont('Arial','',8);

				$query = DB::table('absen')
							->select(DB::raw('DISTINCT(abUserId)'),'userName','abLat','abLng','abJenis','abWaktuAbsen','abKet','abPhoto')
							->leftjoin('mobile_user','userId','=','abUserId')
							->where(DB::raw('left(abWaktuAbsen,10)'),'>=',$tgawal)
							->where(DB::raw('left(abWaktuAbsen,10)'),'<=',$tgahir)
							->where('abUserId','=',$pegid)
							->orderby('abWaktuAbsen')
							->get();

				$oldName = '';
				foreach ($query as $row => $val) {
					$nama = $val->userName;
					$tgl = substr($val->abWaktuAbsen, 0, 10);
					$lat = number_format($val->abLat,7);
					$lng = number_format($val->abLng,7);
					// $ket = $val->abKet;
					// $ket=$this->parse_string($val->abKet,49);
					$ket=$val->abKet;


					if ($val->abJenis == 0) {
						$masuk = substr($val->abWaktuAbsen, -8);
						$keluar = '-';
						if ($masuk > '08:00:00' && $masuk <= '12:00:00') {
							$status = 'Terlambat';
						}else{
							$status = '';
						}
					}else{
						$masuk = '-';
						$keluar = substr($val->abWaktuAbsen, -8);
						$status = '';
					}

					//Photo
					$foto = $this->getImage($val->abPhoto);

					$height = $pdf->getY();
					if ($height > 239) {
						$imgX = 118.2;
						$imgY = 12;
						$current_y=10;
						$rectY = 10;
						$pdf->AddPage();
					}

					if ($foto!==false) $pdf->Image($foto[0], $imgX, $imgY,30,36, $foto[1]);

					$pdf->setY($current_y);
					$pdf->cell(5 ,  40,$no,1,0,'C');
					$pdf->cell(24 ,  40,$tgl,1,0,'C');
					$pdf->cell(25 ,  40,$masuk,1,0,'C');
					$pdf->cell(25 ,  40,$keluar,1,0,'C');
					$pdf->cell(24 ,  40,$status,1,0,'C');
					$pdf->cell(40 ,  40,'',1,0,'C');

					// Keterangan-coding-khusus
					$pdf->rect(153,$rectY,78,40);
					$pdf->Multicell(78 ,  5, $ket,0,'L',0);
					// $pdf->drawTextBox($ket, 78, 40, 'C', 'M');
					$pdf->Ln();

					// for($i=1;$i<=count($ket)-1;$i++){
					// 	$pdf->cell(5 ,  5,'','RL',0,'C');
					// 	$pdf->cell(24 ,  5,'','RL',0,'C');
					// 	$pdf->cell(25 ,  5,'','RL',0,'C');
					// 	$pdf->cell(25 ,  5,'','RL',0,'R');
					// 	$pdf->cell(24 ,  5,'','RL',0,'R');
					// 	$pdf->cell(40 ,  5,'','RL',0,'L');
					// 	$pdf->cell(78 ,  5,$ket[$i],'RL',0,'L');
					// 	$pdf->Ln();                        
					// }

					$imgY += 40;
					$current_y += 40;
					$rectY += 40;

					$no++;
				}

				//garis-bawah
				// $pdf->cell(5 ,  5,'','T',0,'C');
				// $pdf->cell(44 ,  5,'','T',0,'L');
				// $pdf->cell(22 ,  5,'','T',0,'C');
				// $pdf->cell(22 ,  5,'','T',0,'C');
				// $pdf->cell(20 ,  5,'','T',0,'R');
				// $pdf->cell(20 ,  5,'','T',0,'R');
				// $pdf->cell(20 ,  5,'','T',0,'L');
				// $pdf->cell(68 ,  5,'','T',0,'L');

				$pdf->Output();
				exit;
		}

		function nmBulan($bln) {
				switch ($bln) {
						case '01' : return "JANUARI"    ; break;
						case '02' : return "FEBRUARI"   ; break;
						case '03' : return "MARET"      ; break;
						case '04' : return "APRIL"      ; break;
						case '05' : return "MEI"        ; break;
						case '06' : return "JuNI"       ; break;
						case '07' : return "JULI"       ; break;
						case '08' : return "AGUSTUS"    ; break;
						case '09' : return "SEPTEMBER"  ; break;
						case '10' : return "OKTOBER"    ; break;
						case '11' : return "NOVEMBER"   ; break;
						case '12' : return "DESEMBER"   ; break;
				}
		}

		// function formatTgl($tgl) {
		// 		$date=date_create($tgl);
		// 		return date_format($date,"d-m-Y");
		// }

		public function reversdate($tanggal){
				if(substr($tanggal, 2,1)=="/"){
						$a=explode("/",$tanggal);
						$result=$a[2].'-'.$a[0].'-'.$a[1];
				}else{
						$a=explode("-",$tanggal);
						$result=$a[2].'-'.$a[1].' '.$a[0];
				}
				return $result;
		}

		function formatTgl($tanggal){
			$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$tgl = explode('-', $tanggal);
		 
			return $tgl[2] . ' ' . $bulan[ (int)$tgl[1] ] . ' ' . $tgl[0];
		}

		function getImage($dataURI){
			$img = explode(',',$dataURI,2);
			$pic = 'data://text/plain;base64,'.$img[1];
			$type = explode("/", explode(':', substr($dataURI, 0, strpos($dataURI, ';')))[1])[1]; // get the image type
			if ($type=="png"||$type=="jpeg"||$type=="gif") return array($pic, $type);
			return false;
		}

}