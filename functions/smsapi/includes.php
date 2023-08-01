<?php

$dmp = __DIR__ . '/../smsapi/';

$all_dirs = array(
    
    $dmp . 'semaphore/*.php',
   
);

foreach($all_dirs as $dir)
    foreach(glob($dir) as $php_file)
        require_once $php_file;
