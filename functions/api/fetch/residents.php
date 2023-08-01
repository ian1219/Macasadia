<?php

namespace api\fetch;

use responses;
use mysqli_wrapper;


function fetch_all_residents(mysqli_wrapper $c_con){
    $all_u_q = $c_con->query('SELECT * FROM c_residents');
    
    return $all_u_q->fetch_all(1);
}

function fetch_all_residents_numbers(mysqli_wrapper $c_con){
	$all_u_q = $c_con->query('SELECT c_contactnumber FROM c_residents');
    
    return $all_u_q->fetch_all(1);
}

function fetch_resident_barangay(mysqli_wrapper $c_con,$brgy_name){
    $all_u_q = $c_con->query('SELECT * FROM c_residents WHERE c_barangay=?',[$brgy_name]);
    
    return $all_u_q->fetch_all(1);
}