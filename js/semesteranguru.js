var jmlBrs = 0;
var id = '';
var txt = '';
var kode = '';
var satuan = '';
var hrgbeli   = 0;
var nmhidden = '';


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

function logout(){
        var host = window.location.host;

        $.ajax({
            type: "GET",
            url: 'backend/public/api/admin/logout',
            dataType:"json",
            success:function(data){
                //console.log(data);
                window.location.href = 'home.html';
            }
        });
}

$(document).ready(function () {
    var oTable;
    var oTable2;
    cekSession();
    document.getElementById('idxdet').value = 1;
    LoadDataTablesScripts(AllTables());
    combounit();
    $('.form-control').tooltip();
    $('#tglterima').change(function() {
      cekTA();
    });
    WinMove();
});

function AllTables() {

    setFieldType();
    setupTabel();
    setListing();
    combounit();
}


function ceknopemeriksaan(val){
    if(val.length>0){
      // document.getElementById('nopemeriksaan').value='';
      // document.getElementById('nopemeriksaan').disabled=false;
      document.getElementById('nokontrak').disabled=true;
      document.getElementById('nokwitansi').disabled=true; 
      document.getElementById('nopenerimaangudang').disabled=true;      
      document.getElementById('nota').disabled=true; 
    }else{
      // document.getElementById('nopemeriksaan').disabled=false;
      document.getElementById('nokontrak').disabled=false;      
      document.getElementById('nokwitansi').disabled=false; 
      document.getElementById('nopenerimaangudang').disabled=false;      
      document.getElementById('nota').disabled=false;      
    }
}

function ceknokontrak(val){
    if(val.length>0){
      // document.getElementById('nokontrak').value='';      
      document.getElementById('nopemeriksaan').disabled=true;
      // document.getElementById('nopemeriksaan').disabled=true;
      document.getElementById('nokwitansi').disabled=true; 
      document.getElementById('nopenerimaangudang').disabled=true;      
      document.getElementById('nota').disabled=true; 
    }else{
      document.getElementById('nopemeriksaan').disabled=false;
      // document.getElementById('nokontrak').disabled=false;      
      document.getElementById('nokwitansi').disabled=false; 
      document.getElementById('nopenerimaangudang').disabled=false;      
      document.getElementById('nota').disabled=false;      
    }
}

function ceknokwitansi(val){
    if(val.length>0){
      // document.getElementById('nokwitansi').value=''; 
      // document.getElementById('nopemeriksaan').value=true;
      document.getElementById('nopemeriksaan').disabled=true;
      document.getElementById('nokontrak').disabled=true;      
      document.getElementById('nopenerimaangudang').disabled=true;      
      document.getElementById('nota').disabled=true; 
    }else{
      document.getElementById('nopemeriksaan').disabled=false;
      document.getElementById('nokontrak').disabled=false;      
      // document.getElementById('nokwitansi').disabled=false; 
      document.getElementById('nopenerimaangudang').disabled=false;      
      document.getElementById('nota').disabled=false;      
    }
}

function ceknopenerimaangudang(val){
    if(val.length>0){
      // document.getElementById('nopemeriksaan').value=true;
      // document.getElementById('nopenerimaangudang').value='';      
      document.getElementById('nokwitansi').disabled=true; 
      document.getElementById('nopemeriksaan').disabled=true;
      document.getElementById('nokontrak').disabled=true;      
      document.getElementById('nota').disabled=true; 
    }else{
      document.getElementById('nopemeriksaan').disabled=false;
      document.getElementById('nokontrak').disabled=false;      
      document.getElementById('nokwitansi').disabled=false; 
      // document.getElementById('nopenerimaangudang').disabled=false;      
      document.getElementById('nota').disabled=false;      
    }
}

function ceknonota(val){
    if(val.length>0){
      // document.getElementById('nopemeriksaan').value=true;
      // document.getElementById('nota').value=''; 
      document.getElementById('nopenerimaangudang').disabled=true;      
      document.getElementById('nokwitansi').disabled=true; 
      document.getElementById('nopemeriksaan').disabled=true;
      document.getElementById('nokontrak').disabled=true;      
    }else{
      document.getElementById('nopemeriksaan').disabled=false;
      document.getElementById('nokontrak').disabled=false;      
      document.getElementById('nokwitansi').disabled=false; 
      document.getElementById('nopenerimaangudang').disabled=false;      
      // document.getElementById('nota').disabled=false;      
    }
}



