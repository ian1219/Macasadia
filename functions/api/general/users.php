<?php

namespace api\users;

use mysqli_wrapper;
use responses;

use api\logs;

function changepassword(mysqli_wrapper $c_con,$username,$oldpassword,$newpassword){
  // $check_user = $c_con->query('SELECT c_username FROM c_users WHERE c_username=?', [$username])->num_rows;
    $check_user = $c_con->query('SELECT * FROM c_users WHERE c_username=?', [$username]);

    if($check_user->num_rows === 0)
        return 'User not exist!';

    $user = $check_user->fetch_assoc();

    if(!is_array($user))
       return 'User not exist!';

   if(!password_verify($oldpassword, $user['c_password']))
       return 'Invalid Password';

    $hashed_password = password_hash($newpassword, PASSWORD_BCRYPT);

    $log = logs\add($c_con,strtolower($username), "Changed Password");

    $c_con->query('UPDATE c_users SET c_password=? WHERE c_username=?',[$hashed_password,$username]);

    return responses::success;
}

function updateprofilepicture(){
    
}

function updateuserinfo(mysqli_wrapper $c_con,$username,$firsname,$middlename,$lastname){
    $check_user = $c_con->query('SELECT * FROM c_users WHERE c_username=?', [$username]);

    if($check_user->num_rows === 0)
        return 'User not exist!';

    $user = $check_user->fetch_assoc();

    if(!is_array($user))
       return 'User not exist!';

    $log = logs\add($c_con,strtolower($username), "Changed Personal Information");

    $c_con->query('UPDATE c_users SET c_fname=?,c_mname=?,c_lname=? WHERE c_username=?',[$firsname,$middlename,$lastname,$username]);

    $_SESSION['firstname'] =  ucfirst($firsname);
    $_SESSION['middlename'] =   ucfirst($middlename);
    $_SESSION['lastname'] =   ucfirst($lastname);

    return responses::success;
}