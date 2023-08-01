<?php

namespace api\waterlevel;

use responses;
use mysqli_wrapper;
use DateTime;
use DateInterval;
use api\fetch;



function add_wl(mysqli_wrapper $c_con,$barangayname,$clevel,$cfeet){
	$c_con->query('INSERT INTO c_waterlevel (c_brgynumber,c_level,c_feet) VALUES (?,?,?)',[$barangayname,$clevel,$cfeet]);

	return responses::success;
}


function get_water_level_w_interval(mysqli_wrapper $c_con, $range=30,$interval_min = 1,$interval_i = 'M') {
	$start_time = new DateTime();
	$start_time_interval = new DateInterval("PT".$range."M");
	$start_time_interval->invert = 1;
	$start_time->add($start_time_interval);
	$start_time_stamp = $start_time->format('Y-m-d H:i');
	$start_time_stamp = strtotime($start_time_stamp);


	$endtime = new DateTime();
	$endtime_format = $endtime->format('Y-m-d H:i');
	$endtime_stamp = strtotime($endtime_format);

	$brgy = array();
	$river = array();
	$currenttime = 0;
	$interval = $interval_min;

	while($currenttime < $endtime_stamp){
		$minutes_to_add = $interval;
		$time = new DateTime(date('Y-m-d H:i',$start_time_stamp));
		$time->add(new DateInterval('PT' . $minutes_to_add . $interval_i));
		$stamp = $time->format('Y-m-d H:i');
		$currenttime = strtotime($stamp);

		$water_l = fetch\fetch_water_level_by_time($c_con,$currenttime,0);
		if(is_array($water_l)){
			$river[] = array(
				'x'=> date('h:i a',$currenttime),
				'y' => $water_l["c_feet"]
			);
		}else{
			$get_old_data = fetch\fetch_last_water_level_fl(get_connection(),0,$currenttime);
			if(is_array($get_old_data)){
				$river[] = array(
				'x'=> date('h:i a',$currenttime),
				'y' => $get_old_data['c_feet']
			);
			}else{
				$river[] = array(
				'x'=> date('h:i a',$currenttime),
				'y' => 0
			);
			}
		}
		$water_brgy = fetch\fetch_water_level_by_time($c_con,$currenttime,1);
		if(is_array($water_brgy)){
			$brgy[] = array(
				'x'=> date('h:i a',$currenttime),
				'y' => $water_brgy["c_feet"]
			);
		}else{
			$get_old_data = fetch\fetch_last_water_level_fl(get_connection(),1,$currenttime);
			if(is_array($get_old_data)){
				$brgy[] = array(
					'x'=> date('h:i a',$currenttime),
					'y' => $get_old_data['c_feet']
				);
			}else{
				$brgy[] = array(
				'x'=> date('h:i a',$currenttime),
				'y' => 0
				);
			}
		}
		$interval+=$interval_min;
	}

	if(fetch\verify_brgy_number($c_con,0) !== responses::success){
		$fdata[] = array(
			"name"=>'River',
			"data"=> $river
		);
	}
	
	if(fetch\verify_brgy_number($c_con,1) !== responses::success){
		$fdata[] = array(
			"name"=>'Brgy',
			"data"=> $brgy
		);
	}
	
    return $fdata;
}