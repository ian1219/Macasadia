<?php

require '../functions/includes.php';
$c_con = get_connection();

/* HTTP HEADER PARSER */
$HTTPHeaders = array();
foreach ($_SERVER as $key => $value) {
    if (strpos($key, 'HTTP_') === 0) {
        $HTTPHeaders[str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
    }
}

if(!isset($HTTPHeaders['Encryption'])){
     die(responses::wrapper('Invalid'));
     exit();
}
if (strpos($HTTPHeaders['Encryption'], "XgTeIxQLUiv3lOSl8cXNkt4bxIGFjbzl") !== false) {
	// Do nothing
}else{
	exit();
}

function senddatatotnode($message){
	$ch = curl_init('http://localhost:8080');
	// It's POST
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

	// we send JSON encoded data to the client
	$jsonData = json_encode([
		'message' => $message
	]);
	$query = http_build_query(['data' => $jsonData]);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
	// Just return the transfer
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// execute
	$response = curl_exec($ch);
	 // close
	curl_close($ch);
}

switch($_GET['type'] ?? ''){
    case 'send_water_data':
        $loc = (int)$_GET['pid'];
        $level = (int)$_GET['level'];
        $feet = $_GET['feet'];
        
        $water_level = api\waterlevel\add_wl(get_connection(),$loc,$level,$feet);
        if($level > 0){
            $brgy = $c_con->query('SELECT * FROM c_barangay WHERE c_number=?', [$loc]);
            if($brgy->num_rows > 0){
                $fe = $brgy->fetch_assoc();
				
				
                $c_con->query('INSERT INTO c_records (c_floodlevel,c_barangay) VALUES (?,?)',[$level,$fe['c_name']]);         
               

			
			   if($fe['c_number'] === 0){
				    die(responses::wrapper(responses::success));
			   }else{
					$message = $c_con->query('SELECT * FROM c_message WHERE c_id=?', [$level]);
					$messagex = $message->fetch_assoc();
					$stringmessage = $messagex['c_message'];

					$messagetosend = str_replace(['{fl}','{wl}','{brgy}'], [$level,$feet,$fe['c_name']], $stringmessage);
					
					senddatatotnode($messagetosend);
				}
            }
        }
        die(responses::wrapper(responses::success));
    case 'send_single_sms':
        $loc = $_GET['pid'];
        $level = $_GET['level'];
        $feet = $_GET['feet'];
         die($loc.$level. $feet);
    case 'send_sms_all':
		$message = $_GET['message'];
		$get_allnumbers = api\fetch\fetch_all_residents_numbers(get_connection());
		$numbers = array();
		foreach($get_allnumbers as $number){
			$numbers[] = $number['c_contactnumber'];
		}
		
		$send = smsapi\semaphore\send_bulk_sms_priority($numbers,$message);
        die(responses::wrapper(responses::success,$send));
    default: 
        die(responses::wrapper('Invalid Query'));
}