
function tableMaster(modulx){
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        success:function(data){            
            getLangForm(data[0].apiLangForm);
        }
    });      
}


function setFormData(){

    $.ajax({
        type: "GET",
        url: "backend/public/getSession",
        dataType:"json",
        async:false,
        success:function(data){            
            document.getElementById('ausrId').value=data.userIdAdmin;
            document.getElementById('ausrUsername').value=data.userNameAdmin;
            document.getElementById('ausrName').value=data.userNameAdminLong;
            document.getElementById('ausrPassword').value='';
            document.getElementById('ausrPassword2').value='';


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


                if(data.form[i].type=='file'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="file" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
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


        setFormData();    

        }
    });              
}

function save(){

    var user='';
    $.ajax({
        type: "GET",
        url: "backend/public/getSession",
        dataType:"json",
        async:false,
        success:function(data){            
            user=data.userName;
        }
    });          

    var pass1=document.getElementById('ausrPassword').value;
    var pass2=document.getElementById('ausrPassword2').value;

    if(pass1=='' || pass2==''){
        alert('Password Tidak Boleh Kosong');
        return;
    }

    if(pass1.length<3 && pass2.length<3){
        alert('Panjang Password Minimal 3 Karakter');
        return;
    }

    if(pass1!=pass2){
        alert('Password Tidak Sama');
        return;
    }


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
                            alert('Password Berhasil Diganti');
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

