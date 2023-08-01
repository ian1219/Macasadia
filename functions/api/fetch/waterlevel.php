<?php

namespace api\fetch;

use responses;
use mysqli_wrapper;


function fetch_water_all_level(mysqli_wrapper $c_con){
    $all_u_q = $c_con->query('SELECT * FROM `water_level` ORDER BY `water_level`.`timestamp` ASC');
    
    return $all_u_q->fetch_all(1);
}

function fetch_highest_water_level(mysqli_wrapper $c_con,$barangaynumber){
 	$fetch_one = $c_con->query('SELECT * FROM `c_waterlevel` WHERE c_brgynumber=? AND date(c_timestamp)>=? order by c_level desc limit 0,1;',[$barangaynumber,date("Y/m/d")]);


    return $fetch_one->fetch_assoc();
}

function fetch_water_level_by_time(mysqli_wrapper $c_con,$timestamp,$barangaynumber){
	$all_u_q = $c_con->query('SELECT * FROM `c_waterlevel` WHERE c_brgynumber=? AND c_timestamp BETWEEN FROM_UNIXTIME(?) AND FROM_UNIXTIME(?) ORDER BY `c_waterlevel`.`c_level` DESC',[$barangaynumber,$timestamp,$timestamp + 59]);
	
    return $all_u_q->fetch_assoc();
}

function fetch_last_water_level(mysqli_wrapper $c_con,$barangaynumber){
	$fetch_one = $c_con->query('SELECT * FROM `c_waterlevel` WHERE c_brgynumber=? AND date(c_timestamp)>=? order by c_timestamp desc limit 0,1;',[$barangaynumber,date("Y/m/d")]);


    return $fetch_one->fetch_assoc();
}

function fetch_last_water_level_fl(mysqli_wrapper $c_con,$barangaynumber,$ftimestamp){
	$fetch_one = $c_con->query('SELECT * FROM `c_waterlevel` WHERE c_brgynumber=? AND UNIX_TIMESTAMP(c_timestamp)<=? order by c_timestamp desc limit 0,1;',[$barangaynumber,$ftimestamp]);

    return $fetch_one->fetch_assoc();
}

function fetch_last_water_level_ll(mysqli_wrapper $c_con,$barangaynumber,$ftimestamp){
	$fetch_one = $c_con->query('SELECT * FROM `c_waterlevel` WHERE c_brgynumber=? AND UNIX_TIMESTAMP(c_timestamp)>=? order by c_timestamp desc limit 0,1;',[$barangaynumber,$ftimestamp]);

    return $fetch_one->fetch_assoc();
}

