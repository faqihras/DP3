function AllTables(modul){
    $('#judul1').html(modul);
    $('#judul2').html(modul);
    tableMaster(modul);
}
function AllTables2(modul,kode,idData){
    $('#judul1').html(modul);
    $('#judul2').html(modul);
    tableMaster2(modul,idData);
}

$(document).ready(function() {
    var modul=document.getElementById('modul').value;
    LoadDataTablesScripts(AllTables(modul));
    
    $('.form-control').tooltip();
    WinMove(); 
    
});

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

function tableMaster2(modulx,idData){

    
        var url = "backend/public/lang/admin/kinerja/kinerja/form1";
   
        getLangForm(url);
        setFormData2(idData,url);
        
}

function getLangGrid(apiLang,apiData,apiLangForm){ //apiLang = Grid
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
        "bSort" : false,
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


    // $("a.fancybox").fancybox();


    $('#tData tbody').on('click', 'tr', function () {
        var idData = $(this).find('td:eq(0)').text();
        // setFormData(apiData,idData,apiLangForm);
        // $('#btpopup').click();

        //TEXT EDITOR_______________________________________________
        // tinymce.init({
        //     selector: "textarea",
        //     lineheight_formats: "2pt 4pt 6pt 8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt",
        //     content_style:
        //             "body { font-size: 12pt; line-height: 2; }",
        //     setup: function (editor) {
        //         editor.on('change', function () {
        //             editor.save();
        //         });
        //     }
        // });
    })
}
function setFormData(idData,apiLangForm){

    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/kinerja/kinerja/'+idData,
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
                    result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' autocomplete="off" placeholder="Pilih Tanggal" />';
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
                    result +='     <input type="text" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' autocomplete="off"/>';
                    result +='</div>';
                }

                if(data.form[i].type=='angka'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="text" class="form-control" style="text-align:right" name="'+data.form[i].id+'" autocomplete="off" id="'+data.form[i].id+'"  '+ro+' />';
                    result +='</div>';

                }

                if(data.form[i].type=='file'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="file" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
                }

                if(data.form[i].type=='textarea'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <textarea class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' row="'+data.form[i].row+'" style="height:'+data.form[i].height+'"/></textarea>';
                    result +='</div>';

                    // $('#'+data.form[i].id).summernote();
                }

                if(data.form[i].type=='password'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="password" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
                }
                if(data.form[i].type=='email'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="email" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
                    result +='</div>';
                }

                if(data.form[i].type=='time'){
                    result +='<div class="form-group">';
                    result +='     <label class="control-label">'+data.form[i].name+'</label>';
                    result +='     <input type="time" class="form-control" name="'+data.form[i].id+'" id="'+data.form[i].id+'" '+ro+' />';
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

            $('#forminput').html(result); //tambahkan isi dari variabel result sebagai html di dalam elemen #forminput


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
                              id          = e.added.id;
                txt         = e.added.nama;
                akKredit        = e.added.akKredit;
                satuan      = e.added.satuan;
                harga       = e.added.harga;
                nmhidden    = this.id + '_hidden';
                $('#' + nmhidden).attr('value', txt);

                if (this.id == 'lkKegiatan') {
                    $('#lkAngkaKredit').attr('value', akKredit);
                    $('#lkAngkaKredit').prop('disabled', true);
                    $('#satuan').attr('value', satuan);
                    $('#hrgbeli').attr('value', harga);
                    $('#hrgbeli').val(harga);
                }

                // if (this.id == 'lkIdPeg') {
                //     $('#lkIdPeg').attr('value', akKredit);
                //     $('#satuan').attr('value', satuan);
                //     $('#hrgbeli').attr('value', harga);
                //     $('#hrgbeli').val(harga);
                // }
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
                
                // tinymce.init({
                //     selector: "textarea",
                //     setup: function (editor) {
                //         editor.on('change', function () {
                //             editor.save();
                //         });
                //     }
                // });
            }

            // tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'blogArtikel');
            // setTimeout(function(){
            //     tinymce.init({
            //         selector: "textarea",
            //         lineheight_formats: "2pt 4pt 6pt 8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt",
            //         content_style:
            //         "body { font-size: 12pt; line-height: 2; }",
            //         setup: function (editor) {
            //             editor.on('change', function () {
            //                 editor.save();
            //             });
            //         }
            //     });
            // }, 500);
        }
    });              
}

