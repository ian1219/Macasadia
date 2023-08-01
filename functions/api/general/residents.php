<?php

namespace api\residents;

use responses;
use mysqli_wrapper;
use Coreproc\MsisdnPh\Msisdn;

function verify_contactnumber(mysqli_wrapper $c_con, $contactnumber){
  
    if($c_con->query('SELECT c_contactnumber FROM c_residents WHERE c_contactnumber=?', [$contactnumber])->num_rows > 0)
        return 'Contact Number already exists';
    return responses::success;
}

function add(mysqli_wrapper $c_con, $fname,$mname,$lname,$address,$contactnum, $barangay){

    $validate_mobile_number = Msisdn::validate($contactnum);
    if (!$validate_mobile_number) {
        return "Invalid Mobile Number!";
    }

    $msisdn = new Msisdn($contactnum);    
    $contact_number_get =  $msisdn->get();

	$contactnumber_verify = verify_contactnumber($c_con, $contact_number_get);
    if($contactnumber_verify !== responses::success)
        return $contactnumber_verify;

     $c_con->query('INSERT INTO c_residents (c_fname, c_mname, c_lname,c_address,c_contactnumber,c_barangay) VALUES(?, ?, ?, ?, ? ,?)', [$fname,$mname,$lname,$address,$contact_number_get, $barangay]);
    
    return responses::success;
}

function edit(mysqli_wrapper $c_con, $c_id,$fname,$mname,$lname,$address,$contactnum, $barangay){
    $validate_mobile_number = Msisdn::validate($contactnum);
    if (!$validate_mobile_number) {
        return "Invalid Mobile Number!";
    }

    $msisdn = new Msisdn($contactnum);    
    $contact_number_get =  $msisdn->get();

    $fetch_user_by_id = $c_con->query('SELECT c_id FROM c_residents WHERE c_id=?',[$c_id]);
    if($fetch_user_by_id->num_rows > 0)
    {
    	$c_con->query('UPDATE c_residents SET c_fname=?,c_mname=?,c_lname=?,c_address=?,c_barangay=?,c_contactnumber=? WHERE c_id=?',[$fname,$mname,$lname,$address,$barangay, $contactnum,$c_id]);
    }

    return responses::success;
}

function delete(mysqli_wrapper $c_con,$c_id){
    $fetch_user_by_id = $c_con->query('SELECT c_id FROM c_residents WHERE c_id=?',[$c_id]);
    if($fetch_user_by_id->num_rows > 0)
    {
    	$c_con->query('DELETE FROM c_residents WHERE c_id=?',[$c_id]);
    }
    return responses::success;
}


