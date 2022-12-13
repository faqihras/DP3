<?php
namespace Admin\Report;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
use Fpdf;

class LaprekapdpakController extends BasicController {

		public function index(){
				$param      = Input::all();
				$data       = json_decode($_GET['data']);
				//$tgawal     = $this->reversdate($data->tgawal);
				//$tgahir     = $this->reversdate($data->tgahir);
				$bulanid      = $data->bulan;
				$pegid      = $data->pegawai;

				$bulan = $bulanid;
				if ($bulan == '1'){
						$bln='JANUARI';
						
					}else if ($bulan == '2'){
						$bln='FEBRUARI';
					}else if ($bulan == '3'){
						$bln='MARET';
					}else if ($bulan == '4'){
						$bln='APRIL';
					}else if ($bulan == '5'){
						$bln='MEI';
					}else if ($bulan == '6'){
						$bln='JUNI';
					}else if ($bulan == '7'){
						$bln='JULI';
					}else if ($bulan == '8'){
						$bln='AGUSTUS';
					}else if ($bulan == '9'){
						$bln='SEPTEMBER';
					}else if ($bulan == '10'){
						$bln='OKTOBER';
					}else if ($bulan == '11'){
						$bln='NOVEMBER';
					}else if ($bulan == '12'){
						$bln='DESEMBER';
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

				$pdf->cell(220 ,  6,'REKAP DATA PENILAIAN BULANAN',0,1,'C');
				$pdf->SetFont('Arial','B',12);
				$pdf->cell(220 ,  5,'BULAN :  ' . $bln,0,1,'C');
				$pdf->SetFont('Arial','B',12);
				$pdf->cell(220 ,  5,'UNIT : ' . $namapeg,0,1,'C');
				$pdf->SetFont('Arial','',10);
				$pdf->cell(220 ,  5,'Tenaga Pendidik',0,1,'L');
				$pdf->Ln();
				
				$query = DB::table('trdpak')
				->select('*' 
                  )

                  // DB::raw('IF(tanggallahir="0000-00-00",concat("-"),tanggallahir) as tanggal_lahir')
				 ->join('trabsen','abId','=','dpakId')
                  ->join('trbina','bnId','=','dpakId')
                  ->join('trrakor','rkId','=','dpakId')
                  ->join('trjp','jpId','=','dpakId')
                  ->join('trdpk','dpkId','=','dpakId')
                  ->leftjoin('ms_pegawai','pegId','=','dpakId')
                  ->leftjoin('ms_satuankerja','satkerId','=','dpakUnit')
                  ->where('dpakUnit','=',$pegid)
                  ->where('dpkJab','=',1)
                  // ->where('dpkJab','=',2)
                  ->get();

				$pdf->SetFont('Arial','B',8);
				$pdf->cell(10 ,  6,'NO',1,0,'C');
				$pdf->cell(20 ,  6,'NIP',1,0,'C');
				$pdf->cell(60 ,  6,'NAMA PEGAWAI',1,0,'C');
				$pdf->cell(50,  6,'UNIT',1,0,'C');
				$pdf->cell(15 ,  6,' DPK',1,0,'C');
				$pdf->cell(15 ,  6,' DPAK',1,0,'C');
				$pdf->cell(15 ,  6,'NILAI PK',1,0,'C');
				$pdf->cell(20 ,  6,'KATEGORI',1,0,'C');
				// $pdf->cell(40 ,  5,'FOTO',1,0,'C');
				// $pdf->cell(78 ,  5,'KETERANGAN',1,1,'C');
				$pdf->SetFont('Arial','',8);

				
							
				foreach ($query as $row => $val) {
					$nip = $val->dpakNip;
					$namapeg = $val->dpakNama;
					$unitpeg = $val->satkerNama;
					$bln = $bulanid;
					//$tgl = substr($tgawal, 5,2);
					//$masuk > '08:00:00' && $masuk <= '12:00:00'
					if ($bln == '1'){
						//$dpk  		= $val->dpkJan;
						$hadir 		= $val->abHadir1;
						$telat 		= $val->abTelat1;
						$izin 		= $val->abIjin1;
						$hadirjp	= $val->jpHadir1;
						$hadirrk 	= $val->rkHadir1;
						$hadirbina	= $val->bnHadir1;
						$jppeg      = $val->pegJp;
						$aktif 	= 26;

                		// Absensi
                		$absen1 = ($aktif - $hadir);
                		$scoreA = round (($hadir/$aktif)*100);
                		$scoreAb = round($scoreA*0.4);

                		

                		// KBM
                		$absen = ($jppeg- $hadirjp);
                		if ($jppeg > 0){
                			$score1 = round (($hadirjp/$jppeg)*100);
                			$score2 = round($score1*0.4);
                		
                		}else {
                			$score1 = 0;
                			$score2 = 0;

                		}
                		// $score1 = round (($hadirjp/$pgw[0]->pegJp)*100);
                		// $score2 = round($score1*0.4);

                		// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);

						$dpk = ($scoreAb + $score2 +$scorerk +$scorebn);


						$dpak1 = $val->dpakJan1;
						$dpak2 = $val->dpakJan2;
						$dpak3 = $val->dpakJan3;
						$dpak4 = $val->dpakJan4;
						$dpak5 = $val->dpakJan5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);	
					}

					else if ($bln == '2'){

						$hadir 		= $val->abHadir2;
						$telat 		= $val->abTelat2;
						$izin 		= $val->abIjin2;
						$hadirjp	= $val->jpHadir2;
						$hadirrk 	= $val->rkHadir2;
						$hadirbina	= $val->bnHadir2;
						$jppeg      = $val->pegJp;
						$aktif 	= 26;
						$absen1 = ($aktif - $hadir);
                		$scoreA = round (($hadir/$aktif)*100);
                		$scoreAb = round($scoreA*0.4);

                		

                		// KBM
                		$absen = ($jppeg- $hadirjp);
                		if ($jppeg > 0){
                			$score1 = round (($hadirjp/$jppeg)*100);
                			$score2 = round($score1*0.4);
                		
                		}else {
                			$score1 = 0;
                			$score2 = 0;

                		}
                		
                		
                		// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);

                		$dpk = ($scoreAb + $score2 +$scorerk +$scorebn);

						$dpak1 = $val->dpakFeb1;
						$dpak2 = $val->dpakFeb2;
						$dpak3 = $val->dpakFeb3;
						$dpak4 = $val->dpakFeb4;
						$dpak5 = $val->dpakFeb5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}

					else if ($bln == '3'){
						$hadir = $val->abHadir3;
						$telat = $val->abTelat3;
						$izin = $val->abIjin3;
						$hadirjp = $val->jpHadir3;
						$hadirrk = $val->rkHadir3;
						$hadirbina =$val ->bnHadir3;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = ($aktif - $hadir);
                		$scoreA = round (($hadir/$aktif)*100);
                		$scoreAb = round($scoreA*0.4);

                		

                		// KBM
                		$absen = ($jppeg- $hadirjp);
                		if ($jppeg > 0){
                			$score1 = round (($hadirjp/$jppeg)*100);
                			$score2 = round($score1*0.4);
                		
                		}else {
                			$score1 = 0;
                			$score2 = 0;

                		}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakMar1;
						$dpak2 = $val->dpakMar2;
						$dpak3 = $val->dpakMar3;
						$dpak4 = $val->dpakMar4;
						$dpak5 = $val->dpakMar5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}
					else if ($bln == '4'){
						$hadir = $val->abHadir4;
						$telat = $val->abTelat4;
						$izin = $val->abIjin4;
						$hadirjp = $val->jpHadir4;
						$hadirrk = $val->rkHadir4;
						$hadirbina =$val ->bnHadir4;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = ($aktif - $hadir);
                		$scoreA = round (($hadir/$aktif)*100);
                		$scoreAb = round($scoreA*0.4);

                		

                		// KBM
                		$absen = ($jppeg- $hadirjp);
                		if ($jppeg > 0){
                			$score1 = round (($hadirjp/$jppeg)*100);
                			$score2 = round($score1*0.4);
                		
                		}else {
                			$score1 = 0;
                			$score2 = 0;

                		}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakApr1;
						$dpak2 = $val->dpakApr2;
						$dpak3 = $val->dpakApr3;
						$dpak4 = $val->dpakApr4;
						$dpak5 = $val->dpakApr5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}
					else if ($bln == '5'){

						$hadir = $val->abHadir5;
						$telat = $val->abTelat5;
						$izin = $val->abIjin5;
						$hadirjp = $val->jpHadir5;
						$hadirrk = $val->rkHadir5;
						$hadirbina =$val ->bnHadir5;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = (25-$val->abHadir5);
						$scoreA = round(($hadir/25)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakMei1;
						$dpak2 = $val->dpakMei2;
						$dpak3 = $val->dpakMei3;
						$dpak4 = $val->dpakMei4;
						$dpak5 = $val->dpakMei5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bln == '6'){

						$hadir = $val->abHadir6;
						$telat = $val->abTelat6;
						$izin = $val->abIjin6;
						$hadirjp = $val->jpHadir6;
						$hadirrk = $val->rkHadir6;
						$hadirbina =$val ->bnHadir6;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = (25-$val->abHadir6);
						$scoreA = round(($hadir/25)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);
												
						$dpak1 = $val->dpakJun1;
						$dpak2 = $val->dpakJun2;
						$dpak3 = $val->dpakJun3;
						$dpak4 = $val->dpakJun4;
						$dpak5 = $val->dpakJun5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}
					else if ($bln == '7'){
						$hadir = $val->abHadir7;
						$telat = $val->abTelat7;
						$izin = $val->abIjin7;
						$hadirjp = $val->jpHadir7;
						$hadirrk = $val->rkHadir7;
						$hadirbina =$val ->bnHadir7;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = (25-$val->abHadir7);
						$scoreA = round(($hadir/25)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakJul1;
						$dpak2 = $val->dpakJul2;
						$dpak3 = $val->dpakJul3;
						$dpak4 = $val->dpakJul4;
						$dpak5 = $val->dpakJul5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bln == '8'){
						$hadir = $val->abHadir8;
						$telat = $val->abTelat8;
						$izin = $val->abIjin8;
						$hadirjp = $val->jpHadir8;
						$hadirrk = $val->rkHadir8;
						$hadirbina =$val ->bnHadir8;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = (25-$val->abHadir8);
						$scoreA = round(($hadir/25)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakAgs1;
						$dpak2 = $val->dpakAgs2;
						$dpak3 = $val->dpakAgs3;
						$dpak4 = $val->dpakAgs4;
						$dpak5 = $val->dpakAgs5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bln == '9'){
						$hadir = $val->abHadir9;
						$telat = $val->abTelat9;
						$izin = $val->abIjin9;
						$hadirjp = $val->jpHadir9;
						$hadirrk = $val->rkHadir9;
						$hadirbina =$val ->bnHadir9;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = (25-$val->abHadir9);
						$scoreA = round(($hadir/25)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakSept1;
						$dpak2 = $val->dpakSept2;
						$dpak3 = $val->dpakSept3;
						$dpak4 = $val->dpakSept4;
						$dpak5 = $val->dpakSept5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bln == '10'){
						$hadir = $val->abHadir10;
						$telat = $val->abTelat10;
						$izin = $val->abIjin10;
						$hadirjp = $val->jpHadir10;
						$hadirrk = $val->rkHadir10;
						$hadirbina =$val ->bnHadir10;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = ($aktif-$hadir);
						$scoreA = round(($hadir/$aktif)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakOkt1;
						$dpak2 = $val->dpakOkt2;
						$dpak3 = $val->dpakOkt3;
						$dpak4 = $val->dpakOkt4;
						$dpak5 = $val->dpakOkt5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bln == '11'){
						$hadir = $val->abHadir11;
						$telat = $val->abTelat11;
						$izin = $val->abIjin11;
						$hadirjp = $val->jpHadir11;
						$hadirrk = $val->rkHadir11;
						$hadirbina =$val ->bnHadir11;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = (25-$val->abHadir11);
						$scoreA = round(($hadir/25)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakNov1;
						$dpak2 = $val->dpakNov2;
						$dpak3 = $val->dpakNov3;
						$dpak4 = $val->dpakNov4;
						$dpak5 = $val->dpakNov5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);

					}else if ($bln == '12'){
						$hadir = $val->abHadir12;
						$telat = $val->abTelat12;
						$izin = $val->abIjin12;
						$hadirjp = $val->jpHadir12;
						$hadirrk = $val->rkHadir12;
						$hadirbina =$val ->bnHadir12;
						$jppeg = $val->pegJp;
						$aktif 	= 26;

						// Absensi
						$absen1 = (25-$val->abHadir12);
						$scoreA = round(($hadir/25)*100);
						$scoreAb = round($scoreA*0.4);

						// KBM
						$absen = ($jppeg - $hadirjp);

						if ($jppeg > 0){
							$score1 = round(($hadirjp/$jppeg)*100);
							$score2 = round($score1 * 0.4);

						}else{
							$score1 = 0;
							$score2 = 0;
						}

						// rakor
						// rakor
                		$jmlrk = 4;
                		$absen2 = ( $jmlrk - $hadirrk);
                		$scorer = round (($hadirrk/$jmlrk)*100);
                		$scorerk = ($scorer*0.1);

                		// bina
                		$jmlbn = 5;
                		$absen3 = ($jmlbn - $hadirbina);
                		$scoreb = (($hadirbina/$jmlbn)*100);
                		$scorebn = ($scoreb*0.1);


						$dpk = ($scoreAb +$score2 + $scorerk + $scorebn);

						$dpak1 = $val->dpakDes1;
						$dpak2 = $val->dpakDes2;
						$dpak3 = $val->dpakDes3;
						$dpak4 = $val->dpakDes4;
						$dpak5 = $val->dpakDes5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($dpk + $total)*0.6);
						$rank1	 = round(($dpk + $total)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}
					else{
						$dpk ='0';
						$dpak = '0';
						
					}
					

					if ($rank2 >= '96' && $rank2 <= '100') {
							$status = 'A';
							//$warna_belakang = "#99FFFF";
						}elseif ($rank2 >= '90' && $rank2 <= '95'){
							$status = 'B';
						}elseif ($rank2 >= '80' && $rank2 <= '89'){
							$status = 'C';
						}elseif ($rank2 >= '70' && $rank2 <= '79'){
							$status = 'D';
						}
						else{
							$status = 'E';

						}
					


					$height = $pdf->getY();
					if ($height > 239) {
						// $imgX = 118.2;
						// $imgY = 12;
						$current_y=10;
						// $rectY = 20;
						$pdf->AddPage();
					}

					// if ($foto!==false) $pdf->Image($foto[0], $imgX, $imgY,30,36, $foto[1]);

					$pdf->setY($current_y);
					$pdf->cell(10 ,  10,$no,1,0,'C');
					$pdf->cell(20 ,  10,$nip,1,0,'C');
					$pdf->cell(60 ,  10,$namapeg,1,0,'C');
					$pdf->cell(50 ,  10,$unitpeg,1,0,'C');
					$pdf->cell(15 ,  10,$dpk,1,0,'C');
					$pdf->cell(15 ,  10,$total,1,0,'C');
					$pdf->cell(15 ,  10,$rank2,1,0,'C');
					$pdf->cell(20 ,  10,$status,1,0,'C');
					

					//$imgY += 10;
					$current_y += 10;
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
				$pdf->cell(220 ,  5,'DPP   : Daftar Penilaian Pekerjaan',0,1,'L');
				$pdf->cell(220 ,  5,'DPAK : Daftar Penilaian Administrasi Keguruan',0,1,'L');
						
		
				// Bagan Tenaga Kependidikan

				
				$pdf->SetFont('Arial','B',16);

				$pdf->Ln(4);
				// $pdf->Ln(4);
				// $pdf->Ln(4);
				// $pdf->Ln(4);
				$pdf->AddPage();
				// $pdf->Ln(4);
				$query = DB::table('trdpak')
				->select('*' 
                  )

                  // DB::raw('IF(tanggallahir="0000-00-00",concat("-"),tanggallahir) as tanggal_lahir')
                  ->join('trdpk','dpkId','=','dpakId')
                  ->join('trdpp','dppId','=','dpakId')
                  ->leftjoin('ms_satuankerja','satkerId','=','dpakUnit')
                  ->where('dpakUnit','=',$pegid)
                  ->where('dpkJab','=',2)
                  // ->where('dpkJab','=',2)
                  ->get();
                $pdf->SetFont('Arial','',10);
				$pdf->cell(220 ,  5,'Tenaga Kependidikan',0,1,'L');
				$pdf->Ln();  
				$pdf->SetFont('Arial','B',8);
				$pdf->cell(10 ,  6,'NO',1,0,'C');
				$pdf->cell(20 ,  6,'NIP',1,0,'C');
				$pdf->cell(60 ,  6,'NAMA PEGAWAI',1,0,'C');
				$pdf->cell(50,  6,'UNIT',1,0,'C');
				$pdf->cell(15 ,  6,' DPK',1,0,'C');
				$pdf->cell(15 ,  6,' DPP',1,0,'C');
				$pdf->cell(15 ,  6,'NILAI PK',1,0,'C');
				$pdf->cell(20 ,  6,'KATEGORI',1,0,'C');
				// $pdf->cell(40 ,  5,'FOTO',1,0,'C');
				// $pdf->cell(78 ,  5,'KETERANGAN',1,1,'C');
				$pdf->SetFont('Arial','',8);

				
							
				foreach ($query as $row => $val) {
					$nip = $val->dpakNip;
					$namapeg = $val->dpakNama;
					$unitpeg = $val->satkerNama;
					$bln = $bulanid;
					//$tgl = substr($tgawal, 5,2);
					//$masuk > '08:00:00' && $masuk <= '12:00:00'
					if ($bln == '1'){
						$dpk = $val->dpkJan;
						$dpp = $val ->dppJan;

						//$dpak = (( $val->dpakJan1 + $val ->dpakJan2 + $val ->dpakJan3 + $val->dpakJan4 + $val->dpakJan5)/5);		
					}else if ($bln == '2'){
						$dpk = $val->dpkFeb;
						$dpp = $val ->dppFeb;

						//$dpak = (( $val->dpakFeb1 + $val ->dpakFeb2 + $val ->dpakFeb3 + $val->dpakFeb4 + $val->dpakFeb5)/5);
					}else if ($bln == '3'){
						$dpk = $val->dpkMar;
						$dpp = $val ->dppMar;

						//$dpak = (( $val->dpakMar1 + $val ->dpakMar2 + $val ->dpakMar3 + $val->dpakMar4 + $val->dpakMar5)/5);
					}else if ($bln == '4'){
						$dpk = $val->dpkApr;
						$dpp = $val ->dppApr;
						//$dpak = (( $val->dpakApr1 + $val ->dpakApr2 + $val ->dpakApr3 + $val->dpakApr4 + $val->dpakApr5)/5);
					}else if ($bln == '5'){
						$dpk = $val->dpkMei;
						$dpp = $val->dppMei;

						//$dpak = (( $val->dpakMei1 + $val ->dpakMei2 + $val ->dpakMei3 + $val->dpakMei4 + $val->dpakMei5)/5);
					}else if ($bln == '6'){
						$dpk = $val->dpkJun;
						$dpp = $val ->dppJun;

						//$dpak = (( $val->dpakJun1 + $val ->dpakJun2 + $val ->dpakJun3 + $val->dpakJun4 + $val->dpakJun5)/5);
					}else if ($bln == '7'){
						$dpk = $val->dpkJul;
						$dpp = $val->dppJul;

						//$dpak = (( $val->dpakJul1 + $val ->dpakJul2 + $val ->dpakJul3 + $val->dpakJul4 + $val->dpakJul5)/5);
					}else if ($bln == '8'){
						$dpk = $val->dpkAgs;
						$dpp = $val->dppAgs;

						//$dpak = (( $val->dpakAgs1 + $val ->dpakAgs2 + $val ->dpakAgs3 + $val->dpakAgs4 + $val->dpakAgs5)/5);
					}else if ($bln == '9'){
						$dpk = $val->dpkSep;
						$dpp = $val->dppSep;

						//$dpak = (( $val->dpakSep1 + $val ->dpakSep2 + $val ->dpakSep3 + $val->dpakSep4 + $val->dpakSep5)/5);
					}else if ($bln == '10'){
						$dpk = $val->dpkOkt;
						$dpp = $val->dppOkt;

						//$dpak = (( $val->dpakOkt1 + $val ->dpakOkt2 + $val ->dpakOkt3 + $val->dpakOkt4 + $val->dpakOkt5)/5);
					}else if ($bln == '11'){
						$dpk = $val->dpkNov;
						$dpp = $val->dppNov;

						//$dpak = (( $val->dpakNov1 + $val ->dpakNov2 + $val ->dpakNov3 + $val->dpakNov4 + $val->dpakNov5)/5);
					}else if ($bln == '12'){
						$dpk = $val->dpkDes;
						$dpp = $val->dppDes;
						//$dpak = (( $val->dpakDes1 + $val ->dpakDes2 + $val ->dpakDes3 + $val->dpakDes4 + $val->dpakDes5)/5);
					}
					else{
						$dpk ='0';
						$dpak = '0';
						
					}
					
					$rank4 	 = round(($dpk + $dpp)*0.6);
					$rank5	 = round(($dpk + $dpp)*0.4);
					$rank6 	 = round (($rank4 + $rank5)/2);

					if ($rank6 >= '96' && $rank6 <= '100') {
							$status = 'A';
							//$warna_belakang = "#99FFFF";
						}elseif ($rank6 >= '90' && $rank6 <= '95'){
							$status = 'B';
						}elseif ($rank6 >= '80' && $rank6 <= '89'){
							$status = 'C';
						}elseif ($rank6 >= '70' && $rank6 <= '79'){
							$status = 'D';
						}
						else{
							$status = 'E';

						}
					


					$height = $pdf->getY();
					if ($height > 245) {
						// $imgX1 = 118.2;
						// $imgY1 = 12;
						$current_y1=10;
						// $rectY1 = 20;
						
					}

					// if ($foto!==false) $pdf->Image($foto[0], $imgX, $imgY,30,36, $foto[1]);
					$pdf->Ln(3);
					$pdf->setY($current_y1);
					$pdf->cell(10 ,  10,$no,1,0,'C');
					$pdf->cell(20 ,  10,$nip,1,0,'C');
					$pdf->cell(60 ,  10,$namapeg,1,0,'C');
					$pdf->cell(50 ,  10,$unitpeg,1,0,'C');
					$pdf->cell(15 ,  10,$dpk,1,0,'C');
					$pdf->cell(15 ,  10,$dpp,1,0,'C');
					$pdf->cell(15 ,  10,$rank6,1,0,'C');
					$pdf->cell(20 ,  10,$status,1,0,'C');
					

					//$imgY1 += 10;
					$current_y1 += 10;
					//$rectY1 += 10;

					$no++;
				}
				$pdf->Ln(4);
				$pdf->Ln(4);
				$pdf->Ln(6);
				$pdf->SetFont('Arial','',10);
				$pdf->cell(220 ,  5,'KETERANGAN : ',0,1,'L');	
				$pdf->cell(220 ,  5,'PK     : Prestasi Kerja',0,1,'L');	
				$pdf->cell(220 ,  5,'DPK   : Daftar Penilaian Kehadiran',0,1,'L');
				$pdf->cell(220 ,  5,'DPP   : Daftar Penilaian Pekerjaan',0,1,'L');
				$pdf->cell(220 ,  5,'DPAK : Daftar Penilaian Administrasi Keguruan',0,1,'L');


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