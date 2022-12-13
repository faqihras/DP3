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


function rekapDashboard(){
    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/dashboard/rekap',
        dataType:"json",
        success:function(Rdata){
            console.log(Rdata);
            $('#aduan').html(' '+Rdata.aduan);
            $('#status').html(' '+Rdata.status);
            $('#status1').html(' '+Rdata.status1);       
            $('#skpd').html(' '+Rdata.skpd);       
            $('#rbelanja').html(' '+Rdata.rbelanja);     
            $('#sbelanja').html(' '+Rdata.sbelanja);     

            $('#distrik').html(' '+Rdata.distrik); 
             $('#pegawai').html(' '+Rdata.pegawai);    
            $('#rpendapatan').html(' '+Rdata.rpendapatan);       
            $('#spendapatan').html(''+Rdata.spendapatan);       

        }
    });             
}


function MorrisChart1(){


    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/dashboard/angrealskpd',
        dataType:"json",
        success:function(Rdata){
        
            Morris.Bar({
                element: 'morris-chart-1',
                data: Rdata,
                xkey: 'adrkaSkpdKd',
                ykeys: ['adrkaNilai', 'adrkaRealNilai','adrkaSisa'],
                labels: ['Anggaran', 'Realisasi','Sisa'],
                xLabelAngle: 70
            });

        }
    });          
}


function Data(){


    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/dashboard/data',
        dataType:"json",
        success:function(Rdata){
        
            Morris.Bar({
                element: 'Data'
                // data: Rdata,
                // xkey: 'adrkaSkpdKd',
                // ykeys: ['adrkaNilai', 'adrkaRealNilai','adrkaSisa'],
                // labels: ['Anggaran', 'Realisasi','Sisa'],
                // xLabelAngle: 70
            });

        }
    });          
}



