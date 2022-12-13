function setTanggalLahir() { 
    var dd  = $('#DD').val();
    if( dd.length == 1) {
        dd  = '0'+dd;
    }
    var mm  = $('#MM').val();
    if( mm.length == 1) {
        mm  = '0'+mm;
    }
    var yy  = $('#YYYY').val();
    var tgl = mm+'/'+dd+'/'+yy;
    $('#rawatLahir').val(tgl);
}

function tableMaster(modulx){
    $.ajax({
        type: "GET",
        url : "backend/public/api/admin/config/getapimenu",
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
        url : apiLang,
        dataType:"json",
        success:function(data){
            setGrid(data.kolom,apiData,apiLangForm);
            setGrid2("","","","");
            // setGrid3();
            // setGrid4();
            // setGrid5();
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
    });




    $('#tData tbody').on('click', 'tr', function () {
        // var data = $(this).parents('tr').context.cells;
        // var idData=data[0].innerText;
        var idData = $(this).find('td:eq(0)').text();
        setFormData(apiData,idData,apiLangForm);
        // console.log(apiData);
    })

}


// function setGrid2(){

//     var kolom=[];

//     $.ajax({
//         type: "GET",
//         url: 'backend/public/lang/admin/bpjs/peserta/grid',
//         dataType:"json",
//         async:false,
//         success:function(data){
//             kolom=data.kolom;
//         }
//     });

//     var table=$('#tData2').DataTable({
//         "sorting": [[ 0, "asc" ]],
//         "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
//         "paginationType": "bootstrap",
//         "paging":   true,
//         "info"  :   true,
//         "language": {
//                         "lengthMenu": "",
//                         "zeroRecords": "No records available",
//                         "info": "Page _PAGE_ of _PAGES_",
//                         "infoEmpty": "No records available",
//                         "infoFiltered": "(filtered from _MAX_ total records)",
//                         "search": "SEARCH :  ",
//                         "paginate": {"next": "","previous": ""}
//         },
//         "processing": false,
//         "serverSide": true,
//         "ajax": {
//                     "url" : "backend/public/api/admin/bpjs/peserta",

//                     "dataType" : "json",
//                 },

//         "columns": kolom,
//     });


//     $('#tData2 tbody').on('click', 'tr', function () {
//         // var data = $(this).parents('tr').context.cells;
//         // var idData=data[0].innerText;
//         var idData = $(this).find('td:eq(0)').text();

//         // setFormData2('backend/public/api/admin/bpjs/peserta',idData,'backend/public/lang/admin/bpjs/peserta/form');
//         $('#btmodal').click();

//     })

// }

// function setGrid2search(norm,nama,alamat,tgllahir){

//     var kolom=[];

//     $.ajax({
//         type: "GET",
//         url: 'backend/public/lang/admin/bpjs/peserta/grid',
//         dataType:"json",
//         async:false,
//         success:function(data){
//             kolom=data.kolom;
//         }
//     });

//     var table=$('#tData2').DataTable({
//         "sorting": [[ 0, "asc" ]],
//         "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
//         "paginationType": "bootstrap",
//         "paging":   true,
//         "info"  :   true,
//         "language": {
//                         "lengthMenu": "",
//                         "zeroRecords": "No records available",
//                         "info": "Page _PAGE_ of _PAGES_",
//                         "infoEmpty": "No records available",
//                         "infoFiltered": "(filtered from _MAX_ total records)",
//                         "search": "SEARCH :  ",
//                         "paginate": {"next": "","previous": ""}
//         },
//         "processing": false,
//         "serverSide": true,
//         "ajax": {
//                     "url" : "backend/public/api/admin/bpjs/peserta",
//                     "data": ({'norm':norm,'nama':nama,'alamat':alamat,'tgllahir':tgllahir}),
//                     "dataType" : "json",
//                 },

//         "columns": kolom,
//     });


//     $('#tData2 tbody').on('click', 'tr', function () {
//         // var data = $(this).parents('tr').context.cells;
//         // var idData=data[0].innerText;
//         var idData = $(this).find('td:eq(0)').text();

//         // setFormData2('backend/public/api/admin/bpjs/peserta',idData,'backend/public/lang/admin/bpjs/peserta/form');
//         $('#btmodal').click();

//     })

// }



function setFormData2(apiData,idData,apiLangForm){
    $.ajax({
        type: "GET",
        url : apiData+'/'+idData,
        dataType:"json",
        success:function(data){
            var isi=data.data;
            var key=Object.keys(isi);

            $.ajax({
                type: "GET",
                url: apiLangForm,
                dataType:"json",
                success:function(data2){
                       console.log(data2);

                    for (var i = 0; i <= data2.form.length-1; i++) {

                        var nmfield=data2.form[i].id;
                        var iData='isi.'+nmfield;
                        var nmfield2='';


                        if(data2.form[i].type=='text'){
                            if ( data2.form[i].id != 'YYYY' ) { 
                                if(typeof(eval(iData))=='undefined'){
                                    document.getElementById(nmfield2).value=''; 
                                }else{
                                    document.getElementById(nmfield2).value=eval(iData); 
                                }
                            }

                        }else if(data2.form[i].type=='angka'){
                            document.getElementById(nmfield2).value=eval(iData);
                        }else if(data2.form[i].type=='hidden'){
                            // document.getElementById(nmfield2).value=eval(iData);

                            //alert(data2.form[i].id);
                            if ( nmfield2 == 'rawatLahir' ) {
                                var nilai   = eval(iData);
                                var dd      = nilai.substr(8, 2);
                                var mm      = nilai.substr(5, 2);
                                var yy      = nilai.substr(0, 4);
                                var tgl     = mm + '/' + dd + '/' + yy;
                                // alert(tgl);
                                $('#DD').val(nilai.substr(8, 2));
                                $('#MM').val(nilai.substr(5, 2));
                                $('#YYYY').val(nilai.substr(0, 4));
                                $('#'+nmfield2).val(tgl);
                            } else {
                                document.getElementById(nmfield2).value=eval(iData);
                            }

                        }else if(data2.form[i].type=='textarea'){
                            document.getElementById(nmfield2).value=eval(iData);
                        }else if(data2.form[i].type=='combo'){
                            // $("#"+nmfield2).val(eval(iData));
                            document.getElementById(nmfield2).value=eval(iData);
                        }else if(data2.form[i].type=='autocomplete'){
                            var kodecombo=eval(iData);
                            var comboapi=data2.form[i].comboapi;
                            if(nmfield2=='rawatKel'){
                                setAlamat(kodecombo);
                            }
                            // setAutocompleteVal(comboapi,kodecombo,nmfield2);
                        }else if(data2.form[i].type=='date'){
                           var dataxx=eval(iData);
                            var res = dataxx.split("-");
                            var hasil = res[2]+'-'+res[1]+'-'+res[0];
                            document.getElementById(nmfield2).value=hasil;

                            //document.getElementById("rawatTglDaftar").value="20/07/2018";
                           // document.getElementById(rawatTglDaftar).value='';

                        }

                    }
                }
            });
        }
    });
}

function setFormData(apiData,idData,apiLangForm){
    // console.log('setFormData');
    $.ajax({
        type: "GET",
        url : apiData+'/'+idData,
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

                    for (i = 0; i <= data2.form2.length-1; i++) {
                        var nmfield=data2.form2[i].id;
                        var iData='isi.'+nmfield;

                        if(data2.form2[i].type=='text'){


                            if ( data2.form2[i].id != 'YYYY' ) { 
                                // document.getElementById(nmfield).value=eval(iData); 

                                if(typeof(eval(iData))=='undefined'){
                                    document.getElementById(nmfield).value=''; 
                                }else{
                                    document.getElementById(nmfield).value=eval(iData); 
                                }
                            }

                            // document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form2[i].type=='angka'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form2[i].type=='hidden'){

                            if ( data2.form2[i].id == 'rawatLahir' ) {
                                var nilai   = eval(iData);
                                var dd      = nilai.substr(8, 2);
                                var mm      = nilai.substr(5, 2);
                                var yy      = nilai.substr(0, 4);
                                var tgl     = mm + '/' + dd + '/' + yy;
                                // alert(tgl);
                                $('#DD').val(nilai.substr(8, 2));
                                $('#MM').val(nilai.substr(5, 2));
                                $('#YYYY').val(nilai.substr(0, 4));
                                $('#'+data2.form2[i].id).val(tgl);
                            } else {
                                document.getElementById(nmfield).value=eval(iData);
                            }

                            // document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form2[i].type=='textarea'){
                            document.getElementById(nmfield).value=eval(iData);
                        }else if(data2.form2[i].type=='combo'){
                            $("#"+nmfield).val(eval(iData));
                        }else if(data2.form2[i].type=='autocomplete'){
                            var kodecombo=eval(iData);
                            var comboapi=data2.form2[i].comboapi;
                            if(nmfield=='rawatKel'){
                                setAlamat(kodecombo);
                            }

                        }else if(data2.form2[i].type=='date'){
                            var dataxx=eval(iData);
                            var res = dataxx.split("-");
                            var hasil = res[1]+'/'+res[2]+'/'+res[0];
                            document.getElementById(nmfield).value=hasil;
                            // $("#"+nmfield).attr('value',hasil);
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
        url : comboapi,
        data:({'kode':kodecombo}),
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
            // console.log(data);
            var result="";
            for (i = 0; i <= data.form.length-1; i++) {

                nmfield2    = data.form[i].id;

                if(data.form[i].readonly=='1'){
                    var ro='readonly';
                }else{
                    var ro='';
                }


                if(data.form[i].type=='date'){
                    result +='<div class="col-md-3">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' placeholder="Pilih Tanggal" />';
                    result +='</div>';
                    result +='</div>';
                }


                if(data.form[i].type=='hidden'){
                    result +='<div class="form-group">';
                    result +='     <input type="hidden" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" />';
                    result +='</div>';
                }

                if(data.form[i].type=='text'){
                    // result +='<div class="col-md-3">';
                    // result +='<div class="form-group">';
                    // result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    // result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    // result +='</div>';
                    // result +='</div>';

                    var onkeyup     = '';
                    if ( nmfield2 == 'YYYY' ) {

                        input_group  = '<div class="col-md-12" style="padding-left:0px;padding-right:0px">';
                        input_group += '<div class="col-md-3" style="padding-left:0px;padding-right:6px">';
                        input_group += '<input id="DD" type="text" min="1" max="31"  class="form-control text-center" maxlength="2" name="DD" onblur="validDD()">';
                        input_group += '</div>';
                        input_group += '<div class="col-md-3" style="padding-left:0px;padding-right:6px">';
                        input_group += '<input id="MM" type="text" min="1" max="12"  class="form-control text-center" maxlength="2" name="MM" onblur="validMM()">';
                        input_group += '</div>';
                        input_group += '<div class="col-md-6" style="padding-left:0px;padding-right:0px">';
                        input_group += '<input id="YYYY" type="text" class="form-control text-center" maxlength="4" name="TANGGAL LAHIR" onchange="setTanggalLahir()">';
                        input_group += '</div>';
                        input_group += '</div>';

                        result +='<div class="col-md-3"><div class="form-group">';
                        result +='<label class="control-label">' + data.form[i].name + '</label>';
                        result += input_group;
                        result +='</div></div>';

                    } else {

                        if(data.form[i].id=='msPasNoKartu'){
                            var onkeyup='onblur="searchPasienBpjs(this.value)"';
                        }

                        if(data.form[i].id=='msPasKtp'){
                            // var onkeyup='onblur="searchKTP(this.value)"';
                            var onkeyup='';
                        }

                        result +='<div class="col-md-3">';
                        result +='<div class="form-group">';
                        result +='     <label class="control-label">'+data.form[i].name+'</label>';
                        result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' '+onkeyup+'  />';
                        result +='</div>';
                        result +='</div>';

                    }

                }


                if(data.form[i].type=='angka'){
                    result +='<div class="col-md-3">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" style="text-align:right" name="'+data.form[i].id+'" id="'+data.form[i].id+'"  '+ro+' />';
                    result +='</div>';
                    result +='</div>';

                }


                if(data.form[i].type=='textarea'){
                    result +='<div class="col-md-3">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <textarea class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' row="'+data.form[i].row+'" style="height:'+data.form[i].height+'"/></textarea>';
                    result +='</div>';
                    result +='</div>';
                }

                if(data.form[i].type=='password'){
                    result +='<div class="col-md-3">';
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="password" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
                    result +='</div>';
                }

                if(data.form[i].type=='combo'){
                    var comboapi=data.form[i].comboapi;

                    result +='<div class="col-md-3">';
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

                    if(data.form[i].id =='rawatKel'){
                       var change="setAlamat(this.value)";
                       // console.log("sukses cok");
                    }
                    else{
                       var change="";
                    }

                    result +='<div class="col-md-3">';
                    result +='<div class="form-group">';
                    result +='    <label class="control-label">'+data.form[i].name+'</label>';
                    result +='    <input type="hidden" class="populate placeholder" name="'+data.form[i].id+'" id="'+data.form[i].id+'" onchange="'+change+'">';
                    result +='    <input type="hidden" name="'+data.form[i].id+'_hidden" id="'+data.form[i].id+'_hidden">';
                    result +='</div>';
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
                        format: 'mm/dd/yyyy',
                        autoclose:true
                    });

                }

            }

            var result2="";
            for (i = 0; i <= data.form2.length-1; i++) {

                if(data.form2[i].readonly=='1'){
                    var ro='readonly';
                }else{
                    var ro='';
                }


                if(data.form2[i].type=='date'){
                    result2 +='<div class="'+data.form2[i].lebar+'">';
                    result2 +='<div class="form-group">';
                    result2 +='     <label class="control-label">'+data.form2[i].name+'</label>';
                    result2 +='     <input type="text" class="form-control" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" '+ro+' placeholder="Pilih Tanggal" />';
                    result2 +='</div>';
                    result2 +='</div>';
                }

                if(data.form2[i].type=='date2'){
                    result2 +='<div class="form-group">';
                    result2 +='     <input type="hidden" class="form-control" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" />';
                    result2 +='</div>';
                }



                if(data.form2[i].type=='hidden'){
                    result2 +='<div class="form-group">';
                    result2 +='     <input type="hidden" class="form-control" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" />';
                    result2 +='</div>';
                }

                if(data.form2[i].type=='text'){
                    result2 +='<div class="'+data.form2[i].lebar+'">';
                    result2 +='<div class="form-group">';
                    result2 +='     <label class="control-label">'+data.form2[i].name+'</label>';
                    result2 +='     <input type="text" class="form-control" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" '+ro+' />';
                    result2 +='</div>';
                    result2 +='</div>';
                }


                if(data.form2[i].type=='angka'){
                    result2 +='<div class="'+data.form2[i].lebar+'">';
                    result2 +='<div class="form-group">';
                    result2 +='     <label class="control-label">'+data.form2[i].name+'</label>';
                    result2 +='     <input type="text" class="form-control" style="text-align:right" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'"  '+ro+' />';
                    result2 +='</div>';
                    result2 +='</div>';

                }


                if(data.form2[i].type=='textarea'){
                    result2 +='<div class="'+data.form2[i].lebar+'">';
                    result2 +='<div class="form-group">';
                    result2 +='     <label class="control-label">'+data.form2[i].name+'</label>';
                    result2 +='     <textarea class="form-control" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" '+ro+' row="'+data.form2[i].row+'" style="height:'+data.form2[i].height+'"/></textarea>';
                    result2 +='</div>';
                    result2 +='</div>';
                }

                if(data.form2[i].type=='password'){
                    result2 +='<div class="'+data.form2[i].lebar+'">';
                    result2 +='<div class="form-group">';
                    result2 +='     <label class="control-label">'+data.form2[i].name+'</label>';
                    result2 +='     <input type="password" class="form-control" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" '+ro+' />';
                    result2 +='</div>';
                    result2 +='</div>';
                }

                if(data.form2[i].type=='combo'){
                    var comboapi=data.form2[i].comboapi;
                    var change='';

                    if(data.form2[i].id=='rawatPoli'){
                        var change='onchange="cariAntrian(this.value)"';
                    }

                    if(data.form2[i].id=='rawatJenis'){
                        var change='onchange="nonaktif(this.value)"';
                    }

                    if(data.form2[i].id=='rawatPoli' || data.form2[i].id=='rawatRuangan'){
                        var dis='disabled';

                    }
                    else {
                        var dis="";
                    }


                    result2 +='<div class="'+data.form2[i].lebar+'">';
                    result2 +='<div class="form-group">';
                    result2 +='    <label class="control-label">'+data.form2[i].name+'</label>';
                    result2 +='    <select class="form-control" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" '+ro+' '+dis+' '+change+'>';
                    result2 +='        <option></option>';

                    $.ajax({
                        type: "GET",
                        url: comboapi,
                        dataType:"json",
                        async: false,
                        success:function(datacombo){
                            for(j=0;j<=datacombo.length-1;j++){
                                result2 +='<option value="'+datacombo[j].kode+'">'+datacombo[j].nama+'</option>';
                            }
                        }
                    });

                    result2 +='    </select>';
                    result2 +='</div>';
                    result2 +='</div>';
                }


                if(data.form2[i].type=='autocomplete'){
                    var comboapi=data.form2[i].comboapi;

                    result2 +='<div class="'+data.form2[i].lebar+'">';
                    result2 +='<div class="form-group">';
                    result2 +='    <label class="control-label">'+data.form2[i].name+'</label>';
                    result2 +='    <input type="hidden" class="populate placeholder" name="'+data.form2[i].id+'" id="'+data.form2[i].id+'" >';
                    result2 +='    <input type="hidden" name="'+data.form2[i].id+'_hidden" id="'+data.form2[i].id+'_hidden" >';
                    result2 +='</div>';
                    result2 +='</div>';

                }

            }

            $('#forminput2').html(result2);


            for (i = 0; i <= data.form2.length-1; i++) {


                if(data.form2[i].type=='angka'){
                    $('#'+data.form2[i].id).keypress(function(){
                      return(numbersonly(event));
                    });
                }


                if(data.form2[i].type=='autocomplete'){
                    var comboapi=data.form2[i].comboapi;

                    $('#'+data.form2[i].id)
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

                if(data.form2[i].type=='date'){

                    var nmfield=data.form2[i].id;
                    if (nmfield=='rawatTglRujukan') {
                         $('#'+data.form2[i].id).datepicker({
                            format: 'mm/dd/yyyy',
                            autoclose:true
                        });
                    }else{
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!
                        var yyyy = today.getFullYear();
                        var mm2, dd2;

                        if(mm < 10){
                            mm2 = '0'+mm;
                        }else{
                            mm2 = mm;
                        }

                        if (dd < 10) {
                            dd2 = '0'+dd;
                        }else{
                            dd2 = dd;
                        }

                        today = mm2 + '/' + dd2 + '/' + yyyy;
                        document.getElementById("rawatTglDaftar").value=today;

                        // if (mm < 10 && dd > 10) {
                        //     today = '0'+ mm + '/' + dd + '/' + yyyy;
                        // }else if (dd < 10 && mm > 10) {
                        //     today = mm + '/' + '0' + dd + '/' + yyyy;
                        // }else if (mm < 10 && dd < 10) {
                        //     today = '0'+ mm + '/' + '0' + dd + '/' + yyyy;
                        // }
                        // else{
                        //     today = mm + '/' + dd + '/' + yyyy;
                        // }
                        // document.getElementById("rawatTglDaftar").value=today;

                    }
                }

                if(data.form2[i].type=='date2'){
                    /*$('#'+data.form2[i].id).datepicker({
                        format: 'dd/mm/yyyy',
                    });
                    */

                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth()+1; //January is 0!
                    var yyyy = today.getFullYear();

                    today = mm + '-' + dd + '-' + yyyy;

                    document.getElementById("rawatTglDaftar2").value=today;
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
                    var fElement=data2.form2;
                    for (i = 0; i <= fElement.length-1; i++) {
                        if(fElement[i].type=='autocomplete'){
                            $("#"+fElement[i].id).select2("data", { id: '', text:''});
                        }else{
                            //document.getElementById(fElement[i].id).value='';
                        }
                    }

                }
            });
        }
    });
}

