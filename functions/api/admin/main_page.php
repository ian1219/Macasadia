<?php
namespace admin\main;
use responses;
use mysqli_wrapper;

use api\logs;

function fetch_data(mysqli_wrapper $c_con, $username_email){
    if(!filter_var($username_email, FILTER_VALIDATE_EMAIL)) 
        $u_q = $c_con->query('SELECT * FROM c_users WHERE c_username=?', [$username_email]);
    else
        $u_q = $c_con->query('SELECT * FROM c_users WHERE c_email=?', [$username_email]);

    if($u_q->num_rows === 0)
        return 'The user you tried to login with doesn\'t exist';

    return $u_q->fetch_assoc();
}

function verify_user(mysqli_wrapper $c_con, $username){
    return $c_con->query('SELECT c_username FROM c_users WHERE c_username=?', [$username])->num_rows > 0
        ? 'User already exists' : responses::success;
}

function verify_email(mysqli_wrapper $c_con, $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        return 'Invalid Email';

    if($c_con->query('SELECT c_email FROM c_users WHERE c_email=?', [$email])->num_rows > 0)
        return 'Email already exists';

    return responses::success;
}

function login(mysqli_wrapper $c_con, $username, $password){
    $main_data = fetch_data($c_con, $username);
	
    if(!is_array($main_data))
        return $main_data;

    if(!password_verify($password, $main_data['c_password']))
        return 'Wrong password';

    $_SESSION['username'] = $main_data['c_username'];
    $_SESSION['myemail'] = $main_data['c_email'];
    $_SESSION['panel_access'] = md5($_SESSION['username']);
    $_SESSION['firstname'] =  $main_data['c_fname'];
    $_SESSION['middlename'] =  $main_data['c_mname'];
    $_SESSION['lastname'] =  $main_data['c_lname'];
    $log = logs\add(get_connection(),$main_data['c_username'], "Logged In");

    return responses::success;
}

function register(mysqli_wrapper $c_con, $username, $email, $password){
    $email_verification = verify_email($c_con, $email);

    if($email_verification !== responses::success)
        return $email_verification;

    $user_verification = verify_user($c_con, $username);

    if($user_verification !== responses::success)
        return $user_verification;

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $c_con->query('INSERT INTO c_users (c_username, c_email, c_password) VALUES(?, ?, ?)', [$username, $email, $hashed_password]);

    $log = logs\add(get_connection(),strtolower($username), "Registered!");

    return responses::success;
}