function highchartsPendapatan(){

            var xAxisCategori=[
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ];
            
            var seriesData = [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }];






    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/dashboard/pendapatan',
        dataType:"json",
        success:function(Rdata){

            // console.log(Rdata.data);
            // console.log(seriesData);
        
            $('#pendapatanChart').highcharts({              
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Pendapatan'
                },
                xAxis: {
                    categories: Rdata.skpd,
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


function highchartPie(){

    var data=[
                ['Firefox',  45.0],
                ['IE',  26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ];



    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/dashboard/jenisbelanja',
        dataType:"json",
        success:function(Rdata){
                // console.log(data);
                // console.log(Rdata);

               $('#jenisBelanjaPie').highcharts({
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }
                    },
                    title: {
                        text: 'Alokasi J'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Alokasi',
                        data: Rdata
                    }]
                });          

        }
    });    


    
 
}
//
// Graph2 created in element with id = morris-chart-2
//
function MorrisChart2(){
    // Use Morris.Area instead of Morris.Line
    Morris.Area({
        element: 'morris-chart-2',
        data: [
            {x: '2011 Q1', y: 3, z: 3, m: 1},
            {x: '2011 Q2', y: 2, z: 0, m: 7},
            {x: '2011 Q3', y: 2, z: 5, m: 2},
            {x: '2011 Q4', y: 4, z: 4, m: 5},
            {x: '2012 Q1', y: 6, z: 1, m: 11},
            {x: '2012 Q2', y: 4, z: 4, m: 3},
            {x: '2012 Q3', y: 4, z: 4, m: 7},
            {x: '2012 Q4', y: 4, z: 4, m: 9}
        ],
        xkey: 'x',
        ykeys: ['y', 'z', 'm'],
        labels: ['Y', 'Z', 'M']
        })
        .on('click', function(i, row){
            console.log(i, row);
        });
}
//
// Graph3 created in element with id = morris-chart-3
//
function MorrisChart3(){
    var decimal_data = [];
    for (var x = 0; x <= 360; x += 10) {
        decimal_data.push({ x: x, y: Math.sin(Math.PI * x / 180).toFixed(4), z: Math.cos(Math.PI * x / 180).toFixed(4) });
    }
    Morris.Line({
        element: 'morris-chart-3',
        data: decimal_data,
        xkey: 'x',
        ykeys: ['y', 'z'],
        labels: ['sin(x)', 'cos(x)'],
        parseTime: false,
        goals: [-1, 0, 1]
    });
}
//
// Graph4 created in element with id = morris-chart-4
//
function MorrisChart4(){
    // Use Morris.Bar
    Morris.Bar({
        element: 'morris-chart-4',
        data: [
            {x: '2011 Q1', y: 0},
            {x: '2011 Q2', y: 1},
            {x: '2011 Q3', y: 2},
            {x: '2011 Q4', y: 3},
            {x: '2012 Q1', y: 4},
            {x: '2012 Q2', y: 5},
            {x: '2012 Q3', y: 6},
            {x: '2012 Q4', y: 7},
            {x: '2013 Q1', y: 8},
            {x: '2013 Q2', y: 7},
            {x: '2013 Q3', y: 6},
            {x: '2013 Q4', y: 5},
            {x: '2014 Q1', y: 9}
        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Y'],
        barColors: function (row, series, type) {
            if (type === 'bar') {
                var red = Math.ceil(255 * row.y / this.ymax);
                return 'rgb(' + red + ',0,0)';
            }
            else {
                return '#000';
            }
        }
    });
}
//
// Graph5 created in element with id = morris-chart-5
//
function MorrisChart5(){
    Morris.Area({
        element: 'morris-chart-5',
        data: [
            {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
            {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
            {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
            {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
            {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
            {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
            {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
            {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
            {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
            {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
        ],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto'
    });
}

function simpan(){
    $.ajax({
      type: "GET",
      url: 'backend/public/lang/admin/master/absen/form',
      dataType:"json",
      success:function(data2){
        // console.log(data2);
        var postData=new Object();
        var fElement=data2.form;
        // console.log(fElement);
        var idData =document.getElementById('abUserId').value;
        for (i = 0; i <= fElement.length-1; i++) {
          if (document.getElementById("abJenis").value == "") {
            alert("Belum Dipilih Jenis Absennya");
            document.getElementById("AbJenis").focus();
            return;
          }
            if (fElement[i].id == 'AbsenTgl') {
              postData[fElement[i].id]=reversedate(document.getElementById(fElement[i].id).value);
            }else{
              postData[fElement[i].id]=document.getElementById(fElement[i].id).value;
            }
            if(fElement[i].type=='autocomplete'){
                postData[fElement[i].id+'_hidden']=document.getElementById(fElement[i].id+'_hidden').value;                            
            }
        }

        if(idData==''){
            var method='POST';
            var apiUrl="backend/public/api/admin/master/dashboard";
        }else{
            var method='PUT';
            var apiUrl="backend/public/api/admin/master/lapkerja"+'/'+idData;
        }

        if(confirm("Anda Akan Simpan Data Ini ?")){

          var tgl=reversedate(document.getElementById('lkTgl').value);
          $.ajax({
              type: "GET",
              url: "backend/public/api/admin/master/cektanggal",
              dataType:"json",
              data:({tanggal:tgl}),
              success:function(data){
                  if(data==0){
                      alert('Tanggal yang diisikan sudah melebihi 3 hari.\n Anda akan dikenakan sangsi pemotongan gaji. \n Silahkan menghubungi atasan anda!!!');
                      return;
                  }else{
                      $.ajax({
                          type: method,
                          url: apiUrl,
                          dataType:"json",
                          data:postData,
                          success:function(data){
                              idimg=data.data.id;

                              for (i = 0; i <= fElement.length-1; i++) {

                                  if(fElement[i].type=='file'){
                                      var imgfile = document.getElementById(fElement[i].id);  
                                      formdata = new FormData(); 
                                      formdata.append(fElement[i].id,imgfile.files[0]);
                                      formdata.append(fElement[0].id,idimg);

                                      $.ajax({
                                          type: 'POST',
                                          url: 'backend/public/api/admin/setup/uploadImage',
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
                              lapker();
                              var oTableToUpdate =  $('#tData').dataTable( { bRetrieve : true } );
                                  oTableToUpdate .fnDraw();                            
                                  //console.log(data3);
                          },
                          error: function(XMLHttpRequest, textStatus, errorThrown) { 
                              alert(textStatus+" : " + errorThrown+" -> GAGAL DISIMPAN!!"); 
                          } 
                      });
                  }
              }
          });
        }
      }
    }); 
}