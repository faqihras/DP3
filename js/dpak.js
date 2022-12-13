$(document).ready(function() {
    var oTable;
    var oTable2;
    document.getElementById('idxdet').value=1;
    LoadDataTablesScripts(AllTables());    
    $('.form-control').tooltip();
    WinMove(); 

    //tombol-tambah-barang
    //document.getElementById("tomboltambah").disabled = true;

});

function AllTables(){
    combounit(); 
    setFieldType();
    setupTabel2();
    setListing();
}

function combounit(){

    var unit='';
    $.ajax({
        type: "GET",
        url: "backend/public/getSession",
        dataType:"json",
        async:false,
        success:function(data){            
            unit=data.unit;
        }
    });          

    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/master/poliforcombo",
        dataType:"json",
        success:function(datacombo){            
            // console.log(datacombo);

            var dis='';
            if(unit!='1') dis='disabled';

            var result='';
            var nmcombo='';
            result +='    <select class="form-control" name="pilihunit" id="pilihunit" '+dis+'>';
            result +='        <option></option>';

            for(j=0;j<=datacombo.length-1;j++){
                result +='<option value="'+datacombo[j].kode+'" ';
                if(unit==datacombo[j].kode){
                    result +='selected';
                }
                result +='>'+datacombo[j].nama+'</option>';
                nmcombo +='<input type="hidden" id="c'+datacombo[j].kode+'" value="'+datacombo[j].nama+'">';
            }

            result +='    </select>';
            $('#csunit').html(result);
            $('#csnmunit').html(nmcombo);
            // setListing(unit);
            // setListing();

        }
    });          
}

function setListing(){


    var kolom=[

                    {
                       "title":"NAMA", 
                       "data" :"dpakNama",
                       "width":"100px",
                       "sClass":"center",
                    },
                    // {
                    //    "title":"TANGGAL", 
                    //    "data" :"hreturTanggal",
                    //    "width":"80px",
                    //    "sClass":"center",
                    // },
                    // {
                    //    "title":"KETERANGAN", 
                    //    "data" :"hreturPasien",
                    //    // "width":"250px",
                    //    "sClass":"left",
                    // },
                    // {
                    //    "title":"NOTA", 
                    //    "data" :"hreturjualNoTrans",
                    //    "width":"250px",
                    // //    "width":"8%",
                    // },
                    // {
                    //    "title":"PRINT", 
                    //    "data" :"print",
                    //    "width":"3%",
                    //    "sClass":"center",
                    // },

                    // {
                    //    "title":"DEL", 
                    //    "data" :"del",
                    //    "width":"3%",
                    //    "sClass":"center",
                    // },
              ];
   var table=$('#tDataList').DataTable({
        "sorting": [[ 0, "asc" ]],
        "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "paging":   true,      
        "info"  :   false,
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
                    "url" : "backend/public/api/admin/penilaian/dpak",
                    "dataType" : "json",
                    // "data":({"gudang":1}),
                },
                        
        "columns": kolom,   
        "aoColumnDefs": [
                  { 'bSortable': false, 'aTargets': [ 0] }
               ],


    });

    oTable2=table;    
}




