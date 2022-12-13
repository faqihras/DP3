<?php
namespace Admin\Report;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
use Fpdf;

class LapabsenharianController extends BasicController {
		public function index(){
				$param      = Input::all();
				$data       = json_decode($_GET['data']);
				$tanggal     = $this->reversdate($data->tanggal);
				// $tgahir     = $this->reversdate($data->tgahir);

				$today      =  date("Y-m-d");

				// $pdf = new Fpdf('P','mm','A4');
				$pdf = new Fpdf('P','mm',array('240','297'));
				$pdf->AddPage();

				$no=1;
				$pdf->SetFont('Arial','B',16);

				$pdf->cell(220 ,  6,'LAPORAN ABSEN HARIAN',0,1,'C');
				$pdf->SetFont('Arial','B',14);
				$pdf->cell(220 ,  6,$this->formatTgl($tanggal),0,1,'C');
				$pdf->Ln();
				
				$pdf->SetFont('Arial','B',8);
				$pdf->cell(5 ,  5,'No',1,0,'C');
				$pdf->cell(44 ,  5,'Nama',1,0,'C');
				$pdf->cell(22 ,  5,'Absen Masuk',1,0,'C');
				$pdf->cell(22 ,  5,'Absen Keluar',1,0,'C');
				$pdf->cell(20 ,  5,'Lat',1,0,'C');
				$pdf->cell(20 ,  5,'Lng',1,0,'C');
				$pdf->cell(20 ,  5,'Status',1,0,'C');
				$pdf->cell(68 ,  5,'Keterangan',1,1,'C');
				$pdf->SetFont('Arial','',8);

				$query = DB::table('absen')
							->select(DB::raw('DISTINCT(abUserId)'),'userName','abLat','abLng','abJenis','abWaktuAbsen','abKet')
							->leftjoin('mobile_user','userId','=','abUserId')
							->where(DB::raw('left(abWaktuAbsen,10)'),'=',$tanggal)
							// ->orderby('abWaktuAbsen')
							->get();

				$oldName = '';
				foreach ($query as $row => $val) {
					$nama = $val->userName;
					$lat = number_format($val->abLat,7);
					$lng = number_format($val->abLng,7);
					// $ket = $val->abKet;
                    $ket=$this->parse_string($val->abKet,49);


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

					$pdf->cell(5 ,  5,$no,'RLT',0,'C');
					$pdf->cell(44 ,  5,$nama,'RLT',0,'L');
					$pdf->cell(22 ,  5,$masuk,'RLT',0,'C');
					$pdf->cell(22 ,  5,$keluar,'RLT',0,'C');
					$pdf->cell(20 ,  5,$lat,'RLT',0,'R');
					$pdf->cell(20 ,  5,$lng,'RLT',0,'R');
					$pdf->cell(20 ,  5,$status,'RLT',0,'C');
					$pdf->cell(68 ,  5,$ket[0],'RLT',0,'L');
                    $pdf->Ln();

					for($i=1;$i<=count($ket)-1;$i++){
						$pdf->cell(5 ,  5,'','RL',0,'C');
						$pdf->cell(44 ,  5,'','RL',0,'L');
						$pdf->cell(22 ,  5,'','RL',0,'C');
						$pdf->cell(22 ,  5,'','RL',0,'C');
						$pdf->cell(20 ,  5,'','RL',0,'R');
						$pdf->cell(20 ,  5,'','RL',0,'R');
						$pdf->cell(20 ,  5,'','RL',0,'L');
						$pdf->cell(68 ,  5,$ket[$i],'RL',0,'L');
                        $pdf->Ln();                        
                    }


					$no++;
				}

				//garis-bawah
				$pdf->cell(5 ,  5,'','T',0,'C');
				$pdf->cell(44 ,  5,'','T',0,'L');
				$pdf->cell(22 ,  5,'','T',0,'C');
				$pdf->cell(22 ,  5,'','T',0,'C');
				$pdf->cell(20 ,  5,'','T',0,'R');
				$pdf->cell(20 ,  5,'','T',0,'R');
				$pdf->cell(20 ,  5,'','T',0,'L');
				$pdf->cell(68 ,  5,'','T',0,'L');

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

}