function cekHarga(){  
    var hargaE    = $('#hrgbeli').val();

    if (parseFloat(harga) < parseFloat(hargaE)) {
        alert("Melebihi harga yang ditetapkan.");
        $('#hrgbeli').val('').focus();
        return;
    }
}

function cekTA() {
    var tgl     = document.getElementById('tglterima').value;
    if (tgl != '') {
        if(tgl.substr(-4) != document.getElementById('txtang').value) {
            alert("Tanggal tidak dalam Tahun Anggaran. Mohon diganti?????");
            $('#tglterima').val('').focus();
            return;
        }
    } else {
        alert("TAnggal Penerimaan masih kosong...");
    }
}

function combounit() {

    // $.ajax({
    //     type: "GET",
    //     url: "backend/public/api/admin/master/poliforcombo2",
    //     dataType: "json",
    //     success: function (datacombo) {
    //         // console.log(datacombo);

    //         var dis = '';
    //         // if (skpd != '1')
    //         //     dis = 'disabled';

    //         var result = '';
    //         var nmcombo = '';
    //         result += '    <select class="form-control" name="pilihunit" id="pilihunit" ' + dis + '>';
    //         result += '        <option></option>';

    //         for (j = 0; j <= datacombo.length - 1; j++) {
    //             result += '<option value="' + datacombo[j].kode + '" ';
    //             if (unit == datacombo[j].kode) {
    //                 result += 'selected';
    //             }
    //             result += '>' + datacombo[j].nama + '</option>';
    //             nmcombo += '<input type="hidden" id="c' + datacombo[j].kode + '" value="' + datacombo[j].nama + '">';
    //         }

    //         result += '    </select>';

    //         $('#csunit').html(result);
    //         $('#csnmunit').html(nmcombo);
    //         setListing(unit);

    //     }
    // });
}

function setListing() {

    var kolom = [
        {
            "title": "TANGGAL",
            "data": "stokhTglTerima",
            "width": "80px",
            "sClass": "center",
        },

        {
            "title": "NO. TERIMA",
            "data": "nomor_terima",
            "width": "120px",
        },

        // {
        //     "title": "NO. BAP",
        //     "data": "stokhNoPenerimaanGudang",
        //     "width": "120px",
        // },{
        //     "title": "NOTA",
        //     "data": "stokhNoKwitansi",
        //     "width": "120px",
        // },
        {
            "title": "SUPLIER",
            "data": "stokhSuplier",
            //    "width":"8%",
        },
        {
            "title": "TRANSAKSI",
            "data": "stokhNoTrans",
            "width": "150px",
            "sClass": "center",
        },
        {
            "title": "TOTAL",
            "data": "stokhTotal",
            "width": "130px",
            "sClass": "number",
        },
        {
            "title": "PRINT",
            "data": "print",
            "width": "3%",
            "sClass": "center",
        },
        // {
        //     "title": "DEL",
        //     "data": "del",
        //     "width": "3%",
        //     "sClass": "center",
        // },
    ];
    var table = $('#tDataList').DataTable({
        "sorting": [[0, "asc"]],
        "dom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "paging": true,
        "info": false,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "No records available",
            "info": "Page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "SEARCH :  ",
            "paginate": {"next": "", "previous": ""}
        },
        "processing": false,
        "serverSide": true,

        "ajax": {
            "url": "backend/public/api/admin/report/penilaianbulanan",
            "dataType": "json",
            "data": ({stokhGudang: 1}),
        },

        "columns": kolom,
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 1, 2, 3,4,5]}
        ],

    });

    oTable2 = table;
}

