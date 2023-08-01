<?php

class session {

    public static function check($auto_redirect = true) : bool{
        $username = self::username();

        if(isset($_SESSION['panel_access']) && $_SESSION['panel_access'] === md5($username))
            return true;

        if($auto_redirect) header('Location: ../index.php');

        return false;
    }

    public static function username() : string {
        return $_SESSION['username'] ?? 'not_defined';
    }
}
