<?php
	include('conn.php');
	// $no=$_GET['unit'];
	$data = json_decode($_GET['data']);

	$tgawal = $data->tgawal;
	$tgahir = $data->tgahir;
?><head>
	
<link href="bootstrap/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<style type="text/css">	
td {
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left:0px;
}	
.header {font-size: 11px; font-family: "Times New Roman", Times, serif; }
.style1 {font-size: 11px; font-family: "Times New Roman", Times, serif; }
.style2 {border: thin solid #A9A9A9; border-bottom:0px;}
.style3 {border: thin solid #A9A9A9; border-bottom:0px;border-bottom:0px;}
.style3 {border: thin solid #000000; border-bottom:0px;border-bottom:0px;}
.style4 {border: thin solid #000000;}
.style4 {border: thin solid #000000;}
}
.style5 {border-bottom: thin solid #000000;}
.exp {font-size: 10px; font-family: "Times New Roman", Times, serif;}
</style>
</head>

<!-- <div class="row">
	<div  class="col-md-2" id="btload" style="margin:5px">
        <button type="button" class="btn btn-primary" onclick="tableToExcel('tabelData', 'Laporan', 'Rekap Kunjungan Pasien Rajal <?php //echo date("d/m/Y", strtotime($tgawal)) . ' &nbspsampai&nbsp ' . date("d/m/Y", strtotime($tgahir)); ?> Harian.xls')"><i aria-hidden="true" style="font-size:14px">EXPORT KE EXCEL</i></button>
	</div>		        
</div> -->
<body>
	<br>
	<table style="width:80%" align="center">
	<tr>
		<td align="right">
			<img src="images/logorsu.png" alt="logo" width="90" height="90">
		</td>
		<td align="center">
			<h2 style="margin-bottom: -15px;"><strong>RSUD KRT. SETJONEGORO</strong></h2><br>
			<h4 style="margin-top: 0px;">Jl. Setjonegoro No. 1 Wonosobo Jawa Tengah 56311 Telp. (0286) 32109</h4>
			<hr width="75%" style="border: 1px solid black; margin-bottom: 40px">
		</td>
		<td align="left">
			<img src="images/logowsb.png" alt="logo kabupaten" width="90" height="90">
		</td>
	</tr>
</table>

<br>

<table style="width:100%" align="center">
	<tr>
		<td align="center">
			<strong>LAPORAN REKAP KUNJUNGAN PASIEN</strong>
		</td>
	</tr>
	<tr>
		<td align="center">
			<strong>KUNJUNGAN REKAP MEDIS</strong>
		</td>
	</tr>
	<tr>
		<td align="center">
			<strong><?php echo date("d/m/Y", strtotime($tgawal)) . " sampai " . date("d/m/Y", strtotime($tgahir)); ?></strong>
		</td>
	</tr>
	<tr>
		<td align="center"><br></td>
	</tr>
</table>

<br>

	<table width="97%" cellpadding="1" cellspacing="0" border="2" align="center">
	<tr>  
		<td width="10" align="center" class="style1 style4" ><strong>NO</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>TANGGAL</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>NO RM</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>NAMA PASIEN</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>TANGGAL LAHIR</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>UMUR</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>L/P</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>ASURANSI</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>JENIS PASIEN</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>ALAMAT</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>KELURAHAN</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>KECAMATAN</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>POLI</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>ICD 10</strong></td>
		<td width="10" align="center" class="style1 style4" ><strong>ICD 9</strong></td>
	</tr>

	<?php
		//$periode=$ctahun;

		function toNumber($nilai)
		{
			$a = explode(".", $nilai);
			if (empty($a[0])) {
				$a[0] = $nilai;
			}
			$res1 = str_replace(",", "", $a[0]);
			return $res1;
		}

		$tgl1 = date("Y-m-d", strtotime($tgawal));
		$tgl2 = date("Y-m-d", strtotime($tgahir));

		$res2 = mysqli_query($con, "SELECT a.rawatTglDaftar,a.rawatRm,a.rawatNama,g.msjHeadNama,f.dokNama,a.rawatLahir, TIMESTAMPDIFF(YEAR,a.rawatLahir,CURRENT_DATE()) AS rawatUmur,j.kecNama,k.kelNama,a.rawatAlamat,l.ruangNama,
			CASE WHEN a.rawatGender=1 THEN 'L' WHEN a.rawatGender=2 THEN 'P' END AS jk,
			CASE WHEN a.rawatBaru=1 THEN 'PASIEN BARU' WHEN a.rawatBaru=0 THEN 'PASIEN LAMA' END AS pbaru,
			GROUP_CONCAT( DISTINCT CASE WHEN c.tindakTarif=0 THEN  e.mstindKode ELSE NULL END ORDER BY a.rawatTglDaftar ASC, a.rawatId ASC SEPARATOR ' ; ') AS kodetindakan,
			GROUP_CONCAT( DISTINCT d.msdiagKode ORDER BY a.rawatTglDaftar ASC, a.rawatId ASC SEPARATOR ' ; ') AS kodediagnosa
			FROM trRawat a
			LEFT JOIN trRawatDiagnosa b ON b.diagRawatId=a.rawatId 
			LEFT JOIN trRawatTindakan c ON c.tindakRawatId=a.rawatId 
			LEFT JOIN msdiagnosa d ON d.msdiagId=b.diagMsId
			LEFT JOIN mstindakan e ON e.mstindId=c.tindakMsId
			LEFT JOIN msdokter f ON f.dokId=a.rawatDokterId
			LEFT JOIN msJaminanHeader g ON g.msjHeadId=a.rawatJaminanId
			LEFT JOIN msKec j ON a.rawatKec=j.kecKode
			LEFT JOIN msKel k ON a.rawatKel=k.kelKode
			LEFT JOIN msruangan l ON a.rawatPoli=l.ruangId
			WHERE  a.rawatTglDaftar BETWEEN '".$tgl1."' AND '".$tgl2."'
			GROUP BY a.rawatId
			ORDER BY a.rawatTglDaftar ASC, a.rawatId ASC") or die("PARAMETER SALAH");

		$i = 1;
		$tmp = '';
		while ($row = mysqli_fetch_array($res2)) {
			$tgl = $row['rawatTglDaftar'];
			$rm = $row['rawatRm'];
			$nama = $row['rawatNama'];
			$lp = $row['jk'];	
			$sisbayar = $row['msjHeadNama'];
			$baru = $row['pbaru'];
			$poli = $row['ruangNama'];
			$dpjp = $row['dokNama'];
			$Ct = $row['kodediagnosa'];
			$Cs = $row['kodetindakan'];
			$lahir = $row['rawatLahir'];
			$lahirubah = date("d-m-Y", strtotime($lahir));
			$umur = $row['rawatUmur'];
			$kecamatan = $row['kecNama'];
			$kelurahan = $row['kelNama'];
			$alamat = $row['rawatAlamat'];

			$txt = '
						<tr>
							<td style="text-align: center" class="style2"><span class="style1">' . $i . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $tgl . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $rm . '</span></td>
							<td style="text-align: left" class="style2"><span class="style1">' . $nama . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $lahirubah . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $umur . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $lp . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $sisbayar . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $baru . '</span></td>
							<td style="text-align: left" class="style2"><span class="style1">' . $alamat . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $kelurahan . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $kecamatan . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $poli . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $Ct . '</span></td>
							<td style="text-align: center" class="style2"><span class="style1">' . $Cs . '</span></td>
						</tr>	
					';
			echo $txt;
			$i++;
		}

		?>
</table>
<p>&nbsp;</p>
<br style="clear:both;">
</body>
<a id="dlink" style="display:none;"></a>
<script type="text/javascript">

var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();

        }
    })();    

</script>
</html>