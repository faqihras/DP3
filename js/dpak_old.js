$(document).ready(function() {
    var modul=document.getElementById('modul').value;
    LoadDataTablesScripts(AllTables(modul));

    $('.form-control').tooltip();
    WinMove();

    var oTable;
    var oTable2;
    var oTable3;

    // $(".gallery").fancybox();
    LoadFancyboxScript(DemoGallery);
});

function DemoGallery(){
    $('.fancybox').fancybox({
        openEffect  : 'none',
        closeEffect : 'none'
    });
}


function AllTables(modul){
    $('#judul1').html(modul);
    $('#judul2').html(modul);
    tableMaster(modul);
}

function AllTables2(modul,kode,idData){
    $('#judul1').html(modul);
    $('#judul2').html(modul);
    tableMaster2(modul,kode,idData);
}

// function filterwilayah(){
//     var modul=document.getElementById('modul').value;
//     tableMaster(modul);

//     console.log('sampai 1');
// }

function tableMaster(modulx){
    $.ajax({
        type: "GET",
        url : "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        success:function(data){

            getLangGrid(data[0].apiLangGrid,data[0].apiData,data[0].apiLangForm);

        }
    });
}

function tableMaster2(modulx,kode,idData){

    if (kode == 1) {
        var url = "backend/public/lang/admin/penilaian/dpak/form";
    }else if(kode == 2){
        var url = "backend/public/lang/admin/penilaian/dpak/form2";
    }else if(kode == 3){
        var url = "backend/public/lang/admin/penilaian/dpak/form";
    }else if(kode == 4){
        var url = "backend/public/lang/admin/penilaian/dpak/form";
    }else if(kode == 5){
        var url = "backend/public/lang/admin/penilaian/dpak/form";
    }else if(kode == 6){
        var url = "backend/public/lang/admin/penilaian/dpak/form";
    }else if(kode == 7){
        var url = "backend/public/lang/admin/penilaian/dpak/form";
    }
    if (kode == 7) {
        // getLangForm(url,kode);
        setTimeout(function(){ 
            if ( ! $.fn.DataTable.isDataTable( '#tData2' ) ) {
                setGrid2(idData,kode);
            }else{
                $('#tData2').dataTable().fnDestroy();
                setGrid2(idData,kode);
            }
        }, 100);
        
    }else if (kode == 6) {
        // getLangForm(url,kode);
        setTimeout(function(){ 
            if ( ! $.fn.DataTable.isDataTable( '#tData3' ) ) {
                setGrid3(idData,kode);
                setTimeout(function(){ 
                    cek_status();
                }, 500);
            }else{
                $('#tData3').dataTable().fnDestroy();
                setGrid3(idData,kode);
                setTimeout(function(){ 
                    cek_status();
                }, 500);
            }
        }, 100);
        
    }else{
        getLangForm(url,kode);
        setFormData(idData,url);
    }
}

function getLangGrid(apiLang,apiData,apiLangForm){
    $.ajax({
        type: "GET",
        url : apiLang,
        dataType:"json",
        success:function(data){
            setGrid(data.kolom,apiData,apiLangForm);
        }
    });
}

