
function tableMaster(modulx){
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        success:function(data){
            
            getLangGrid(data[0].apiLangGrid,data[0].apiData,data[0].apiLangForm);
            getLangForm(data[0].apiLangForm);
            
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

	var table=$('#tData').DataTable({
		"sorting": [[ 0, "asc" ]],
		"dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
		"paginationType": "bootstrap",
		"paging":   true,		
        "info"  :   true,
        "ordering": false,
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
        			"dataType" : "json",
		        },
				        
        "columns": kolom,
        // "aoColumnDefs": [
        //     {'bSortable': false, 'aTargets': [1, 2, 3, 4]},
        // ],
	});


    $('#tData tbody').on('click', 'tr', function () {
        // var data = $(this).parents('tr').context.cells;
        // var idData=data[0].innerText; 
        var idData = $(this).find('td:eq(0)').text();
        setFormData(apiData,idData,apiLangForm);
    })

}

function setFormData(apiData,idData,apiLangForm){

    $.ajax({
        type: "GET",
        url: apiData+'/'+idData,
        dataType:"json",
        success:function(data){
            // console.log(data);
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
                        }else if(data2.form[i].type=='angka'){
                            document.getElementById(nmfield).value=eval(iData);                            
                        }else if(data2.form[i].type=='hidden'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form[i].type=='textarea'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form[i].type=='combo'){
                            $("#"+nmfield).val(eval(iData));
                        }else if(data2.form[i].type=='autocomplete'){
                            var kodecombo=eval(iData);    
                            var comboapi=data2.form[i].comboapi;
                            setAutocompleteVal(comboapi,kodecombo,nmfield);
                        }else if(data2.form[i].type=='date'){
                            var dataxx=eval(iData);    
                            var res = dataxx.split("-");
                            var hasil = res[1]+'/'+res[2]+'/'+res[0];
                            // $("#"+nmfield).attr('value',hasil);
                            document.getElementById(nmfield).value=hasil;
                            
                        }    

                    }
                }
            });          
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