function setFieldType() {
    var ctabel = '';
    var field = [
        {
            nama: 'nota',
            readonly: false,
            type: 'text',
        },

        {
            nama: 'tglfaktur',
            readonly: false,
            type: 'date',
        },

        {
            nama: 'suplier',
            readonly: false,
            apidata: 'backend/public/api/admin/master/supplierforcombo',
            type: 'autocomplete',
        },
        {
            nama: 'ppn',
            readonly: false,
            type: 'text',
        },

        {
            nama: 'nofaktur',
            readonly: false,
            type: 'text',
        },
        {
            nama: 'tglterima',
            readonly: false,
            type: 'date',
        },
        {
            nama: 'jthtempo',
            readonly: false,
            type: 'date',
        },

        {
            nama: 'kodeBarang',
            readonly: true,
            type: 'text',
        },

        {
            nama: 'lkIdPeg',
            readonly: false,
            apidata: 'backend/public/api/admin/master/pegawai2forcombo',
            type: 'autocomplete',
        },

        {
            nama: 'satuan',
            readonly: true,
            type: 'text',
        },

        {
            nama: 'tglexp',
            readonly: false,
            type: 'date',
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
            nama: 'diskon',
            readonly: false,
            type: 'angka',
        },
        {
            nama: 'ket',
            readonly: false,
            type: 'text',
        },
    ];




    for (i = 0; i <= field.length - 1; i++) {

        if (field[i].type == 'text') {
            if (field[i].readonly) {
                $('#' + field[i].nama).attr("readonly", "readonly");
            }
        }

        if (field[i].type == 'date') {

            var tg = new Date();
            var day = tg.getDate();
            var mon = tg.getMonth();
            var yee = tg.getFullYear();
            mon = mon + 1;


            mon = mon.toString();
            if(mon.length==1) mon = '0'+mon;

            day = day.toString();
            if(day.length==1) day = '0'+day;

            $('#' + field[i].nama).datepicker({
                format: 'dd/mm/yyyy',
            });
            if (field[i].readonly) {
                $('#' + field[i].nama).attr("readonly", "readonly");
            }
        }

        if (field[i].type == 'angka') {
            // $('#' + field[i].nama).keypress(function () {
            //     return(numbersonly(event));
            // });
            if (field[i].readonly) {
                $('#' + field[i].nama).attr("readonly", "readonly");
            }
        }

        if (field[i].type == 'autocomplete') {
            var comboapi = field[i].apidata;

            $('#' + field[i].nama)
            .on("change", function (e) {
                id          = e.added.id;
                txt         = e.added.nama;
                kode        = e.added.kode;
                satuan      = e.added.satuan;
                harga       = e.added.harga;

                nmhidden    = this.id + '_hidden';
                $('#' + nmhidden).attr('value', txt);

                var koma = numeral(harga).format('0.00')
                if (this.id == 'lkIdPeg') {
                    $('#kodeBarang').attr('value', kode);
                    $('#satuan').attr('value', satuan);
                    $('#hrgbeli').attr('value', harga);
                    // $('#hrgbeli').val(koma);
                }
            })
            .select2({
                placeholder: "Pilih Data",
                ajax: {
                    url: comboapi,
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term, page, tabel) {
                        return {
                            term: term, //search term
                            page_limit: 10 // page size
                        };
                    },
                    results: function (data, page) {
                        return {results: data};
                    },
                }
            });
        }
    }


}

function setupTabel() {

    var kolom = [

        {
            "title": "NO",
            "data": "nomor",
            "width": "3%",
            "sClass": "center",
        },
        {
            "title": "NIP",
            "data": "kodeBarang",
            "width": "8%",
        },
        {
            "title": "NAMA PEGAWAI",
            "data": "namaBarang",
            // "width":"30%",
        },
        {
            "title": "DPK",
            "data": "hrgbeli",
            "width": "10%",
            "sClass": "number",
        },
        {
            "title": "DPAK",
            "data": "qty",
            "width": "10%",
            "sClass": "number",
        },
          {
            "title": "DPSK",
            "data": "qty",
            "width": "10%",
            "sClass": "number",
        },
          {
            "title": "DPA",
            "data": "qty",
            "width": "10%",
            "sClass": "number",
        },
        // {
        //     "title": "SATUAN",
        //     "data": "satuan",
        //     "width": "7%",
        //     "sClass": "center",
        // },

        {
            "title": "NILAI DP3",
            "data": "total",
            "width": "10%",
            "sClass": "number",
        },

        {
            "title": "DEL",
            "data": "aksi",
            "width": "3%",
            "sClass": "center",
        },
    ];


    var table = $('#tData').DataTable({
        "sorting": [[0, "asc"]],
        "dom": "<<'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "paginationType": "bootstrap",
        "paging": false,
        "info": false,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "No records available",
            "info": "Page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "",
            "paginate": {"next": "", "previous": ""}
        },
        "processing": false,
        "serverSide": false,
        "columns": kolom,
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0, 1, 2, 3, 4, 5, 6]}
        ],

    });

    oTable = table;
}

