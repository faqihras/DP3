<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "blud";
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
 //------------------------------------------------------------------------ A ---------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,5) IN ('11102','11103','11104','11202')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,5) IN ('11102','11103','11104','11202')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$a=$debet-$kredit;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('211','212','214','215','216')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('211','212','214','215','216')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$aa=$kredit-$debet;
 if ($aa==0)
 { $aaa=0; }
 else
 { $aaa=($a/$aa)*100; }


 //--------------------------------------------------------------------------------- B ------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('111','112','113','114','116','117')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('111','112','113','114','116','117')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet1 FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('115')");   while($data = mysql_fetch_array($sql)) $debet1=$data['debet1'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit1 FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('115')"); while($data = mysql_fetch_array($sql)) $kredit1=$data['kredit1'];
$deb=$debet-$debet1;
$kre=$kredit-$kredit1;

$b=$deb-$kre;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('211','212','214','215','216')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('211','212','214','215','216')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$bb=$kredit-$debet;
 if ($bb==0)
 { $bbb=0; }
 else
 { $bbb=($b/$bb)*100; }

 //---------------------------------------------------------------------- C -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,7) IN ('1130414')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,7) IN ('1130414')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$c=($debet-$kredit)*360;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,7) IN ('8142001')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,7) IN ('8142001')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$cc=$kredit-$debet;
 if ($cc==0)
 { $ccc=0; }
 else
 { $ccc=($c/$cc)*100; }



 //---------------------------------------------------------------------- D -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$d=$kredit-$debet;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('13')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,2) IN ('13')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$dd=$debet-$kredit;
 if ($dd==0)
 { $ddd=0; }
 else
 { $ddd=($d/$dd)*100; }



 //---------------------------------------------------------------------- G -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('117')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('117')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$g=$debet-$kredit;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$gg=$kredit-$debet;
 if ($gg==0)
 { $ggg=0; }
 else
 { $ggg=($g/$gg)*100; }


 //---------------------------------------------------------------------- H -----------------------------------------------------------------------------

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$h=$kredit-$debet;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('91')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,2) IN ('91')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$hh=$debet-$kredit;
 if ($hh==0)
 { $hhh=0; }
 else
 { $hhh=($h/$hh)*100; }



 //---------------------------------------------------------------------- I -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,7) IN ('9120344')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,7) IN ('9120344')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$i=$debet-$kredit;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$ii=$kredit-$debet;
 if ($ii==0)
 { $iii=0; }
 else
 { $iii=($i/$ii)*100; }



 //---------------------------------------------------------------------- J -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('13')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,2) IN ('13')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$j=$debet-$kredit;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$jj=$kredit-$debet;
 if ($jj==0)
 { $jjj=0; }
 else
 { $jjj=($j/$jj)*100; }



 //---------------------------------------------------------------------- K failed -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('13')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,2) IN ('13')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$k=$debet-$kredit;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$kk=$kredit-$debet;
 if ($kk==0)
 { $kkk=0; }
 else
 { $kkk=($k/$kk)*100; }



 //---------------------------------------------------------------------- L -----------------------------------------------------------------------------

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$l=$kredit-$debet;

$sql = mysql_query("SELECT SUM(mapNilaiAng) apbd FROM mappreal a LEFT JOIN angkegiatan b ON a.mappKegKd=b.angkgKegKd");   while($data = mysql_fetch_array($sql)) $apbd=$data['apbd'];
//$sql = mysql_query("SELECT SUM(mapNilaiAng) AS APBD FROM mappreal a LEFT JOIN angkegiatan b ON a.mappKegKd=b.angkgKegKd"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$ll=$apbd;
 if ($ll==0)
 { $lll=0; }
 else
 { $lll=($l/$ll)*100; }



 //---------------------------------------------------------------------- M -----------------------------------------------------------------------------

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('814')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,3) IN ('814')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$m=$kredit-$debet;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('51') OR LEFT (klrRekDebet,3) IN ('521','522')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('51') OR LEFT (klrRekDebet,3) IN ('521','522')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$mm=$debet-$kredit;
 if ($mm==0)
 { $mmm=0; }
 else
 { $mmm=($m/$mm)*100; }




 //---------------------------------------------------------------------- N1 -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('51') OR LEFT (klrRekDebet,3) IN ('521','522')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekDebet,2) IN ('51') OR LEFT (klrRekDebet,3) IN ('521','522')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$n1=$debet-$kredit;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,5) IN ('52151','52250','52350')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,5) IN ('52151','52250','52350')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$nn1=$kredit-$debet;
 if ($nn1==0)
 { $nnn1=0; }
 else
 { $nnn1=($n1/$nn1)*100; }




 //---------------------------------------------------------------------- N2 -----------------------------------------------------------------------------
