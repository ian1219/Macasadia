<?php

class responses {
    public const success = 'success';

    public static function wrapper(/* responses|string */ $response, $data = null, $force_success = false){
        $success = ($response === self::success || $force_success);

        return json_encode(array(
            'success' => $success,
            'response' => $response,
            'data' => $data
        ));
    }
}
