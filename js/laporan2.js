
function setTahun(){
    var res='';

    var d = new Date();
    var n = d.getFullYear();    

    res +='<select class="form-control" name="filterTahun" id="filterTahun" style="width: 200px" onchange="onTahunChange()">';

    for(i=(n+1);i>=(n-4);i--){
        res +='<option value="'+i+'"';   
            if(i==n){
                res +=' selected ';
            }
        res +='>'+i+'</option>';            
    }

    res +='</select>';

    $('#divtahun').html(res);
}

function onTahunChange(){
    var modul=document.getElementById('modul').value;
    $('#tData').dataTable().fnDestroy();
    tableMaster(modul);
}


function tableMaster(modulx){
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        success:function(data){
            
            getLangGrid(data[0].apiLangGrid,data[0].apiData,data[0].apiLangForm);
            $("#linkpdf").attr("value",data[0].apiPdf);

            // getLangForm(data[0].apiLangForm);
            
        }
    });      
}

function getLangGrid(apiLang,apiData,apiLangForm){
    $.ajax({
        type: "GET",
        url: apiLang,
        dataType:"json",
        success:function(data){
            setGrid(data.kolom,apiData,apiLangForm);
        }
    });          
}

function setGrid(kolom,apiData,apiLangForm){

    var tahun=document.getElementById('filterTahun').value;

	var table=$('#tData').DataTable({
		"sorting": [[ 0, "asc" ]],
		"dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
		"paginationType": "bootstrap",
		"paging":   true,
        // "scrollX": true,		
        "fixedHeader": true,
        "bSort" : false,
        "info"  :   true,
        "language": {
			            "lengthMenu": "",
			            "zeroRecords": "No records available",
			            "info": "Page _PAGE_ of _PAGES_",
			            "infoEmpty": "No records available",
			            "infoFiltered": "(filtered from _MAX_ total records)",
			            "search": "CARI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   ",
			            "paginate": {"next": "","previous": ""}
        },
        "processing": false,
        "serverSide": true,
        "ajax": {
        			"url" : apiData,
                    "data": ({"ctahun":tahun}),
        			"dataType" : "json",
		        },
				        
        "columns": kolom,    
	});


    $('#tData tbody').on('click', 'tr', function () {
        var idData = $(this).find('td:eq(0)').text();
        var modul=document.getElementById('modul').value;

        if(modul=='Detailinstansi'){
             setDetailInstansi(apiData,idData,apiLangForm,tahun);
        }

        if(modul=='Detailpokja'){
             setDetailPokja(apiData,idData,apiLangForm,tahun);
        }


        $("#idpdf").attr("value",idData);

        document.getElementById('input').click();

    })

}




function setDetailPokja(apiData,idData,apiLangForm,tahun){

    var res='';
    res +='<table class="table" id="tabelData">';
    $.ajax({
        type: "GET",
        url: apiData,
        data: ({"ctahun":tahun,"cid":idData}),
        dataType:"json",
        async : false,
        success:function(data){

            res +='<tr class="wbaris">';
            res +='<td style="text-align:center"><h3>'+data.data[0].pokjaNama+'</h3></td>';
            res +='</tr>';

            res +='<tr>';
            res +='<td>';
                res +='<table class="tablex">';
                res +='  <tr>';
                res +='     <td width="15%" class="kanan">Tahun Anggaran <td>';                
                res +='     <td class="kanan" width="2px">:<td>';                
                res +='     <td class="kanan" width="12%">'+tahun+'<td>';                
                res +='     <td width="15%">&nbsp;<td>';                
                res +='     <td width="15%" class="kanan"><label>Jenis Pengadaan</label><td>';                
                res +='     <td width="10%"><td>';                
                res +='     <td >&nbsp;<td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan">Total Paket <td>';                
                res +='     <td class="kanan" width="2px">:<td>';                
                res +='     <td class="kanan">'+data.data[0].totalPaket+'  Paket<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Persiapan :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketBarang+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan">Total Pagu (Rp) <td>';                
                res +='     <td class="kanan" width="20px">:<td>';                
                res +='     <td class="kanan">'+data.data[0].totalPagu+'<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Proses :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketKonstruksi+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan">Total Hps (Rp) <td>';                
                res +='     <td class="kanan" width="2px">:<td>';                
                res +='     <td class="kanan">'+data.data[0].totalHps+'<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Selesai :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketKonsultansi+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';    

                res +='  <tr>';
                res +='     <td class="kanan">&nbsp;<td>';                
                res +='     <td class="kanan" width="2px"><td>';                
                res +='     <td class="kanan">&nbsp;<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Gagal :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketLainnya+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';      


                res +='  <tr>';
                res +='     <td class="kanan"><td>';                
                res +='     <td class="kanan" width="2px"><td>';                
                res +='     <td class="kanan"><td>';                
                res +='     <td ><td>';                
                res +='     <td class="kanan"><label>Jumlah :</label><td>';                
                res +='     <td class="kanan">'+data.data[0].paketAll+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='</table>';

            res +='</td>';
            res +='</tr>';

            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>APBD</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th width="8%">No Reg</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="10%">Kode Lelang</th>';
            res +='<th width="15%">Instansi</th>';
            res +='<th width="10%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="5%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":1}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaReg+'</td>';
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].insNama+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';

            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>APBN</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th width="8%">No Reg</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="10%">Kode Lelang</th>';
            res +='<th width="15%">Instansi</th>';
            res +='<th width="10%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="5%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":2}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaReg+'</td>';
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].insNama+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';




            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>APBD-P</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th width="8%">No Reg</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="10%">Kode Lelang</th>';
            res +='<th width="15%">Instansi</th>';
            res +='<th width="10%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="5%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":3}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaReg+'</td>';
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].insNama+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';

            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>LAINNYA</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th width="8%">No Reg</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="10%">Kode Lelang</th>';
            res +='<th width="15%">Instansi</th>';
            res +='<th width="10%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="5%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":4}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaReg+'</td>';
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].insNama+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';


            res +='</td>';
            res +='</tr>';

        }
    });          

    res +='</table>';
    $("#detailIns").html(res);
     
}





