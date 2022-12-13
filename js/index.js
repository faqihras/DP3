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

$(document).ready(function(){

	var host = window.location.host;
    cekSession();
    $.ajax({
        type: "GET",
        url: "backend/public/getSession",
        dataType:"json",
        async: false,        
        success:function(data){
            //console.log(data);
            if(data.userNameAdmin==''){
                window.location.href = 'home.html';
            }
            $('#longname').html(data.userNameAdminLong);
            $('#shortname').html(data.userNameAdmin);
        }
    });      

    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/config/menuadmin',
        dataType:"json",
        async: false,        
        success:function(data){
            //console.log(data);
            var level1=data.data;
            var result='<ul class="nav main-menu">';
            for(i=0;i<=data.data.length-1;i++){
                
                level2=level1[i].data;
                result +='<li class="dropdown">';
                result +='    <a href="'+level1[i].htmlLink+'" class="dropdown-toggle">';
                result +='        <i class="fa '+level1[i].menuIcon+'"></i>';
                result +='        <span class="hidden-xs">'+level1[i].menuName+'</span>';
                result +='    </a>';
                
                if(level2.length>0){
                    result +='<ul class="dropdown-menu">';
                    for(j=0;j<=level2.length-1;j++){
                        
                        var level3=level2[j].data;
                        if(level3.length>0){
                            result +='<li class="dropdown">';
                            result +='    <a href="#" class="dropdown-toggle">';
                            result +='        <i class="fa fa-plus-square"></i>';
                            result +='        <span class="hidden-xs">'+level2[j].menuName+'</span>';
                            result +='    </a>';
                            result +='    <ul class="dropdown-menu">';
                            for(h=0;h<=level3.length-1;h++){
                                var level4=level3[h].data;
                                if(level4.length>0){

                                    result +='<li class="dropdown">';
                                    result +='    <a href="#" class="dropdown-toggle">';
                                    result +='        &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus-square"></i>';
                                    result +='        <span class="hidden-xs">'+level3[h].menuName+'</span>';
                                    result +='    </a>';
                                    result +='    <ul class="dropdown-menu">';
                                    
                                    
                                    for(k=0;k<=level4.length-1;k++){
                                        //console.log(level4);
                                        result +='<li><a class="ajax-link" href="'+level4[k].htmlLink+'#'+level4[k].menuLink+'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+level4[k].menuName+'</a></li>';
                                    }
                                    result +='    </ul>';
                                    result +='</li>';

                                }else{
                                    result +='<li><a class="ajax-link" href="'+level3[h].htmlLink+'#'+level3[h].menuLink+'">&nbsp;&nbsp;&nbsp;&nbsp;'+level3[h].menuName+'</a></li>';
                                }

                            }
                            result +='    </ul>';
                            result +='</li>';

                        }else{
                            result +='<li><a class="ajax-link" href="'+level2[j].htmlLink+'#'+level2[j].menuLink+'">'+level2[j].menuName+'</a></li>';

                        }
                    }
                    result +='</ul>';
                }

                result +='</li>';    
            }            
            result +='</ul>';
            $('#lmenu').html(result);
        }
    });    

   // hari_ini();
});	

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

// function hari_ini(){
//     var namaUser = '';

//     var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
//     var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
//     var date = new Date();
//     var day = date.getDate();
//     var month = date.getMonth();
//     var thisDay = date.getDay(),
//         thisDay = myDays[thisDay];

//     var yy = date.getYear();
//     var year = (yy < 1000) ? yy + 1900 : yy;

//     var tgl = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;

//     $.ajax({
//        type     : "GET",
//        url      : 'backend/public/getSession',
//        dataType : "json",
//        async    : false,
//        success  : function (data) {
//            namaUser = data.userNameAdmin;
//        }
//     });   

//     document.getElementById('hari_ini').innerHTML = tgl + ' | <font style="font-size: 15px; font-weight: 500;">' + namaUser + '</font> &nbsp';
// }