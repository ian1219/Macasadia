<?php

class functions {
    static function get_ip() { //headers used by fluxcdn
        if (isset($_SERVER['HTTP_X_REAL_IP']))
            return $_SERVER['HTTP_X_REAL_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            return 'unknown';
    }
    //CAN USE TO RANDOM FORM DATA
    public static function random_string($length = 10, $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {
        $out = '';

        for($i = 0; $i < $length; $i++){
            $rand_index = random_int(0, strlen($keyspace) - 1);

            $out .= $keyspace[$rand_index];
        }

        return $out;
	}
    public static function is_valid_timestamp($timestamp) : bool {
        try{
            new DateTime('@'.(string)$timestamp);
        }
        catch(Exception $ex){
            return false;
        }

        return true;
    }
    
    public static function get_timestamp(){
        return time();
    }
}