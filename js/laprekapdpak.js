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

    //var tgawal   = document.getElementById('tgawal').value;
    //var tgahir   = document.getElementById('tgahir').value;
    var bulan  = document.getElementById('bulan').value;
    var pegawai  = document.getElementById('pegawai').value;

    if(bulan==''){
        alert('Bulan Laporan belum ditentukan dengan benar !!!');
        $('#bulan').focus();
        return;
    }

    if(pegawai==''){
        alert('Unit silahkan dipilih terlebih dahulu !!!');
        return;
    }

    var postData=new Object();
        // postData['unit']=unitx;
        // postData['tgawal']  = tgawal;
        postData['bulan']  = bulan;
        postData['pegawai'] = pegawai;

    var param='?data='+JSON.stringify(postData);
    var url="backend/public/api/admin/report/laprekapdpak";
    window.open(url+param, '_blank');

}

function loadPerpegawai() {

    var modulx=document.getElementById('modul').value;
    // var unitx=document.getElementById('filterUnit').value;

    //var tgawal   = document.getElementById('tgawal').value;
    //var tgahir   = document.getElementById('tgahir').value;
    var bulan  = document.getElementById('bulan1').value;
    var unit  = document.getElementById('unit').value;

    if(bulan==''){
        alert('Bulan Laporan belum ditentukan dengan benar !!!');
        $('#bulan').focus();
        return;
    }

    if(unit==''){
        alert('Pegawai silahkan dipilih terlebih dahulu !!!');
        return;
    }

    var postData=new Object();
        // postData['unit']=unitx;
        // postData['tgawal']  = tgawal;
        postData['bulan1']  = bulan;
        postData['unit'] = unit;

    var param='?data='+JSON.stringify(postData);
    var url="backend/public/api/admin/report/laprekapbulanpgw";
    window.open(url+param, '_blank');

}

function loadKeseluruhan() {

    var modulx=document.getElementById('modul').value;
    // var unitx=document.getElementById('filterUnit').value;

    //var tgawal   = document.getElementById('tgawal').value;
    //var tgahir   = document.getElementById('tgahir').value;
    var unit  = document.getElementById('unit').value;
    var bulan  = document.getElementById('bulan1').value;
    var bidang  = document.getElementById('bidang').value;

    if(bulan==''){
        alert('Bulan Laporan belum ditentukan dengan benar !!!');
        $('#bulan').focus();
        return;
    }

    // if(bidang==''){
    //     alert('Unit silahkan dipilih terlebih dahulu !!!');
    //     return;
    // }

    var postData=new Object();
        // postData['unit']=unitx;
        postData['unit']=unit;
        postData['bulan1']  = bulan;
        postData['bidang'] = bidang;

    var param='?data='+JSON.stringify(postData);

    if(unit == 0) {
        url     = "backend/public/api/admin/report/lapkeseluruhan";
    }if(unit != 0 && bidang != 0 ) {
        url     = "backend/public/api/admin/report/laprekapbulanpgw";
    }

    //var url="backend/public/api/admin/report/lapkeseluruhan";
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