function setGrid(kolom,apiData,apiLangForm){

    // var kelurahan = document.getElementById('filterkelurahan').value;
    // var kecamatan = document.getElementById('filterkecamatan').value;
    // var kabupaten = document.getElementById('filterkabupaten').value;
    // var provinsi = document.getElementById('filterprovinsi').value;

    var table=$('#tData').DataTable({
        "sorting": [[ 0, "asc" ]],
        "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "ordering": false,
        "paging":   true,
        "info"  :   true,
        "language": {
                        "lengthMenu": "",
                        "zeroRecords": "No records available",
                        "info": "Page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "SEARCH :  ",
                        "paginate": {"next": "","previous": ""}
        },
        "processing": false,
        "serverSide": true,
        "ajax": {
                    "url" : apiData,
                    // "data" : ({kel:kelurahan,kec:kecamatan,kab:kabupaten,prov:provinsi}),
                    "dataType" : "json",
                },

        "columns": kolom,
        // "aoColumnDefs": [
        //     {'bSortable': false, 'aTargets': [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]},
        // ],
    });




    // $('#tData tbody').on('click', 'tr', function () {
    //     // var data = $(this).parents('tr').context.cells;
    //     // var idData=data[0].innerText;
    //     var idData = $(this).find('td:eq(0)').text();
    //     setFormData(apiData,idData,apiLangForm);
    //     // console.log(apiData);
    // })

}

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
    var unit=document.getElementById('filterbarang').value; 

   // var tanggal=document.getElementById('tanggal').value;                         

    var postData=new Object();
      //  postData['tanggal']=tanggal;
        postData['dpakUnit']=unit;
        
    // if(tanggal==''){
    //     alert('Tanggal Masih Kosong');
    //     return;
    // }
 
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx,dpakUnit:unit}),
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
        // var kdbrg=document.getElementById('filterbarang').value;
        // var nmbarang=document.getElementById('filterbarang_hidden').value;  
        //tampilan kode brg, nama brg, harga beli, harga beli ppn diatas tabel
       

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

        }
    });


    $.ajax({
        type: "GET",
        url: apiData,
        dataType:"json",
        // data:({unit:unitx,tgawal:tgawalx,tgahir:tgahirx}),
        // data:({tanggal:tanggal}),
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


    $('#tabelData').DataTable({
        "sorting": [[ 0, "asc" ]],
        "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "paging":   false,       
        "bSort" : false,
        "info"  :   true,
        "language": {
                        "lengthMenu": "",
                        "zeroRecords": "No records available",
                        "info": "Jumlah Pegawai : _TOTAL_",
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

function addBarang(){
    var kdbarang=document.getElementById('filterbarang').value;                            
    var nmbarang=document.getElementById('filterbarang_hidden').value;                            
    if(kdbarang=='') return;

    var idxBarang=parseInt(document.getElementById('idxBarang').value); 

    var item=document.getElementById('itembarang').innerHTML;
        item +='<input type="hidden" name="idxBarang'+idxBarang+'" id="idxBarang'+idxBarang+'" value="'+kdbarang+'">'+nmbarang+', ';
        idxBarang +=1;

    document.getElementById('idxBarang').value=idxBarang; 
    $('#itembarang').html(item);

}

function getLangForm(apiLang,kode){
    $.ajax({
        type: "GET",
        url: apiLang,
        dataType:"json",
        success:function(data){
            // console.log(data);
            var result="";
            for (i = 0; i <= data.form.length-1; i++) {

                if(data.form[i].readonly=='1'){
                    var ro='readonly';
                }else{
                    var ro='';
                }


                if(data.form[i].type=='date'){
                    result +='<div class="col-md-6">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control"  name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' placeholder="Pilih Tanggal" />';
                    result +='</div>';
                    result +='</div>';
                }


                if(data.form[i].type=='hidden'){
                    result +='<div class="form-group">';
                    result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" />';
                    result +='</div>';
                }
                
                if(data.form[i].type=='text'){
                    result +='<div class="col-md-2">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
                    result +='</div>';
                }
                if (data.form[i].type)

                if(data.form[i].type=='textarea'){
                    result +='<div class="col-md-12">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <textarea class="form-control" rows="'+data.form[i].rows+'" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' /></textarea>';
                    result +='</div>';
                    result +='</div>';
                }
                  if(data.form[i].type=='label'){
                    result +='<div class="col-md-12">';
                   result +='<div class="form-group">';
                    result +='     <label class="control-label" style="color:#2d850d">'+data.form[i].name+'</label>';
                    result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" />';
                    result +='</div>';
                    result +='</div>';

                }

                if(data.form[i].type=='label1'){
                    result +='<div class="col-md-12">';
                   result +='<div class="form-group">';
                    result +='     <label class="control-label" style="color:#2d850d">'+data.form[i].name+'</label>';
                    result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" />';
                    result +='</div>';
                    result +='</div>';

                }
                if(data.form[i].type=='batas'){
                    result +='<div class="col-md-1">';
                   result +='<div class="form-group">';
                    result +='     <label class="control-label" style="color:#2d850d">'+data.form[i].name+'</label>';
                     result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" />';
                    result +='</div>';
                    result +='</div>';

                }
                if(data.form[i].type=='angka'){
                    result +='<div class="col-md-4">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'"  '+ro+' />';
                    result +='</div>';
                    result +='</div>';

                }
                 if(data.form[i].type=='checkbox'){
                    result +='<div class="col-md-3">';
                    result +='<div class="form-group">';
                    // result +='     <label>'+data.form[i].name+'</label>';
                    result +='     <input type="checkbox" class="checkbox-inline" value ="1" name="'+data.form[i].id+'" id="'+data.form[i].id+'"  '+ro+' />'+"   "+ data.form[i].name ;
                    result +='</div>';
                    result +='</div>';

                }

                if(data.form[i].type=='password'){
                    result +='<div class="col-md-6">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="password" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
                    result +='</div>';
                }

                if(data.form[i].type=='combo'){
                    var comboapi=data.form[i].comboapi;

                    result +='<div class="col-md-4">';
                    result +='<div class="form-group">';
                    result +='    <label class="control-label">'+data.form[i].name+'</label>';
                    result +='    <select class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+'>';
                    result +='        <option></option>';

                    $.ajax({
                        type: "GET",
                        url: comboapi,
                        dataType:"json",
                        async: false,
                        success:function(datacombo){
                            for(j=0;j<=datacombo.length-1;j++){
                                result +='<option value="'+datacombo[j].kode+'">'+datacombo[j].nama+'</option>';
                            }
                        }    
                    });    

                    result +='    </select>';
                    result +='</div>';
                    result +='</div>';
                }


                if(data.form[i].type=='autocomplete'){
                    var comboapi=data.form[i].comboapi;

                    result +='<div class="col-md-6">';
                    result +='<div class="form-group">';
                    result +='    <label class="control-label">'+data.form[i].name+'</label>';
                    result +='    <input type="hidden" class="populate placeholder" name="'+data.form[i].id+'" id="'+data.form[i].id+'" >';
                    result +='    <input type="hidden" name="'+data.form[i].id+'_hidden" id="'+data.form[i].id+'_hidden" >';
                    result +='</div>';
                    result +='</div>';

                }

            }

            $('#forminput').html(result);
            // $('#forminput2').html(result);


            for (i = 0; i <= data.form.length-1; i++) {

                if(data.form[i].type=='angka'){
                    $('#'+data.form[i].id).keypress(function(){
                      return(numbersonly(event));
                    });
                }    


                if(data.form[i].type=='autocomplete'){
                    var comboapi=data.form[i].comboapi;
                    var param1 =data.form[i].param1;
                    var param2 =data.form[i].param2;

                    $('#'+data.form[i].id)
                        .on("change", function(e) {
                              var id=e.added.id;
                              var txt=e.added.nama;  
                              var nmhidden=this.id+'_hidden';
                              //console.log(nmhidden);                              
                              $('#'+nmhidden).attr('value',txt);

                              var anggaran=e.added.anggaran; 
                              if (this.id == 'verifIdKegiatan') {
                                // alert('bisa');
                                    document.getElementById('admAnggaran').value = parseInt(anggaran);
                                    // $('#admAnggaran').attr('value', anggaran);
                              }
                        })      
                        .select2({

                        placeholder: "Pilih Data", 
                        ajax: {
                                url: comboapi,
                                dataType: 'json',
                                quietMillis: 100,
                                data: function (term, page) {
                                    // if(param1 !=''){
                                    //     var vskpd=document.getElementById(param1).value;
                                    // }else{
                                    //     var vskpd='';
                                    // }                                    

                                    // if(param2 !=''){
                                    //     var vkeg=document.getElementById(param2).value;
                                    // }else{
                                    //     var vkeg='';
                                    // }                                    

                                    return {
                                        // kode1 :vskpd,
                                        // kode2 :vkeg,
                                        term: term, //search term
                                        page_limit: 10 // page size
                                    };
                                },
                                results: function (data, page) {
                                    return { results: data };
                                },
                            }
                    });

                }  

                if(data.form[i].type=='date'){
                    $('#'+data.form[i].id).datepicker({
                        // format: 'yyyy-mm-dd',
                    });                
                }                 
            }


        }
    });
}

function detail_data(kode,idData){
    // alert(kode);
    // alert(idData);
    if (idData == undefined) {
        idData = document.getElementById('dpakId').value;
        // idData2 = document.getElementById('dpakId').value;
    }

    var modul=document.getElementById('modul').value;

    //id-tombol
    var link1 = document.getElementById('linkPribadi');
    var link2 = document.getElementById('linkTempat');
    

    //id-form
    var form1 = document.getElementById('forminput');
    var form2 = document.getElementById('forminput2');
   

    //tombol-verifikasi
    var btVerif = document.getElementById('verifikasi');

    if (kode == 1) {
        // alert('1');
        link1.classList.add("active");
        link2.classList.remove("active");

        form1.style.display = "block";
         // form2.style.display = "block";
       

    }else if(kode == 2){
        // alert('2');
        link1.classList.remove("active");
        link2.classList.add("active");
        
   

        form2.style.display = "block";
        

    }

    form1.innerHTML = "";
    //form2.innerHTML = "";
    LoadDataTablesScripts(AllTables2(modul,kode,idData));
    document.getElementById('dpakId').value = idData;
    // LoadDataTablesScripts(AllTables2(modul,kode,idData2));
    // document.getElementById('dpakId').value = idData2;
}

function setFormData(idData,apiLangForm){

    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/penilaian/dpak/'+idData,
        dataType:"json",
        success:function(data){
            var isi=data.data;
            var key=Object.keys(isi);

            // console.log(key[0]);

            $.ajax({
                type: "GET",
                url: apiLangForm,
                dataType:"json",
                success:function(data2){
                       // console.log(data2);    

                    for (i = 0; i <= data2.form.length-1; i++) {


                        var nmfield=data2.form[i].id;
                        var iData='isi.'+nmfield;


                        if(data2.form[i].type=='text'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form[i].type=='hidden'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form[i].type=='textarea'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form[i].type=='label'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form[i].type=='batas'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form[i].type=='angka'){
                            document.getElementById(nmfield).value=eval(iData);                            
                        }else if(data2.form[i].type=='combo'){
                            $("#"+nmfield).val(eval(iData));
                        }else if(data2.form[i].type=='autocomplete'){
                            var kodecombo=eval(iData);    
                            console.log(kodecombo);
                            var comboapi=data2.form[i].comboapi;
                            setAutocompleteVal(comboapi,kodecombo,nmfield);
                        }else if(data2.form[i].type=='date'){
                            var data=eval(iData);
                            var res = data.split("-");
                            var hasil = res[1]+'/'+res[2]+'/'+res[0];
                            $("#"+nmfield).attr('value',hasil);
                        }    

                    }

                }
            });          
        }
    });          
}

function setGrid2(idData, kode){

    var kolom = [
        {
            "title": "id",
            "data": "id",
            "width": "5%",
            "sClass": "hidden",
        },
        {
            "title": "NO",
            "data": "id",
            // "width": "5%",
            "sClass": "center",
        },
        {
            "title": "DOKUMEN",
            "data": "dokumen",
            "width": "80%",
        },
        {
            "title": "PREVIEW",
            "data": "preview",
            "width": "20%",
            "sClass": "center",
        },

        // {
        //     "title": "CEKLIST",
        //     "data": "ceklist",
        //     "width": "10%",
        //     "sClass": "center",
        // },
    ];

    var table2=$('#tData2').DataTable({
        "sorting": [[ 0, "asc" ]],
        "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "ordering": false,
        "paging":   false,       
        "info"  :   false,
        "searching": false,
        "language": {
                        "lengthMenu": "",
                        "zeroRecords": "No records available",
                        "info": "Page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "SEARCH :  ",
                        "paginate": {"next": "","previous": ""}
        },
        "processing": false,
        "serverSide": true,
        "ajax": {
                    "url" : 'backend/public/api/admin/psb/piagam',
                    "dataType" : "json",
                    "data" : ({'dataId' : idData}),
                },
                        
        "columns": kolom,    
    });

    otable2 = table2;
}

function setGrid3(idData, kode){

    var kolom = [
        {
            "title": "id",
            "data": "id",
            "width": "5%",
            "sClass": "hidden",
        },
        {
            "title": "NO",
            "data": "id",
            // "width": "5%",
            "sClass": "center",
        },
        {
            "title": "DOKUMEN",
            "data": "dokumen",
            "width": "80%",
        },
        {
            "title": "PREVIEW",
            "data": "preview",
            "width": "10%",
            "sClass": "center",
        },

        {
            "title": "REVIEW",
            "data": "ceklist",
            "width": "10%",
            "sClass": "center",
        },
    ];

    var table3=$('#tData3').DataTable({
        "sorting": [[ 0, "asc" ]],
        "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "ordering": false,
        "paging":   false,       
        "info"  :   false,
        "searching": false,
        "language": {
                        "lengthMenu": "",
                        "zeroRecords": "No records available",
                        "info": "Page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "SEARCH :  ",
                        "paginate": {"next": "","previous": ""}
        },
        "processing": false,
        "serverSide": true,
        "ajax": {
                    "url" : 'backend/public/api/admin/psb/dokumen',
                    "dataType" : "json",
                    "data" : ({'dataId' : idData}),
                },
                        
        "columns": kolom,    
    });

    otable3 = table3;

}

function review(kode){
    var idData = document.getElementById('dataId').value;
    var ket = '';
    var postData=new Object();

    if (kode == 1) {
        var verif = document.getElementById('fotonisn_verif');
        if (verif.checked == true) {
            // alert('checked');
            postData['fotonisn_verif'] = 1;
            ket = "Dokumen Berhasil Diverifikasi";
        }else{
            postData['fotonisn_verif'] = 0;
            ket = "Proses Verifikasi Dibatalkan";
            // alert('unchecked');
        }
    }else if(kode == 2){
        var verif = document.getElementById('pasfoto_verif');
        if (verif.checked == true) {
            postData['pasfoto_verif'] = 1;
            ket = "Dokumen Berhasil Diverifikasi";
        }else{
            postData['pasfoto_verif'] = 0;
            ket = "Proses Verifikasi Dibatalkan";
        }
    }else if(kode == 3){
        var verif = document.getElementById('fotokk_verif');
        if (verif.checked == true) {
            postData['fotokk_verif'] = 1;
            ket = "Dokumen Berhasil Diverifikasi";
        }else{
            postData['fotokk_verif'] = 0;
            ket = "Proses Verifikasi Dibatalkan";
        }
    }else if(kode == 4){
        var verif = document.getElementById('fotoakta_verif');
        if (verif.checked == true) {
            postData['fotoakta_verif'] = 1;
            ket = "Dokumen Berhasil Diverifikasi";
        }else{
            postData['fotoakta_verif'] = 0;
            ket = "Proses Verifikasi Dibatalkan";
        }
    }else if(kode == 5){
        var verif = document.getElementById('kartukip_verif');
        if (verif.checked == true) {
            postData['kartukip_verif'] = 1;
            ket = "Dokumen Berhasil Diverifikasi";
        }else{
            postData['kartukip_verif'] = 0;
            ket = "Proses Verifikasi Dibatalkan";
        }
    }


    $.ajax({
        type: 'PUT',
        url: 'backend/public/api/admin/psb/datapendaftar/'+idData,
        dataType:"json",
        data:postData,
        success:function(data3){

            // if(method=='PUT'){

            alert(ket);
            cek_status();

            // }else{
            //     alert('Data Save');
            //     newdata();
            // }

            // ceklist_status();
            // if(data3.data.admVerified == 1){
            //     document.getElementById('status').value = 'Terverifikasi';
            // }else{
            //     document.getElementById('status').value = 'Tidak Terverifikasi';
            // }
            // $('#myModal').modal('hide');

            var oTableToUpdate =  $('#tData3').dataTable( { bRetrieve : true } );
                oTableToUpdate .fnDraw();                            
                //console.log(data3);
        }
    });
}
function save(){
    var modulx=document.getElementById('modul').value;
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        async: false,
        success:function(data){
            var apiForm=data[0].apiLangForm;
            var apiGrid=data[0].apiLangGrid;
            var apiData=data[0].apiData;    

            $.ajax({
                type: "GET",
                url: apiForm,
                dataType:"json",
                success:function(data2){
                    //console.log(data2);
                    var postData=new Object();
                    var fElement=data2.form;
                    var idData =document.getElementById(fElement[0].id).value 

                    for (i = 0; i <= fElement.length-1; i++) {

                        if(fElement[i].type!='file'){
                            postData[fElement[i].id]=document.getElementById(fElement[i].id).value;
                        }

                        if(fElement[i].type=='autocomplete'){
                            postData[fElement[i].id+'_hidden']=document.getElementById(fElement[i].id+'_hidden').value;                            
                        }
                    }

                    if(idData==''){
                        var method='POST';
                        var apiUrl=apiData;
                    }else{
                        var method='PUT';
                        var apiUrl=apiData+'/'+idData;
                    }

                    $.ajax({
                        type: method,
                        url: apiUrl,
                        dataType:"json",
                        data:postData,
                        success:function(data3){
                            // console.log(data3);
                            idimg=data3.data.id;

                            for (i = 0; i <= fElement.length-1; i++) {

                                if(fElement[i].type=='file'){
                                    var imgfile = document.getElementById(fElement[i].id);  
                                    formdata = new FormData(); 
                                    formdata.append(fElement[i].id,imgfile.files[0]);
                                    formdata.append(fElement[0].id,idimg);

                                    $.ajax({
                                        type: 'POST',
                                        url: 'backend/public/api/admin/arsip/upload',
                                        dataType:"json",
                                        async: false,
                                        data:formdata,
                                        processData: false,  
                                        contentType: false,  
                                        success:function(data4){
                                            console.log(data4);
                                        }
                                    });                                        
                                }
                            }


                            newdata();
                            var oTableToUpdate =  $('#tData').dataTable( { bRetrieve : true } );
                                oTableToUpdate .fnDraw();                            
                                //console.log(data3);
                        }
                    });
                }                
            });    

           
        }
    });      
}
function newdata(){
    var modulx=document.getElementById('modul').value;

    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        async: false,
        success:function(data){
            var apiForm=data[0].apiLangForm;
            var apiGrid=data[0].apiLangGrid;
            var apiData=data[0].apiData;    

            $.ajax({
                type: "GET",
                url: apiForm,
                dataType:"json",
                success:function(data2){
                    var fElement=data2.form;

                    for (i = 0; i <= fElement.length-1; i++) {

                        if(fElement[i].type=='autocomplete'){
                            $("#"+fElement[i].id).select2("data", { id: '', text:''});
                        }else{
                            document.getElementById(fElement[i].id).value='';                            
                        }
    
                    }

                }                
            });               
        }
    });      
}

