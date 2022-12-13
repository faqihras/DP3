function startMapping(){
	document.getElementById('pgress').style.width="0px";
	$('#pgresslabel').html('');

    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/tool/hapuspotdobel",
        dataType:"json",
        async: false,
        success:function(data){
			document.getElementById('pgress').style.width="100%";
			$('#pgresslabel').html('SELESAI');
        }
    });
}

// 125.166.124.220:1
