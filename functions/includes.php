<?php

$dmp = __DIR__ . '/../functions/';

$all_dirs = array(
    
    $dmp . 'operator/Exceptions/*.php',
    $dmp . 'operator/*.php',
    $dmp . 'general/*.php',
	$dmp . 'api/*.php',
	$dmp . 'api/fetch/*.php',
	$dmp . 'api/admin/*.php',
    $dmp . 'api/general/*.php',
    $dmp . 'smsapi/*.php',
   
);

foreach($all_dirs as $dir)
    foreach(glob($dir) as $php_file)
        require_once $php_file;
