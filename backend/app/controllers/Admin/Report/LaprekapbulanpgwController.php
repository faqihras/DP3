<?php
namespace Admin\Report;

use BasicController;
use DB;
use Lang;
use Input;
use Session;
use Fpdf;

class LaprekapbulanpgwController extends BasicController {

		public function index(){
				$param      = Input::all();
				$data       = json_decode($_GET['data']);
				$today      =  date("Y-m-d");
				// $time = time(); // or whenever
				// $week_of_the_month = ceil(date('d', $time)/7);
				// $to      =  date("N");
				//$tgawal     = $this->reversdate($data->tgawal);
				//$tgahir     = $this->reversdate($data->tgahir);
				$bulanid      = $data->bulan1;
				$pegid      = $data->unit;

				$bulan = $bulanid;
				if ($bulan == '1'){
						$bln='Januari';
						
					}else if ($bulan == '2'){
						$bln='Februari';
					}else if ($bulan == '3'){
						$bln='Maret';
					}else if ($bulan == '4'){
						$bln='April';
					}else if ($bulan == '5'){
						$bln='Mei';
					}else if ($bulan == '6'){
						$bln='Juni';
					}else if ($bulan == '7'){
						$bln='Juli';
					}else if ($bulan == '8'){
						$bln='Agustus';
					}else if ($bulan == '9'){
						$bln='September';
					}else if ($bulan == '10'){
						$bln='Oktober';
					}else if ($bulan == '11'){
						$bln='November';
					}else if ($bulan == '12'){
						$bln='Desember';
					}
					else{
						$bln='-';
						
					}
				$today      =  date("Y-m-d");
				$year 		= date("Y");

				// $pdf = new Fpdf('P','mm','A4');
				$pdf = new Fpdf('P','cm',array (27, 22.7));
				$pdf->AddPage();

				$no=1;
				$imgX = 118.2;
				$imgY = 38;
				$rectY = 36;
				$current_y=70;
				$current_y1=26;
				$pdf->SetFont('Arial','B',16);

				$nama = DB::table('ms_satuankerja')
						->select('satkerNama')
						->where('satkerId','=',$pegid)
						->get();

				$namapeg = !empty($nama[0]->satkerNama) ? $nama[0]->satkerNama : '-';

				$pgw = DB::table('ms_pegawai')
						->select('pegNama','pegUnit','satkerNama','pegJp','pegJab')
						->leftjoin('ms_satuankerja','satkerId','=','pegUnit')
						->where('pegId','=',$pegid)
						->get();

				$pgwnama = !empty($pgw[0]->pegNama) ? $pgw[0]->pegNama : '-';
				$jp = !empty($pgw[0]->pegJp) ? $pgw[0]->pegJp : '0';
				$pgwjab = !empty($pgw[0]->pegJab) ? $pgw[0]->pegJab:'';

				// $pdf->cell(220 ,  6,'REKAP DATA PENILAIAN BULANAN',0,1,'C');
				// $pdf->SetFont('Arial','B',12);
				// $pdf->cell(220 ,  5,'BULAN :  ' . $bln,0,1,'C');
				// $pdf->SetFont('Arial','B',12);
				
				// $pdf->SetFont('Arial','B',10);
				// $pdf->cell(220 ,  5,'Nama Pegawai : '.$pgwnama,0,1,'L');
				// $pdf->cell(220 ,  5,'Unit Kerja : ' . $namapeg,0,1,'L');
				// $pdf->Ln(2);
				
				$query = DB::table('trdpak')
				->select('*' 
                  )

                  // DB::raw('IF(tanggallahir="0000-00-00",concat("-"),tanggallahir) as tanggal_lahir')
                  ->join('trabsen','abId','=','dpakId')
                  ->join('trbina','bnId','=','dpakId')
                  ->join('trrakor','rkId','=','dpakId')
                  ->join('trjp','jpId','=','dpakId')
                  ->leftjoin('ms_satuankerja','satkerId','=','dpakUnit')

                  ->where('dpakId','=',$pegid)
                  // ->where('dpkJab','=',1)
                  // ->where('dpkJab','=',2)
                  ->get();

				$pgwjab = !empty($query[0]->dpakJab) ? $query[0]->dpakJab:'';
                 
                if ($bulan == '1'){

                		$hadir = $query[0]->abHadir1;
                		$telat = $query[0]->abTelat1;
                		$izin  = $query[0]->abIjin1;
                		$hadirjp = $query[0]->jpHadir1;
                		$hadirrk = $query[0]->rkHadir1;
                		$hadirbina= $query[0]->bnHadir1;
                		$jppeg    = $pgw[0]->pegJp;
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

						$dpak1 = $query[0]->dpakJan1;
						$dpak2 = $query[0]->dpakJan2;
						$dpak3 = $query[0]->dpakJan3;
						$dpak4 = $query[0]->dpakJan4;
						$dpak5 = $query[0]->dpakJan5;

						

						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);


					}else if ($bulan == '2'){
						$hadir = $query[0]->abHadir2;
                		$telat = $query[0]->abTelat2;
                		$izin  = $query[0]->abIjin2;
                		$hadirjp = $query[0]->jpHadir2;
                		$hadirrk = $query[0]->rkHadir2;
                		$hadirbina= $query[0]->bnHadir2;
                		$jppeg      = $pgw[0]->pegJp;
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



						$dpak1 = $query[0]->dpakFeb1;
						$dpak2 = $query[0]->dpakFeb2;
						$dpak3 = $query[0]->dpakFeb3;
						$dpak4 = $query[0]->dpakFeb4;
						$dpak5 = $query[0]->dpakFeb5;

						
						
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);

						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);

					}else if ($bulan == '3'){
						$hadir = $query[0]->abHadir3;
                		$telat = $query[0]->abTelat3;
                		$izin  = $query[0]->abIjin3;
                		$hadirjp = $query[0]->jpHadir3;
                		$hadirrk = $query[0]->rkHadir3;
                		$hadirbina= $query[0]->bnHadir3;
                		$jppeg      = $pgw[0]->pegJp;
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

						$dpak1 = $query[0]->dpakMar1;
						$dpak2 = $query[0]->dpakMar2;
						$dpak3 = $query[0]->dpakMar3;
						$dpak4 = $query[0]->dpakMar4;
						$dpak5 = $query[0]->dpakMar5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '4'){
						$hadir = $query[0]->abHadir4;
                		$telat = $query[0]->abTelat4;
                		$izin  = $query[0]->abIjin4;
                		$hadirjp = $query[0]->jpHadir4;
                		$hadirrk = $query[0]->rkHadir4;
                		$hadirbina= $query[0]->bnHadir4;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakApr1;
						$dpak2 = $query[0]->dpakApr2;
						$dpak3 = $query[0]->dpakApr3;
						$dpak4 = $query[0]->dpakApr4;
						$dpak5 = $query[0]->dpakApr5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '5'){
						$hadir = $query[0]->abHadir5;
                		$telat = $query[0]->abTelat5;
                		$izin  = $query[0]->abIjin5;
                		$hadirjp = $query[0]->jpHadir5;
                		$hadirrk = $query[0]->rkHadir5;
                		$hadirbina= $query[0]->bnHadir5;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakMei1;
						$dpak2 = $query[0]->dpakMei2;
						$dpak3 = $query[0]->dpakMei3;
						$dpak4 = $query[0]->dpakMei4;
						$dpak5 = $query[0]->dpakMei5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '6'){
						$hadir = $query[0]->abHadir6;
                		$telat = $query[0]->abTelat6;
                		$izin  = $query[0]->abIjin6;
                		$hadirjp = $query[0]->jpHadir6;
                		$hadirrk = $query[0]->rkHadir6;
                		$hadirbina= $query[0]->bnHadir6;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakJun1;
						$dpak2 = $query[0]->dpakJun2;
						$dpak3 = $query[0]->dpakJun3;
						$dpak4 = $query[0]->dpakJun4;
						$dpak5 = $query[0]->dpakJun5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '7'){
						$hadir = $query[0]->abHadir7;
                		$telat = $query[0]->abTelat7;
                		$izin  = $query[0]->abIjin7;
                		$hadirjp = $query[0]->jpHadir7;
                		$hadirrk = $query[0]->rkHadir7;
                		$hadirbina= $query[0]->bnHadir7;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakJul1;
						$dpak2 = $query[0]->dpakJul2;
						$dpak3 = $query[0]->dpakJul3;
						$dpak4 = $query[0]->dpakJul4;
						$dpak5 = $query[0]->dpakJul5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '8'){
						$hadir = $query[0]->abHadir8;
                		$telat = $query[0]->abTelat8;
                		$izin  = $query[0]->abIjin8;
                		$hadirjp = $query[0]->jpHadir8;
                		$hadirrk = $query[0]->rkHadir8;
                		$hadirbina= $query[0]->bnHadir8;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakAgs1;
						$dpak2 = $query[0]->dpakAgs2;
						$dpak3 = $query[0]->dpakAgs3;
						$dpak4 = $query[0]->dpakAgs4;
						$dpak5 = $query[0]->dpakAgs5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '9'){
						$hadir = $query[0]->abHadir9;
                		$telat = $query[0]->abTelat9;
                		$izin  = $query[0]->abIjin9;
                		$hadirjp = $query[0]->jpHadir9;
                		$hadirrk = $query[0]->rkHadir9;
                		$hadirbina= $query[0]->bnHadir9;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakSep1;
						$dpak2 = $query[0]->dpakSep2;
						$dpak3 = $query[0]->dpakSep3;
						$dpak4 = $query[0]->dpakSep4;
						$dpak5 = $query[0]->dpakSep5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '10'){
						$hadir = $query[0]->abHadir10;
                		$telat = $query[0]->abTelat10;
                		$izin  = $query[0]->abIjin10;
                		$hadirjp = $query[0]->jpHadir10;
                		$hadirrk = $query[0]->rkHadir10;
                		$hadirbina= $query[0]->bnHadir10;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakOkt1;
						$dpak2 = $query[0]->dpakOkt2;
						$dpak3 = $query[0]->dpakOkt3;
						$dpak4 = $query[0]->dpakOkt4;
						$dpak5 = $query[0]->dpakOkt5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '11'){
						$hadir = $query[0]->abHadir11;
                		$telat = $query[0]->abTelat11;
                		$izin  = $query[0]->abIjin11;
                		$hadirjp = $query[0]->jpHadir11;
                		$hadirrk = $query[0]->rkHadir11;
                		$hadirbina= $query[0]->bnHadir11;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakNov1;
						$dpak2 = $query[0]->dpakNov2;
						$dpak3 = $query[0]->dpakNov3;
						$dpak4 = $query[0]->dpakNov4;
						$dpak5 = $query[0]->dpakNov5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}else if ($bulan == '12'){
						$hadir = $query[0]->abHadir12;
                		$telat = $query[0]->abTelat12;
                		$izin  = $query[0]->abIjin12;
                		$hadirjp = $query[0]->jpHadir12;
                		$hadirrk = $query[0]->rkHadir12;
                		$hadirbina= $query[0]->bnHadir12;
                		$jppeg      = $pgw[0]->pegJp;
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

                		
						$dpak1 = $query[0]->dpakDes1;
						$dpak2 = $query[0]->dpakDes2;
						$dpak3 = $query[0]->dpakDes3;
						$dpak4 = $query[0]->dpakDes4;
						$dpak5 = $query[0]->dpakDes5;
						$total = (($dpak1 + $dpak2 + $dpak3 + $dpak4 + $dpak5)/5);
						$rank 	 = round(($total + $dpk)*0.6);
						$rank1	 = round(($total + $dpk)*0.4);
						$rank2 	 = round (($rank + $rank1)/2);
					}
					else{
						$dpk = '0';
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
							
				if ($pgwjab =='1'){
				$pdf -> SetLineWidth(0.05);
		        $pdf -> Line(1,3.5, 22, 3.5);
		        //Garis ke 2
		        $pdf -> SetLineWidth(0.02);
		        $pdf -> Line(1,3.6, 22, 3.6);
		        $pdf -> ln(0.2);
                $pdf -> Setx(0.5);
	        	$pdf -> SetFont('Arial','B',12);
	        	$pdf -> Cell(0,0.7,'    Laporan Penilaian Pelaksanaan Pekerjaan Bulanan ','',0,'C');
	        	$pdf -> ln(1);
                  //BODY (Identitas)
		       	$pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(20,0.5,'Nama','',0,'L');

		        // Nama
		        $pdf -> Setx(0.5);
		        $pdf->Cell(4);
		        $pdf -> Cell(20,0.5,': '.$pgw[0]->pegNama,'',0,'L');
		        $pdf->Ln();

				$pdf -> Cell(20,0.5,'Unit','',0,'L');
		        $pdf -> Setx(0.5);
		        $pdf->Cell(4);
		        $pdf -> Cell(20,0.5,': '.$pgw[0]->satkerNama,'',0,'L');
		        $pdf->Ln();

		        $pdf -> Setx(0.5);
		        $pdf -> Sety(2.2);
		        $pdf -> Cell(15.9,0.5,'Bulan','',0,'R');
		        $pdf->Cell(1.9);
		        $pdf -> Cell(17.5,0.5,': '.$bln,'',0,'L');
		        $pdf->Ln(2);
		        $pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(20,0.5,'A. DAFTAR PENILAIAN KEHADIRAN (DPK)','',0,'L');
		        $pdf->Ln();

        		$pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(17.0,0.7,'INSTRUMEN',1,0,'C');
		        // $pdf -> Cell(7.0,0.7,'KRITERIA',1,0,'C');
		        // $pdf -> Cell(3.0,0.7,'POINT',1,0,'C');
		        $pdf -> Cell(2.0,0.7,'JUMLAH',1,0,'C');
		        $pdf -> Cell(2.0,0.7,'NILAI',1,0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(13.0,0.7,'1. Kehadiran Disekolah','TRL',0,'L');
		        // $pdf -> Cell(7.0,0.6,'Check Clock Mobile','TRL',0,'C');
		        $pdf -> Cell(4.0,0.6,'Hari Aktif','TBR',0,'L');
		        $pdf -> Cell(2,0.6,''.$aktif,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(13.0,0.6,'','LR',0,'L');
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(4.0,0.6,'Hadir','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$hadir,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'' .$scoreA,'LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(13.0,0.6,'','LR',0,'L');
		        // $pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(4.0,0.6,'Absen','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$absen1,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		         $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(13.0,0.6,'','BLR',0,'L');
		        //$pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(4,0.6,'Terlambat','BR',0,'L');

		        $pdf -> Cell(2,0.6,'-','RT',0,'C');
		        $pdf -> Cell(2,0.6,'','BLR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(13.0,0.6,'2. Kehadiran KBM ','LR',0,'L');
		        $pdf -> Cell(4.0,0.6,'JP Per Bulan','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$pgw[0]->pegJp,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(13.0,0.6,'','LR',0,'L');
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(4.0,0.6,'Hadir','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$hadirjp,'RT',0,'C');
		        $pdf -> Cell(2,0.6,''.$score1,'LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(13.0,0.6,'','BLR',0,'L');
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(4.0,0.6,'Absen','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$absen,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','BLR',0,'C');
		        $pdf -> ln();

		         $pdf -> SetFont('Arial','',10);
		        //$pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(13.0,0.6,'3. Kehadiran Rapat Kordinasi ','LR',0,'L');
		        $pdf -> Cell(4.0,0.6,'Jumlah Pertemuan','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$jmlrk,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        //$pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(13.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(4.0,0.6,'Hadir','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$hadirrk,'RT',0,'C');
		        $pdf -> Cell(2,0.6,''.$scorer,'LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(13.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(4.0,0.6,'Absen','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$absen2,'RT',0,'C');

		        // $pdf -> SetFont('Arial','B',20);
		        $pdf -> Cell(2,0.6,'','BLR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(13.0,0.6,'4. Kehadiran Halaqoh & Pembinaan ','LR',0,'L');
		        $pdf -> Cell(4.0,0.6,'Jumlah Pertemuan','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$jmlbn,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		       
		        $pdf -> SetFont('Arial','',10);
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(13.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(4.0,0.6,'Hadir','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$hadirbina,'RT',0,'C');
		        $pdf -> Cell(2,0.6,''.$scoreb,'LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        //$pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(13.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(4.0,0.6,'Absen','BR',0,'L');
		        $pdf -> Cell(2,0.6,''.$absen3,'BRT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','B',10);
		        
		        $pdf -> Cell(19.0,0.6,'TOTAL NILAI DPK','BLR',0,'R');
		       
		        $pdf -> Cell(2,0.6,''.$dpk,'BRT',0,'C');
		        // $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln(1);
		        $pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(20,0.5,'B. DAFTAR PENILAIAN ADMINISTRASI KEGURUAN (DPAK)','',0,'L');
		        $pdf->Ln();
		        $pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(19.0,0.7,'INSTRUMEN',1,0,'C');
		        $pdf -> Cell(2.0,0.7,'NILAI',1,0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        // $pdf -> Cell(7.0,0.6,'Daftar Penilaian Administrasi Keguruan','TLR',0,'C');
		        $pdf -> Cell(19.0,0.6,'1. Membuat Prota & Promes ','BLR',0,'L');
		        $pdf -> Cell(2,0.6,$dpak1,'BLR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(19.0,0.6,'2. Membuat Silabus ','BLR',0,'L');
		        $pdf -> Cell(2,0.6,$dpak2,'BLR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(19.0,0.6,'3. Membuat Rencana Pelaksanaan Pembelajaran ','BLR',0,'L');
		        $pdf -> Cell(2,0.6,$dpak3,'BLR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(19.0,0.6,'4. Membuat Laporan Pelaksanaan Tatap Muka  ','BLR',0,'L');
		        $pdf -> Cell(2,0.6,$dpak4,'BLR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(19.0,0.6,'5. Membuat Laporan Hasil Evaluasi Belajar ','BLR',0,'L');
		        $pdf -> Cell(2,0.6,$dpak5,'LR',0,'C');
		         $pdf -> ln();
		         $pdf -> SetFont('Arial','B',10);
		        
		        $pdf -> Cell(19.0,0.6,'TOTAL NILAI DPAK','LBR',0,'R');
		         $pdf -> Cell(2,0.6,$total,'BRT',0,'C');
		        // $pdf -> Cell(2,0.6,'','BLR',0,'C');

		         $pdf -> ln(1);

		         $pdf -> SetFont('Arial','B',10);
		        
		        $pdf -> Cell(19.0,0.6,'NILAI PRESTASI KINERJA (PK)','R',0,'R');
		        $pdf -> Cell(2,0.6,$rank2,'BRT',0,'C');
		        // $pdf -> Cell(2,0.6,'','BLR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','B',10);
		        
		        $pdf -> Cell(19.0,1,'KATEGORI','R',0,'R');
		         $pdf -> SetFont('Arial','B',14);
		        $pdf -> Cell(2,1,$status,'BRT',0,'C');
		        // $pdf -> Cell(2,0.6,'','BLR',0,'C');
		        $pdf -> ln(2);

		        
		        $pdf -> SetFont('Arial','B',10);
		        $pdf -> Setx(17);
		        $pdf -> Cell(5,0.5,'Mengetahui','',1,'C');
		       
		        $pdf -> Setx(17);
		        $pdf -> Cell(5,0.5,'Kepala Sekolah','',0,'C');
		        $pdf -> ln(2.8);
		        $pdf -> Setx(1);
				}
		       else {
		       	 $pdf -> SetLineWidth(0.05);
		        $pdf -> Line(1,3.5, 22, 3.5);
		        //Garis ke 2
		        $pdf -> SetLineWidth(0.02);
		        $pdf -> Line(1,3.6, 22, 3.6);
		        $pdf -> ln(0.2);
                $pdf -> Setx(0.5);
	        	$pdf -> SetFont('Arial','B',12);
	        	$pdf -> Cell(0,0.7,'    Laporan Penilaian Pelaksanaan Pekerjaan Bulanan ','',0,'C');
	        	$pdf -> ln(1);
                  //BODY (Identitas)
		       	$pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(20,0.5,'Nama','',0,'L');

		        // Nama
		        $pdf -> Setx(0.5);
		        $pdf->Cell(4);
		        $pdf -> Cell(20,0.5,': '.$pgw[0]->pegNama,'',0,'L');
		        $pdf->Ln();

				$pdf -> Cell(20,0.5,'Unit','',0,'L');
		        $pdf -> Setx(0.5);
		        $pdf->Cell(4);
		        $pdf -> Cell(20,0.5,': '.$pgw[0]->satkerNama,'',0,'L');
		        $pdf->Ln();

		        $pdf -> Setx(0.5);
		        $pdf -> Sety(2.2);
		        $pdf -> Cell(15.9,0.5,'Bulan','',0,'R');
		        $pdf->Cell(1.9);
		        $pdf -> Cell(17.5,0.5,': '.$bln,'',0,'L');
		        $pdf->Ln(2);

        		$pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(7.0,0.7,'PENILAIAN',1,0,'C');
		        $pdf -> Cell(7.0,0.7,'KRITERIA',1,0,'C');
		        $pdf -> Cell(3.0,0.7,'POINT',1,0,'C');
		        $pdf -> Cell(2.0,0.7,'NILAI',1,0,'C');
		        $pdf -> Cell(2.0,0.7,'KATEGORI',1,0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'Daftar Penilaian Kehadiran','TRL',0,'C');
		        $pdf -> Cell(7.0,0.6,'Check Clock Mobile','TRL',0,'C');
		        $pdf -> Cell(3.0,0.6,'Hadir','TBR',0,'C');
		        $pdf -> Cell(2,0.6,''.$hadir,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Terlambat','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$telat,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Absen','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$absen1,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		         $pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        //$pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(10,0.6,'Skor','TBR',0,'C');

		        $pdf -> Cell(2,0.6,''.$scoreA,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(7.0,0.6,'Kehadiran KBM ','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Jumlah JP','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$pgw[0]->pegJp,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Hadir','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$hadirjp,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Absen','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$absen,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		         $pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        //$pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(10,0.6,'Skor','TBR',0,'C');

		        $pdf -> Cell(2,0.6,''.$score2,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(7.0,0.6,'Kehadiran Rapat Kordinasi ','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Hadir','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$hadirrk,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Absen','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$absen2,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		         $pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        //$pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(10,0.6,'Skor','TBR',0,'C');

		        $pdf -> Cell(2,0.6,''.$scorer,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        // $pdf -> SetFont('Arial','',10);
		        // $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        // $pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        // $pdf -> Cell(3.0,0.6,'Izin/Tugas','BR',0,'C');
		        // $pdf -> Cell(2,0.6,''.$izin,'RT',0,'C');
		        // $pdf -> Cell(2,0.6,'','LR',0,'C');
		        // $pdf -> ln();
		       
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(7.0,0.6,'Kehadiran Pembinaan SDM ','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Hadir','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$hadirbina,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'','LR',0,'C');
		        $pdf -> Cell(3.0,0.6,'Absen','BR',0,'C');
		        $pdf -> Cell(2,0.6,''.$absen3,'BRT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		         $pdf -> SetFont('Arial','B',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        //$pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        $pdf -> Cell(10,0.6,'Skor','TBR',0,'C');

		        $pdf -> Cell(2,0.6,''.$scoreb,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        // $pdf -> SetFont('Arial','',10);
		        // $pdf -> Cell(7.0,0.6,'','BLR',0,'L');
		        // $pdf -> Cell(7.0,0.6,'','BLR',0,'C');
		        // $pdf -> Cell(3.0,0.6,'Izin','BR',0,'C');
		        // $pdf -> Cell(2,0.6,''.$izin,'BRT',0,'C');
		        // $pdf -> Cell(2,0.6,'','LR',0,'C');
		        // $pdf -> ln();
		        $pdf -> SetFont('Arial','B',10);
		        
		        $pdf -> Cell(17.0,0.6,'TOTAL NILAI DPK','TBLR',0,'C');
		       
		        $pdf -> Cell(2,0.6,''.$dpk,'BRT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'Daftar Penilaian Pekerjaan','TLR',0,'C');
		        $pdf -> Cell(7.0,0.6,'?? ','TBLR',0,'C');
		        $pdf -> Cell(3.0,0.6,'','TR',0,'C');
		         $pdf -> Cell(2,0.6,$ca1,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'??','BLR',0,'C');
		        $pdf -> Cell(3.0,0.6,'','R',0,'C');
		         $pdf -> Cell(2,0.6,$ca2,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'??','BLR',0,'C');
		        $pdf -> Cell(3.0,0.6,'','R',0,'C');
		         $pdf -> Cell(2,0.6,$ca3,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();
		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','LR',0,'L');
		        $pdf -> Cell(7.0,0.6,'??','BLR',0,'C');
		        $pdf -> Cell(3.0,0.6,'','R',0,'C');
		         $pdf -> Cell(2,0.6,$ca4,'RT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		        $pdf -> ln();

		        $pdf -> SetFont('Arial','',10);
		        $pdf -> Cell(7.0,0.6,'','BLR',0,'L');
		        $pdf -> Cell(7.0,0.6,'??','BLR',0,'C');
		        $pdf -> Cell(3.0,0.6,'','BR',0,'C');
		         $pdf -> Cell(2,0.6,$ca5,'BRT',0,'C');
		        $pdf -> Cell(2,0.6,'','LR',0,'C');
		         $pdf -> ln();
		         $pdf -> SetFont('Arial','B',10);
		        
		        $pdf -> Cell(17.0,0.6,'NILAI DPP',1,0,'C');
		         $pdf -> Cell(2,0.6,$total,'BRT',0,'C');
		        $pdf -> Cell(2,0.6,'','BLR',0,'C');

		         $pdf -> ln();
		         $pdf -> SetFont('Arial','B',10);
		        
		        $pdf -> Cell(17.0,0.6,'NILAI PK',1,0,'C');
		         $pdf -> Cell(2,0.6,$rank2,'BRT',0,'C');
		        $pdf -> Cell(2,0.6,'','BLR',0,'C');
		        $pdf -> ln(2);

		        
		        $pdf -> SetFont('Arial','B',10);
		        $pdf -> Setx(17);
		        $pdf -> Cell(5,0.5,'Mengetahui','',1,'C');
		       
		        $pdf -> Setx(17);
		        $pdf -> Cell(5,0.5,'Kepala Sekolah','',0,'C');
		        $pdf -> ln(2.8);
		        $pdf -> Setx(1);
		       }


		        $pdf_file_name = $pgwnama." ".$bln." ".$year.".pdf";

				$pdf->Output($pdf_file_name,'I');

				// $pdf->Output();
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



		// function getWeeks($tanggal)
		// {
		//     $maxday    = date("N",$tanggal);
		//     $thismonth = getdate($tanggal);
		//     $timeStamp = mktime(0,0,0,$thismonth['mon'],1,$thismonth['year']);    //Create time stamp of the first day from the give date.
		//     $startday  = date('w',$timeStamp);    //get first day of the given month
		//     $day = $thismonth['mday'];
		//     $weeks = 0;
		//     $week_num = 0;

		//     for ($i=0; $i<($maxday+$startday); $i++) {
		//         if(($i % 7) == 0){
		//             $weeks++;
		//         }
		//         if($day == ($i - $startday + 1)){
		//             $week_num = $weeks;
		//         }
		//       }     
		//     return $week_num;
		// }

}