<?php

namespace smsapi\semaphore;

use Coreproc\MsisdnPh\Msisdn;


function send_single_sms($number,$message,$sendername="SEMAPHORE"){

    if(!Msisdn::validate($number)){
        return "invalid_number";
    }
	
    $msisdn = new Msisdn($number);    
    $contact_number_get =  $msisdn->get();

    $ch = curl_init();
    $payload = array(
        'apikey' => '0d959184e93f27a6cdf13d18299aa672',
        'number' => $contact_number_get,
        'message' => $message,
        'sendername' => $sendername
    );
    curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $payload ) );
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec( $ch );
    curl_close ($ch);
    /*
    {"number":["The number format is invalid."]}
    ["Your current balance of 0 credits is not sufficient. This transaction requires 1 credits."]
	[
		{
			"message_id":146083769,
			"user_id":25909,
			"user":"2018010179@dhvsu.edu.ph",
			"account_id":25771,
			"account":"IT50DHVSU",
			"recipient":"639071639573",
			"message":"asdasdasd",
			"sender_name":"Semaphore",
			"network":"Smart",
			"status":"Pending",
			"type":"Single",
			"source":"Api",
			"created_at":"2022-11-21 00:12:03",
			"updated_at":"2022-11-21 00:12:03"
		}
	]
    */
    return $result;
}
function send_bulk_sms_priority($numbers,$message,$sendername="SEMAPHORE")
{
	 if(!is_array($numbers)){
        return '{"error": "invalid_request"}';
    }

    $number = '';
    $lastkey = count($numbers) - 1;
    foreach($numbers as $k=>$x){
        if(Msisdn::validate($x)){
            $msisdn = new Msisdn($x);    
            $contact_number_get =  $msisdn->get();
        
            $number .= $contact_number_get . ',';
        }
    }

    //Remove the comma at the last string
    $number = rtrim($number, ',');
    if($number === ''){
        return 'invalid_number';
    }
	
	$payload = array(
        'apikey' => '0d959184e93f27a6cdf13d18299aa672',
        'number' => $number,
        'message' => $message,
        'sendername' => $sendername
    );
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/priority');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $payload ) );

	$headers = array();
	$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
}
function send_bulk_sms($numbers,$message,$sendername="SEMAPHORE")
{
    ////apikey=8c1b284a6a2cc279b2aabf684fbf206a&number=09107392977&message=Hello+Ma+friend&sendername=SEMAPHORE
    if(!is_array($numbers)){
        return '{"error": "invalid_request"}';
    }

    $number = '';
    $lastkey = count($numbers) - 1;
    foreach($numbers as $k=>$x){
        if(Msisdn::validate($x)){
            $msisdn = new Msisdn($x);    
            $contact_number_get =  $msisdn->get();
        
            $number .= $contact_number_get . ',';
        }
    }

    //Remove the comma at the last string
    $number = rtrim($number, ',');
    if($number === ''){
        return 'invalid_number';
    }
    $ch = curl_init();
    $payload = array(
        'apikey' => '0d959184e93f27a6cdf13d18299aa672',
        'number' => $number,
        'message' => $message,
        'sendername' => $sendername
    );
    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $payload ) );
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
	
	return $result;
}

function get_credits_remaining(){
    return '';
}