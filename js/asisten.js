
function combodokter(){
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/master/dokterforcombo",
        dataType:"json",
        success:function(datacombo){            
            // console.log(datacombo);

            var result='&nbsp;<br>';


            result +='<div class="form-group">';
            result +='<table width="100%"><tr><td width="13%">';
            result +='    <label class="control-label">DOKTER</label>';
            result +='</td><td>';
            result +='    <select class="form-control" name="pilihdokter" id="pilihdokter" onchange="getPasien(this.value)">';
            result +='        <option></option>';

            for(j=0;j<=datacombo.length-1;j++){
                result +='<option value="'+datacombo[j].kode+'">'+datacombo[j].nama+'</option>';
            }

            result +='    </select>';
            result +='</td></tr></table>';
            result +='</div>';

            $('#cdokter').html(result);


        }
    });          
}

function getPasien(idDok){

    $.ajax({
        type: "GET",
        url: "backend/public/lang/admin/dokter/asisten/grid",
        dataType:"json",
        success:function(data){

            $('#tData').dataTable().fnDestroy();
            // tableMaster('Asistendokter');
            setGrid(data.kolom,'backend/public/api/admin/dokter/asisten','backend/public/lang/admin/dokter/asisten/form',idDok);
        }
    });          

}


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
            setGrid(data.kolom,apiData,apiLangForm,'');
        }
    });          
}

function setGrid(kolom,apiData,apiLangForm,idDokter){
	var table=$('#tData').DataTable({
		"sorting": [[ 0, "asc" ]],
		"dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
		"paginationType": "bootstrap",
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
                    "data": ({'iddokter':idDokter}),
        			"dataType" : "json",
		        },
				        
        "columns": kolom,    
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
                            // var hasil = res[1]+'/'+res[2]+'/'+res[0];
                            // $("#"+nmfield).attr('value',hasil);
                            var hasil = res[2]+'-'+res[1]+'-'+res[0];
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
                    result +='<div class="form-group">';
                    result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" />';
                    result +='</div>';
                }
                
                if(data.form[i].type=='text'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
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
                    }else{
                        var method='DELETE';
                        var apiUrl=apiData+'/'+idData;

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

    var namax=document.getElementById('rawatNama').value;

    if(namax==''){
        return;
    }

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
