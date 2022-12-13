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
	padding:10px 7px;
}
table{
	width: 96%;
	margin: 0px auto;

}	
.header {font-size: 12px; font-family: "Times New Roman", Times, serif; }
.style1 {font-size: 12px; font-family: "Times New Roman", Times, serif; }
.style2 {border: thin solid #000000; border-top:0px; border-bottom:0px;}
.style3 {border: thin solid #000000; border-bottom:0px;}
.style4 {border: thin solid #000000;
}
.style5 {border-bottom: thin solid #000000; border-top:0px;}

body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Times New Roman";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 215mm;
        min-height: 330mm;
        margin: 0px auto;
        margin-top: 5mm;

    }

    td.min-size{
    	min-height: 200px;
    	background-color: #FAFAFA;
    }
    
    
    @page {
        size: F4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 215mm;
            height: 330mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
            margin-top: 5mm;
        }
    }
</style>
</head>
 <div class="page">
<?php
//echo "$no";
 $resQX=mysqli_query ($con,"select * from trRawat where rawatId='$no'")or die ("gagal melakukan query1");  
	while($rowQX=mysqli_fetch_array($resQX)){
		$nama=$rowQX['rawatNama'];
		$lahir=$rowQX['rawatLahir'];
		$norm=$rowQX['rawatRm'];
		$tglM=$rowQX['rawatTglDaftar'];
		$tglK=$rowQX['rawatTglPindah'];
		$jenisR=$rowQX['rawatJenis'];
		$idA=$rowQX['rawatId'];
		//echo "$nama";
	}
?>  
<table table width="100%" cellpadding="5" cellspacing="0" border="1">
		<tr>
			<td colspan="2" rowspan="3" class="text-center" width="60%">RINGKASAN KELUAR</td>
			<td width="30%">Nama &nbsp; &nbsp; :<?php echo $nama; ?></td>
			
		</tr>
		<tr >
			
			<td width="30%">Tgl.Lahir :<?php echo $lahir; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <s>L</s> / P</td>		
		</tr>
		<tr>
			
			<td width="30%">No Rm &nbsp; &nbsp;:<?php echo $norm; ?></td>
		</tr>
		<tr>
			<td colspan="3">Tanggal MRS&nbsp;: <?php echo $tglM; ?>&nbsp; &nbsp; Tanggal Keluar&nbsp;:<?php echo $tglK; ?> &nbsp; &nbsp;
			<?php
			//////////////////////////////////////pilih jenis runagan / poli///////////////////////////////////////
			if ($jenisR==1) {
				$resQ=mysqli_query ($con," select * from trRawat a left join msruangan b on b.ruangId=a.rawatPoli where a.rawatId='$no' ")or die ("gagal melakukan query1");  
				while($rowQ=mysqli_fetch_array($resQ)){
					echo "Ruangan&nbsp;: Poli ".$rowQ['ruangNama'];
				}
				
			} else if ($jenisR==2) {
				$resK=mysqli_query ($con," select * from trRawat a left join msruangan b on b.ruangId=a.rawatRuangan where a.rawatId='$no' ")or die ("gagal melakukan query1");  
				while($rowK=mysqli_fetch_array($resK)){
					echo "Ruangan&nbsp;: kamar ".$rowK['ruangNama'];
				}
			}else{
				$resI=mysqli_query ($con," select * from trRawat a left join msruangan b on b.ruangId=a.rawatIgd where a.rawatId='$no' ")or die ("gagal melakukan query1");  
				while($rowI=mysqli_fetch_array($resI)){
					echo "Ruangan&nbsp;: kamar ".$rowI['ruangNama'];
			}
		}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////
			?> 
				
			</td>
			
		</tr>
				
	</table>
	<?php
		$resQ2=mysqli_query ($con," select * from trResume where resumRawatId='$no' ")or die ("gagal melakukan query2");
		
		if (count($resQ2) > 0) {
		while($rowQ2=mysqli_fetch_array($resQ2)){
		$keluhan=$rowQ2['resumKeluhan'];
		$pFisik=$rowQ2['resumPeFisik'];
		$konsul=$rowQ2['resumHasilKonsul'];
		$alasanrawat=$rowQ2['resumAlasan'];
		$alergi=$rowQ2['resumAlergi'];
		$prognosis=$rowQ2['resumPrognosis'];
		}
		 } else {
		 	$keluhan='';
			$pFisik='';
			$konsul='';
			$alasanrawat='';
			$alergi='';
			$prognosis='';
		 }
		  
	
	?>
	<table table width="100%" cellpadding="5" cellspacing="0" border="1">
		<tr>
			<td width="30%" class="text-capitalize">keluhan utama saat masuk</td>
			<td colspan="2" width="70%"><?php echo $keluhan; ?></td>
			
		</tr>
		<tr>
			<td width="30%">alasan dirawat</td>
			<td colspan="2" width="70%"><?php echo $alasanrawat; ?></td>
			
		</tr>
		<tr>
			<td width="30%">riwayat alergi</td>
			<td colspan="2" width="70%"><?php echo $alergi; ?></td>
			
		</tr>
		<tr >
			<td width="30%" class="min-size">pemeriksaan fisik</td>
			<td colspan="2" width="70%" class="min-size"><?php echo $pFisik; ?></td>
			
		</tr>
		<tr>
			<td width="30%">prosedur diagnotistic dan terapeutic</td>
			<td colspan="2" width="70%">data</td>
			
		</tr>		
		<tr>
			<td width="30%">diagnosis
				<ul style="list-style-type:none; padding: 15px;">
				  <li>PRIMER</li>
				  <li>SEKUNDER</li>				  
				</ul>
			</td>
			<td colspan="2" width="70%">
				<ul style="list-style-type:none; padding:0;">
			<?php
			$resdiag=mysqli_query ($con," select * from trRawatDiagnosa where diagRawatId='$no' ")or die ("gagal melakukan query diagnosa"); 
			$nmr=1; 
			while($rowdiag=mysqli_fetch_array($resdiag)){
				echo "<li>".$nmr.".".$rowdiag['diagDiagnosa']." &nbsp; &nbsp; &nbsp; &nbsp;["."]</li>";
				$nmr++;
				}
				
			?>
			</ul>
			</td>
			
		</tr>
		<tr>
			<td width="30%">operasi/tindakan/anesthesi</td>
			<td colspan="2" width="70%">
			<?php
				$restind=mysqli_query ($con," select * from trRawatTindakan where tindakRawatId='$no'")or die ("gagal melakukan query tindakan 1");
				$nmr=1;  
				while($rowtind=mysqli_fetch_array($restind)){
					echo $nmr.".".$rowtind['tindakTindakan']." &nbsp; &nbsp; &nbsp; &nbsp;["."]<br>";
					$nmr++;
				}
				

			?>
			</td>
			
		</tr>
		<tr>
			<td width="30%">hasil konsultasi</td>
			<td colspan="2" width="70%"><?php echo $konsul; ?></td>
			
		</tr>
	</table>              
	</div>
		<!-- ///////////////////////////////////sheet 2////////////////////////////////////////////  -->	 
<div class="page">
        <?php
        //echo "$idA";
 $resQt2=mysqli_query ($con," select * from trRawat where rawatId='$idA' ")or die ("gagal melakukan query sheet 2.1");  
	while($rowQt2=mysqli_fetch_array($resQt2)){
		$nama2=$rowQt2['rawatNama'];
		$lahir2=$rowQt2['rawatLahir'];
		$norm2=$rowQt2['rawatRm'];
		$tglM2=$rowQt2['rawatTglDaftar'];
		$tglK2=$rowQt2['rawatTglPindah'];
		$rax=$rowQt2['rawatJenis'];
		//echo "$jenisR2";
	}
?>  
<table table width="100%" cellpadding="5" cellspacing="0" border="1">
		<tr>
			<td colspan="2" rowspan="3" class="text-center" width="60%">RINGKASAN KELUAR</td>
			<td width="30%">Nama &nbsp; &nbsp; :<?php echo $nama2; ?></td>
			
		</tr>
		<tr >
			
			<td width="30%">Tgl.Lahir :<?php echo $lahir2; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; L / P</td>		
		</tr>
		<tr>
			
			<td width="30%">No Rm &nbsp; &nbsp;:<?php echo $norm2; ?></td>
		</tr>
		<tr>
			<td colspan="3">Tanggal MRS&nbsp;: <?php echo $tglM2; ?>&nbsp; &nbsp; Tanggal Keluar&nbsp;:<?php echo $tglK2; ?> &nbsp; &nbsp;
			<?php
			//////////////////////////////////////pilih jenis runagan / poli///////////////////////////////////////
			if ($rax==1) {
				$rest2=mysqli_query ($con," select * from trRawat a left join msruangan b on b.ruangId=a.rawatPoli where a.rawatId='$idA' ")or die ("gagal melakukan query1");  
				while($rowt2=mysqli_fetch_array($rest2)){
					echo "Ruangan&nbsp;: Poli ".$rowt2['ruangNama'];
				}
				
			} else {
				# code...
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////
			?> 
				
			</td>
			
		</tr>
				
	</table> 
	<table table width="100%" cellpadding="5" cellspacing="0" border="1">
		<tr>
			<td>terapi <br>ss</td>
			<td>terapi sebelum MRS <br>ss</td>
			<td>saat dirawat<br>ss</td>
		</tr>
		<tr>
			<td width="30%">perkembangan penyakit</td>
			<td colspan="2" width="70%"><input type="checkbox" value="">membaik &nbsp; &nbsp; <input type="checkbox" value="">stabil &nbsp; &nbsp;<input type="checkbox" value="">memburuk &nbsp; &nbsp; <input type="checkbox" value="">komplikasi</td>
			
		</tr>
		<tr>
			<td width="30%">kondisi saat keluar</td>
			<td colspan="2" width="70%"><input type="checkbox" value="">sembuh &nbsp; &nbsp;<input type="checkbox" value="">membaik &nbsp; &nbsp;<input type="checkbox" value="">tidak sembuh &nbsp; &nbsp;<input type="checkbox" value="">meninggal < 48 jam <br><input type="checkbox" value="">meninggal > 48 jam </td>
			
		</tr>
		<tr>
			<td width="30%">cara keluar</td>
			<td colspan="2" width="70%"><input type="checkbox" value="">diijinkan pulang&nbsp; &nbsp;<input type="checkbox" value="">pulang atas kehendak sendiri &nbsp; &nbsp;<input type="checkbox" value="">minggat<br><input type="checkbox" value="">pindah RS lain &nbsp; &nbsp;<input type="checkbox" value="">dirujuk ke</td>
			
		</tr>
		<tr>
			<td width="30%">transfusi darah</td>
			<td colspan="2" width="70%"><input type="checkbox" value="">ya &nbsp;<input type="checkbox" value="">tidak&nbsp; &nbsp; &nbsp; bila ya, reaksi transfusi&nbsp;&nbsp; &nbsp;<input type="checkbox" value="">ya &nbsp;<input type="checkbox" value="">tidak</td>
			
		</tr>
		<tr>
			<td width="30%">tranfusi albumin</td>
			<td colspan="2" width="70%"><input type="checkbox" value="">ya &nbsp; &nbsp;<input type="checkbox" value="">tidak </td>
			
		</tr>
		<tr>
			<td width="30%">infeksi nosokomial</td>
			<td colspan="2" width="70%"><input type="checkbox" value="">ya &nbsp; &nbsp;<input type="checkbox" value="">tidak &nbsp; &nbsp; penyebab infeksi</td>
			
		</tr>
		<tr>
			<td width="30%">prognosisi</td>
			<td colspan="2" width="70%"><?php echo $prognosis; ?></td>
			
		</tr>
		<tr>
			<td width="30%">penyebab dasar kematian</td>
			<td colspan="2" width="70%"></td>
			
		</tr>
		<tr>
			<td width="30%">masalah yang masih ada</td>
			<td colspan="2" width="70%"><input type="checkbox" value="">fisik&nbsp; &nbsp;<input type="checkbox" value="">mental</td>
			
		</tr>
		<tr>
			<td>intruksi<br>ss</td>
			<td>edukasi/intruksi untuk dirumah<br>ss</td>
			<td>obat saat pulang dan dirumah<br>ss</td>
		</tr>
	</table> 
	<table width="100%">
		<tr>
			<td></td>
			<td></td>
			<td>Kupang,</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>doctor</td>
		</tr>
		<tr>
			<td width="60%">RS/Hospital : RSUD SK LERIK</td>
			<td width="10%">stampel</td>
			<td>TTD</td>
		</tr>
	</table> 
    </div>