function hitDiskon(hrg, dsc) {

    if (dsc == '') {
        dsc = 0;
    }

    var harga = parseFloat(hrg);
    var diskon = parseFloat(dsc);
    var result = harga * (diskon / 100);
    return result;
}

function addList() {
    var idxDetail= document.getElementById('idxdet').value;
    var kode     = document.getElementById('kodeBarang').value;
    var nama     = document.getElementById('lkIdPeg_hidden').value;
    // var satuan   = document.getElementById('satuan').value;
    var ket      = document.getElementById('keterangan').value;
    var qty      = document.getElementById('qty').value;
    var hrgbeli  = document.getElementById('hrgbeli').value;
    var tglterima= document.getElementById('tglterima').value;

    if (kode === '' || qty === '' || qty === 0 || hrgbeli === '' || hrgbeli === 0 || tglterima === '') {
        alert('Item : \n1. Barang \n2. Harga Beli \n3. Qty \n4. Tanggal Penerimaan \nMasih Ada Yang Kosong');
        $('#hrgbeli').focus();
        return;
    }

    var status_eksis=false;
    for (i = 1; i <= idxDetail - 1; i++) {
        if (document.getElementById('kodeBarang' + i) != null) {
            var kode_eksis    = document.getElementById('kodeBarang' + i).value;
            if(kode_eksis==kode){
                status_eksis=true;
            }
        }
    }
    if(status_eksis){
        alert('Pegawai Sudah Ditambahkan !!!');
        return;
    }

    // var ndiskon             = hitDiskon((hrgbeli * qty), 0);
    var total               = (parseInt(qty) + parseInt(hrgbeli));
    var hasil               = (parseInt(qty) + parseInt(hrgbeli))/2;
    var kehadiran           =(total * 0.6);
    var pekerjaan           =(total * 0.4);
    var result              = new Object();

    result["nomor"]         = idxDetail;
    result["kodeBarang"]    = "<input type='hidden' id='kodeBarang" + idxDetail + "' value='" + kode + "'>" + kode + "<input type='hidden' id='baris" + idxDetail + "' value='" + idxDetail + "'>";
    result["namaBarang"]    = "<input type='hidden' id='namaBarang" + idxDetail + "' value='" + nama + "'>" + nama;
    result["satuan"]        = "<input type='hidden' id='satuan" + idxDetail + "' value='" + satuan + "'>" + satuan + "<input type='hidden' id='keterangan" + idxDetail + "' value='" + ket + "'>";
    result["qty"]           = "<input type='hidden' id='qty" + idxDetail + "' value='" + pekerjaan + "'>" + pekerjaan;
    result["hrgbeli"]       = "<input type='hidden' id='hrgbeli" + idxDetail + "' value='" + kehadiran + "'>" + kehadiran;
    result["total"]         = "<input type='hidden' id='total" + idxDetail + "' value='" + hasil + "'>" + numeral(hasil);
    // result["aksi"]          = '<a href="#"><i class="fa  fa-times-circle" onclick="delList(' + idxDetail + ')"></i></a>';
    result["aksi"]          = '<a href="#"><i class="fa  fa-times-circle" onclick="delList(this,'+total+')"></i></a>';

    oTable.row.add(result).draw();

    var a = parseInt(idxDetail);
    a = a + 1;
    jmlBrs += 1;
    document.getElementById('idxdet').value = a;
    //clear
    $('#kodeBarang').attr('value','');
    // $('#namaBarang').attr('value','');
    $('#satuan').attr('value','');
    document.getElementById('keterangan').value = '';
    document.getElementById('qty').value = '';
    document.getElementById('hrgbeli').value = '';
    $("#namaBarang").select2("val", "");
    result = null;
    hitTotal();
}

