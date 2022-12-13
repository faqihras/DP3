<?php
namespace Admin\Report;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
use Fpdf;

class LaprekapabsenController extends BasicController {

		public function index(){
				$param      = Input::all();
				$data       = json_decode($_GET['data']);
				$tgawal     = $this->reversdate($data->tgawal);
				$tgahir     = $this->reversdate($data->tgahir);

				$today      =  date("Y-m-d");

				$pdf = new Fpdf('P','mm','A4');
				// $pdf = new Fpdf('P','mm',array('240','297'));
				$pdf->AddPage();

				$no=1;
				$imgX = 118.2;
				$imgY = 38;
				
				$rectY = 36;
				$current_y=36;

				$pdf->SetFont('Arial','B',16);

				$namapeg = !empty($nama[0]->userName) ? $nama[0]->userName : '-';

				$pdf->cell(190 ,  6,'REKAP ABSENSI',0,1,'C');
				$pdf->SetFont('Arial','B',12);
				$pdf->cell(190 ,  5,'Periode ' . $this->formatTgl($tgawal) . ' s/d ' . $this->formatTgl($tgahir),0,1,'C');
				$pdf->Ln();
				
				$pdf->SetFont('Arial','B',8);
				$pdf->cell(8 ,  5,'NO',1,0,'C');
				$pdf->cell(50 ,  5,'NAMA',1,0,'C');
				$pdf->cell(20 ,  5,'MASUK',1,0,'C');
				$pdf->cell(20 ,  5,'KELUAR',1,0,'C');
				$pdf->cell(20 ,  5,'TERLAMBAT',1,0,'C');
				$pdf->cell(70 ,  5,'KETERANGAN',1,1,'C');

				$pdf->SetFont('Arial','',8);
				$query = DB::table('mobile_user')
						->select('*')
						->where('userId','<>','21')
						->orderby('userName')
						->get();

				foreach ($query as $row => $val) {
					$id = $val->userId;
					$nama = $val->userName;

					$query2 = DB::table('absen')
						->select(DB::raw('COUNT(DISTINCT(LEFT(abWaktuAbsen,10))) as total'))
						->where('abUserId','=',$id)
						->where('abJenis','=','0')
						->where(DB::raw('right(abWaktuAbsen,8)'),'<=','12:00:00')
						->where(DB::raw('left(abWaktuAbsen,10)'),'>=',$tgawal)
						->where(DB::raw('left(abWaktuAbsen,10)'),'<=',$tgahir)
						->get();

					$totmasuk = !empty($query2[0]->total) ? $query2[0]->total : '0';

					$query3 = DB::table('absen')
						->select(DB::raw('COUNT(DISTINCT(LEFT(abWaktuAbsen,10))) as total'))
						->where('abUserId','=',$id)
						->where('abJenis','=','1')
						->where(DB::raw('left(abWaktuAbsen,10)'),'>=',$tgawal)
						->where(DB::raw('left(abWaktuAbsen,10)'),'<=',$tgahir)
						->get();

					$totkeluar = !empty($query3[0]->total) ? $query3[0]->total : '0';

					$query4 = DB::table('absen')
						->select(DB::raw('COUNT(DISTINCT(LEFT(abWaktuAbsen,10))) as total'))
						->where('abUserId','=',$id)
						->where('abJenis','=','0')
						->where(DB::raw('right(abWaktuAbsen,8)'),'>','08:00:00')
						->where(DB::raw('right(abWaktuAbsen,8)'),'<=','12:00:00')
						->where(DB::raw('left(abWaktuAbsen,10)'),'>=',$tgawal)
						->where(DB::raw('left(abWaktuAbsen,10)'),'<=',$tgahir)
						->get();

					$totterlambat = !empty($query4[0]->total) ? $query4[0]->total : '0';

					$pdf->cell(8 ,  5,$no,1,0,'C');
					$pdf->cell(50 ,  5,$nama,1,0,'L');
					$pdf->cell(20 ,  5,$totmasuk,1,0,'C');
					$pdf->cell(20 ,  5,$totkeluar,1,0,'C');
					$pdf->cell(20 ,  5,$totterlambat,1,0,'C');
					$pdf->cell(70 ,  5,'',1,0,'C');
					$pdf->ln();

					$no++;
				}

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