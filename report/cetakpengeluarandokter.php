<?php
	include('conn.php');
	$no=$_GET['id'];

?><head>
	
<link href="bootstrap/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<style type="text/css">	
td {
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
}	
.header {font-size: 12px; font-family: "Times New Roman", Times, serif; }
.style1 {font-size: 12px; font-family: "Times New Roman", Times, serif; }
.style2 {border: thin solid #000000; border-top:0px; border-bottom:0px;}
.style3 {border: thin solid #000000; border-bottom:0px;}
.style4 {border: thin solid #000000;
}
.style5 {border-bottom: thin solid #000000; border-top:0px;}
</style>
</head>

<table style="width:50%">
<td>
<td>
<tr>
	<td width="20%" rowspan="10" align="left"><div align="center"><img src="images/logos.png" alt="logo" width="70" height="70" /></div></td>
	<td width="120%" height="30" align="left">
	  <span class="style1"><strong>RSUD S.K. LERIK</strong>
	  </br></span>
	  <span class="header">Jl. Timor Raya Pasir No. 134, Kec. Kota Lama, Kupang NTT
	  </br>
	  Telp. (0380) 824157</span></td>
</tr>
</td>
</td>
<tr>
	<td align="left">
		<span class="style4"><strong>RESEP E-PRESCRIBBING</strong>
</table>


<table border="0" style="width:100%">


<?php
    $res=mysqli_query ($con," select * from trResepHeader a left join mspoli b on a.reshUnitPengguna=b.mspolId left join msdokter c on a.reshDokterId=c.dokId where a.reshNoTrans='$no' ")or die ("gagal melakukan query1");  
	while($row=mysqli_fetch_array($res)){
		$notrans=$row['reshNoTrans'];
		$nama=$row['reshNamaPasien'];
		//$resep=$row['reshNoResep'];
		$umur=$row['reshUmur'];
		$alamat=$row['reshAlamat'];
		$bayar=$row['reshSisBayar'];
		$tgl=date('d-m-Y',strtotime($row['reshTanggal']));
		$norm=$row['reshNoRm'];
		$poli=$row['mspolNama'];
		$dokter=$row['dokNama'];
		$txt="
			<table width='100%' cellpadding='3' cellspacing='0' border='0'>
				<tr>
					<td style='width:7%'><span class='style1'>No RM</span>
						<td style='width:1%'><span class='style1'>:</span></td>
						<td style='text-align: left' width='7%'><span class='style1'>$norm</span></td>
					</td>
					<td style='width:1%'><span class='style1'>Tanggal</span>
						<td style='width:1%'><span class='style1'>:</span></td>
						<td style='text-align: left' width='7%'><span class='style1'>$tgl</span></td>
					</td>
				</tr>
				<tr>
					<td ><span class='style1'>Nama</span>
						<td ><span class='style1'>:</span></td>
						<td style='text-align: left'><span class='style1'>$nama</span></td>
					</td>
					<td ><span class='style1'>Dokter</span>
						<td ><span class='style1'>:</span></td>
						<td style='text-align: left'><span class='style1'>$dokter</span></td>
					</td>
				</tr>
				<tr>
					<td ><span class='style1'>Umur</span>
						<td ><span class='style1'>:</span></td>
						<td style='text-align: left'><span class='style1'>$umur tahun</span></td>
					</td>
					<td ><span class='style1'></span>
						<td ><span class='style1'></span></td>
						<td style='text-align: left'><span class='style1'></span></td>
					</td>
				</tr>
				<tr>
					<td ><span class='style1'>Alamat</span>
						<td '><span class='style1'>:</span></td>
						<td style='text-align: left'><span class='style1'>$alamat</span></td>
					</td>
					<td ><span class='style1'></span>
						<td ><span class='style1'></span></td>
						<td style='text-align: left' width='9%'><span class='style1'></span></td>
					</td>
				</tr>
			</table>	
		";	

		echo $txt;
		
	}	
?>
</table>
<br>

	<table width="100%" cellpadding="5" cellspacing="0" border="1">
	<tr>
		<td width="10" align="center" class="style1 style4">No</td>
		<td align="center" class="style1 style4">Nama Barang</td>
		
		
		<td align="center" class="style1 style4">Qty</td>
		<td align="center" class="style1 style4">Dosis</td>
	</tr>
	<?php

    $res=mysqli_query ($con," select * from trResepDetail a left join msbarang b on a.resdObatId=b.barangKode left join trResepHeader c on a.resdNoResep=c.reshNoResep where c.reshNoTrans='$no' order by resdRacikan")or die ("gagal melakukan query2");  
    $i=1;
    $jracik1=0;
	$jracik2=0;
	$jracik3=0;
	$jracik4=0;
	$gracik=0;
    $tracik='';
    $totalobat=0;
	while($row=mysqli_fetch_array($res)){
		$nama=$row['resdObatNama'];
		$dosis=$row['resdDosis'];
		$sat=$row['barangJenis'];
		$harga=number_format(($row['resdHarga']))."<br>";
		$qty=$row['resdVolume'];
		$total=number_format(($row['resdJumlah']))."<br>";
		$totalobat=$totalobat+$qty;

		$racikan=trim($row['resdRacikan']);
		if($racikan=='RC1'){
			$jracik1 = count( $racikan!='RC1');
		}
		if($racikan=='RC2'){
			$jracik2 = count( $racikan!='RC2');
		}
		if($racikan=='RC3'){
			$jracik3 = count( $racikan!='RC3');
		}
		if($racikan=='RC4'){
			$jracik4 = count( $racikan!='RC4');
		}
		if($tracik==$racikan){
			$gracik ++;
		}	
		
		if($dosis==1){
            $result='1x Sehari 1';
        }elseif($dosis==2){
            $result='2x Sehari 1';
        }elseif($dosis==3){
            $result='3x Sehari 1';            
        }elseif($dosis==4){
            $result='4x Sehari 1';            
        }elseif($dosis==5){
            $result='1x Sehari 2';            
        }elseif($dosis==6){
            $result='2x Sehari 2';            
        }elseif($dosis==7){
            $result='3x Sehari 2';            
        }elseif($dosis==8){
            $result='4x Sehari 2';            
        }elseif($dosis==9){
            $result='2x Sehari 2/3 sendok takar';            
        }elseif($dosis==10){
            $result='2x Sehari 1/2 sendok takar';            
        }elseif($dosis==11){
            $result='2x Sehari oleskan';            
        }elseif($dosis==12){
            $result='2x Sehari 1 sendok takar';            
        }elseif($dosis==13){
            $result='2x Sehari 1/4 sendok takar';            
        }elseif($dosis==14){
            $result='3x Sehari 1 sendok takar';            
        }elseif($dosis==15){
            $result='4x Sehari 1 ml';            
        }elseif($dosis==16){
            $result='2x Sehari 3/4 sendok takar';            
        }elseif($dosis==17){
            $result='3x Sehari 1,5 ml sendok takar';            
        }elseif($dosis==18){
            $result='1x Sehari 0,3 ml';            
        }elseif($dosis==19){
            $result='0,5 cm';            
        }elseif($dosis==20){
            $result='10-10-6';            
        }elseif($dosis==21){
            $result='0-0-10';            
        }elseif($dosis==22){
            $result='1x Sehari 4';            
        }elseif($dosis==23){
            $result='3x Sehari 2 sendok takar';            
        }elseif($dosis==24){
            $result='3x Sehari oleskan';            
        }elseif($dosis==25){
            $result='2x Sehari 2/3 sendok takar';            
        }elseif($dosis==26){
            $result='3x Sehari 2/3 sendok takar';            
        }elseif($dosis==27){
            $result='3x Sehari 1/3 sendok takar';            
        }elseif($dosis==28){
            $result='1x Sehari 1 masukan dubur';            
        }elseif($dosis==29){
            $result='1x Sehari 2 masukan dubur';            
        }elseif($dosis==30){
            $result='2x Sehari 1 masukan dubur';            
        }elseif($dosis==31){
            $result='1x Sehari 1 sendok takar';            
        }elseif($dosis==32){
            $result='2x Sehari 1/2 tablet';            
        }elseif($dosis==33){
            $result='3x Sehari 1/2 tablet';            
        }elseif($dosis==34){
            $result='4x Sehari 1 sendok takar';            
        }elseif($dosis==35){
            $result='3x Sehari 1/2 sendok takar';            
        }else{
            $result='';                        
        }
		
		
		
		$txt="
			<tr>
				<td style='text-align: left' class='style2 style5'><span class='style1'>$i</span></td>
				<td style='text-align: left' class='style2 style5'><span class='style1'>$nama</span></td>
				<td style='text-align: left' class='style2 style5'><span class='style1'>".number_format($qty,2)."</span></td>
				<td style='text-align: center' class='style2 style5'><span class='style1'>$result</span></td>
			</tr>			
		";	

		echo $txt;
		$i++;
	}	
?>
<?php
  /*  $res=mysqli_query ($con," select * from trreshHeader where reshNoTrans='$no' ")or die ("gagal melakukan query");  
	while($row=mysqli_fetch_array($res)){
		$totalobat=number_format(($row['reshTotalHarga']))."<br>";
		
		if(substr($bayar,0,4)=='BPJS'){
			$akhir=number_format(($row['reshTotalHarga'])+($gracik*300)+(($jracik1+$jracik2+$jracik3+$jracik4)*500))."<br>";
			$biaya=number_format(($gracik*300)+(($jracik1+$jracik2+$jracik3+$jracik4)*500));
		}else{
			$akhir=number_format(($row['reshTotalHarga']))."<br>";
			$biaya=0;
		}
		
		}*/
		

		$txt="
			<tr>
	  			<td colspan='2' class='style3'><div align='center'><span class='style1'>Total Obat</span></div></td>
				<td colspan='2' align='left' class='style3'><span class='style1'>".number_format($totalobat,2)."</span></td>
			</tr>
		";	

		echo $txt;
		$i++;
		
?>
	
</table>

<br>
	<table width="100%" cellpadding="5" cellspacing="0">
	<tr>
		<td width="30%" align="center"><span class="style1"></span></td>
		<td width="40%" align="center"><span class="style1"><b>DIISI OLEH FARMASI</b></td>
		<td width="30%" align="center"><span class="style1"></span></td>
	</tr>
	<tr>
		<td width="30%" align="left"><span class="style1"><b>1. TELAAH RESEP</b></span></td>
		<td width="40%" align="center"><span class="style1"></span></td>
		<td width="30%" align="left"><span class="style1"><b>2. KOREKSI AKHIR</b></span></td>
	</tr>
	<tr>
		
		<td align="left" class="style1">
			
				<table width="100%" cellpadding="5" cellspacing="0">
					<tr>
					<td width="70%" class="style1 style4">Materi</td>
					<td  width="10%"  class="style1 style4">Ya</td>
					<td  width="10%" class="style1 style4">Tidak</td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>

					<tr>
					<td width="70%" class="style1 style4">Kejelasan Tulisan</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Benar Pasien</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Benar Nama Obat</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Dosis Frekuensi Rute</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Kontra Indikasi</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Duplikasi</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>				
				</table>
			
		</td>

		<td align="left" class="style1" >
			<table width="100%" cellpadding="5" cellspacing="0">
					<tr>
					<td width="70%" class="style1 style4">Materi</td>
					<td  width="10%"  class="style1 style4">Ya</td>
					<td  width="10%" class="style1 style4">Tidak</td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>

					<tr>
					<td width="70%" class="style1 style4">Riwayat Alergi</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Interaksi Obat</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">BB/TB/Umur</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Polifarmasi > 7 obat</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Antibiotika  2 obat</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td colspan='3' width="70%" class="style1 style4" cellpadding="50">Petugas</td>
					
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>				
				</table>
			
		</td>

		<td align="left" class="style1">
			
				<table width="100%" cellpadding="5" cellspacing="0">
				<tr>
					<td width="70%" class="style1 style4">Materi</td>
					<td  width="10%"  class="style1 style4">Ya</td>
					<td  width="10%" class="style1 style4">Tidak</td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Benar Pasien</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Benar Obat</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Benar Dosis</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Benar Cara Pemberian</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>


					<tr>
					<td width="70%" class="style1 style4">Benar Waktu Pemberian</td>
					<td  width="10%"  class="style1 style4"></td>
					<td  width="10%" class="style1 style4"></td>
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>

					<tr>
					<td colspan='3' width="70%" class="style1 style4" cellpadding="50">Petugas</td>
					
					<td  width="10%" class="style1 ">&nbsp;&nbsp;</td>
					</tr>			

				</table>
			
		</td>

		
	</tr>

	<tr><td  width="5%" class="style1 ">&nbsp;</td></tr>

	<tr>
	
			<td colspan="2" align="left" class="style1">
			<table width="100%" cellpadding="5" cellspacing="0">
				<tr>
						<td  class="style1 style4">Terima</td>
						<td   class="style1 style4">Entri</td>
						<td  class="style1 style4">Ambil</td>
						<td  class="style1 style4">E-Tiket</td>
						<td  class="style1 style4">Penyerahan</td>
						<td  class="style1 ">&nbsp;&nbsp;</td>

						
				</tr>

				<tr>
						<td  class="style1 style4"></td>
						<td    class="style1 style4"></td>
						<td  class="style1 style4"></td>
						<td  class="style1 style4"></td>
						<td   class="style1 style4"></td>
						<td  width="5%" class="style1 ">&nbsp;&nbsp;</td>
				</tr>
				</table>
			</td>

		


			<td align="left" class="style1">
				<table width="90%" cellpadding="5" cellspacing="0">
				<tr rowspan="2" class="style1 style4">
						<td  class="style1 style4">Identitas Penerima</td>
											
				</tr>

				</table>
			</td>
		
	</tr>
<?php
    $res=mysqli_query ($con," select * from trResepHeader a left join mspoli b on a.reshUnitPengguna=b.mspolId where a.reshNoTrans='$no' ")or die ("gagal melakukan query3");  
	while($row=mysqli_fetch_array($res)){
	$nama=$row['mspolNama'];
	$txt="
		<tr>
			<td align='center'><u><span class='style1'>$nama</span><u></td>
			<td align='center'><span class='style1'>&nbsp;</span></td>
			<td align='center'><u><span class='style1'>(................)</span></u><br /></td>
		</tr>
	";
	//	echo $txt;
		
	}	
?>
	</table>
	</td>
	
</tr>	
<p>&nbsp;</p>
<br style="clear:both;">                 