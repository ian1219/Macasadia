


$(document).ready(function() {
	$.fn.dataTable.ext.errMode = 'none'; // Remove Error Alert colspan not supported
	resi_dataTable = $('#barangay').DataTable();
	fetch_update_barangay();
	
});

setInterval(function () 
{

}, 50000);



function fetch_update_barangay(){

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../api/main_handler.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {	
        resi_dataTable.clear().draw();
        const obj = JSON.parse(this.responseText);
        if(obj.data.length === 0)//if object is empty
           return false

        obj.data.every(function retry(value, index){
            //action = '<button type="button" onclick="myFunction()" class="btn btn-success btn-sm" style="margin-right:5px">Edit</button><button type="button" class="btn btn-danger btn-sm">Delete</button>';
            if(value.c_number === 0){
            	 action = '';
            }
            else{
            	 action = '<button type="button" onclick="editModal(\''+value.c_id+'\',\''+value.c_name+'\')" class="btn btn-success btn-sm" style="margin-right:5px">Edit</button><button type="button" onclick="confirmDelete(\''+value.c_id+'\',\''+value.c_name+'\')" class="btn btn-danger btn-sm">Delete</button>';
            }
            resi_dataTable.row.add([value.c_number,value.c_name,action]).draw(false);
            return true;
        });
    };
    xhr.send('type=get_barangay');
}

function isEmpty(str) {
    return (!str || str.length === 0 );
}

function add_new_barangay() {
    const brgy_id = $("#brgy_number").val();
    var brgy_name = $("#brgy_name").val();
    var formData = {
        type: 'add_barangay',
        b_id: parseInt(brgy_id),
        b_name:brgy_name,
    };

   if(!Number.isInteger(parseInt(brgy_id))){
		
    	toastr.error('', "Invalid Barangay Number");
    	return;
    }
	
    if(isEmpty(brgy_id) || isEmpty(brgy_name)){
    	toastr.error('', "Fill Up The Form")
    	return;
    }

	$.ajax({
		url: '../api/main_handler.php',
		type: 'POST',
		data : formData,
		async: true,
		beforeSend: function () {
		},
		success: function(data){
		const quer = JSON.parse(data);

			if(quer.success === true){
				fetch_update_barangay();
				$('#addnewbarangay').modal('hide');
				$('#addnewbarangay').find('form').trigger('reset');
				toastr.success('', 'Success')
	                  
	        }else{
				$('#addnewbarangay').modal('hide');
				$('#addnewbarangay').find('form').trigger('reset');
				toastr.error('', quer.response)
                 
			}
		}
	});
}


$('#addnewbarangay').on('hidden.bs.modal', function () {
	$('#addnewbarangay').find('form').trigger('reset');
});

function confirmDelete(index,name) {
	document.getElementById("user_id").innerHTML = name;
	document.getElementById("delete_id").innerHTML = index;
	$('#confirmDiaglog').modal('show');
}
function editModal(index,name) {
	document.getElementById("edit_user_id").innerHTML = name;
	document.getElementById("brgy_name_update").value = name;
	document.getElementById("edit_id").innerHTML = index;
	$('#editModal').modal('show');
}

function deleteBarangay(){
	var xhr = new XMLHttpRequest();	
	xhr.open('POST', '../api/main_handler.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
	const obj = JSON.parse(this.responseText);
		if(obj.response === "success"){
			toastr.success('', 'Success');
					
			fetch_update_barangay();
		}
	};
	$('#confirmDiaglog').modal('hide');
	xhr.send('type=delete_barangay&id='+document.getElementById("delete_id").innerHTML);
}

function editBarangay(){
	var id = document.getElementById("edit_id").innerHTML;
	var name = document.getElementById("brgy_name_update").value;
	var oldname = document.getElementById("edit_user_id").innerHTML;

	var xhr = new XMLHttpRequest();	
	xhr.open('POST', '../api/main_handler.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
		
		const obj = JSON.parse(this.responseText);
		if(obj.response === "success"){
			toastr.success('', 'Success');
					
			fetch_update_barangay();
		}
	};
	$('#editModal').modal('hide');
	xhr.send('type=update_barangay&id='+id+'&brgyname='+name+'&oldname='+oldname);
}
