
$(document).ready(function(){


}); 

function login(){
    var user=document.getElementById('userid').value;
    var pass=document.getElementById('password').value;

	var host = window.location.host;


    $.ajax({
        type: "POST",
        url: 'backend/public/api/admin/config/login',
        data: ({username:user,password:pass}),
        dataType:"json",
        success:function(data){
            if(data.status.message==''){
                window.location.href = 'main.html';
            }else{
                alert(data.status.message);                            
            }
        }
    });

}     
