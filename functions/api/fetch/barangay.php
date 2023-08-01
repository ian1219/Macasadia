<?php

namespace api\fetch;

use responses;
use mysqli_wrapper;


function verify_brgy_number(mysqli_wrapper $c_con,$brgy_number){
    if($c_con->query('SELECT c_number FROM c_barangay WHERE c_number=?', [$brgy_number])->num_rows > 0)
        return 'Barangay # Already Exist';


    return responses::success;
}


function fetch_all_barangay(mysqli_wrapper $c_con){
    $all_u_q = $c_con->query('SELECT * FROM c_barangay');
    
    return $all_u_q->fetch_all(1);
}

