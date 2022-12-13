
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

    var modulx      = document.getElementById('modul').value;
    var tgawalx     = document.getElementById('tgawal').value;
    var tgahirx     = document.getElementById('tgahir').value;
    var jenis       = document.getElementById('jenjang1').value;

    var postData=new Object();
    postData['tgawal']=tgawalx;
    postData['tgahir']=tgahirx;
    postData['jenjan1']=jenis;

    if(tgawalx=='' || tgahirx==''){
        alert('Periode Laporan Masih Kosong');
        return;
    }

    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx,tgawal:tgawalx,tgahir:tgahirx}),
        dataType:"json",
        async:false,
        success:function(data){
            apiData=data[0].apiData;
            apiGrid=data[0].apiLangGrid;
            $("#linkpdf").attr("value",data[0].apiPdf);
        }
    });


    var res='<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="tabelData" name="tabelData">';
    var kolm=[];
    var lgn =[];
    var label=[];
    $.ajax({
        type: "GET",
        url: apiGrid,
        dataType:"json",
        async:false,
        success:function(data){

            var rx=0;
            for(i=0;i<=data.kolom.length-1;i++){
                if(data.kolom[i].rowspan!=0){
                   if(data.kolom[i].rowspan>rx){
                        rx=data.kolom[i].rowspan;
                   }
                }
            }

            res +='<thead>';
            res +='  <tr>';

            if(rx>0){
                res +='    <th width="2%" rowspan="2">NO</th>';
            }else{
                res +='    <th width="2%" >NO</th>';
            }
            for(i=0;i<=data.kolom.length-1;i++){

                var rowspan='';
                if(data.kolom[i].rowspan!=0){
                    rowspan='rowspan="'+data.kolom[i].rowspan+'"';
                }

                var colspan='';
                if(data.kolom[i].colspan!=0){
                    colspan='colspan="'+data.kolom[i].colspan+'"';
                }else{
                    kolm.push(data.kolom[i].data);
                    lgn.push(data.kolom[i].align);
                    label.push(data.kolom[i].title);
                }

                res +='<th width="'+data.kolom[i].width+'" '+rowspan+' '+colspan+'>'+data.kolom[i].title+'</th>';
            }
            res +='  </tr>';

            if(rx>0){
                res +='  <tr>';
                for(i=0;i<=data.kolom2.length-1;i++){

                    var rowspan='';
                    if(data.kolom2[i].rowspan!=0){
                        rowspan='rowspan="'+data.kolom2[i].rowspan+'"';
                    }

                    if(data.kolom2[i].colspan!=0){
                        colspan='colspan="'+data.kolom2[i].colspan+'"';
                    }else{
                        var colspan='';
                        kolm.push(data.kolom2[i].data);
                        lgn.push(data.kolom2[i].align);
                        label.push(data.kolom2[i].title);
                    }

                    res +='<th width="'+data.kolom2[i].width+'" '+rowspan+' '+colspan+'>'+data.kolom2[i].title+'</th>';
                }
                res +='  </tr>';
            }


            res +='</thead>';
            res +='<tbody>';

        }
    });


    $.ajax({
        type: "GET",
        url: apiData,
        dataType:"json",
        // data:({unit:unitx,tgawal:tgawalx,tgahir:tgahirx}),
        data:postData,
        async:false,
        success:function(data){
            for(i=0;i<=data.length-1;i++){
                res +='  <tr>';
                res +='<td>'+(i+1)+'</td>';

                for(j=0;j<=kolm.length-1;j++){
                    var cell='data[i].'+kolm[j];
                    var style='style="text-align:'+lgn[j]+'"';
                    res +='<td '+style+'>'+eval(cell)+'</td>';
                }
                res +='  </tr>';
            }
        }
    });
    res +='</tbody>';
    res +='</table>';
    $('#tData').html(res);

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

    var modulx      = document.getElementById('modul').value;
    var tgawalx     = document.getElementById('tgawal').value;
    var tgahirx     = document.getElementById('tgahir').value;
    var kdbarang    = document.getElementById('filterbarang').value;
    // tanda tangan
    //var KD = document.getElementById('filterkepaladinas').value;
    //var PPB = document.getElementById('filterpenatausahaan').value;
    //var PB = document.getElementById('filterpengurus').value;

    if(tgawalx=='' || tgahirx==''){
        alert('Periode Laporan belum ditentukan dengan benar.');
        $('#tglawal').focus();
        return;
    }

    //if(KD == '' || PPB == '' || PB == ''){
    //    alert('Data Penandatangan Masih Kosong');
    //    return;
    //}

    var link = 'backend/public/api/admin/report/cetakkartustok';
    var param='?tgawal='+tgawalx+'&tgahir='+tgahirx+'&kode='+kdbarang;
    window.open(link+param, '_blank');

}
//
// function addBarang(){
//     var kdbarang=document.getElementById('filterbarang').value;
//     var nmbarang=document.getElementById('filterbarang_hidden').value;
//     if(kdbarang=='') return;
//
//     var idxBarang=parseInt(document.getElementById('idxBarang').value);
//
//     var item=document.getElementById('itembarang').innerHTML;
//         item +='<input type="hidden" name="idxBarang'+idxBarang+'" id="idxBarang'+idxBarang+'" value="'+kdbarang+'">'+nmbarang+', ';
//         idxBarang +=1;
//
//     document.getElementById('idxBarang').value=idxBarang;
//     $('#itembarang').html(item);
//
// }