function deleteData(){

    var idRawat =document.getElementById('rawatId').value;
    var idPasien=document.getElementById('rawatPasId').value;

    var boleh=0;
    $.ajax({
        type: "GET",
        url : "backend/public/api/admin/bpjs/peserta/"+idRawat,
        dataType:"json",
        async:false,
        success:function(data){
            boleh=data.data.rawatStatusAsisten;
        }
    });


    if(boleh==1){
        alert('Data Tidak Boleh Dihapus');
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
    //alert(modulx);
    var namax=document.getElementById('rawatNama').value;
    var jenisx=document.getElementById('rawatJenis').value;
    var ruangx=document.getElementById('rawatRuangan').value;

    var norm=document.getElementById('rawatRm').value;
   // var normlama=document.getElementById('rawatRmLama').value;
    var tgldaftar=document.getElementById('rawatTglDaftar2').value;
    var jenis=document.getElementById('rawatJenis').value;
    var asuransi=document.getElementById('rawatJaminanId').value;

    var poli=document.getElementById('rawatPoli').value;
 //   var igd=document.getElementById('rawatIgd').value;
    var ruangan=document.getElementById('rawatRuangan').value;

    var antri = document.getElementById('rawatUrutDaftar').value;

    // console.log(jenis);

    if(norm==''){
        alert('Pasien Belum Dipilih');
        return;
    }

    if(asuransi==''){
        alert('Jenis Pasien Belum Dipilih');
        return;
    }

    if(jenis==''){
        alert('Jenis Layanan Belum Dipilih');
        return;
    }

    if(tgldaftar==''){
        alert('Tanggal Pendaftaran Belum Dipilih!');
        return;
    }




    if(jenis==1 && poli==''){

        alert('Poli Belum Dipilih');
        return;
    }

     if(jenis==2 && ruangan==''){

        alert('Kamar Rawat Inap Belum Dipilih');
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


                    var fElement=data2.form2;

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
                            getLangForm(data[0].apiLangForm);
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


function cetakkartupasien(id){
    var param="?id="+id;

    if(id==''){
        return;
    }

    var url="backend/public/api/admin/report/cetakkartu";
    window.open(url+param, '_blank');
}



function setAlamat(idx2){

    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/master/setkelurahan",
        data:({'id':idx2}),
        dataType:"json",
        async: false,
        success:function(data){
        // var dat=JSON.parse(data);

           $("#rawatKel").select2("data", { id: data[0].kelKode, text:data[0].kelNama});
           $("#rawatKec").select2("data", { id: data[0].kecKode, text:data[0].kecNama});
           $("#rawatKab").select2("data", { id: data[0].kabKode, text:data[0].kabNama});
           $("#rawatProv").select2("data", { id: data[0].provKode, text:data[0].provNama});

        }
    });

}




function peserta(){

    var nobpjs =document.getElementById('rawatNoKartu').value;
    var tglsep =document.getElementById('rawatTglDaftar').value;

    if(nobpjs==''){
        alert('Nomor Peserta BPJS Tidak Boleh Kosong !!!');
        return
    }

    $.ajax({
        type: "GET",
        url : "bpjs/getpeserta.php",
        data : ({'nobpjs':nobpjs,'tglsep':tglsep}),
        dataType:"json",
        success:function(data){
            console.log(data);
            document.getElementById('bpjsNama').value=data.response.peserta.nama;
            document.getElementById('bpjsNomor').value=data.response.peserta.noKartu;
            document.getElementById('bpjsNIK').value=data.response.peserta.nik;
            document.getElementById('bpjsAlamat').value=data.response.peserta.provUmum.nmProvider;
            document.getElementById('bpjsAktiv').value=data.response.peserta.statusPeserta.keterangan;
            document.getElementById('bpjsHakKelas').value=data.response.peserta.hakKelas.keterangan;
            document.getElementById('bpjsJenisPeserta').value=data.response.peserta.jenisPeserta.keterangan;
            document.getElementById('bpjsLahir').value=data.response.peserta.tglLahir;
            document.getElementById('bpjsTat').value=data.response.peserta.tglTAT;
            document.getElementById('bpjsTmt').value=data.response.peserta.tglTMT;
            document.getElementById('bpjsUmurSekarang').value=data.response.peserta.umur.umurSekarang;
            document.getElementById('bpjsUmurPelayanan').value=data.response.peserta.umur.umurSaatPelayanan;
        }
    });

}

