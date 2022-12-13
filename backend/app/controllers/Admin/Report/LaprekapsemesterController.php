<?php
namespace Admin\Report;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
use Fpdf;

class LaprekapsemesterController extends BasicController {

		public function index(){
				$param      = Input::all();
				$data       = json_decode($_GET['data']);
				// $tgawal     = $this->reversdate($data->tgawal);
				// $tgahir     = $this->reversdate($data->tgahir);
				$semesterid = $data->semester;
				$pegid      = $data->pegawai;
				$semes      = $semesterid;
				if ($semes == '1'){
						$bln='Ganjil ( Juli - Desember )';
						
					}else if ($semes == '2'){
						$bln='Genap ( Januari - Juni )';
					}
					else{
						$bln='-';
						
					}
				$today      =  date("Y-m-d");

				// $pdf = new Fpdf('P','mm','A4');
				$pdf = new Fpdf('P','mm',array('240','297'));
				$pdf->AddPage();

				$no=1;
				$imgX = 118.2;
				$imgY = 38;
				$rectY = 36;
				$current_y=42;
				$current_y1=26;

				$pdf->SetFont('Arial','B',16);

				$nama = DB::table('ms_satuankerja')
						->select('satkerNama')
						->where('satkerId','=',$pegid)
						->get();

				$namapeg = !empty($nama[0]->satkerNama) ? $nama[0]->satkerNama : '-';

				$pdf->cell(220 ,  6,'REKAP DP3 SEMESTER',0,1,'C');
				$pdf->SetFont('Arial','B',12);
				$pdf->cell(220 ,  5,'UNIT : ' . $namapeg,0,1,'C');
				$pdf->SetFont('Arial','B',12);
				$pdf->cell(220 ,  5,'SEMESTER :  ' . $bln,0,1,'C');
				$pdf->SetFont('Arial','',10);
				$pdf->cell(220 ,  5,'Tenaga Pendidik',0,1,'L');
				$pdf->Ln();
				
				$pdf->SetFont('Arial','B',8);
				$pdf->cell(10 ,  6,'NO',1,0,'C');
				$pdf->cell(20 ,  6,'NIP',1,0,'C');
				$pdf->cell(40 ,  6,'NAMA PEGAWAI',1,0,'C');
				$pdf->cell(45,  6,'UNIT',1,0,'C');
				$pdf->cell(15 ,  6,' DPK',1,0,'C');
				$pdf->cell(15 ,  6,' DPAK',1,0,'C');
				$pdf->cell(15 , 6,'DPSK',1,0,'C');
				$pdf->cell(15 , 6, 'DPA',1,0,'C');
				$pdf->cell(15 ,  6,'NILAI PK',1,0,'C');
				$pdf->cell(20 ,  6,'KATEGORI',1,0,'C');
				// $pdf->cell(40 ,  5,'FOTO',1,0,'C');
				// $pdf->cell(78 ,  5,'KETERANGAN',1,1,'C');
				$pdf->SetFont('Arial','',8);

				$query = DB::table('trdpak')
				->select('*' 
                  )

                  // DB::raw('IF(tanggallahir="0000-00-00",concat("-"),tanggallahir) as tanggal_lahir')
                  ->join('trdpsk','dpskId','=','dpakId')
                  ->join('trdpk','dpkId','=','dpakId')
                  ->join('trdpa','dpaId','=','dpakId')
                  ->join('trdpp','dppId','=','dpakId')

                  ->leftjoin('ms_satuankerja','satkerId','=','dpakUnit')
                  ->where('dpakUnit','=',$pegid)
                   ->where('dpkJab','=',1)
                  ->get();

						
				foreach ($query as $row => $val) {
					$nip = $val->dpakNip;
					$namapeg = $val->dpakNama;
					$unitpeg = $val->satkerNama;
					$semes = $semesterid;


					// Perhitungan Dpak
					$dpakJan = (( $val->dpakJan1 + $val ->dpakJan2 + $val ->dpakJan3 + $val->dpakJan4 + $val->dpakJan5)/5);
					$dpakFeb = (( $val->dpakFeb1 + $val ->dpakFeb2 + $val ->dpakFeb3 + $val->dpakFeb4 + $val->dpakFeb5)/5);
					$dpakMar = (( $val->dpakMar1 + $val ->dpakMar2 + $val ->dpakMar3 + $val->dpakMar4 + $val->dpakMar5)/5);
					$dpakApr = (( $val->dpakApr1 + $val ->dpakApr2 + $val ->dpakApr3 + $val->dpakApr4 + $val->dpakApr5)/5);
					$dpakMei = (( $val->dpakMei1 + $val ->dpakMei2 + $val ->dpakMei3 + $val->dpakMei4 + $val->dpakMei5)/5);
					$dpakJun = (( $val->dpakJun1 + $val ->dpakJun2 + $val ->dpakJun3 + $val->dpakJun4 + $val->dpakJun5)/5);
					$dpakJul = (( $val->dpakJul1 + $val ->dpakJul2 + $val ->dpakJul3 + $val->dpakJul4 + $val->dpakJul5)/5);
					$dpakAgs = (( $val->dpakAgs1 + $val ->dpakAgs2 + $val ->dpakAgs3 + $val->dpakAgs4 + $val->dpakAgs5)/5);
					$dpakSep = (( $val->dpakSep1 + $val ->dpakSep2 + $val ->dpakSep3 + $val->dpakSep4 + $val->dpakSep5)/5);
					$dpakOkt = (( $val->dpakOkt1 + $val ->dpakOkt2 + $val ->dpakOkt3 + $val->dpakOkt4 + $val->dpakOkt5)/5);
					$dpakNov = (( $val->dpakNov1 + $val ->dpakNov2 + $val ->dpakNov3 + $val->dpakNov4 + $val->dpakNov5)/5);
					$dpakDes = (( $val->dpakDes1 + $val ->dpakDes2 + $val ->dpakDes3 + $val->dpakDes4 + $val->dpakDes5)/5);

					// Perhitungan Dpsk
					$dpsk1 =  (( $val->dpskc1 + $val ->dpskc2 + $val ->dpskc3 + $val->dpskc4 + $val->dpskc5 + $val->dpskc6 + $val->dpskc7 + $val->dpskc8 + $val->dpskc9)/9);

					$dpsk2 =  (( $val->dpskc10 + $val ->dpskc11 + $val ->dpskc12 + $val->dpskc13 + $val->dpskc14 + $val->dpskc15 + $val->dpskc16 + $val->dpskc17 + $val->dpskc18)/9);

					// Perhitungan Dpa
					$dpa1 =  (( $val->dpac1 + $val ->dpac2 + $val ->dpac3 + $val->dpac4 + $val->dpac5 + $val->dpac6 + $val->dpac7 + $val->dpac8)/8);

					$dpa2 =  (( $val->dpac9 + $val ->dpac10 + $val ->dpac11 + $val->dpac12 + $val->dpac13 + $val->dpac14 + $val->dpac15 + $val->dpac16 )/8);



					if ($semes == '1'){
						$dpk = (( $val->dpkJul + $val ->dpkAgs + $val ->dpkSep + $val->dpkOkt + $val->dpkNov + $val ->dpkDes)/6);	
						$dpak = (( $dpakJul + $dpakAgs + $dpakSep + $dpakOkt + $dpakNov + $dpakDes)/6);
						$dpsk= $dpsk2;
						$dpa = $dpa2;
						
					}else if ($semes == '2'){
						$dpk = (($val->dpkJan + $val->dpkFeb + $val ->dpkMar + $val ->dpkApr + $val->dpkMei + $val->dpkJun)/6);	
						$dpak = (($dpakJan + $dpakFeb + $dpakMar + $dpakApr + $dpakMei + $dpakJun)/6);
						$dpsk= $dpsk1;
						$dpa = $dpa1;
					}	
					
					else{
						$dpk ='0';
						$dpak = '0';
						$dpsk ="0";
						$dpa ="0";
					}
					$rank    = round(($dpk + $dpak + $dpsk + $dpa)*0.45);
					$rank1 	 = round(($dpk + $dpak + $dpsk + $dpa)*0.35);
					$rank2	 = round(($dpk + $dpak + $dpsk + $dpa)*0.1);
					$rank3	 = round(($dpk + $dpak + $dpsk + $dpa)*0.1);

					$rank4 	 = round(($rank + $rank1 + $rank2 + $rank3)/4);

					if ($rank4 >= '96' && $rank3 <= '100') {
							$status = 'A';
							//$warna_belakang = "#99FFFF";
						}elseif ($rank4 >= '90' && $rank3 <= '95'){
							$status = 'B';
						}elseif ($rank4 >= '80' && $rank3 <= '89'){
							$status = 'C';
						}elseif ($rank4 >= '70' && $rank3 <= '79'){
							$status = 'D';
						}
						else{
							$status = 'E';

						}
					


					$height = $pdf->getY();
					if ($height > 239) {
						$imgX = 118.2;
						$imgY = 12;
						$current_y=20;
						$rectY = 5;
						$pdf->AddPage();
					}

					// if ($foto!==false) $pdf->Image($foto[0], $imgX, $imgY,30,36, $foto[1]);

					$pdf->setY($current_y);
					$pdf->cell(10 ,  10,$no,1,0,'C');
					$pdf->cell(20 ,  10,$nip,1,0,'C');
					$pdf->cell(40 ,  10,$namapeg,1,0,'C');
					$pdf->cell(45 ,  10,$unitpeg,1,0,'C');
					$pdf->cell(15 ,  10,round($dpk),1,0,'C');
					$pdf->cell(15 ,  10,round($dpak),1,0,'C');
					$pdf->cell(15 ,  10,round($dpsk),1,0,'C');
					$pdf->cell(15 ,  10,round($dpa),1,0,'C');
					$pdf->cell(15 ,  10,round($rank4),1,0,'C');
					$pdf->cell(20 ,  10,$status,1,0,'C');
					

					$imgY += 10;
					$current_y += 10;
					$rectY += 10;

					$no++;
				}
					$pdf->Ln(4);
				$pdf->Ln(4);
				$pdf->Ln(6);
				$pdf->SetFont('Arial','',10);
				$pdf->cell(220 ,  5,'KETERANGAN : ',0,1,'L');	
				$pdf->cell(220 ,  5,'PK     : Prestasi Kerja',0,1,'L');	
				$pdf->cell(220 ,  5,'DPK   : Daftar Penilaian Kehadiran',0,1,'L');
				$pdf->cell(220 ,  5,'DPA   : Daftar Penilaian Atasan',0,1,'L');
				$pdf->cell(220 ,  5,'DPP   : Daftar Penilaian Pekerjaan',0,1,'L');
				$pdf->cell(220 ,  5,'DPAK : Daftar Penilaian Administrasi Keguruan',0,1,'L');
				$pdf->cell(220 ,  5,'DPSK : Daftar Penilaian Supervisi Kelas',0,1,'L');	

				//Bagian Tenaga Kependidikan
				//$pdf->SetFont('Arial','B',10);

				$pdf->Ln(4);
				// $pdf->Ln(4);
				// $pdf->Ln(4);
				// $pdf->Ln(4);
				$pdf->AddPage();

				// $pdf->SetFont('Arial','',10);
				// $pdf->cell(220 ,  5,'Tenaga Kependidikan',0,1,'L');
				$query = DB::table('trdpak')
				->select('*' 
                  )

                  // DB::raw('IF(tanggallahir="0000-00-00",concat("-"),tanggallahir) as tanggal_lahir')
                  ->join('trdpsk','dpskId','=','dpakId')
                  ->join('trdpk','dpkId','=','dpakId')
                  ->join('trdpa','dpaId','=','dpakId')
                  ->join('trdpp','dppId','=','dpakId')

                  ->leftjoin('ms_satuankerja','satkerId','=','dpakUnit')
                  ->where('dpakUnit','=',$pegid)
                   ->where('dpkJab','=',2)
                  
                  ->get();
                $pdf->SetFont('Arial','',10);
				$pdf->cell(220 ,  5,'Tenaga Kependidikan',0,1,'L');
				$pdf->Ln();    
                $pdf->SetFont('Arial','B',8);
				$pdf->cell(10 ,  6,'NO',1,0,'C');
				$pdf->cell(20 ,  6,'NIP',1,0,'C');
				$pdf->cell(40 ,  6,'NAMA PEGAWAI',1,0,'C');
				$pdf->cell(45,  6,'UNIT',1,0,'C');
				$pdf->cell(15 ,  6,' DPK',1,0,'C');
				$pdf->cell(15 ,  6,' DPP',1,0,'C');
				//$pdf->cell(15 , 6,'DPSK',1,0,'C');
				$pdf->cell(15 , 6, 'DPA',1,0,'C');
				$pdf->cell(15 ,  6,'NILAI PK',1,0,'C');
				$pdf->cell(20 ,  6,'KATEGORI',1,0,'C');
				// $pdf->cell(40 ,  5,'FOTO',1,0,'C');
				// $pdf->cell(78 ,  5,'KETERANGAN',1,1,'C');
				$pdf->SetFont('Arial','',8);
						
				foreach ($query as $row => $val) {
					$nip = $val->dpakNip;
					$namapeg = $val->dpakNama;
					$unitpeg = $val->satkerNama;
					$semes = $semesterid;

					// Perhitungan Dpa
					$dpa1 =  (( $val->dpac1 + $val ->dpac2 + $val ->dpac3 + $val->dpac4 + $val->dpac5 + $val->dpac6 + $val->dpac7 + $val->dpac8)/8);

					$dpa2 =  (( $val->dpac9 + $val ->dpac10 + $val ->dpac11 + $val->dpac12 + $val->dpac13 + $val->dpac14 + $val->dpac15 + $val->dpac16 )/8);



					if ($semes == '1'){
						$dpk = (( $val->dpkJul + $val ->dpkAgs + $val ->dpkSep + $val->dpkOkt + $val->dpkNov + $val ->dpkDes)/6);
						$dpp = (( $val->dppJul + $val ->dppAgs + $val ->dppSep + $val->dppOkt + $val->dppNov + $val ->dppDes)/6);	
						$dpa = $dpa2;
						
					}else if ($semes == '2'){
						$dpk = (($val->dpkJan + $val->dpkFeb + $val ->dpkMar + $val ->dpkApr + $val->dpkMei + $val->dpkJun)/6);
						$dpp = (($val->dppJan + $val->dppFeb + $val ->dppMar + $val ->dppApr + $val->dppMei + $val->dppJun)/6);
						$dpa = $dpa1;
					}	
					
					else{
						$dpp ='0';
						$dpk ='0';
						$dpa ="0";
					}
					$rank4    = round(($dpk + $dpp  + $dpa)*0.5);
					$rank5 	 = round(($dpk + $dpp  + $dpa)*0.4);
					$rank6	 = round(($dpk + $dpp  + $dpa)*0.1);
					//$rank3	 = round(($dpk + $dpak + $dpsk + $dpa)*0.1);

					$rank7 	 = round(($rank4 + $rank5 + $rank6)/3);

					if ($rank7 >= '96' && $rank7 <= '100') {
							$status = 'A';
							//$warna_belakang = "#99FFFF";
						}elseif ($rank7 >= '90' && $rank7 <= '95'){
							$status = 'B';
						}elseif ($rank7 >= '80' && $rank7 <= '89'){
							$status = 'C';
						}elseif ($rank7 >= '70' && $rank7 <= '79'){
							$status = 'D';
						}
						else{
							$status = 'E';

						}
					


					$height = $pdf->getY();
					if ($height > 245) {
						// $imgX = 118.2;
						// $imgY = 12;
						$current_y1=10;
						//$rectY = 5;
						$pdf->AddPage();
					}

					// if ($foto!==false) $pdf->Image($foto[0], $imgX, $imgY,30,36, $foto[1]);

					$pdf->setY($current_y1);
					$pdf->cell(10 ,  10,$no,1,0,'C');
					$pdf->cell(20 ,  10,$nip,1,0,'C');
					$pdf->cell(40 ,  10,$namapeg,1,0,'C');
					$pdf->cell(45 ,  10,$unitpeg,1,0,'C');
					$pdf->cell(15 ,  10,round($dpk),1,0,'C');
					$pdf->cell(15 ,  10,round($dpp),1,0,'C');
					$pdf->cell(15 ,  10,round($dpa),1,0,'C');
					//$pdf->cell(15 ,  10,round($dpa),1,0,'C');
					$pdf->cell(15 ,  10,round($rank7),1,0,'C');
					$pdf->cell(20 ,  10,$status,1,0,'C');
					

					//$imgY += 10;
					$current_y1 += 10;
					//$rectY += 10;

					$no++;
				}
				$pdf->Ln(4);
				$pdf->Ln(4);
				$pdf->Ln(6);
				$pdf->SetFont('Arial','',10);
				$pdf->cell(220 ,  5,'KETERANGAN : ',0,1,'L');	
				$pdf->cell(220 ,  5,'PK     : Prestasi Kerja',0,1,'L');	
				$pdf->cell(220 ,  5,'DPK   : Daftar Penilaian Kehadiran',0,1,'L');
				$pdf->cell(220 ,  5,'DPA   : Daftar Penilaian Atasan',0,1,'L');
				$pdf->cell(220 ,  5,'DPP   : Daftar Penilaian Pekerjaan',0,1,'L');
				$pdf->cell(220 ,  5,'DPAK : Daftar Penilaian Administrasi Keguruan',0,1,'L');
				$pdf->cell(220 ,  5,'DPSK : Daftar Penilaian Supervisi Kelas',0,1,'L');	
				



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