function getLangForm(apiLang){
    $.ajax({
        type: "GET",
        url: apiLang,
        dataType:"json",
        success:function(data){
            //console.log(data);
            var result="";
            for (i = 0; i <= data.form.length-1; i++) {

                if(data.form[i].readonly=='1'){
                    var ro='readonly';
                }else{
                    var ro='';
                }


                if(data.form[i].type=='date'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' placeholder="Pilih Tanggal" />';
                    result +='</div>';
                }


                if(data.form[i].type=='hidden'){
                    if(data.form[i].id=='roleStatus'){
                            result +='<div class="form-group">';
                            result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" value="2" />';
                            result +='</div>';
                    }
                    else{
                            result +='<div class="form-group">';
                            result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" />';
                            result +='</div>';
                    }
                }
                
                if(data.form[i].type=='text'){
                    if(data.form[i].search){

                        result +='<div class="'+data.form[i].lebar+'">';
                        result +='<div class="form-group">';
                        result +='     <label class="control-label">'+data.form[i].name+'</label>';
                        result +='     <table><tr><td>';
                        result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                        result +='     </td><td>';
                        result +='     <button type="button" class="btn btn-primary btn-block" onclick="search(\''+data.form[i].searchlink+'\')" style="margin-left: 15px;margin-bottom: 4px;"><i class="fa fa-search"></i></button>';
                        result +='     </td></tr></table>';
                        result +='</div>';
                        result +='</div>';

                    }else{
                        result +='<div class="form-group">';
                        result +='     <label class="control-label">'+data.form[i].name+'</label>';
                        result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                        result +='</div>';
                    }
                }


                if(data.form[i].type=='angka'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" style="text-align:right" name="'+data.form[i].id+'" id="'+data.form[i].id+'"  '+ro+' />';
                    result +='</div>';

                }


                if(data.form[i].type=='textarea'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <textarea class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' row="'+data.form[i].row+'" style="height:'+data.form[i].height+'"/></textarea>';
                    result +='</div>';
                }

                if(data.form[i].type=='password'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="password" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
                }

                if(data.form[i].type=='combo'){
                    var comboapi=data.form[i].comboapi;

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
                }


                if(data.form[i].type=='autocomplete'){
                    var comboapi=data.form[i].comboapi;

                    result +='<div class="form-group">';
                    result +='    <label class="control-label">'+data.form[i].name+'</label>';
                    result +='    <input type="hidden" class="populate placeholder" name="'+data.form[i].id+'" id="'+data.form[i].id+'" >';
                    result +='    <input type="hidden" name="'+data.form[i].id+'_hidden" id="'+data.form[i].id+'_hidden" >';
                    result +='</div>';

                }

            }

            $('#forminput').html(result);


            for (i = 0; i <= data.form.length-1; i++) {


                if(data.form[i].type=='angka'){
                    $('#'+data.form[i].id).keypress(function(){
                      return(numbersonly(event));
                    });
                }    


                if(data.form[i].type=='autocomplete'){
                    var comboapi=data.form[i].comboapi;

                    $('#'+data.form[i].id)
                        .on("change", function(e) {
                              var id=e.added.id;
                              var txt=e.added.nama;  
                              var nmhidden=this.id+'_hidden';
                              //console.log(nmhidden);                              
                              $('#'+nmhidden).attr('value',txt);
                        })      
                        .select2({

                        placeholder: "Pilih Data", 
                        ajax: {
                                url: comboapi,
                                dataType: 'json',
                                quietMillis: 100,
                                data: function (term, page) {
                                    return {
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
                        format: 'dd/mm/yyyy',
                    });                
                }                 
            }




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

function save(){
    var modulx=document.getElementById('modul').value;
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        async: false,
        success:function(data){
            // console.log(data);
            var apiForm=data[0].apiLangForm;
            var apiGrid=data[0].apiLangGrid;
            var apiData=data[0].apiData;    

            $.ajax({
                type: "GET",
                url: apiForm,
                dataType:"json",
                success:function(data2){
                    // console.log(data2);
                    var postData=new Object();
                    var fElement=data2.form;
                    var idData =document.getElementById(fElement[0].id).value 
                    // alert(idData);

                    for (i = 0; i <= fElement.length-1; i++) {
                        postData[fElement[i].id]=document.getElementById(fElement[i].id).value;
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

                    // console.log(postData);

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
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert(textStatus+" : " + errorThrown+" -> Kode Sudah Terpakai"); 
                        } 
                    });
                }                
            });    

           
        }
    });      
}


function cetakanggota(idpasien){

    if(idpasien==''){
        return;
    }
    
    var param='?id='+idpasien;
    var url="backend/public/api/admin/report/kartuanggota";                    
    window.open(url+param, '_blank');
}

// function initGrid(apiData,tabel,close){
//     var postData=new Object();
//         // postData['jenis']=jenis;
//         // postData['kode']=kode;

//         var res='<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="tabelData" name="tabelData">';
//         var kolom=[];
//         var lgn =[];
//         var label=[];
        
//         res +='<thead>';
//         res +='  <tr>';     
//         res +='  <td>NO</td>';     
//         res +='  <td>KODE</td>';     
//         res +='  <td>NAMA</td>';     
//         res +='  </tr>';     
//         res +='</thead>';     
//         res +='<tbody>';     

//         var data=[];
//         $.ajax({
//             type: "GET",
//             url: apiData,
//             dataType:"json",
//             data:postData,
//             async:false,
//             success:function(datax){

//                 if(datax.metaData.code!=200){
//                     // alert(datax.metaData.message);
//                 }else{
//                     // if(field=='bpjsPpkRujukan'){
//                     //     var data=datax.response.faskes;
//                     // }else if(field=='bpjsPoli'){
//                     //     var data=datax.response.poli;                        
//                     // }else if(field=='bpjsDiagnosaAwal'){
//                     //     var data=datax.response.diagnosa;                        
//                     // }else if(field=='bpjsLakaProp'){
//                     //     var data=datax.response.list;                        
//                     // }else if(field=='bpjsLakaKab'){
//                     //     var data=datax.response.list;                        
//                     // }else if(field=='bpjsLakaKec'){
//                     //     var data=datax.response.list;                        
//                     // }else if(field=='bpjsDokterDpjp'){
//                     //     var data=datax.response.list;                        
//                     // }
//                     for(i=0;i<=datax.response.count-1;i++){
//                         res +='<tr>';
//                         res +='<td>'+(i+1)+'</td>';
//                         res +='<td>'+datax.response.list[i].kdDokter+'</td>';
//                         res +='<td>'+datax.response.list[i].nmDokter+'</td>';
//                         res +='</tr>';
//                     }
//                 }

//             }
//         });

//         res +='</tbody>';
//         res +='</table>';
//         $('#'+tabel).html(res);
//         $('#tabelData tbody').on('click', 'tr', function () {
//             var data = $(this).find('td:eq(1)').text();
//             document.getElementById('dokKdPcare').value=data;
//             $('#'+close).click();
//         })

// }

// function initGrid2(apiData,tabel,close){
//     var postData=new Object();
//         // postData['jenis']=jenis;
//         // postData['kode']=kode;

//         var res='<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="tabelData2" name="tabelData2">';
//         var kolom=[];
//         var lgn =[];
//         var label=[];
        
//         res +='<thead>';
//         res +='  <tr>';     
//         res +='  <td>NO</td>';     
//         res +='  <td>KODE</td>';     
//         res +='  <td>NAMA</td>';     
//         res +='  </tr>';     
//         res +='</thead>';     
//         res +='<tbody>';     

//         var data=[];
//         $.ajax({
//             type: "GET",
//             url: apiData,
//             dataType:"json",
//             data:postData,
//             async:false,
//             success:function(datax){

//                 if(datax.metaData.code!=200){
//                     alert(datax.metaData.message);
//                 }else{
//                     // if(field=='bpjsPpkRujukan'){
//                     //     var data=datax.response.faskes;
//                     // }else if(field=='bpjsPoli'){
//                     //     var data=datax.response.poli;                        
//                     // }else if(field=='bpjsDiagnosaAwal'){
//                     //     var data=datax.response.diagnosa;                        
//                     // }else if(field=='bpjsLakaProp'){
//                     //     var data=datax.response.list;                        
//                     // }else if(field=='bpjsLakaKab'){
//                     //     var data=datax.response.list;                        
//                     // }else if(field=='bpjsLakaKec'){
//                     //     var data=datax.response.list;                        
//                     // }else if(field=='bpjsDokterDpjp'){
//                     //     var data=datax.response.list;                        
//                     // }
//                     for(i=0;i<=datax.response.count-1;i++){
//                         if (datax.response.list[i].kdPoli !== "undefined") {
//                             res +='<tr>';
//                             res +='<td>'+(i+1)+'</td>';
//                             res +='<td>'+datax.response.list[i].kdPoli+'</td>';
//                             res +='<td>'+datax.response.list[i].nmPoli+'</td>';
//                             res +='</tr>';
//                         }
//                     }
//                 }

//             }
//         });

//         res +='</tbody>';
//         res +='</table>';
//         $('#'+tabel).html(res);
//         $('#tabelData2 tbody').on('click', 'tr', function () {
//             var data = $(this).find('td:eq(1)').text();
//             document.getElementById('ruangKdPcare').value=data;
//             $('#'+close).click();
//         })

// }

// function search(ref){
//     if(ref=='reffaskes'){
//         $('#modalppk').click();
//     }else if(ref=='refpoli'){
//         $('#modalpoli').click();
//         refreshPoli();      
//     }else if(ref=='refdiagnosa'){
//         $('#modaldiagnosa').click();
//     }else if(ref=='refprov'){
//         $('#modalprov').click();
//         setTimeout(function(){ 
//             refreshProv(); 
//         }, 200);
        
//     }else if(ref=='refkab'){
//         $('#modalkab').click();        
//     }else if(ref=='refkec'){
//         $('#modalkec').click();        
//     }else if(ref=='refdokter'){
//         $('#modaldokter').click();  
//         refreshDokter();      
//     }

// }

// function refreshDokter(){
//     // var nama=document.getElementById('').value;
//     var apiData='bpjs/refdokter.php';  
//     // var kode='';
//     // var jenis=1;
//     initGrid(apiData,'tDataList','btmodalclose');                       
// }


// function refreshPoli(){
//     // var nama=document.getElementById('').value;
//     var apiData='bpjs/refpoli.php';  
//     // var kode='';
//     // var jenis=1;
//     initGrid2(apiData,'tDataList2','btmodalclose2');                       
// }