function setFieldType(){


    var field=[
                {
                    nama:'tglbeli',
                    readonly:true,
                    type:'date',
                },

                {
                    nama:'dpakId',
                    readonly:true,
                    type:'hidden',
                },
                {
                    nama:'tglretur',
                    readonly:false,
                    type:'date',
                },
                {
                    nama:'mutasike',
                    readonly:true,
                    type:'text',
                },
                /*
                {
                    nama:'mutasike',
                    readonly:false,
                    apidata:'backend/public/api/admin/master/poliforcombo',
                    type:'autocomplete',
                },
                */
                {
                    nama:'pengambil',
                    readonly:false,
                    type:'text',
                },
                {
                    nama:'nomorpermintaan',
                    readonly:false,
                    apidata:'backend/public/api/admin/penilaian/dpakforcombo',
                    type:'autocomplete',
                },

                //
                {
                    nama: 'kodeBarang',
                    readonly: true,
                    type: 'text',
                },

                {
                    nama: 'namaBarang',
                    readonly: true,
                    type: 'text',
                },

                {
                    nama: 'satuan',
                    readonly: true,
                    type: 'text',
                },

                {
                    nama: 'hrgbeli',
                    readonly: false,
                    type: 'angka',
                },

                {
                    nama: 'qty',
                    readonly: false,
                    type: 'angka',
                },

                {
                    nama: 'keterangan',
                    readonly: false,
                    type: 'text',
                },

              ];




    for (i = 0; i <= field.length-1; i++) {
       
        if(field[i].type=='text'){            
            if(field[i].readonly){
                $('#'+field[i].nama).attr("readonly","readonly");
            }
        }

        if(field[i].type=='date'){


            var tg=new Date();
            var day=tg.getDate();
            var mon=tg.getMonth();
            var yee=tg.getFullYear();
            mon=mon+1;

            var tanggal=mon+'/'+day+'/'+yee;    
            $('#'+field[i].nama).attr('value',tanggal);

            
            $('#'+field[i].nama).datepicker({
                format: 'dd/mm/yyyy',
            });    
            if(field[i].readonly){
                $('#'+field[i].nama).attr("readonly","readonly");
            }
        }
    
        if(field[i].type=='angka'){
            $('#'+field[i].nama).keypress(function(){
              return(currency(event));
              // return(numbersonly(event));
            });
            if(field[i].readonly){
                $('#'+field[i].nama).attr("readonly","readonly");
            }
        }    

        if(field[i].type=='autocomplete'){
            var comboapi=field[i].apidata;

            $('#'+field[i].nama)
                .on("change", function(e) {
                      var id=e.added.id;
                      var txt=e.added.nama;  
                      var kode=e.added.kode;  
                      var satuan=e.added.satuan; 
                      var harga=e.added.harga;
                      var returke=e.added.returke;
                      var tglretur=e.added.tglretur;
                      var nmpasien=e.added.pasien; 
                      var nmhidden=this.id+'_hidden';
                      $('#'+nmhidden).attr('value',txt);

                      if(this.id=='namaBarang'){
                          $('#kodeBarang').attr('value',kode);
                          $('#kodeBarang').val(kode);
                          $('#satuan').attr('value',satuan);
                          $('#satuan').val(satuan);
                          $('#hrgbeli').attr('value', harga);
                          $('#hrgbeli').val(harga);
                      }

                      if(this.id=='nomorpermintaan'){
                          $('#tglbeli').attr('value',tglretur);
                          $('#tglbeli').val(tglretur);
                          //$('#returke').attr('value',returke);
                          $('#namaBarang').attr('value',namaBarang);
                          $('#namaBarang').val(namaBarang);
                          $('#nmpasien').attr('value',nmpasien);
                          $('#nmpasien').val(nmpasien);
                          $('#kdunit').attr('value',returke);
                          $('#kdunit').val(returke);
                            loadPermintaan(e.added.id);

                          cek_notrans(e.added.id,e.added.tglretur);
                      }

                })      
                .select2({
                placeholder: "Pilih Data", 
                ajax: {
                        url: comboapi,
                        dataType: 'json',
                        quietMillis: 100,
                        data: function (term, page) {
                            return {
                                unit:document.getElementById('pilihunit').value,
                                gudang:1,
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
    }


}          

function loadPermintaan(id){
    $('#tData2').dataTable().fnDestroy();

    setTimeout(function(){ 
        setupTabel2(id);
    }, 700);
}



function setupTabel2(id){

    var kolom=[

                    {
                       "title":"NO", 
                       "data" :"nomor",
                       "width":"3%",
                       "sClass":"center",
                    },
                    {
                       "title":"NOMOR BATCH SISTEM", 
                       "data" :"pegId",
                       "width":"3%",
                       "sClass":"hidden",
                    },
                    // {
                    //    "title":"NO NOTA", 
                    //    "data" :"jualdNoTrans",
                    //    "width":"18%",
                    // },

                    {
                       "title":"NIP", 
                       "data" :"pegNip",
                       "width":"8%",
                    },
                    {
                       "title":"NAMA PEGAWAI", 
                       "data" :"pegNama",
                       // "width":"30%",
                    },
                    // {
                    //    "title":"STOK PENERIMAAN KESELURUHAN", 
                    //    "data" :"stok_penerimaan",
                    //    "width":"8%",
                    //    "sClass":"center",
                    // },
                    // {
                    //    "title":"STOK PEMAKAIAN KESELURUHAN", 
                    //    "data" :"stok_pemakaian",
                    //    "width":"8%",
                    //    "sClass":"center",
                    // },
                    // {
                    //    "title":"SATUAN", 
                    //    "data" :"satuan_kecil",
                    //    "width":"8%",
                    //    "sClass":"center",
                    // },
                    // {
                    //    "title":"QTY", 
                    //    "data" :"qty",
                    //    "width":"8%",
                    //    "sClass":"center",
                    // },
                    // {
                    //    "title":"JADWAL KBM", 
                    //    "data" :"jadwalkbm",
                    //    "width":"8%",
                    //    "sClass":"number",
                    // },
                    //  {
                    //    "title":"PEKAN EFEKTIF", 
                    //    "data" :"pekanefektif",
                    //    "width":"8%",
                    //    "sClass":"number",
                    // },
                    // {
                    //    "title":"HARGA", 
                    //    "data" :"harga",
                    //    "width":"10%",
                    //    "sClass":"number",
                    // },
                    // {
                    //    "title":"TOTAL", 
                    //    "data" :"total",
                    //    "width":"11%",
                    //    "sClass":"number",
                    // },
                    {
                       "title":"DETAIL", 
                       "data" :"detail2",
                       "width":"3%",
                       "sClass":"center",
                    },

              ];


    var table=$('#tData2').DataTable({
        "sorting": [[ 0, "asc" ]],
        "dom": "<<'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "paging":   false,      
        "info"  :   false,
        "language": {
                        "lengthMenu": "",
                        "zeroRecords": "No records available",
                        "info": "Page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "",
                        "paginate": {"next": "","previous": ""}
        },
        "processing": false,
        "serverSide": true,

        "ajax": {
                    "url" : "backend/public/api/admin/penilaian/dpakdetail",
                    "type": "GET",
                    "data":({'id':id}),
                    "dataType" : "json",
                },
                        
        "columns": kolom,   
        "aoColumnDefs": [
                  { 'bSortable': false, 'aTargets': [ 0,1,2,3,4] }
               ],
        "fnDrawCallback": function (oSettings) {
                document.getElementById('idxdet').value=oSettings.aiDisplay.length;
             }

    });

    oTable=table;

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

function cekInput(param){
    var paramname=param.name.split('_');
    var row=paramname[1];

    var harga=document.getElementById('harga'+row).value;
    var total=param.value * harga;

    var qty=document.getElementById('qty'+row).value;
    var koreksi= qty - param.value;

    document.getElementById('koreksi'+row).value=koreksi;
    document.getElementById('total'+row).value=total;

}

function simpan(){
    if(document.getElementById('isProcessing').value == 1){
        alert('Maaf Data sedang diproses.');
        return;
    }


    
    document.getElementById('isProcessing').value = 1;

    var postData=new Object();
    var idxDetail=document.getElementById('idxdet').value;

   // var dpakId                 = document.getElementById('dpakId').value;
   var jumlah=0;
                   var jumlah2=0; 
                var jumlah3=0;
                var jumlah4=0;
                var jumlah5=0;
                var harga;
                var harga2;
                var harga3;
                var harga4;
                var harga5;

                var total;
                var total2;
                var total3;
                var total4;
                var total5;

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                tanggal = mm + '/' + dd + '/' + yyyy;

                tanggal = document.getElementById("tanggal").value;

                var dpakId = document.getElementById("dpakId").value;;

                if(document.getElementById("jadwalkbm").checked)
                {
                harga=document.getElementById("jadwalkbm").value;
                jumlah=jumlah+parseInt(harga);
                }
                if(document.getElementById("pekanefektif").checked)
                {
                harga=document.getElementById("pekanefektif").value;
                jumlah=jumlah+parseInt(harga);
                }
                if(document.getElementById("kalender").checked)
                {
                harga=document.getElementById("kalender").value;
                jumlah=jumlah+parseInt(harga);
                }
                if(document.getElementById("analisa").checked)
                {
                harga=document.getElementById("analisa").value;
                jumlah=jumlah+parseInt(harga);
                }
                if(document.getElementById("distribusi").checked)
                {
                harga=document.getElementById("distribusi").value;
                jumlah=jumlah+parseInt(harga);
                }
                if(document.getElementById("analisis").checked)
                {
                harga=document.getElementById("analisis").value;
                jumlah=jumlah+parseInt(harga);
                }
                document.getElementById("total").value=jumlah;
                totala = document.getElementById("total").value;
                total = (totala*100)/6;
                postData['total']=total;


                // Categori2
                if(document.getElementById("ki").checked)
                {
                harga=document.getElementById("ki").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                if(document.getElementById("kd").checked)
                {
                harga=document.getElementById("kd").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                if(document.getElementById("mp").checked)
                {
                harga=document.getElementById("mp").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                if(document.getElementById("kp").checked)
                {
                harga=document.getElementById("kp").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                if(document.getElementById("indika").checked)
                {
                harga=document.getElementById("indika").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                if(document.getElementById("nilai").checked)
                {
                harga=document.getElementById("nilai").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                if(document.getElementById("alokasi").checked)
                {
                harga=document.getElementById("alokasi").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                if(document.getElementById("sumber").checked)
                {
                harga=document.getElementById("sumber").value;
                jumlah2=jumlah2+parseInt(harga);
                }
                document.getElementById("total2").value=jumlah2;
                totalb = document.getElementById("total2").value;
                total2 = (totalb*100)/8;
                postData['total2']=total2;

                // categori3
                if(document.getElementById("alokasiwaktu").checked)
                {
                harga=document.getElementById("alokasiwaktu").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("komin").checked)
                {
                harga=document.getElementById("komin").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("komdas").checked)
                {
                harga=document.getElementById("komdas").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("indikatorpembelajaran").checked)
                {
                harga=document.getElementById("indikatorpembelajaran").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("tujuanpel").checked)
                {
                harga=document.getElementById("tujuanpel").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("mapel").checked)
                {
                harga=document.getElementById("mapel").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("metode").checked)
                {
                harga=document.getElementById("metode").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("kegiatan").checked)
                {
                harga=document.getElementById("kegiatan").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("sumberbelajar").checked)
                {
                harga=document.getElementById("sumberbelajar").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("bahanbelajar").checked)
                {
                harga=document.getElementById("bahanbelajar").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("alatbelajar").checked)
                {
                harga=document.getElementById("alatbelajar").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                if(document.getElementById("penilaian").checked)
                {
                harga=document.getElementById("penilaian").value;
                jumlah3=jumlah3+parseInt(harga);
                }
                 document.getElementById("total3").value=jumlah3;
                totalc = document.getElementById("total3").value;
                total3 = (totalc*100)/12;
                postData['total3']=total3;

                //categori4
                if(document.getElementById("materipembelajaran").checked)
                {
                harga=document.getElementById("materipembelajaran").value;
                jumlah4=jumlah4+parseInt(harga);
                }
                if(document.getElementById("presensi").checked)
                {
                harga=document.getElementById("presensi").value;
                jumlah4=jumlah4+parseInt(harga);
                }
                if(document.getElementById("catatan").checked)
                {
                harga=document.getElementById("catatan").value;
                jumlah4=jumlah4+parseInt(harga);
                }
                if(document.getElementById("bentukkbm").checked)
                {
                harga=document.getElementById("bentukkbm").value;
                jumlah4=jumlah4+parseInt(harga);
                }
                document.getElementById("total4").value=jumlah4;
                totalf = document.getElementById("total4").value;
                total4 = (totalf*100)/4;
                postData['total4']=total4;

                //categori5
                if(document.getElementById("butirsoal").checked)
                {
                harga=document.getElementById("butirsoal").value;
                jumlah5=jumlah5+parseInt(harga);
                }
                if(document.getElementById("pelaksanaanpenilaian").checked)
                {
                harga=document.getElementById("pelaksanaanpenilaian").value;
                jumlah5=jumlah5+parseInt(harga);
                }
                if(document.getElementById("hasilpenilaian").checked)
                {
                harga=document.getElementById("hasilpenilaian").value;
                jumlah5=jumlah5+parseInt(harga);
                }
                if(document.getElementById("atl").checked)
                {
                harga=document.getElementById("atl").value;
                jumlah5=jumlah5+parseInt(harga);
                }
                document.getElementById("total5").value=jumlah5;
                totale = document.getElementById("total5").value;
                total5 = (totale*100)/4;
                postData['total5']=total5;


                dpakId = document.getElementById("dpakId").value;

    postData['jumRecord']=idxDetail;

    // for (i = 1; i <= idxDetail - 1; i++) {
    //     if (document.getElementById('jadwalkbm' + i) != null) {

    //         // var jadwalkbm    = document.getElementById('jadwalkbm' + i).value;
    //         // var kalender    = document.getElementById('kalender' + i).value;
    //         // var pekanefektif  = document.getElementById('pekanefektif' + i).value;
    //         // var analisa     = document.getElementById('analisa' + i).value;
    //         // var distribusi     = document.getElementById('distribusi' + i).value;
    //         // var analisis = document.getElementById('analisis' + i).value;
    //         // var ki   = document.getElementById('ki' + i).value;

    //         var jadwalkbm            = document.getElementById('jadwalkbm' + i).value ;
    //         var pekanefektif         = document.getElementById('pekanefektif' + i).value ;
    //         // var kalender             = document.getElementById('kalender' + i).value ;
    //         // var pekanefektif         = document.getElementById('pekanefektif' + i).value ;
    //         // var analisa              = document.getElementById('analisa' + i).value ;
    //         // var distribusi           = document.getElementById('distribusi' + i).value ;
    //         // var analisis             = document.getElementById('analisis' + i).value ;

    //         // var ki                          = document.getElementById('ki' + i).value ;
    //         // var kd                          = document.getElementById('kd' + i).value ;
    //         // var mp                          = document.getElementById('mp' + i).value ;
    //         // var kp                          = document.getElementById('kp' + i).value ;
    //         // var indika                      = document.getElementById('indika' + i).value ;
    //         // var nilai                       = document.getElementById('nilai' + i).value ;
    //         // var alokasi                     = document.getElementById('alokasi' + i).value ;
    //         // var sumber                      = document.getElementById('sumber' + i).value ;

    //         // var alokasiwaktu                        = document.getElementById('alokasiwaktu' + i).value ;
    //         // var komin                               = document.getElementById('komin' + i).value ;
    //         // var komdas                              = document.getElementById('komdas' + i).value ;
    //         // var indikatorpembelajaran               = document.getElementById('indikatorpembelajaran' + i).value ;
    //         // var tujuanpel                           = document.getElementById('tujuanpel' + i).value ;
    //         // var mapel                               = document.getElementById('mapel' + i).value ;
    //         // var metode                              = document.getElementById('metode' + i).value ;
    //         // var kegiatan                            = document.getElementById('kegiatan' + i).value ;
    //         // var sumberbelajar                       = document.getElementById('sumberbelajar' + i).value ;
    //         // var bahanbelajar                        = document.getElementById('bahanbelajar' + i).value ;
    //         // var alatbelajar                         = document.getElementById('alatbelajar' + i).value ;
    //         // var penilaian                           = document.getElementById('penilaian'+ i).value ;

    //         // var materipembelajaran                          = document.getElementById('materipembelajaran'+ i).value ;
    //         // var presensi                                    = document.getElementById('presensi'+ i).value ;
    //         // var catatan                                     = document.getElementById('catatan'+ i).value ;
    //         // var bentukkbm                                   = document.getElementById('bentukkbm'+ i).value ;

    //         // var butirsoal                                                 = document.getElementById('butirsoal'+ i).value ;
    //         // var pelaksanaanpenilaian                                      = document.getElementById('pelaksanaanpenilaian'+ i).value ;
    //         // var hasilpenilaian                                            = document.getElementById('hasilpenilaian'+ i).value ;
    //         // var atl                                                       = document.getElementById('atl'+ i).value ;

    //         // postData['id_barang' + i] = kode;
    //         // postData['nama_barang' + i] = nama;
    //         // postData['satuan_besar' + i] = satuan;
    //         // postData['keterangan' + i]  = ket;
    //         // postData['distribusi' + i] = qty;
    //         // postData['harga' + i] = hrgbeli;
    //         // postData['total' + i] = total;

    //         postData['jadwalkbm'+ i]                       = jadwalkbm;
    //         postData['pekanefektif'+ i]                       = pekanefektif;
    //         // postData['kalender'+ i]                        = kalender;
    //         // postData['pekanefektif'+ i]                    = pekanefektif;
    //         // postData['analisa'+ i]                         = analisa;
    //         // postData['distribusi'+ i]                       = distribusi;
    //         // postData['analisis'+ i]                        = analisis;

    //         // postData['ki'+ i]                              = ki;
    //         // postData['kd'+ i]                              = kd;
    //         // postData['mp'+ i]                              = mp;
    //         // postData['kp'+ i]                              = kp;
    //         // postData['indika'+ i]                          = indika;
    //         // postData['nilai'+ i]                           = nilai;
    //         // postData['alokasi'+ i]                         = alokasi;
    //         // postData['sumber'+ i]                          = sumber;

    //         // postData['alokasiwaktu'+ i]                    = alokasiwaktu;
    //         // postData['komin'+ i]                           = komin;
    //         // postData['komdas'+ i]                          = komdas;
    //         // postData['indikatorpembelajaran'+ i]           = indikatorpembelajaran;
    //         // postData['tujuanpel'+ i]                       = tujuanpel;
    //         // postData['mapel'+ i]                           = mapel;
    //         // postData['metode'+ i]                          = metode;
    //         // postData['kegiatan']                        = kegiatan;
    //         // postData['sumberbelajar'+ i]                   = sumberbelajar;
    //         // postData['bahanbelajar'+ i]                    = bahanbelajar;
    //         // postData['alatbelajar'+ i]                     = alatbelajar;
    //         // postData['penilaian'+ i]                       = penilaian;

    //         // postData['materipembelajaran'+ i]              = materipembelajaran;
    //         // postData['presensi'+ i]                        = presensi;
    //         // postData['catatan'+ i]                         = catatan;
    //         // postData['bentukkbm'+ i]                       = bentukkbm;

    //         // postData['butirsoal'+ i]                       = butirsoal;
    //         // postData['pelaksanaanpenilaian'+ i]            = pelaksanaanpenilaian;
    //         // postData['hasilpenilaian'+ i]                  = hasilpenilaian;
    //         // postData['atl'+ i]                             = atl;

    //     }
    // }





    if(idxDetail>0){
        if(confirm("Anda Akan Simpan Transaksi ?")){
            $.ajax({
                type: "POST",
                url : "backend/public/api/admin/penilaian/dpakdetail",
                data : postData,
                dataType:"json",
                success:function(data){

                    oTable.clear().draw();
                    $('#tData2').dataTable().fnDestroy();
                    setTimeout(function(){ 
                        setupTabel2(0);
                    }, 700);


                    oTable2.clear().draw();
                    // $('#tDataList').dataTable().fnDestroy();        
                    // setListing();

                    // // $("#mutasike").select2("data", { id: '', text:''});
                    // $("#nomorpermintaan").select2("data", { id: '', text:''});

                    // document.getElementById('tglbeli').value='';
                    // document.getElementById('nmpasien').value='';

                    // var param="?id="+data.data.hreturNoTrans;
                    // var url="report/cetakkoreksigudang.php";                    
                    // window.open(url+param, '_blank');   
                    // document.getElementById('isProcessing').value = 0; 

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    document.getElementById('isProcessing').value = 0;
                    alert(textStatus+" : " + errorThrown+" -> GAGAL DISIMPAN !!!"); 
                }
            });  
        }else{
            document.getElementById('isProcessing').value = 0;
        }     
    }else{
        alert('Data Kosong');
        document.getElementById('isProcessing').value = 0;
    }

}

// function simpan() {
//     if(document.getElementById('isProcessing').value == 1){
//         alert('Maaf Data sedang diproses.');
//         return;
//     }
    
//     document.getElementById('isProcessing').value = 1;

//     var jumlah=0;
//                 var jumlah2=0;
//                 var jumlah3=0;
//                 var jumlah4=0;
//                 var jumlah5=0;
//                 var harga;
//                 var harga2;
//                 var harga3;
//                 var harga4;
//                 var harga5;

//                 var total;
//                 var total2;
//                 var total3;
//                 var total4;
//                 var total5;

//                 var today = new Date();
//                 var dd = String(today.getDate()).padStart(2, '0');
//                 var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
//                 var yyyy = today.getFullYear();

//                 tanggal = mm + '/' + dd + '/' + yyyy;

//                 tanggal = document.getElementById("tanggal").value;

//                 var dpakId = document.getElementById("dpakId").value;;

//                 if(document.getElementById("jadwalkbm").checked)
//                 {
//                 harga=document.getElementById("jadwalkbm").value;
//                 jumlah=jumlah+parseInt(harga);
//                 }
//                 if(document.getElementById("pekanefektif").checked)
//                 {
//                 harga=document.getElementById("pekanefektif").value;
//                 jumlah=jumlah+parseInt(harga);
//                 }
//                 if(document.getElementById("kalender").checked)
//                 {
//                 harga=document.getElementById("kalender").value;
//                 jumlah=jumlah+parseInt(harga);
//                 }
//                 if(document.getElementById("analisa").checked)
//                 {
//                 harga=document.getElementById("analisa").value;
//                 jumlah=jumlah+parseInt(harga);
//                 }
//                 if(document.getElementById("distribusi").checked)
//                 {
//                 harga=document.getElementById("distribusi").value;
//                 jumlah=jumlah+parseInt(harga);
//                 }
//                 if(document.getElementById("analisis").checked)
//                 {
//                 harga=document.getElementById("analisis").value;
//                 jumlah=jumlah+parseInt(harga);
//                 }
//                 document.getElementById("total").value=jumlah;
//                 totala = document.getElementById("total").value;
//                 total = (totala*100)/6;
//                 // postData['total']=total;


//                 // Categori2
//                 if(document.getElementById("ki").checked)
//                 {
//                 harga=document.getElementById("ki").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 if(document.getElementById("kd").checked)
//                 {
//                 harga=document.getElementById("kd").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 if(document.getElementById("mp").checked)
//                 {
//                 harga=document.getElementById("mp").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 if(document.getElementById("kp").checked)
//                 {
//                 harga=document.getElementById("kp").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 if(document.getElementById("indika").checked)
//                 {
//                 harga=document.getElementById("indika").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 if(document.getElementById("nilai").checked)
//                 {
//                 harga=document.getElementById("nilai").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 if(document.getElementById("alokasi").checked)
//                 {
//                 harga=document.getElementById("alokasi").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 if(document.getElementById("sumber").checked)
//                 {
//                 harga=document.getElementById("sumber").value;
//                 jumlah2=jumlah2+parseInt(harga);
//                 }
//                 document.getElementById("total2").value=jumlah2;
//                 totalb = document.getElementById("total2").value;
//                 total2 = (totalb*100)/8;
//                 // postData['total2']=total2;

//                 // categori3
//                 if(document.getElementById("alokasiwaktu").checked)
//                 {
//                 harga=document.getElementById("alokasiwaktu").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("komin").checked)
//                 {
//                 harga=document.getElementById("komin").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("komdas").checked)
//                 {
//                 harga=document.getElementById("komdas").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("indikatorpembelajaran").checked)
//                 {
//                 harga=document.getElementById("indikatorpembelajaran").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("tujuanpel").checked)
//                 {
//                 harga=document.getElementById("tujuanpel").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("mapel").checked)
//                 {
//                 harga=document.getElementById("mapel").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("metode").checked)
//                 {
//                 harga=document.getElementById("metode").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("kegiatan").checked)
//                 {
//                 harga=document.getElementById("kegiatan").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("sumberbelajar").checked)
//                 {
//                 harga=document.getElementById("sumberbelajar").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("bahanbelajar").checked)
//                 {
//                 harga=document.getElementById("bahanbelajar").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("alatbelajar").checked)
//                 {
//                 harga=document.getElementById("alatbelajar").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                 if(document.getElementById("penilaian").checked)
//                 {
//                 harga=document.getElementById("penilaian").value;
//                 jumlah3=jumlah3+parseInt(harga);
//                 }
//                  document.getElementById("total3").value=jumlah3;
//                 totalc = document.getElementById("total3").value;
//                 total3 = (totalc*100)/12;
//                 // postData['total3']=total3;

//                 //categori4
//                 if(document.getElementById("materipembelajaran").checked)
//                 {
//                 harga=document.getElementById("materipembelajaran").value;
//                 jumlah4=jumlah4+parseInt(harga);
//                 }
//                 if(document.getElementById("presensi").checked)
//                 {
//                 harga=document.getElementById("presensi").value;
//                 jumlah4=jumlah4+parseInt(harga);
//                 }
//                 if(document.getElementById("catatan").checked)
//                 {
//                 harga=document.getElementById("catatan").value;
//                 jumlah4=jumlah4+parseInt(harga);
//                 }
//                 if(document.getElementById("bentukkbm").checked)
//                 {
//                 harga=document.getElementById("bentukkbm").value;
//                 jumlah4=jumlah4+parseInt(harga);
//                 }
//                 document.getElementById("total4").value=jumlah4;
//                 totalf = document.getElementById("total4").value;
//                 total4 = (totalf*100)/4;
//                 // postData['total4']=total4;

//                 //categori5
//                 if(document.getElementById("butirsoal").checked)
//                 {
//                 harga=document.getElementById("butirsoal").value;
//                 jumlah5=jumlah5+parseInt(harga);
//                 }
//                 if(document.getElementById("pelaksanaanpenilaian").checked)
//                 {
//                 harga=document.getElementById("pelaksanaanpenilaian").value;
//                 jumlah5=jumlah5+parseInt(harga);
//                 }
//                 if(document.getElementById("hasilpenilaian").checked)
//                 {
//                 harga=document.getElementById("hasilpenilaian").value;
//                 jumlah5=jumlah5+parseInt(harga);
//                 }
//                 if(document.getElementById("atl").checked)
//                 {
//                 harga=document.getElementById("atl").value;
//                 jumlah5=jumlah5+parseInt(harga);
//                 }
//                 document.getElementById("total5").value=jumlah5;
//                 totale = document.getElementById("total5").value;
//                 total5 = (totale*100)/4;
//                 // postData['total5']=total5;


//                 dpakId = document.getElementById("dpakId").value;

//     $.ajax({
//         type:"GET",
//         url:"backend/public/api/admin/gudang/ceksaldoawalgudang"+param2,
//         data: ({modul:modulx}),
//         dataType:"json",
//         success: function(data2){
//             // console.log('data2  = '+data2);

//             barang = data2[0].barang_kode;
//             harga_barang = data2[0].awal_harga;

//             // console.log('barang = '+barang);
//             // console.log('harga_barang = '+harga_barang);

//             if (barang == 0 && harga_barang ==0) {


//                     var postData             = new Object();
//                     // var idxDetail            = document.getElementById('idxdet').value;
//                     var idxDetail            = 1;
//                     var idskpd               = $('#idskpd').val();

//                     postData['otomatis']             = 0;
//                     postData['jumRecord'] = idxDetail - 1;

//                     var kode    = document.getElementById('kodeBarang').value;
//                     var nama    = document.getElementById('namaBarang_hidden').value;
//                     var satuan  = document.getElementById('satuan').value;
//                     var ket     = document.getElementById('keterangan').value;
//                     var qty     = document.getElementById('qty').value;
//                     var hrgbeli = document.getElementById('hrgbeli').value;
//                     var total   = qty * hrgbeli;

//                     postData['id_barang'] = kode;
//                     postData['nama_barang'] = nama;
//                     postData['satuan_besar'] = satuan;
//                     postData['keterangan']  = ket;
//                     postData['qty'] = qty;
//                     postData['harga'] = hrgbeli;
//                     postData['total'] = total;

//                     // console.log(postData);


//                     // if (idxDetail > 1) {
//                         if (confirm("Anda Akan Simpan Transaksi ?")) {
//                             //confirm("isinya nota= "+nota);
//                             //confirm(postData['nota']);

//                             $.ajax({
//                                 type: "POST",
//                                 url: "backend/public/api/admin/gudang/saldoawalgudang",
//                                 data: postData,
//                                 dataType: "json",
//                                 success: function (data) {
//                                     //confirm(data['stokhNota']);
//                                     //confirm(data['nota']);
//                                     //confirm(data);

//                                     console.log(data);

//                                     oTable.clear().draw();
//                                     $('#tData').dataTable().fnDestroy();
//                                     setupTabel();

//                                     oTable2.clear().draw();
//                                     $('#tDataList').dataTable().fnDestroy();
//                                     setListing();

//                                     document.getElementById('idxdet').value = 1;
//                                     document.getElementById('kodeBarang').value = '';
//                                     document.getElementById('satuan').value = '';
//                                     document.getElementById('qty').value = '';
//                                     document.getElementById('hrgbeli').value = '';
//                                     document.getElementById('keterangan').value = '';
//                                     $("#namaBarang").select2("val", "");
//                                     jmlBrs = 0;

//                                     alert("Data Berhasil Disimpan !");

//                                     document.getElementById('isProcessing').value = 0;
//                                 },
//                                 error: function (XMLHttpRequest, textStatus, errorThrown) {
//                                     document.getElementById('isProcessing').value = 0;
//                                     alert(textStatus + " : " + errorThrown + " -> GAGAL DISIMPAN !!!");
//                                 }
//                             });
//                         }else{
//                             document.getElementById('isProcessing').value = 0;
//                         }
//             }else{
//                 alert("Barang Sudah Ada Mohon di Cek Kembali (Kode Barang dan Harga Tidak Boleh Sama)");
//                 document.getElementById('isProcessing').value = 0;
//             }
//     // }
//         }
//     });

// }

function deleteData(idData,batch_sistem){
    if(document.getElementById('isProcessing2').value == 1){
        alert('Maaf Data sedang diproses.');
        return;
    }
    
    document.getElementById('isProcessing2').value = 1;

    var method='DELETE';
    // var apiUrl="backend/public/api/admin/gudang/koreksistokgudang/"+idData;
    var apiUrl="backend/public/api/admin/gudang/penerimaanbagiandetail/"+idData;
    var idxDetail=document.getElementById('idxdet').value;
    alert('Perlu Diingat!! jika anda hapus sembarangan data penerimaan yang sudah anda pakai stoknya, kemungkinan besar laporannya akan menjadi minus\n\nTolong Berhati-hati saat menghapus Penerimaan barang!');
    if(confirm("Anda Akan Menghapus Data Ini?\n\n*Ini akan berpengaruh pada laporan FIFO")){
      for(i=0;i<=idxDetail-1;i++){
        if(document.getElementById('id_barang'+i) != null) {
          if(document.getElementById('batch_sistem'+i).value == batch_sistem) {
            // var batch_sistem=document.getElementById('batch_sistem'+i).value;
            var qty=document.getElementById('qty'+i).value;

            $.ajax({
                type: 'GET',
                url: 'backend/public/api/admin/gudang/cekstok',
                data : ({'batch_sistem':batch_sistem}),
                dataType:"json",
                success:function(data2){
                  if (data2[0].trperfStok != qty) {
                    document.getElementById('isProcessing2').value = 0;
                    alert('Stok sudah pernah dipakai penerimaan tidak bisa dihapus, silahkan hapus data pemakaiannya terlebih dahulu !');
                    return;
                  }else{
                    $.ajax({
                        type: method,
                        url: apiUrl,
                        dataType:"json",
                        success:function(data3){
                            var oTableToUpdate =  $('#tDataList').dataTable( { bRetrieve : true } );
                                oTableToUpdate .fnDraw();                            
                            console.log(data3);
                            loadPermintaan(document.getElementById('nomorpermintaan').value);
                            document.getElementById('isProcessing2').value = 0;
                            alert('Data Berhasil Dihapus!');

                        }
                    });
                    // alert('ok');
                  }
                }
            });
          }
        }
      }
    }else{
      document.getElementById('isProcessing2').value = 0;
    }

}

function printData(id){
    var param="?id="+id;
    var url="report/cetakkoreksigudang.php";                    
    window.open(url+param, '_blank');    
}

function cek_notrans(no_trans,tgl_trans){
    if (no_trans != '') {
        // document.getElementById("tomboltambah").disabled = false;
        document.getElementById("nomortransaksi").value = no_trans;
        document.getElementById("tgltransaksi").value = tgl_trans;
    }else{
        // document.getElementById("tomboltambah").disabled = true;
        document.getElementById("nomortransaksi").value = '';
        document.getElementById("tgltransaksi").value = '';
    }

    // console.log(no_trans);
    // console.log(tgl_trans);
    // console.log(document.getElementById("nomortransaksi").value);
}

function simpanbarang(){
    if(document.getElementById('isProcessing2').value == 1){
        alert('Maaf Data sedang diproses.');
        return;
    }
    
    document.getElementById('isProcessing2').value = 1;
    var postData=new Object();

    var kodeBarang=document.getElementById('kodeBarang').value;
    var tgltransaksi=document.getElementById('tgltransaksi').value;
    var namaBarang=document.getElementById('namaBarang_hidden').value;
    var nomortransaksi=document.getElementById('nomortransaksi').value;
    var satuan=document.getElementById('satuan').value;
    var hrgbeli=document.getElementById('hrgbeli').value;
    var qty=document.getElementById('qty').value;
    var ket=document.getElementById('keterangan').value;

    postData['nomortransaksi']=nomortransaksi;
    postData['tgltransaksi']=tgltransaksi;

    postData['kodeBarang']=kodeBarang;
    postData['namaBarang']=namaBarang;
    postData['satuan']=satuan;
    postData['hrgbeli']=hrgbeli;
    postData['qty']=qty;
    postData['ket']=ket;

    if(nomortransaksi==''){
        alert('Transaksi Belum Dipilih');
        return;
    }

    console.log(postData);


    if(confirm("Anda Akan Simpan Transaksi ?")){
        $.ajax({
            type: "POST",
            url : "backend/public/api/admin/gudang/tambahbarang",
            data : postData,
            dataType:"html",
            success:function(data){
                console.log(data);

                oTable.clear().draw();
                $('#tData2').dataTable().fnDestroy();
                setTimeout(function(){ 
                    // setupTabel2(0);
                    loadPermintaan(document.getElementById('nomorpermintaan').value);
                }, 700); 

                document.getElementById('isProcessing2').value = 0;

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                document.getElementById('isProcessing2').value = 0;
                alert(textStatus+" : " + errorThrown+" -> GAGAL DISIMPAN !!!"); 
            }
        });  
    } else{
            document.getElementById('isProcessing2').value = 0;
        }        

}

function newbarang(){
    document.getElementById('kodeBarang').value = '';
    document.getElementById('satuan').value = '';
    document.getElementById('hrgbeli').value = '';
    document.getElementById('qty').value = '';
    document.getElementById('keterangan').value = '';
    $("#namaBarang").select2("data", { id: '', text:''});

}