<?php

namespace api\settings;

use mysqli_wrapper;
use responses;

use api\logs;

function fetchmessage(mysqli_wrapper $c_con,$message_id = 1){
    $all_u_q = $c_con->query('SELECT * FROM c_message WHERE c_id = '.$message_id);
    
    return $all_u_q->fetch_assoc();
}

function update(mysqli_wrapper $c_con,$message,$message_id = 1){
    $all_u_q = $c_con->query('SELECT * FROM c_message WHERE c_id = '.$message_id);
    if($all_u_q->num_rows > 0)
    {
        $c_con->query('UPDATE c_message SET c_message=? WHERE c_id=?',[$message,$message_id]);
    }

    return responses::success;
}
