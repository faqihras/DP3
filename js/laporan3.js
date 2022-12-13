function LoadMorrisScripts(callback){
    function LoadMorrisScript(){
        if(!$.fn.Morris){
            $.getScript('plugins/morris/morris.min.js', callback);
        }
        else {
            if (callback && typeof(callback) === "function") {
                callback();
            }
        }
    }
    if (!$.fn.raphael){
        $.getScript('plugins/raphael/raphael-min.js', LoadMorrisScript);
    }
    else {
        LoadMorrisScript();
    }
}


function setTahun(){
    var res='';

    var d = new Date();
    var n = d.getFullYear();    

    res +='<label>TAHUN</label><select class="form-control" name="filterTahun" id="filterTahun" onchange="onTahunChange()">';

    for(i=(n+1);i>=(n-4);i--){
        res +='<option value="'+i+'"';   
            if(i==n){
                res +=' selected ';
            }
        res +='>'+i+'</option>';            
    }

    res +='</select>';

    $('#divtahun').html(res);
    loadLaporan();
}


function loadLaporan(){

    var modulx=document.getElementById('modul').value;
    var tahunx=document.getElementById('filterTahun').value;

    var danax=document.getElementById('filterDana').value;
    var dasarx=document.getElementById('filterDasar').value;

    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        async:false,
        success:function(data){
            // console.log(data);
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
                res +='    <th width="3%" rowspan="2">NO</th>';
            }else{
                res +='    <th width="3%" >NO</th>';                
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

            res +='  <tr  class="trhide">'; 
            res +='    <td align="center">NO</td>';                
            for(i=0;i<=label.length-1;i++){
                res +='<td align="center">'+label[i]+'</td>';
            }
            res +='  </tr>';


        }
    });


    $.ajax({
        type: "GET",
        url: apiData,
        dataType:"json",
        data:({"ctahun":tahunx,"cdana":danax,"cdasar":dasarx}),
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


    $('#tabelData').DataTable({
        "sorting": [[ 0, "asc" ]],
        "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "paging":   true,       
        "scrollX": true,
        "bSort" : false,
        "info"  :   true,
        "language": {
                        "zeroRecords": "No records available",
                        "info": "Page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "SEARCH :  ",
                        "paginate": {"next": "","previous": ""}
        },
        "processing": true,
        "serverSide": false,
        "footer": true,

    });



    if(modulx=='Progrespokja'){

        var res='';
        res +='<table class="table table-bordered">';
        res +='<thead>';
        res +='<tr>';
        res +='<th>NO</th>';
        res +='<th>PROSES</th>';
        res +='<th>PAKET</th>';
        res +='<th>PAGU/HPS</th>';
        res +='</tr>';
        res +='</thead>';

        $.ajax({
            type: "GET",
            url: apiData+"rekap",
            dataType:"json",
            data:({"ctahun":tahunx,"cdana":danax,"cdasar":dasarx}),
            async:false,
            success:function(data){
                console.log(data)
 
                for(i=0;i<=data.length-1;i++){
                    res +='<tr>';
                    res +='<td>'+(i+1)+'</td>';
                    res +='<td >'+data[i].statNama+'</td>';
                    res +='<td align="right">'+data[i].totalPaket+'</td>';
                    res +='<td align="right">'+data[i].totalPagu+'</td>';
                    res +='</tr>';
                }
            }
        });
        res +='</table>';
        $('#tDataRekap').html(res);
        $('#crekap').attr('style','display:block')
        rekapGrafik();
    }

}



function rekapGrafik(){

    var tahunx=document.getElementById('filterTahun').value;
    var danax=document.getElementById('filterDana').value;
    var dasarx=document.getElementById('filterDasar').value;


    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/ulp/lapprogrespokjagrapik1',
        data:({"ctahun":tahunx,"cdana":danax,"cdasar":dasarx}),
        dataType:"json",
        success:function(Rdata){

            console.log(Rdata);
            // console.log(seriesData);
        
            $('#progresStatus').highcharts({              
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Status'
                },
                xAxis: {
                    categories: Rdata.stat,
                    crosshair: false
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0,
                        borderWidth: 0
                    }
                },
                series: Rdata.data
            });

        }
    });       


    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/ulp/lapprogrespokjagrapik2',
        data:({"ctahun":tahunx,"cdana":danax,"cdasar":dasarx}),
        dataType:"json",
        success:function(Rdata){

            console.log(Rdata);
            // console.log(seriesData);
        
            $('#distribusiPokja').highcharts({              
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Pokja'
                },
                xAxis: {
                    categories: Rdata.stat,
                    crosshair: false
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0,
                        borderWidth: 0
                    }
                },
                series: Rdata.data
            });

        }
    });       


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

    var param='?th='+tahunx;
    window.open(link+param, '_blank');
}