function delList(btn, total){
    
    var tbl = $(btn).closest('table').DataTable();
    var tr = $(btn).closest('tr');
    oTable.row(tr).remove().draw(false);
    oTable2.row(tr).remove().draw(false);

     
}

function detail_data(kode,idData){
    // alert(kode);
    // alert(idData);
    if (idData == undefined) {
        idData = document.getElementById('lkId').value;
    }

    var modul=document.getElementById('modul').value;

    //id-tombol
    var link1 = document.getElementById('linkPribadi');
  
    //id-form
    var form1 = document.getElementById('forminput');
    // var form2 = document.getElementById('forminput2');
    // var form3 = document.getElementById('forminput3');
    // var form4 = document.getElementById('forminput4');
    // var form5 = document.getElementById('forminput5');
    // var form6 = document.getElementById('forminput6');
    // var form7 = document.getElementById('forminput7');

    //tabel
    

    //tombol-verifikasi
    // var btVerif = document.getElementById('verifikasi');

   

    form1.innerHTML = "";
    LoadDataTablesScripts(AllTables2(modul,kode,idData));
    document.getElementById('lkId').value = idData;
}

function setFormData2(idData,apiLangForm){

    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/kinerja/kinerjadetail/'+idData,
        dataType:"json",
        success:function(data){
            var isi=data.data;
            var key=Object.keys(isi);

            // console.log(data);

            document.getElementById('pegawai').value = isi.lkIdPeg;
            document.getElementById('skp').value = isi.lkSkpTahun;
            document.getElementById('atasan').value = isi.lkAtasan;
            document.getElementById('kegiatan').value = isi.lkKegiatan;
            document.getElementById('kredit').value = isi.lkAngkaKredit;
            document.getElementById('biaya').value = isi.lkBiaya;
            document.getElementById('status').value = isi.lkStatus;
            document.getElementById('keterangan').value = isi.lkKeterangan;
            document.getElementById('pegawai').disabled = true;
            document.getElementById('kegiatan').disabled = true;
            document.getElementById('status').disabled = true;
            // setAutocompleteVal('backend/public/api/admin/master/pegawai2forcombo',isi.lkIdPeg,'lkIdPeg');
            // $('namaBarang').prop('disabled', true);
            // $('#pegawai').prop('disabled', true);
            // $('#pegawai').select2('disable');      
        }
    });          
}
function newdata(){  

    $.ajax({
        type: "GET",
        url: 'backend/public/lang/admin/kinerja/kinerja/form',
        dataType:"json",
        success:function(data2){
           // var fElement=data2.form;
  
           //            for (i = 0; i <= fElement.length-1; i++) {
  
           //                if(fElement[i].id=='lkHari'){
           //                    $("#"+fElement[i].id).select2("data", { id: '', text:''});
           //                }else{
           //                    document.getElementById(fElement[i].id).value='';
           //                }
  
           //            }
            var fElement=data2.form;
  
            for (i = 0; i <= fElement.length-1; i++) {
  
                if(fElement[i].type=='autocomplete'){
                    $("#"+fElement[i].id).select2("data", { id: '', text:''});
                }else if(fElement[i].id=='lkTgl'){
                    var tg=new Date();
                    var day=tg.getDate();
                    var mon=tg.getMonth();
                    var yee=tg.getFullYear();
                    mon=mon+1;
  
                    //untuk memunculkan pilihan tanggal berupa kalender di field 
                    $('#'+fElement[i].id).datepicker({
                        dateFormat: 'mm/dd/yy',
                    });
  
                    var tanggal=mon+'/'+day+'/'+yee;    
                    // alert(tanggal);
                    document.getElementById('lkTgl').value = tanggal;
  
                    // $('#'+fElement[i].id).attr('value',tanggal);
  
                }else if(fElement[i].id=='lkJamMulai'){
                  document.getElementById('lkJamMulai').value='08:00';
                }else if(fElement[i].id=='lkJamSelesai'){
                  document.getElementById('lkJamSelesai').value='17:00';
                }else{
  
                       document.getElementById(fElement[i].id).value='';
                }
  
            }
        }
    });      
  }


