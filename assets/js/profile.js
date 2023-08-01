
$(document).ready(function() {
    //DefaultShown
    $("#loading").hide();
    $("#overview").show();
               
});


$("#changeprofile").click(function(){
    alert("wala pang function");
});

$("#changepasswordbtn").click(function(){
    changepassword_fn();
});
$("#savechangesprofile").click(function(){
    changepersonalinfo_fn();
});

function changepassword_fn() {
    var oldpassword = $("#oldpassword").val();
    var newpassword = $("#newpassword").val();
    var confirmnewpassword = $("#confirmnewpassword").val();
    if(newpassword !== confirmnewpassword){
        toastr.error("","Password Do Not Match");
    }
    var payload = {
        type:"change_user_password",
        oldpass: oldpassword,
        newpass: newpassword
    }
    $.ajax({
        url: '../api/main_handler.php',
        type: 'POST',
        data : payload,
        async: true,
        beforeSend: function () {
        },
        success: function(data){
            const quer = JSON.parse(data);
            if(quer.success === true){
                resetInputs();
            	toastr.success('', 'Success');
             }else{
             	toastr.error('', quer.response);
            }
        }
    });
}

function changepersonalinfo_fn(){
    var firstname = $("#firstname").val();
    var middlename = $("#middlename").val();
    var lastname = $("#lastname").val();
    
    var payload = {
        type:"change_profile_information",
        fname: firstname,
        mname: middlename,
        lname: lastname
    }

    $.ajax({
        url: '../api/main_handler.php',
        type: 'POST',
        data : payload,
        async: true,
        beforeSend: function () {
        },
        success: function(data){
            resetInputs();
            const quer = JSON.parse(data);
            if(quer.success === true){
            	toastr.success('', 'Success');
             }else{
             	toastr.error('', quer.response);
            }
        }
    });
  
}

$('#change_avatar_btn').click(function() {
    //	$('#personal_info_btn').classList.remove("active");
    $(this).addClass("active");
    $("#change_password").hide();
    resetInputs();
    $('#change_password_btn').removeClass("active");

    $("#change_avatar").show();
});


$('#change_password_btn').click(function() {
    //	$('#personal_info_btn').classList.remove("active");
    $(this).addClass("active");
    $("#change_avatar").hide();

    $('#change_avatar_btn').removeClass("active");

    $("#change_password").show();
});


$('#overview_btn').click(function() {
    //	$('#personal_info_btn').classList.remove("active");
    $(this).addClass("active");
    $('#personal_info_btn').removeClass("active");
    $('#account_sett_btn').removeClass("active");

    $("#loading").show();
    settodefault();
    setTimeout(() => {
        $("#loading").hide();
        settodefault();
        $("#overview").show();
    }, 500);
});

$('#personal_info_btn').click(function() {
    //	$('#overview_btn').classList.remove("active");
    $(this).addClass("active");
    $('#overview_btn').removeClass("active");
    $('#account_sett_btn').removeClass("active");

    $("#loading").show();
    settodefault();

    setTimeout(() => {
        $("#loading").hide();
        settodefault();
        $("#personal_info").show();
    }, 500);
});

$('#account_sett_btn').click(function() {
    //	$('#overview_btn').classList.remove("active");

    $(this).addClass("active");
    resetInputs();
    $('#change_avatar_btn').addClass("active");
    $('#change_password_btn').removeClass("active");
    $("#change_password").hide();
    $("#change_avatar").show();




    $('#personal_info_btn').removeClass("active");
    $('#overview_btn').removeClass("active");


    $("#loading").show();
    settodefault();

    setTimeout(() => {
        $("#loading").hide();
        settodefault();
        $("#account_sett").show();
    }, 500);
});

function resetInputs() {
    $('#change_password').find('form').trigger('reset');
    $('#personal_info').find('form').trigger('reset');
}

function settodefault( /*hidden_all*/ ) {
    resetInputs();
    $("#overview").hide();
    $("#personal_info").hide();
    $("#account_sett").hide();
}