$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('523')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekDebet,3) IN ('523')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$n2=$debet-$kredit;

$sql = mysql_query("SELECT SUM(klrNilaiDebet) debet FROM tukdju WHERE LEFT (klrRekDebet,5) IN ('52151','52250','52350')");   while($data = mysql_fetch_array($sql)) $debet=$data['debet'];
$sql = mysql_query("SELECT SUM(klrNilaiKredit) kredit FROM tukdju WHERE LEFT (klrRekKredit,5) IN ('52151','52250','52350')"); while($data = mysql_fetch_array($sql)) $kredit=$data['kredit'];
$nn2=$kredit-$debet;
 if ($nn2==0)
 { $nnn2=0; }
 else
 { $nnn2=($n2/$nn2)*100; }


?> 
<!DOCTYPE html>
<html>
<head>
	<title>Cara Membuat Tabel Dengan HTML 5 dan CSS 3</title>
	<meta name="description" content="Panduan membuat tabel dengan HTML 5 dan CSS 3. Dilengkapi dengan kode HTML dan CSS yang diap digunakan">
	<link rel="shortcut icon" href="img/favicon.png">
	<style type="text/css">
		/* SITE */
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		.main-wrapper a {
			text-decoration: none;
			color: #3586b7;
			background-color:#FFFFFF;
		}
		.main-wrapper a.text-link:hover {
			border-bottom: 1px dashed #CCCCCC;
		}
		.tutorial-link-wrapper {
			text-align: center;
		}
		header {
			padding: 10px 30px 7px 30px;
			border-bottom: 2px solid #636b71;
			background: #343d44;
		}
		footer {   
			background: #343d44;
			padding: 10px 0 7px 30px;
			color: #b9bfc3;
			font-size: 13px;
		}
		footer a {
			color: #b9bfc3;
			text-decoration: none;
			margin-left: 10px;
		}
		.link-header {
			margin-top: 10px;
		}
		.link-header a {
			font-size: 15px;
			color: #b9bfc3;
			text-decoration: none;
			margin: 0;
		}
		.link-header a.home:hover {
			color: #b9bfc3;
		}
		.main-wrapper {
			padding: 25px 0;
		}
		.link-header {
			float: right;
		}
		.clearfix {
			clear: both;
		}
		@media screen and (max-width: 450px) {
			header,
			footer {
				text-align: center;
			}
			.link-header {
				float: none;
				margin: 0;
			}
		}
		
		/* TABLE */
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		.table-wrapper {
			overflow: auto;
		}
		.main-wrapper {
			padding: 20px;
		}
		.main-wrapper a:hover {
			border-bottom: 1px dashed #CCCCCC;
		}
		
		/* Table */
		.demo-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.demo-table th, 
		.demo-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.demo-table caption {
			margin: 7px;
		}

		/* Table Header */
		.demo-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.demo-table tbody td {
			color: #353535;
		}
		.demo-table tbody td:first-child,
		.demo-table tbody td:nth-child(4),
		.demo-table tbody td:last-child {
			text-align: right;
		}

		.demo-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.demo-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.demo-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.demo-table tfoot th:first-child {
			text-align: left;
		}
		.demo-table tbody td:empty
		{
			background-color: #ffcccc;
		}
		
		/* Table 2 */
		.demo-table2 {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 536px;
		}

		.demo-table2 th, 
		.demo-table2 td {
			padding: 7px 17px;
		}
		.demo-table2 caption {
			margin: 7px;
		}

		.demo-table2 thead th:last-child,
		.demo-table2 tfoot th:last-child,
		.demo-table2 tbody td:last-child {
			border: 0;
		}

		/* Table Header */
		.demo-table2 thead th {
			border-right: 1px solid #c7ecc7;
			text-transform: uppercase;
		}

		/* Table Body */
		.demo-table2 tbody td {
			color: #353535;
			border-right: 1px solid #c7ecc7;
		}
		.demo-table2 tbody tr:nth-child(odd) td {
			background-color: #f4fff7;
		}
		.demo-table2 tbody tr:nth-child(even) td {
			background-color: #dbffe5;
		}
		.demo-table2 tbody td:nth-child(4),
		.demo-table2 tbody td:first-child,
		.demo-table2 tbody td:last-child {
			text-align: right;
		}
		.demo-table2 tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.demo-table2 tfoot th {
			border-right: 1px solid #c7ecc7;
			text-align: right;
		}
	</style>
