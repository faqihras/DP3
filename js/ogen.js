function LoadMorrisScripts(callback){
    function LoadMorrisScript(){
        if(!$.fn.Morris){
            $.getScriPencarianpakett('plugins/morris/morris.min.js', callback);
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



function loadLaporan(){

    var modulx=document.getElementById('modul').value;
    // var unitx=document.getElementById('filterUnit').value;

    var cbulan=document.getElementById('cbulan').value;
    var ctahun=document.getElementById('ctahun').value;

    // var tgawalx=document.getElementById('tgawal').value;
    // var tgahirx=document.getElementById('tgahir').value;


    var postData=new Object();
        // postData['unit']=unitx;
        postData['ctahun']=ctahun;
        postData['cbulan']=cbulan;

    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx,unit:unitx,cbulan:cbulan,ctahun:ctahun}),
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
                    if(data.kolom[i].data!=''){
                        kolm.push(data.kolom[i].data);                
                        lgn.push(data.kolom[i].align);   
                        label.push(data.kolom[i].title);   
                    }
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


            //kolom3========================================

            for(c=0;c<=data.kolom3.length-1;c++){

                    kolm.push(data.kolom3[c].data);                
                    lgn.push(data.kolom3[c].align);   
                    label.push('');   

            }

            //==============================================


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
                    var style='style="text-align:'+lgn[j]+';padding:1px;"';
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
        "paging":   false,       
        "scrollX": true,     
        "bSort" : false,
        "info"  :   true,
        "language": {
                        "zeroRecords": "No records available",
                        // "info": "Page _PAGE_ of _PAGES_",
                        "info": "",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "SEARCH :  ",
                        "paginate": {"next": "","previous": ""}
        },
        "processing": true,
        "serverSide": false,
        "footer": true,

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
    var danax=document.getElementById('filterDana').value;
    var dasarx=document.getElementById('filterDasar').value;

    var param='?th='+tahunx+'&dn='+danax+'&ds='+dasarx;
    window.open(link+param, '_blank');

}


function loadPerfaktual(){

    // alert('test');
    var modulx=document.getElementById('modul').value;

    var cbulan=document.getElementById('cbulan').value;
    var ctahun=document.getElementById('ctahun').value;

    if(cbulan=='' || ctahun==''){
        alert('Bulan Atau Tahun Belum Dipilih !!!');
        return;
    }


    var postData=new Object();
        postData['ctahun']=ctahun;
        postData['cbulan']=cbulan;
		
    var param='?data='+JSON.stringify(postData);
    var url="laporan/apotek/ogen.php";                    
    window.open(url+param, '_blank');

}