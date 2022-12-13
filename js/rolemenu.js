
function tableMaster(modulx){
    $.ajax({
        type: "GET",
        url: "backend/public/api/admin/config/getapimenu",
        data:({modul:modulx}),
        dataType:"json",
        success:function(data){
            
            getLangGrid(data[0].apiLangGrid,data[0].apiData,'backend/public/api/admin/config/roledetail?start=0&draw=1');
            getLangForm('backend/public/api/admin/config/roledetail?start=0&draw=1');
            
        }
    });      
}

function getLangGrid(apiLang,apiData,apiLangForm){
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
        var data = $(this).parents('tr').context.cells;
        var idData=data[0].innerText; 
        // setUncheck(apiData,idData,apiLangForm);
        setFormData(apiData,idData,apiLangForm);
    })

}

function setFormData(apiData,idData,apiLangForm){

    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/config/RoleDetaildata?start=0&draw=1&roleId='+idData,
        dataType:"json",
        success:function(data){
            //console.log(data);
            // setUncheck();
            $('#roleMenuId').attr('value',idData);

            if(data.data.length>0){
                for(i=0;i<=data.data.length-1;i++){
                    var field='ck'+data.data[i].rolmMenuId;
                    $('#'+field).attr('checked',true);
                }
            }
        }
    });          
}

function setUncheck(apiData,idData,apiLangForm){
    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/config/roledetail?start=0&draw=1',
        dataType:"json",
        success:function(data){

            for (i = 0; i <= data.data.length-1; i++) {
                var field='ck'+data.data[i].menuId;
                $('#'+field).attr('checked',false);
            }
            setFormData(apiData,idData,apiLangForm);
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
            var result='<input type="hidden" id="roleMenuId" name="roleMenuId">';

            result +='<table class="table table-bordered" margin="10px">';
            result +='<thead>';
            result +='    <tr>';
            result +='        <th>No</th>';
            result +='        <th>Menu</th>';
            result +='        <th>Parent</th>';
             result +='        <th>Aktif</th>';
            result +='    </tr>';
            result +='</thead>';
            result +='<tbody>';

            for (i = 0; i <= data.data.length-1; i++) {
                    if(data.data[i].nmParent==null){
                        var parent="";
                    }
                    else
                    {
                        var parent=data.data[i].nmParent;
                    }

                    result +='    <tr>';
                    result +='        <td>'+(i+1)+'</td>';
                    result +='        <td>'+data.data[i].menuName+'</td>';
                    result +='        <td>'+parent+'</td>';
                    result +='        <td>';

                    result +='<div class="toggle-switch toggle-switch-success">';
                    result +='    <label>';
                    result +='        <input type="checkbox"  id="ck'+data.data[i].menuId+'" name="ck'+data.data[i].menuId+'">';
                    result +='        <div class="toggle-switch-inner"></div>';
                    result +='        <div class="toggle-switch-switch"><i class="fa fa-check"></i></div>';
                    result +='    </label>';
                    result +='</div>';

                    result +='        </td>';
                    result +='    </tr>';

            }


            result +='</tbody>';
            result +='</table>';


            $('#forminput').html(result);
        }
    });              
}


function newdata(){
// alert(document.getElementById('roleMenuId').value);
}

function deleteData(){



}

function save(){

    $.ajax({
        type: "GET",
        url: 'backend/public/api/admin/config/roledetail?start=0&draw=1',
        dataType:"json",
        success:function(data){
            //console.log(data);
            var postData=new Object();

            postData['roleMenuId']=document.getElementById('roleMenuId').value;

            if(document.getElementById('roleMenuId').value!=''){
                for (i = 0; i <= data.data.length-1; i++) {
                    var field='ck'+data.data[i].menuId;

                    if(document.getElementById(field).checked){
                        postData[data.data[i].menuId]=data.data[i].menuId;
                    }else{
                        postData[data.data[i].menuId]='xxx';
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "backend/public/api/admin/config/RoleDetaildata",
                    dataType:"json",
                    data:postData,
                    success:function(data2){
                        alert('Data Tersimpan');
                    }
                });
            }else{
                alert('Role Belum Dipilih');
            }

        }                
    });    

           
}