function deleteData(){


    var modulx=document.getElementById('modul').value;
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        async: false,
        success:function(data){
            var apiForm=data[0].apiLangForm;
            var apiGrid=data[0].apiLangGrid;
            var apiData=data[0].apiData;    


            $.ajax({
                type: "GET",
                url: apiForm,
                dataType:"json",
                success:function(data2){
                    //console.log(data2);
                    var postData=new Object();
                    var fElement=data2.form;
                    var idData =document.getElementById(fElement[0].id).value 

                    if(idData==''){
                        alert('Data Belum Dipilih !!!');
                    }else if(modulx == 'User') {
                        postData['id']=idData;
                        var param2='?data='+JSON.stringify(postData);
                        var apiUrl="backend/public/api/admin/master/deleteuser"+param2;

                        if(confirm("Anda Akan Menghapus Data Ini?")){
                            $.ajax({
                                type:"GET",
                                url:apiUrl,
                                data: ({modul:modulx}),
                                dataType:"json",
                                success:function(data3){

                                    newdata();
                                    var oTableToUpdate =  $('#tData').dataTable( { bRetrieve : true } );
                                        oTableToUpdate .fnDraw();                            
                                    //console.log(data3);
                                }
                            });
                        }
                    }else{
                        var method='DELETE';
                        var apiUrl=apiData+'/'+idData;
                        // alert(idData);

                        if(confirm("Anda Akan Menghapus Data Ini?")){
                            $.ajax({
                                type: method,
                                url: apiUrl,
                                dataType:"json",
                                data:postData,
                                success:function(data3){

                                    newdata();
                                    var oTableToUpdate =  $('#tData').dataTable( { bRetrieve : true } );
                                        oTableToUpdate .fnDraw();                            
                                    //console.log(data3);
                                }
                            });
                        }
                    }


                }                
            });    

           
        }
    });      

}