</head>
<body data-gr-c-s-loaded="true"> 
<div class="main-wrapper"> 
	<table width="865" height="123" border="1">
      <tr bgcolor="#FFFFFF">
        <td>
		
	<h1>PERHITUNGAN KINERJA PADA SATUAN KERJA BLU PADA RSUD BENDAN KOTA PEKALONGAN</h1>
	<br />
	<div class="table-wrapper">
	<table width="624" border="0" align="center" class="demo-table">
  <tr>
    <td><div align="center"><strong>NO</strong></div></td>
    <td><div align="center"><strong>INDIKATOR</strong></div>      <div align="center"></div></td>
    <td><div align="center"><strong>PROSENTASE</strong></div></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>1.</td>
    <td>Rasio Kas (Cash Ratio)</td> 
    <td><?php {echo number_format($aaa,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>2.</td>
    <td>Rasio Lancar (Current Ratio)</td> 
    <td><?php {echo number_format($bbb,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>3.</td>
    <td>Periode Penagihan Piutang (Collection Period)</td> 
    <td><?php {echo number_format($ccc,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>4.</td>
    <td>Perputaran Aset Tetap (Fixed Asset Turnover)</td> 
    <td><?php {echo number_format($ddd,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>5.</td>
    <td>Imbalan atas Aset Tetap (Return on fixed asset)</td> 
    <td><?php {echo'panding';} ?></td>
  </tr>
  <tr>
    <td>6.</td>
    <td>Imbalan Ekuitas (Return on Equity)</td> 
    <td><?php {echo'panding';} ?></td>
  </tr>
  <tr>
    <td>7.</td>
    <td>Perputaran persediaan (Inventory Turnover)</td> 
    <td><?php {echo number_format($ggg,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>8.</td>
    <td>Rasio Pendapatan PNBP terhadap Biaya Operasional</td> 
    <td><?php {echo number_format($hhh,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>9.</td>
    <td>Rasio Subsidi Biaya Pasien</td> 
    <td><?php {echo number_format($iii,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>10.</td>
    <td>Rasio Produktivitas aset</td> 
    <td><?php {echo number_format($jjj,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>11.</td>
    <td>Rasio Produktifitas SDM</td> 
    <td><?php {echo'panding';} ?></td>
  </tr>
  <tr>
    <td>12.</td>
    <td>Rasio kemandirian Keu  BLU</td> 
    <td><?php {echo number_format($lll,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td>13.</td>
    <td>Rasio Indeks Kemampuan Rutin</td> 
    <td><?php {echo number_format($mmm,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr>
    <td rowspan="2">14.</td>
    <td rowspan="2">Rasio Keserasian </td> 
    <td><?php {echo number_format($nnn1,2,',','.'); echo' %';} ?></td>
  </tr>
  <tr> 
    <td><?php {echo number_format($nnn2,2,',','.'); echo' %';} ?></td>
  </tr>
</table>
		</td>
      </tr>
    </table>
</div>
</div>
</body>
</html>