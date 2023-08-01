<?php

namespace api\barangay;

use responses;
use mysqli_wrapper;

use api\fetch;

function add(mysqli_wrapper $c_con,$brgy_number,$brgy_name){

    if (!is_int((int)$brgy_number)) {
        return "Invalid Barangay Number";//river
    }


    $verify_brgynumber = fetch\verify_brgy_number($c_con, $brgy_number);

    //CHECKING IF THE CONTACT NUMBER ALREADY EXIST
    if($verify_brgynumber !== responses::success)
        return $verify_brgynumber;

   
    $c_con->query('INSERT INTO c_barangay (c_number, c_name) VALUES(?, ?)', [$brgy_number,$brgy_name]);
    
    return responses::success;
}

function update(mysqli_wrapper $c_con,$c_id,$brgy_name,$oldbrgy_name){
    if($c_id === 0)
        return "Failed to Update!";//river

    $fetch_user_by_id = $c_con->query('SELECT c_id FROM c_barangay WHERE c_id=?',[$c_id]);
    if($fetch_user_by_id->num_rows > 0)
    {
       
        $c_con->query('UPDATE c_barangay SET c_name=? WHERE c_id=?',[$brgy_name,$c_id]);

        /*Update Residents With that BRGY Name*/
         $c_con->query('UPDATE c_residents SET c_barangay=? WHERE c_barangay=?',[$brgy_name,$oldbrgy_name]);
    }
    
  
    
   
    


    return responses::success;
}

function delete(mysqli_wrapper $c_con,$c_id){
    if($c_id === 0)
        return "Failed to Delete!";//river

  

    $fetch_user_by_id = $c_con->query('SELECT c_id FROM c_barangay WHERE c_id=?',[$c_id]);
    if($fetch_user_by_id->num_rows > 0)
    {
        $c_con->query('DELETE FROM c_barangay WHERE c_id=?',[$c_id]);
    }
    return responses::success;
}

