<head>	
<link href="bootstrap/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<style type="text/css">	
td {
	font-size: small;
	padding-top: 1px;
	padding-right: 2px;
	padding-bottom: 1px;
	padding-left: 2px;
}	
</style>
</head>
<?php

	//include('koneksi.php');
$ip_server='localhost';
$user_server='root';
$pass_server="rsud2018";
//$db_server='jslogistik';
//$pass_server="Rsudwb2015";
$db_server='medical';

$con = mysql_connect($ip_server,$user_server,$pass_server,$db_server) or trigger_error(mysql_error(),E_USER_ERROR);
$db = mysql_select_db("medical");

?>

	<div  class="col-md-2" id="btload" style="margin:5px">
        <button type="button" class="btn btn-primary" onClick="tableToExcel('tabelData', 'laporan', 'INFORMASI KAMAR.xls')"><i aria-hidden="true" style="font-size:14px"> EXPORT KE EXCEL</i></button>
	</div>	

<div class="row">
	<div  class="col-md-2" id="btload" style="margin:5px">
       
	</div>		        
  <div class="col-md-8" style="text-align:center">
<label>
		<span aria-hidden="true" style="font-size:14px;text-align:center"> INFORMASI KAMAR </span><br>
    </label>
  </div>
</div>

<table width="50%" class="table-responsive" border="1" id="tabelData" name="tabelData" align="center">
	<tr>
	  <td width="8%" style="text-align: center">Gol ID Kamar </td>
	  <td width="17%" style="text-align: center">Gol Kamar </td>
		<td width="19%" style="text-align: center">Kelas Kamar</td>
		<td width="18%" style="text-align: center">Jumlah Bed </td>
		<td width="10%" style="text-align: center">Terisi</td>
		<td width="17%" style="text-align: center">Kosong</td>
	</tr>
		<?php

    $i=1;


// 	$query=mysql_query(" SELECT golIdKamar, golKamar, kelasKamar, jml_bed, terisi, kosong
// FROM medical.vkondisi");

	$query=mysql_query("SELECT * FROM vlaporan");



	if($query === FALSE) { 
    die(mysql_error()); 
	}

	while($d=mysql_fetch_array($query)){
	
			$golIdKamar=$d['golIdKamar'];
			$golKamar=$d['golKamar'];
			$kelasKamar=$d['kelasKamar'];
			$jml_bed=$d['jml_bed'];
			$terisi=$d['terisi'];
			$kosong=$d['kosong'];
 
			$txt="
				<tr>
					<td style='text-align: center' class='style2 style5'><span class='style1'>$golIdKamar</span></td>
					<td style='text-align: left' class='style2 style5'><span class='style1'>$golKamar</span></td>
					<td style='text-align: left' class='style2 style5'><span class='style1'>$kelasKamar</span></td>
					<td style='text-align: center' class='style2 style5'><span class='style1'>$jml_bed</span></td>
					<td style='text-align: center' class='style2 style5'><span class='style1'>$terisi</span></td>
					<td style='text-align: center' class='style2 style5'><span class='style1'>$kosong</span></td>
				</tr>			
			";	

			echo $txt;

			$i++;
		}	


?>
</table>
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


