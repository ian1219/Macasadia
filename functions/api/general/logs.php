<?php

namespace api\logs;

use responses;
use mysqli_wrapper;

use DateTime;

function add(mysqli_wrapper $c_con,$username,$c_activity){


    $c_con->query("INSERT INTO c_logs (c_username, c_desc,c_timestamp) VALUES(?, ?, ?)", [$username,$c_activity,date("Y-m-d H:i:s",time())]);
    
    return responses::success;
}
