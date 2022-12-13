var noBrs = 0;

function cekSession() {
    $.ajax({
       type     : "GET",
       url      : 'backend/public/getSession',
       dataType : "json",
       async    : false,
       success  : function (data) {
           if ( data.userNameAdmin === '' ) {
               logout();
           }
       }
    });    
}

// Run Datables plugin and create 3 variants of settings
function AllTables(modul){
    $('#judul1').html(modul);
    $('#judul2').html(modul);
}

function setAutocompleteVal(comboapi,kodecombo,nmfield){
    $.ajax({
        type: "GET",
        url: comboapi,
        data:({kode:kodecombo}),
        dataType:"json",
        success:function(data3){
            $("#"+nmfield).select2("data", { id: kodecombo, text:data3[0].text});
        }
    });
}

function loadPerfaktual() {

    var modulx=document.getElementById('modul').value;
    // var unitx=document.getElementById('filterUnit').value;

    var tgawal   = document.getElementById('tgawal').value;
    var tgahir   = document.getElementById('tgahir').value;
    var pegawai  = document.getElementById('pegawai').value;

    if(tgawal=='' || tgahir==''){
        alert('Periode Laporan belum ditentukan dengan benar !!!');
        $('#tgawal').focus();
        return;
    }

    if(pegawai==''){
        alert('Pegawai silahkan dipilih terlebih dahulu !!!');
        return;
    }

    var postData=new Object();
        // postData['unit']=unitx;
        postData['tgawal']  = tgawal;
        postData['tgahir']  = tgahir;
        postData['pegawai'] = pegawai;

    var param='?data='+JSON.stringify(postData);
    var url="backend/public/api/admin/report/laprekapabsenpegawai";
    window.open(url+param, '_blank');

}


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

function loadLaporan(){

    var modulx=document.getElementById('modul').value;
    var tgawal  = document.getElementById('tgawal').value;
    var tgahir  = document.getElementById('tgahir').value;
    var cskpd   = document.getElementById('skpd').value;
    var cnmskpd = document.getElementById('nmskpd').value;

    $('#btnCetakExcel').removeAttr("disabled");

    $('#tData').empty();


    if(tgawal=='' || tgahir==''){
        alert('Periode Laporan belum ditentukan dengan benar !!!');
        $('#tgawal').focus();
        return;
    }


    var idx=parseInt(document.getElementById('idxBarang').value);

    var postData=new Object();
        // postData['unit']=unitx;
        postData['tgawal']=tgawal;
        postData['tgahir']=tgahir;
        postData['cskpd']=cskpd;
        postData['cnmskpd']=cnmskpd;
        postData['idx']=idx-1;

    for(i=1;i<=idx-1;i++){
        postData['idxBarang'+i]=document.getElementById('idxBarang'+i).value;
    }
    var res='<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="tabelData" name="tabelData">';
    res+= '<thead>';
    res+= '<tr>';
    res+= '<th colspan="18" align="center">LAPORAN KARTU PERSEDIAAN BARANG SKPD</th> ';
    res+= '</tr>';
    res+= '<tr>';
    res+= '<th width="90" align="center" rowspan="2">No.</th> ';
    res+= '<th width="180" align="center" rowspan="2">TANGGAL</th> ';
    res+= '<th width="200" align="center" rowspan="2" nowrap>BAST</th> ';
    res+= '<th width="200" align="center" rowspan="2" nowrap>SATUAN</th> '; 
    res+= '<th width="380" align="center" colspan="3" nowrap>Penerimaan</th> ';
    res+= '<th width="380" align="center" colspan="3" nowrap>Pengeluaran</th> ';
    res+= '<th width="380" align="center" colspan="3" nowrap>Saldo</th> ';
    res+= '<th width="240" align="center" rowspan="2" nowrap>Keterangan</th> ';
    res+= '</tr>';
    res+= '<tr>';
    res+= '<th align="center" >Unit</th> ';
    res+= '<th align="right">Harga</th> ';
    res+= '<th align="right">Jumlah</th> ';
    res+= '<th align="center" >Unit</th> ';
    res+= '<th align="right">Harga</th> ';
    res+= '<th align="right">Jumlah</th> ';
    res+= '<th align="center" >Unit</th> ';
    res+= '<th align="right">Harga</th> ';
    res+= '<th align="right">Jumlah</th> ';
    res+= '</tr>';
    res+= '</thead>';
    res+= '<tbody>';
    var kolomIdx = 0;
    var data     = 'data='+ JSON.stringify(postData) +'';
    var awal     = '';
    var nama     = '';

    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/report/kartupersediaan',
        dataType:"json",
        data:data,
        async:false,
        success:function(data){
            // var c = 1;
            for(i=0;i<data.length;i++){

                if(awal != data[i].kode) {
                    // c = 1;
                    if(i>0) {
                        res += '<tr><td colspan="18"></td></tr>';
                    }
                    res += '<tr><td colspan="18">Kode Barang: '+data[i].kode+'</td></tr>';
                    res += '<tr><td colspan="18">Nama Barang: '+data[i].nama+'</td></tr>';
                    awal = data[i].kode;
                }
                var ref;
                res +='  <tr>';
                res +='<td align="center">'+data[i].nmr+'</td>';
                res +='<td align="center" nowrap>'+data[i].tgl+'</td>';
                res +='<td align="center" nowrap>'+data[i].ref+'</td>';
                res +='<td align="center">'+data[i].akhirsatuan+'</td>';
                res +='<td align="right">'+data[i].masukunit+'</td>';
                // res +='<td align="center">'+data[i].masuksatuan+'</td>';
                res +='<td align="right">'+data[i].masukharga+'</td>';
                res +='<td align="right">'+data[i].masukjml+'</td>';
                res +='<td align="right">'+data[i].keluarunit+'</td>';
                // res +='<td align="center">'+data[i].keluarsatuan+'</td>';
                res +='<td align="right">'+data[i].keluarharga+'</td>';
                res +='<td align="right">'+data[i].keluarjml+'</td>';
                res +='<td align="right">'+data[i].akhirunit+'</td>';
                // res +='<td align="center">'+data[i].akhirsatuan+'</td>';
                res +='<td align="right">'+data[i].akhirharga+'</td>';
                res +='<td align="right">'+data[i].akhirjml+'</td>';
                res +='<td align="left">'+data[i].keterangan+'</td>';
                res +='  </tr>';
                // c = c + 1;
            }
        }
    });

    res +='</tbody>';
    res +='</table>';
    $('#tData').html(res);
    //
    // $('#tData').DataTable({
    //     "sorting": [[ 0, "asc" ]],
    //     "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
    //     "paginationType": "bootstrap",
    //     "paging":   false,
    //     "scrollX": true,
    //     "bSort" : false,
    //     "info"  :   true,
    //     "language": {
    //                     "zeroRecords": "No records available",
    //                     // "info": "Page _PAGE_ of _PAGES_",
    //                     "info": "",
    //                     "infoEmpty": "No records available",
    //                     "infoFiltered": "(filtered from _MAX_ total records)",
    //                     "search": "SEARCH :  ",
    //                     "paginate": {"next": "","previous": ""}
    //     },
    //     "processing": false,
    //     "serverSide": false,
    //     "footer": true,

    // });
    //

}