function setDetailInstansi(apiData,idData,apiLangForm,tahun){

    var res='';
    res +='<table class="table" id="tabelData">';
    $.ajax({
        type: "GET",
        url: apiData,
        data: ({"ctahun":tahun,"cid":idData}),
        dataType:"json",
        async : false,
        success:function(data){

            res +='<tr class="wbaris">';
            res +='<td style="text-align:center"><h3>'+data.data[0].insNama+'</h3></td>';
            res +='</tr>';

            res +='<tr>';
            res +='<td>';
                res +='<table class="tablex">';
                res +='  <tr>';
                res +='     <td width="15%" class="kanan">Tahun Anggaran <td>';                
                res +='     <td class="kanan" width="2px">:<td>';                
                res +='     <td class="kanan" width="12%">'+tahun+'<td>';                
                res +='     <td width="15%">&nbsp;<td>';                
                res +='     <td width="15%" class="kanan"><label>Jenis Pengadaan</label><td>';                
                res +='     <td width="10%"><td>';                
                res +='     <td >&nbsp;<td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan">Total Paket <td>';                
                res +='     <td class="kanan" width="2px">:<td>';                
                res +='     <td class="kanan">'+data.data[0].totalPaketBrg+'  Paket<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Barang :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketBarang+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan">Total Pagu (Rp) <td>';                
                res +='     <td class="kanan" width="20px">:<td>';                
                res +='     <td class="kanan">'+data.data[0].totalPagu+'<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Konstruksi :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketKonstruksi+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan">Total Hps (Rp) <td>';                
                res +='     <td class="kanan" width="2px">:<td>';                
                res +='     <td class="kanan">'+data.data[0].totalHps+'<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Konsultansi :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketKonsultansi+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan">Sisa Paket <td>';                
                res +='     <td class="kanan" width="2px">:<td>';                
                res +='     <td class="kanan">'+data.data[0].totalSisaPaket+' Paket<td>';                
                res +='     <td >&nbsp;<td>';                
                res +='     <td class="kanan">Lainnya :<td>';                
                res +='     <td class="kanan">'+data.data[0].paketLainnya+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='  <tr>';
                res +='     <td class="kanan"><td>';                
                res +='     <td class="kanan" width="2px"><td>';                
                res +='     <td class="kanan"><td>';                
                res +='     <td ><td>';                
                res +='     <td class="kanan"><label>Jumlah :</label><td>';                
                res +='     <td class="kanan">'+data.data[0].paketAll+'  Paket<td>';                
                res +='     <td ><td>';                
                res +='  <tr>';            
                res +='</table>';

            res +='</td>';
            res +='</tr>';

            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>APBD</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="13%">Kode Lelang</th>';
            res +='<th width="13%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="7%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":1}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';

            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>APBN</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="13%">Kode Lelang</th>';
            res +='<th width="13%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="7%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":2}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';




            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>APBD-P</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="13%">Kode Lelang</th>';
            res +='<th width="13%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="7%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":3}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';

            res +='<tr class="wbaris">';
            res +='<td style="text-align:left"><h4>LAINNYA</h4></td>';
            res +='</tr>';


            res +='<tr>';
            res +='<td>';

            res +='<table class="table"';
            res +='<tr>';
            res +='<th width="3%">No</th>';
            res +='<th >Nama Paket Pekerjaan</th>';
            res +='<th width="13%">Kode Lelang</th>';
            res +='<th width="13%">Jenis Pengadaan</th>';
            res +='<th width="12%" class="kanan">Pagu</th>';
            res +='<th width="12%" class="kanan">HPS</th>';
            res +='<th width="7%" >Status</th>';
            res +='</tr>';
            $.ajax({
                type: "GET",
                url: apiData+"sdana",
                data: ({"ctahun":tahun,"cid":idData,"cdana":4}),
                dataType:"json",
                async : false,
                success:function(data2){
                    console.log(data2);
                    for(i=0;i<=data2.data.length-1;i++){
                        res +='<tr>';
                        if(i!=data2.data.length-1){
                            res +='<td >'+(i+1)+'</td>';
                        }else{
                            res +='<td >&nbsp;</td>';
                        }
                        res +='<td >'+data2.data[i].kerjaNamaPaket+'</td>';
                        res +='<td >'+data2.data[i].kerjaKodeLelang+'</td>';
                        res +='<td >'+data2.data[i].jpengNama+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaPagux+'</td>';
                        res +='<td class="kanan">'+data2.data[i].kerjaHpsx+'</td>';
                        res +='<td >'+data2.data[i].statNama+'</td>';
                        res +='</tr>';
                    }
                }
            });
            res +='</table>';

            res +='</td>';
            res +='</tr>';


            res +='</td>';
            res +='</tr>';

        }
    });          

    res +='</table>';
    $("#detailIns").html(res);
     
}



function cetakPdf(){
    var link=document.getElementById('linkpdf').value;
    var tahunx=document.getElementById('filterTahun').value;
    var idx=document.getElementById('idpdf').value;

    var param='?th='+tahunx+'&id='+idx;
    window.open(link+param, '_blank');
}