<?php

namespace api\fetch;

use responses;
use mysqli_wrapper;


function fetch_all_logs(mysqli_wrapper $c_con){
    $all_u_q = $c_con->query('SELECT * FROM `c_logs` ORDER BY c_timestamp DESC');
    
    return $all_u_q->fetch_all(1);
}

function fetch_all_logs_by_username(mysqli_wrapper $c_con,$username){
    date_default_timezone_set("UTC");
    $all_u_q = $c_con->query('SELECT * FROM `c_logs` WHERE c_username=? ORDER BY c_timestamp DESC',[$username]);
    
    return $all_u_q->fetch_all(1);
}