function cek_status(){
    var id = document.getElementById('dataId').value;
    var fotonisn = document.getElementById('fotonisn_verif').checked;
    var pasfoto = document.getElementById('pasfoto_verif').checked;
    var fotokk = document.getElementById('fotokk_verif').checked;
    var fotoakta = document.getElementById('fotoakta_verif').checked;
    var kartukip = document.getElementById('kartukip_verif').checked;

    if (fotonisn == true && pasfoto == true && fotokk == true && fotoakta == true && kartukip == true) {
        $.ajax({
            type: 'PUT',
            url: 'backend/public/api/admin/psb/datapendaftar/'+id,
            dataType:"json",
            async: false,
            // data: postData,
            success:function(data3){

                // console.log(data3);
                if(data3.data.dokumen_verif == 1){
                    alert('Seluruh Dokumen Telah Terverifikasi');
                    document.getElementById('status').value = 'Terverifikasi';
                }else{
                    document.getElementById('status').value = 'Tidak Terverifikasi';
                }

                var oTableToUpdate =  $('#tData3').dataTable( { bRetrieve : true } );
                    oTableToUpdate .fnDraw();                            
                    //console.log(data3);
            }
        });
        document.getElementById('status_verifikasi').disabled = false;
    }else{
        document.getElementById('status_verifikasi').disabled = true;
    }
}