function delList(btn, total){
    var totaltanpa_ppn = document.getElementById('totaltanpa_ppn').value;
    var totaltrans = document.getElementById('totaltrans').value;
    var nppn = document.getElementById('nppn').value;
     for(c=1;c<=10;c++){
            totaltanpa_ppn=totaltanpa_ppn.replace(",","");
            totaltrans=totaltrans.replace(",","");
            nppn=nppn.replace(",","");

        }
        
    var ppn= parseFloat(total)*0.1;
    
    if(nppn == 0){
      var nppnbaru = 0;
      var totalbaru =parseFloat(totaltrans)-parseFloat(total);
     
    }
    else {
    var nppnbaru = parseFloat(nppn)-ppn;
    var totalbaru =parseFloat(totaltrans)-parseFloat(total)-ppn;
     
    }
    var totaltanpa_ppn = parseFloat(totaltanpa_ppn)-parseFloat(total);
    
    var tbl = $(btn).closest('table').DataTable();
    var tr = $(btn).closest('tr');
    oTable.row(tr).remove().draw(false);
    document.getElementById('nppn').value=numeral(nppnbaru).format('0,0.00');
    document.getElementById('totaltrans').value=numeral(totalbaru).format('0,0.00');
    document.getElementById('totaltanpa_ppn').value=numeral(totaltanpa_ppn).format('0,0.00');
     
}

// function delList(row) {
//     document.getElementById("tData").deleteRow(row);
//     var idx = document.getElementById('idxdet').value;
//     idx = idx - 1;
//     var b = 1;

//     for(var a = 1; a <= jmlBrs; a++) {
//         if(document.getElementById('baris'+a) !== null) {
//             document.getElementById('baris'+a).value = b;
//             b = b + 1;
//         }
//     }
//     var brs = document.getElementById('baris'+row).value;
//     oTable.row(brs-1).remove().draw();
//     // document.getElementById('idxdet').value = idx;
//     hitTotal();
// }

function hitTotal() {
    var idxDetail   = document.getElementById('idxdet').value;
    var ppn         = document.getElementById('ppn').value;
    var jumlah      = 0;
    var nlppn       = 0;
    var jum         = 0;
    if (ppn==2){ //cek kondisi exclude
        for(i=1;i<=jmlBrs;i++){
            if(document.getElementById('total'+i) !== null){
                var jum =document.getElementById('total'+i).value;
                for(c=1;c<=10;c++){
                    jum = jum.replace(",", "");
                }
            } else {jum = 0;}
            jumlah  += parseFloat(jum);
        }
        nlppn=jumlah*0.1; //hitung ppn
    }
    else { //cek kondisi include atau tanpa ppn
        for(i=1;i<=jmlBrs;i++){
            if(document.getElementById('total'+i) !== null){
                var jum =document.getElementById('total'+i).value;
                for(c=1;c<=10;c++){
                    jum = jum.replace(",","");
                }
            }else {jum = 0;}
            jumlah  += parseFloat(jum);
        }
    }
    document.getElementById('nppn').value=numeral(nlppn).format('0,0.00');
    document.getElementById('totaltanpa_ppn').value=numeral(jumlah).format('0,0.00');
    document.getElementById('totaltrans').value=numeral(jumlah+nlppn).format('0,0.00');
    jumlah = 0;
}

