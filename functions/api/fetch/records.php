<?php

namespace api\fetch;

use responses;
use mysqli_wrapper;


function fetch_all_records(mysqli_wrapper $c_con){
    $all_u_q = $c_con->query('SELECT * FROM c_records');
    
    return $all_u_q->fetch_all(1);
}

function fetch_recent_records(mysqli_wrapper $c_con,$count=5){
  	$fetch_rr = $c_con->query('SELECT * FROM `c_records` ORDER BY `c_records`.`c_timestamp` DESC LIMIT '.$count);

 	return $fetch_rr->fetch_all(1);
}