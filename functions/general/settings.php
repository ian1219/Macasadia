<?php
if (!isset($_SESSION))
    session_start(array(
        'name' => 'thesis_rev1'
    ));

date_default_timezone_set('Asia/Manila');

function get_connection() { 


    return new mysqli_wrapper(
        'localhost', 'root', '', 'thesis_rev1', true
    );
}