function simpan() {
    if(document.getElementById('isProcessing').value == 1){
        alert('Maaf Data sedang diproses.');
        return;
    }
    
    document.getElementById('isProcessing').value = 1;

    var postData             = new Object();
    var idxDetail            = document.getElementById('idxdet').value;
    // var nota                 = document.getElementById('nota').value;
    var nopemeriksaan        = document.getElementById('nopemeriksaan').value;
    // var nokontrak            = document.getElementById('nokontrak').value;
    // var nokwitansi           = document.getElementById('nokwitansi').value;
    // var jenis                = document.getElementById('jenis').value;
    // var nopenerimaangudang   = document.getElementById('nopenerimaangudang').value;
    var idskpd               = $('#idskpd').val();
    // var supplier             = document.getElementById('suplier_hidden').value;
    // var ppn                  = document.getElementById('ppn').value;
    var tgl_pengadaan        = document.getElementById('tglterima').value;

    if ( tgl_pengadaan == '') {
        alert("1. Tanggal Penerimaan \nBelum sepenuhnya diisi. Mohon dilengkapi");
        document.getElementById('isProcessing').value = 0;
        return;
    }

    // if (supplier == '') {
    //     alert("Suplier Belum dipilih silahkan dipilih terlebih dahulu");
    //     document.getElementById('isProcessing').value = 0;
    //     return;
    // }

    var bulan = tgl_pengadaan.split('/');
    
    if(bulan[0] > 12){
        alert('Format tanggal salah !\n\nFormat Tanggal pada sistem adalah Bulan/Tanggal/Tahun');
        document.getElementById('tglterima').value = '';
        document.getElementById('tglterima').focus();
        document.getElementById('isProcessing').value = 0;
        return;
    }

    // postData['nota']                 = nota;
    postData['nopemeriksaan']        = nopemeriksaan;
    // postData['nokontrak']            = nokontrak;
    // postData['nokwitansi']           = nokwitansi;
    // postData['nopenerimaangudang']   = nopenerimaangudang;
    // postData['supplier']             = supplier;
    // postData['jenis_ppn']            = ppn;
    postData['tgl_pengadaan']        = tgl_pengadaan;
    // postData['jenis']                = jenis;
    postData['stokhGudang']          = 1;
    postData['otomatis']             = 0;
    postData['jumRecord'] = idxDetail - 1;

    for (i = 1; i <= idxDetail - 1; i++) {
        if (document.getElementById('kodeBarang' + i) != null) {

            var kode    = document.getElementById('kodeBarang' + i).value;
            var nama    = document.getElementById('namaBarang' + i).value;
            //var satuan  = document.getElementById('satuan' + i).value;
            // var ket     = document.getElementById('keterangan' + i).value;
            var qty     = document.getElementById('qty' + i).value;
            var hrgbeli = document.getElementById('hrgbeli' + i).value;
            var total   = document.getElementById('total' + i).value;

            postData['id_barang' + i] = kode;
            postData['nama_barang' + i] = nama;
            //postData['satuan_besar' + i] = satuan;
            // postData['keterangan' + i]  = ket;
            postData['qty' + i] = qty;
            postData['harga' + i] = hrgbeli;
            postData['total' + i] = total;

        }
    }


    if (idxDetail > 1) {
        if (confirm("Anda Akan Simpan Transaksi ?")) {
            //confirm("isinya nota= "+nota);
            //confirm(postData['nota']);

            $.ajax({
                type: "POST",
                url: "backend/public/api/admin/report/penilaianbulanan",
                data: postData,
                dataType: "json",
                success: function (data) {
                    //confirm(data['stokhNota']);
                    //confirm(data['nota']);
                    //confirm(data);

                    oTable.clear().draw();
                    $('#tData').dataTable().fnDestroy();
                    setupTabel();

                    oTable2.clear().draw();
                    $('#tDataList').dataTable().fnDestroy();
                    setListing();

                    document.getElementById('nopemeriksaan').value = '';
                    // document.getElementById('nokontrak').value = '';
                    // document.getElementById('nokwitansi').value = '';
                    // document.getElementById('nopenerimaangudang').value = '';
                    document.getElementById('idxdet').value = 1;
                    document.getElementById('nota').value = '';
                    //document.getElementById('tglfaktur').value = '';
                    // document.getElementById('ppn').value =0;
                    // document.getElementById('nppn').value =0;
                    // document.getElementById('nofaktur').value = '';
                    document.getElementById('tglterima').value = '';
                    // document.getElementById('totaltrans').value   = 0;
                    // document.getElementById('totaltanpa_ppn').value = 0;
                    //document.getElementById('sdana').value = '';
                    //document.getElementById('jthtempo').value = '';
                    $("#suplier").select2("val", "");
                    jmlBrs = 0;

                    document.getElementById('isProcessing').value = 0;

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

function deleteData(idData) {
    var method = 'DELETE';
    var apiUrl = "backend/public/api/admin/gudang/penerimaan/" + idData;

    if (confirm("Anda Akan Menghapus Data Ini?")) {
        $.ajax({
            type: method,
            url: apiUrl,
            dataType: "json",
            success: function (data3) {

                var oTableToUpdate = $('#tDataList').dataTable({bRetrieve: true});
                oTableToUpdate.fnDraw();
                //console.log(data3);
            }
        });
    }

}
function printData(id) {
    var param = "?id=" + id;
    var url = "backend/public/api/admin/report/cetakpenerimaan";
    window.open(url + param, '_blank');
}