function simpan(){
    // alert('abId');
    var modulx=document.getElementById('modul').value;

    
    // var search=document.getElementById('search').value;
    var lkId=document.getElementById('lkId').value;
    var lkIdPeg=document.getElementById('lkIdPeg').value;
    // var abUserId=document.getElementById('abUserId').value;
    // q2
    var lkSkpTahun=document.getElementById('lkSkpTahun').value;
    var lkAtasan=document.getElementById('lkAtasan').value;
    var lkKegiatan = document.getElementById('lkKegiatan').value;
    var lkTglAwal=document.getElementById('lkTglAkhir').value;
    var lkTargetWaktu=document.getElementById('lkTargetWaktu').value;
    var lkBiaya=document.getElementById('lkBiaya').value;
    var lkAngkaKredit=document.getElementById('lkAngkaKredit').value;
    var lkKeterangan=document.getElementById('lkKeterangan').value;
    var idData=document.getElementById('lkId').value;


   

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
            console.log(data);
            $.ajax({
                type: "GET",
                url: apiForm,
                dataType:"json",
                success:function(data2){
                    console.log(data2);
                    var postData=new Object();

                    // postData['search'] = search;
                    postData['idData'] = idData;
                    postData['lkId'] = lkId;
                    postData['lkIdPeg'] = lkIdPeg;
                    postData['lkSkpTahun'] = lkSkpTahun;
                    postData['lkAtasan'] = lkAtasan;
                    postData['lkKegiatan'] = lkKegiatan;
                    postData['lkTglAwal'] = lkTglAwal;
                    postData['lkTglAkhir'] = lkTglAkhir;
                    postData['lkAngkaKredit'] = lkAngkaKredit;
                    postData['lkBiaya'] = lkBiaya;
                    postData['lkKeterangan'] = lkKeterangan;
                    

                    // console.log(postData);
                     
                   var fElement=data2.form;
                    var idData =document.getElementById(fElement[0].id).value;

               
                    for (i = 0; i <= fElement.length-1; i++) {
                        if(fElement[i].type!='file'){
                            postData[fElement[i].id]=document.getElementById(fElement[i].id).value;
                        }
                        if(fElement[i].type=='autocomplete'){
                            postData[fElement[i].id]=document.getElementById(fElement[i].id).value;
                        }
                    
                        if(fElement[i].type=='date'){
                            postData[fElement[i].id]=reversedate(document.getElementById(fElement[i].id).value);
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
                            console.log(data3);
                            idimg=data3.data.id;
                            alert('Anda akan simpan data ini??')

                            // window.location.reload();

                            for (i = 0; i <= fElement.length-1; i++) {
                                
                                 // postData[fElement[i].id]=document.getElementById(fElement[i].id).value;

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


                           // 
                                alert('Data Sudah Tersimpan')
                                newdata();
                                lapker();
                                var oTableToUpdate =  $('#tData').dataTable( { bRetrieve : true } );
                                    oTableToUpdate .fnDraw();        
                        }
                    });
                }                
            });    

           
        }
    });      
}

// function coba(){

//     var x = document.getElementById("lkKegiatan").value;
    
//     if(x == 1) {
//       document.getElementById('lkLemburMulai').readOnly = true;
//       document.getElementById('lkLemburSelesai').readOnly = true;
  
//       document.getElementById('lkLemburMulai').disabled = true;
//       document.getElementById('lkLemburSelesai').disabled = true;
  
//     }else{
     
//      document.getElementById('lkLemburMulai').readOnly = false;
//       document.getElementById('lkLemburSelesai').readOnly = false;
  
//       document.getElementById('lkLemburMulai').disabled = false;
//       document.getElementById('lkLemburSelesai').disabled = false;
  
//     }
//   }

  function reversedate(tanggal){
    // console.log(tanggal);
      if(tanggal.substr(2,1) == "/" || tanggal.substr(tanggal, 1,1) == "/"){
          var a = tanggal.split("/");
          var result = a[2] + '-' + a[0] + '-' + a[1];
      }else if(tanggal.substr(2,1) == "-" || tanggal.substr(1,1) == "-"){
          var a = tanggal.split("-");
          var result = a[2] + '-' + a[1] + '-' + a[0];
      }else{
          var result = tanggal; 
      }
  
      // console.log(result);
      return result;
  }

  // function lapker() {
  //   var table = $('#tData').DataTable();
  //   table.destroy();
  
  //   setupTabel();
  // }