function cetakDetailPaket(idpaket){

    if(idpaket==''){
        return;
    }

    var param='?id='+idpaket;
    var url="backend/public/api/admin/ulp/cetakdetailpaket";
    window.open(url+param, '_blank');
}

function cetakPdf(){

    var link=document.getElementById('linkpdf').value;
    var tahunx=document.getElementById('filterTahun').value;
    var danax=document.getElementById('filterDana').value;
    var dasarx=document.getElementById('filterDasar').value;

    var param='?th='+tahunx+'&dn='+danax+'&ds='+dasarx;
    window.open(link+param, '_blank');

}

function addBarang(){
    var kdbarang=document.getElementById('filterbarang').value;
    var nmbarang=document.getElementById('filterbarang_hidden').value;
    if(kdbarang=='') return;
    var item = '';
    var idxBarang=parseInt(document.getElementById('idxBarang').value);

    var oTable=document.getElementById('tBarang');
        item += '</td><td width="3%" align="center"><a href="#" class="text-danger" onclick="delBarang('+idxBarang+')"><i class="fa fa-times-circle fa-lg"></i></a></td>';
        item += '<td width="90%"><input type="hidden" id="baris'+idxBarang+'" value="'+idxBarang+'">';
        item += '<input type="hidden" name="idxBarang'+idxBarang+'" id="idxBarang'+idxBarang+'" value="'+kdbarang+'">'+nmbarang;
        rowIns = oTable.insertRow(idxBarang-1);
        rowIns.innerHTML = item;
        noBrs = idxBarang;
        idxBarang +=1;
    document.getElementById('idxBarang').value=idxBarang;
    $('#itembarang').html(item);

}

function delBarang(row) {
    var idx = document.getElementById('idxBarang').value;
    var brs = document.getElementById('baris'+row).value;
    document.getElementById('tBarang').deleteRow(brs-1);
    idx = idx - 1;
    var b = 1;
    for(var a = 1; a <= noBrs; a++) {
        if(document.getElementById('baris'+a) !== null) {
            document.getElementById('baris'+a).value = b;
            b = b + 1;
        }
    }
    document.getElementById('idxBarang').value = idx;
}