function ubah_status() {
    var id = document.getElementById('dataId').value;
    var postData = new Object();

    // alert(id);

    postData['id']          = id;
    postData['dokumen_verif'] = 1;

    $.ajax({
        type: 'PUT',
        url: 'backend/public/api/admin/psb/datapendaftar/'+id,
        dataType:"json",
        async: false,
        data: postData,
        success:function(data3){

            // console.log(data3);
            if(data3.data.dokumen_verif == 1){
                alert('Seluruh Dokumen Telah Terverifikasi');
                document.getElementById('status').value = 'Terverifikasi';
            }else{
                document.getElementById('status').value = 'Tidak Terverifikasi';
            }

            var oTableToUpdate =  $('#tData3').dataTable( { bRetrieve : true } );
                oTableToUpdate .fnDraw();                            
                //console.log(data3);
        }
    });
}

function loadExcel(){

    // alert('test');
    var modulx=document.getElementById('modul').value;

    var kelurahan = document.getElementById('filterkelurahan_hidden').value;
    var kecamatan = document.getElementById('filterkecamatan_hidden').value;
    var kabupaten = document.getElementById('filterkabupaten_hidden').value;
    var provinsi = document.getElementById('filterprovinsi_hidden').value;


    var postData=new Object();
        postData['kel']=kelurahan;
        postData['kec']=kecamatan;
        postData['kab']=kabupaten;
        postData['prov']=provinsi;
        // postData['cbulan']=cbulan;

    document.getElementById('filterkelurahan').value='';
    document.getElementById('filterkelurahan_hidden').value='';
    document.getElementById('filterkecamatan').value='';
    document.getElementById('filterkecamatan_hidden').value='';
    document.getElementById('filterkabupaten').value='';
    document.getElementById('filterkabupaten_hidden').value='';
    document.getElementById('filterprovinsi').value='';
    document.getElementById('filterprovinsi_hidden').value='';
        
    var param='?data='+JSON.stringify(postData);
    var url="laporan/datasiswa.php";                    
    window.open(url+param, '_blank');


}
function simpan() {
    if(document.getElementById('isProcessing').value == 1){
        alert('Maaf Data sedang diproses.');
        return;
    }
    
    document.getElementById('isProcessing').value = 1;

    var postData             = new Object();
    var idxDetail            = document.getElementById('dpakId').value;

    var dpakJan1                 = document.getElementById('dpakJan1').value;
    var dpakJan2       = document.getElementById('dpakJan2').value;
    var dpakJan3            = document.getElementById('dpakJan3').value;
    var dpakJan4           = document.getElementById('dpakJan4').value;
    var dpakJan5                = document.getElementById('dpakJan5').value;
    // var nopenerimaangudang   = document.getElementById('nopenerimaangudang').value;
    // var idskpd               = $('#idskpd').val();
    // var supplier             = document.getElementById('suplier_hidden').value;
    // var ppn                  = document.getElementById('ppn').value;
    // var tgl_pengadaan        = document.getElementById('tglterima').value;

         postData['dpakJan1']                 = dpakJan1;
        postData['dpakJan2']        = dpakJan2;
        postData['dpakJan3']            = dpakJan3;
        postData['dpakJan4']           = dpakJan4;
        postData['dpakJan5']   = dpakJan5;
        // postData['supplier']             = supplier;
        // postData['jenis_ppn']            = ppn;



    for (i = 1; i <= idxDetail - 1; i++) {
        if (document.getElementById('jadwalkbm' + i) != null) {

            var jadwalkbm    = document.getElementById('jadwalkbm' + i).value;
            var kalender    = document.getElementById('kalender' + i).value;
            var pekanefektif  = document.getElementById('pekanefektif' + i).value;
            var analisa     = document.getElementById('analisa' + i).value;
            var distribusi     = document.getElementById('distribusi' + i).value;
            var analisis = document.getElementById('analisis' + i).value;
            var ki   = document.getElementById('ki' + i).value;

            var jadwalkbm            = document.getElementById('jadwalkbm' + i).value ;
            var kalender             = document.getElementById('kalender' + i).value ;
            var pekanefektif         = document.getElementById('pekanefektif' + i).value ;
            var analisa              = document.getElementById('analisa' + i).value ;
            var distribusi           = document.getElementById('distribusi' + i).value ;
            var analisis             = document.getElementById('analisis' + i).value ;

            var ki                          = document.getElementById('ki' + i).value ;
            var kd                          = document.getElementById('kd' + i).value ;
            var mp                          = document.getElementById('mp' + i).value ;
            var kp                          = document.getElementById('kp' + i).value ;
            var indika                      = document.getElementById('indika' + i).value ;
            var nilai                       = document.getElementById('nilai' + i).value ;
            var alokasi                     = document.getElementById('alokasi' + i).value ;
            var sumber                      = document.getElementById('sumber' + i).value ;

            var alokasiwaktu                        = document.getElementById('alokasiwaktu' + i).value ;
            var komin                               = document.getElementById('komin' + i).value ;
            var komdas                              = document.getElementById('komdas' + i).value ;
            var indikatorpembelajaran               = document.getElementById('indikatorpembelajaran' + i).value ;
            var tujuanpel                           = document.getElementById('tujuanpel' + i).value ;
            var mapel                               = document.getElementById('mapel' + i).value ;
            var metode                              = document.getElementById('metode' + i).value ;
            var kegiatan                            = document.getElementById('kegiatan' + i).value ;
            var sumberbelajar                       = document.getElementById('sumberbelajar' + i).value ;
            var bahanbelajar                        = document.getElementById('bahanbelajar' + i).value ;
            var alatbelajar                         = document.getElementById('alatbelajar' + i).value ;
            var penilaian                           = document.getElementById('penilaian'+ i).value ;

            var materipembelajaran                          = document.getElementById('materipembelajaran'+ i).value ;
            var presensi                                    = document.getElementById('presensi'+ i).value ;
            var catatan                                     = document.getElementById('catatan'+ i).value ;
            var bentukkbm                                   = document.getElementById('bentukkbm'+ i).value ;

            var butirsoal                                                 = document.getElementById('butirsoal'+ i).value ;
            var pelaksanaanpenilaian                                      = document.getElementById('pelaksanaanpenilaian'+ i).value ;
            var hasilpenilaian                                            = document.getElementById('hasilpenilaian'+ i).value ;
            var atl                                                       = document.getElementById('atl'+ i).value ;

            postData['id_barang' + i] = kode;
            postData['nama_barang' + i] = nama;
            postData['satuan_besar' + i] = satuan;
            postData['keterangan' + i]  = ket;
            postData['distribusi' + i] = qty;
            postData['harga' + i] = hrgbeli;
            postData['total' + i] = total;

            postData['jadwalkbm'+ i]                       = jadwalkbm;
            postData['kalender'+ i]                        = kalender;
            postData['pekanefektif'+ i]                    = pekanefektif;
            postData['analisa'+ i]                         = analisa;
            postData['distribusi'+ i]                       = distribusi;
            postData['analisis'+ i]                        = analisis;

            postData['ki'+ i]                              = ki;
            postData['kd'+ i]                              = kd;
            postData['mp'+ i]                              = mp;
            postData['kp'+ i]                              = kp;
            postData['indika'+ i]                          = indika;
            postData['nilai'+ i]                           = nilai;
            postData['alokasi'+ i]                         = alokasi;
            postData['sumber'+ i]                          = sumber;

            postData['alokasiwaktu'+ i]                    = alokasiwaktu;
            postData['komin'+ i]                           = komin;
            postData['komdas'+ i]                          = komdas;
            postData['indikatorpembelajaran'+ i]           = indikatorpembelajaran;
            postData['tujuanpel'+ i]                       = tujuanpel;
            postData['mapel'+ i]                           = mapel;
            postData['metode'+ i]                          = metode;
            postData['kegiatan']                        = kegiatan;
            postData['sumberbelajar'+ i]                   = sumberbelajar;
            postData['bahanbelajar'+ i]                    = bahanbelajar;
            postData['alatbelajar'+ i]                     = alatbelajar;
            postData['penilaian'+ i]                       = penilaian;

            postData['materipembelajaran'+ i]              = materipembelajaran;
            postData['presensi'+ i]                        = presensi;
            postData['catatan'+ i]                         = catatan;
            postData['bentukkbm'+ i]                       = bentukkbm;

            postData['butirsoal'+ i]                       = butirsoal;
            postData['pelaksanaanpenilaian'+ i]            = pelaksanaanpenilaian;
            postData['hasilpenilaian'+ i]                  = hasilpenilaian;
            postData['atl'+ i]                             = atl;

        }
    }


    // if (idxDetail > 1) {
    //     if (confirm("Sudahkah anda benar ada di lokasi ?")) {
    //         //confirm("isinya nota= "+nota);
    //         //confirm(postData['nota']);

    //         $.ajax({
    //             type: "POST",
    //             url: "backend/public/api/admin/penilaian/dpak",
    //             data: postData,
    //             dataType: "json",
    //             success: function (data) {
    //                  alert("Terimakasih Telah Absen Masuk Hari ini");

    //                 document.getElementById('isProcessing').value = 0;


    //                 // document.getElementById('masuk').onclick = function () {
    //                 //     alert('Maaf anda sudah absen masuk hari ini');
    //                 //     this.onclick = false;
    //                 // }


    //             },
    //             error: function (XMLHttpRequest, textStatus, errorThrown) {

    //                 document.getElementById('isProcessing').value = 0;
    //                 alert(textStatus + " : " + errorThrown + " -> GAGAL DISIMPAN !!!");
    //             }
    //         });
    //     }else{
    //                         document.getElementById('isProcessing').value = 0;
    //         }
    // }else{
    //     document.getElementById('isProcessing').value = 1;
    //     alert("1. Anda Sudah Absen Hari ini");
    // }

     if (idxDetail > 1) {
        if (confirm("Anda Akan Simpan Transaksi ?")) {
            //confirm("isinya nota= "+nota);
            //confirm(postData['nota']);

            $.ajax({
                type: "POST",
                url: "backend/public/api/admin/penilaian/dpak",
                data: postData,
                dataType: "json",
                success: function (data) {
                    //confirm(data['stokhNota']);
                    //confirm(data['nota']);
                    //confirm(data);
                    alert("Terimakasih Telah Absen Masuk Hari ini");

                    document.getElementById('isProcessing').value = 0;

                    oTable.clear().draw();
                    $('#tData').dataTable().fnDestroy();
                    setupTabel();

                   

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {

                    document.getElementById('isProcessing').value = 0;
                    alert(textStatus + " : " + errorThrown + " -> GAGAL DISIMPAN !!!");
                }
            });
        }else{
            document.getElementById('isProcessing').value = 0;
        }
    }else{
        document.getElementById('isProcessing').value = 0;
    }


}