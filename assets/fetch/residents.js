


$(document).ready(function() {
	$.fn.dataTable.ext.errMode = 'none'; // Remove Error Alert colspan not supported
	resi_dataTable = $('#residents').DataTable({
		searchHighlight: true,
	});
	fetch_update_residents();
	
});


setInterval(function () 
{

}, 50000);



function fetch_update_residents(){

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
            var residentname = value.c_fname+' '+ value.c_mname+' '+value.c_lname; 
           /*index,firstname,middlename,lastname,address,c_contactnumber,barangay*/ 
			
			action = '<button type="button" onclick="editModal(\''+value.c_id+'\',\''+value.c_fname+'\',\''+value.c_mname+'\',\''+value.c_lname+'\',\''+value.c_address+'\',\''+value.c_contactnumber+'\',\''+value.c_barangay+'\')" class="btn btn-success btn-sm" style="margin-right:5px">Edit</button><button type="button" onclick="confirmDelete(\''+value.c_id+'\',\''+residentname+'\')" class="btn btn-danger btn-sm">Delete</button>';
            resi_dataTable.row.add([value.c_fname,value.c_mname,value.c_lname,value.c_address,value.c_contactnumber,value.c_barangay,action]).draw(false);
            return true;
        });
    };
    xhr.send('type=get_residents');
}

function isEmpty(str) {
    return (!str || str.length === 0 );
}

function register_residents() {
    var fname = $("#fname").val();
    var mname = $("#mname").val();
    var lname = $("#lname").val();
    var address = $("#address").val();
    var barangay = $("#barangay").val();
    var number = $("#number").val();
    
    if(barangay === 'njf3894'){
    	toastr.error('', "Please Add Barangay First!");
    	return;
    }
    if(isEmpty(fname) || isEmpty(lname) || isEmpty(address) || isEmpty(barangay) || isEmpty(number)){
    	toastr.error('', "Fill Up All Information");
    	return;
    }

    var formData = {
        type: 'add_resident',
        number: number,
        fname:fname,
        mname:mname,
        lname:lname,
        address:address,
        barangay:barangay
    };

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
				fetch_update_residents();
				$('#addnewresident').modal('hide');
				$('#addnewresident').find('form').trigger('reset');
				toastr.success('', 'Success')
	                  
	        }else{
				//$('#addnewresident').modal('hide');
				//$('#addnewresident').find('form').trigger('reset');
				toastr.error('', quer.response)
                 
			}
		}
	});
}


$('#addnewresident').on('hidden.bs.modal', function () {
	$('#addnewresident').find('form').trigger('reset');
});

function confirmDelete(index,name) {
	document.getElementById("user_id").innerHTML = name;
	document.getElementById("delete_id").innerHTML = index;
	$('#confirmDiaglog').modal('show');
}
function editModal(index,firstname,middlename,lastname,address,c_contactnumber,barangay) {
	
	document.getElementById("edit_user_id").innerHTML = firstname +' '+ middlename + ' '+lastname;
	document.getElementById("edit_id").innerHTML = index;
	document.getElementById("e_fname").value = firstname;
	document.getElementById("e_mname").value = middlename;
	document.getElementById("e_lname").value = lastname;
	document.getElementById("e_address").value = address;
	document.getElementById("e_number").value = c_contactnumber;
	document.getElementById("e_barangay").value = barangay;

	$('#editModal').modal('show');
}

function deleteUser(){
	var xhr = new XMLHttpRequest();	
	xhr.open('POST', '../api/main_handler.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
	const obj = JSON.parse(this.responseText);
		if(obj.response === "success"){
			toastr.success('', 'Success');
					
			fetch_update_residents();
		}
	};
	$('#confirmDiaglog').modal('hide');
	xhr.send('type=delete_resident&id='+document.getElementById("delete_id").innerHTML);
}

function editUser(){
	var index = document.getElementById("edit_id").innerHTML ;
	var firstname = document.getElementById("e_fname").value ;
	var middlename = document.getElementById("e_mname").value ;
	var lastname = document.getElementById("e_lname").value;
	var address = document.getElementById("e_address").value ;
	var contactnumber = document.getElementById("e_number").value;
	var barangay = document.getElementById("e_barangay").value ;
	
	


	var xhr = new XMLHttpRequest();	
	xhr.open('POST', '../api/main_handler.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
		
		const obj = JSON.parse(this.responseText);
		if(obj.response === "success"){
			toastr.success('', 'Success');
					
			fetch_update_residents();
		}else{
			toastr.error('', obj.response);
		}
	};
	$('#editModal').modal('hide');
	xhr.send('type=edit_resident&id='+index+'&fname='+firstname+'&mname='+middlename+'&lname='+lastname+'&address='+address+'&contactnumber='+contactnumber+'&barangay='+barangay);
	


}
