function startMapping(){
	document.getElementById('pgress').style.width="0px";
	$('#pgresslabel').html('');			

	//mapping LRA
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/tool/prosesmapping2",
        dataType:"json",
        async: false,
        success:function(data){
			document.getElementById('pgress').style.width="20%";
			$('#pgresslabel').html('20% Complete');			
			setTimeout(function(){
	        	startMappingTetapPend();
			}, 500);

        }    
    });    
}


function startMappingTetapPend(){

	//mapping Penetapan Pendapatan
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/tool/prosesmappingtetappend2",
        dataType:"json",
        async: false,
        success:function(data){
			document.getElementById('pgress').style.width="30%";
			$('#pgresslabel').html('30% Complete');			
			setTimeout(function(){
	        	startMappingPenerimaan();
			}, 500);
        }    
    });    
}

function startMappingPenerimaan(){

    //mapping Penetapan Pendapatan
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/tool/prosesmappingpenerimaan",
        dataType:"json",
        async: false,
        success:function(data){
            document.getElementById('pgress').style.width="50%";
            $('#pgresslabel').html('50% Complete');         
            setTimeout(function(){
                startMappingSts();
	        	// startMappingTagihan();
            }, 500);
        }    
    });    
}

function startMappingSts(){

	//mapping STS
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/tool/prosesmappingsts2",
        dataType:"json",
        async: false,
        success:function(data){
			document.getElementById('pgress').style.width="60%";
			$('#pgresslabel').html('60% Complete');			
			setTimeout(function(){
             startMappingTagihan();
			}, 500);
        }    
    });    
}


function startMappingTagihan(){

	//mapping STS
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/tool/prosesmappingtagihan2",
        dataType:"json",
        async: false,
        success:function(data){
			document.getElementById('pgress').style.width="80%";
			$('#pgresslabel').html('80% Complete');			
			setTimeout(function(){
	        	startMappingBendahara();
			}, 500);
        }    
    });    
}

function startMappingBendahara(){

	//mapping STS
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/tool/prosesmappingbendahara2",
        dataType:"json",
        async: false,
        success:function(data){
			document.getElementById('pgress').style.width="100%";
			$('#pgresslabel').html('SELESAI');			
        	// console.log('SELESAI');

        }    
    });    
}

// function setProgress(i,m){

//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/prosesmapping",
//         data:({limit:m}),
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var j=i.toPrecision(3);
// 			var h=Math.floor(j);
// 			var angka=h.toString();
// 			var persen=angka+"%";

// 			document.getElementById('pgress').style.width=persen;
// 			if(h==100){
// 				$('#pgresslabel').html('Proses Selesai');			
// 			}else{
// 				$('#pgresslabel').html(j+'% Complete');			
// 			}
//         }    
//     });    

// }


// function startMapping2(){
// 	document.getElementById('pgress').style.width="0px";
// 	$('#pgresslabel').html('');			


//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/jumrecordtagihan",
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var panjang=data.data[0].jumrecord;
// 			var satuan=(100/panjang);

// 			var a=satuan;
// 			var b=0; 
// 			for(i=1;i<=panjang;i++){
// 				var x=i*200;
// 				setTimeout(function(){
// 					setProgress2(a,b);
// 					a=a+satuan;
// 					b=b+1;			
// 				}, x);
// 			}
//         }    
//     });    
// }

// function setProgress2(i,m){

//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/prosesmappingtagihan",
//         data:({limit:m}),
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var j=i.toPrecision(3);
// 			var h=Math.floor(j);
// 			var angka=h.toString();
// 			var persen=angka+"%";

// 			if(h==100){
// 				startMapping3();
// 			}
// 			document.getElementById('pgress2').style.width=persen;
// 			$('#pgresslabel2').html(j+'% Jurnal SP2D LS');			
//         }    
//     });    

// }


// function startMapping3(){
// 	document.getElementById('pgress').style.width="0px";
// 	$('#pgresslabel').html('');			


//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/jumrecordbendahara",
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var panjang=data.data[0].jumrecord;
// 			var satuan=(100/panjang);

// 			var a=satuan;
// 			var b=0; 
// 			for(i=1;i<=panjang;i++){
// 				var x=i*200;
// 				setTimeout(function(){
// 					setProgress3(a,b);
// 					a=a+satuan;
// 					b=b+1;			
// 				}, x);
// 			}
//         }    
//     });    

// }

// function setProgress3(i,m){

//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/prosesmappingbendahara",
//         data:({limit:m}),
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var j=i.toPrecision(3);
// 			var h=Math.floor(j);
// 			var angka=h.toString();
// 			var persen=angka+"%";

// 			document.getElementById('pgress2').style.width=persen;
// 			if(h==100){
// 				$('#pgresslabel2').html('Proses Jurnal Selesai');							
// 				startMapping4();
// 			}else{
// 				$('#pgresslabel2').html(j+'% Jurnal Transaksi Bendahara');							
// 			}
//         }    
//     });    

// }

// function startMapping4(){
// 	document.getElementById('pgress').style.width="0px";
// 	$('#pgresslabel').html('');			


//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/jumrecordtetappend",
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var panjang=data.data[0].jumrecord;
// 			var satuan=(100/panjang);

// 			if(panjang==0){
// 				startMapping5();
// 			}

// 			var a=satuan;
// 			var b=0; 
// 			for(i=1;i<=panjang;i++){
// 				var x=i*200;
// 				setTimeout(function(){
// 					setProgress4(a,b);
// 					a=a+satuan;
// 					b=b+1;			
// 				}, x);
// 			}
//         }    
//     });    
// }

// function setProgress4(i,m){

//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/prosesmappingtetappend",
//         data:({limit:m}),
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var j=i.toPrecision(3);
// 			var h=Math.floor(j);
// 			var angka=h.toString();
// 			var persen=angka+"%";

// 			document.getElementById('pgress2').style.width=persen;
// 			if(h==100){
// 				$('#pgresslabel2').html('Proses Jurnal Selesai');							
// 				startMapping5();
// 			}else{
// 				$('#pgresslabel2').html(j+'% Jurnal Penetapan Pendapatan');							
// 			}
//         }    
//     });    

// }

// function startMapping5(){
// 	document.getElementById('pgress').style.width="0px";
// 	$('#pgresslabel').html('');			


//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/jumrecordsts",
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var panjang=data.data[0].jumrecord;
// 			var satuan=(100/panjang);

// 			var a=satuan;
// 			var b=0; 
// 			for(i=1;i<=panjang;i++){
// 				var x=i*200;
// 				setTimeout(function(){
// 					setProgress5(a,b);
// 					a=a+satuan;
// 					b=b+1;			
// 				}, x);
// 			}
//         }    
//     });    
// }

// function setProgress5(i,m){

//     $.ajax({
//         type: "GET",
//         url: "backend/public/api/admin/tool/prosesmappingsts",
//         data:({limit:m}),
//         dataType:"json",
//         async: false,
//         success:function(data){

// 			var j=i.toPrecision(3);
// 			var h=Math.floor(j);
// 			var angka=h.toString();
// 			var persen=angka+"%";

// 			document.getElementById('pgress2').style.width=persen;
// 			if(h==100){
// 				$('#pgresslabel2').html('Proses Jurnal Selesai');							
// 			}else{
// 				$('#pgresslabel2').html(j+'% Jurnal Setoran Pendapatan');							
// 			}
//         }    
//     });    

// }
