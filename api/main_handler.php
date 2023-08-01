<?php

require '../functions/includes.php';
require '../session.php';
//Check is admin
session::check();

switch($_POST['type'] ?? ''){
    case 'update_message':
      $message = $_POST['message'];
      $level = $_POST['level'];
      $result = api\settings\update(get_connection(),$message,$level);

      die(responses::wrapper($result));
   /*----------------------------------------*/
    case 'change_user_password':
      $oldpass = $_POST['oldpass'];
      $newpass = $_POST['newpass'];
     
      $result = api\users\changepassword(get_connection(),session::username(),$oldpass,$newpass);

      die(responses::wrapper($result));
    case 'change_profile_information':

      $firstname = $_POST['fname'];
      $middlename = $_POST['mname'];
      $lastname = $_POST['lname'];
     
      
      $result = api\users\updateuserinfo(get_connection(),session::username(),$firstname,$middlename,$lastname);
      die(responses::wrapper($result));
      /*----------------------------------------*/
    case 'get_water_level':
      $all_brgy_list = api\fetch\fetch_all_barangay(get_connection());
      $result = array();
      foreach($all_brgy_list as $brgy){
          $brgynumber = $brgy['c_number'];

          $highest_level_of_barangay =  api\fetch\fetch_highest_water_level(get_connection(),$brgynumber);
          $result[] = array(
              "c_id" => $brgy['c_number'],
              "brgy_name" => $brgy['c_name'],
              "hlevel" =>  $highest_level_of_barangay
          );
      }
     die(responses::wrapper(responses::success,$result));  

    case 'get_water_feet_data':
      $result = api\waterlevel\get_water_level_w_interval(get_connection());
      die(json_encode($result,JSON_PRETTY_PRINT));

      /*----------------------------------------*/
    case 'get_recent_records':
      $result = api\fetch\fetch_recent_records(get_connection());
      die(responses::wrapper(responses::success,$result));
    case 'get_records':
      $result = api\fetch\fetch_all_records(get_connection());
      die(responses::wrapper(responses::success,$result));

      /*----------------------------------------*/
    case 'get_residents':
      $result = api\fetch\fetch_all_residents(get_connection());
      die(responses::wrapper(responses::success,$result));
    case 'add_resident':
      $fname = $_POST['fname'];
      $mname = $_POST['mname'];
      $lname = $_POST['lname'];
      $address = $_POST['address'];
      $number =$_POST["number"];
      $barangay = $_POST['barangay'];
        
      $register_residents = api\residents\add(get_connection(),$fname,$mname,$lname,$address,$number, $barangay);
      if($register_residents !== responses::success){
        die(responses::wrapper($register_residents));
      }
      die(responses::wrapper(responses::success));
    case 'delete_resident':
        $id = $_POST['id'];
        $result = api\residents\delete(get_connection(),$id);
        die(responses::wrapper($result));
    case 'edit_resident':
      /*function edit(mysqli_wrapper $c_con, $fname,$mname,$lname,$address,$contactnum, $barangay){*/
      $id = $_POST['id'];
      $fname = $_POST['fname'];
      $mname = $_POST['mname'];
      $lname = $_POST['lname'];
      $address = $_POST['address'];
      $contactnumber = $_POST['contactnumber'];
      $barangay = $_POST['barangay'];
     
      $result = api\residents\edit(get_connection(),$id, $fname,$mname,$lname,$address,$contactnumber,$barangay);

      die(responses::wrapper($result));
      /*----------------------------------------*/
    case 'get_barangay':
      $result = api\fetch\fetch_all_barangay(get_connection());
      die(responses::wrapper(responses::success,$result));
    case 'add_barangay':
      $id = $_POST['b_id'];
      $name = $_POST['b_name'];
      $result = api\barangay\add(get_connection(),$id,$name);
      if($result !== responses::success){
        die(responses::wrapper($result));
      }
      die(responses::wrapper(responses::success,$result));
    case 'delete_barangay':
        $id = $_POST['id'];
        if($id === 0){
          $result = "Failed To Delete!";
          die(responses::wrapper($result));
        }
        $result = api\barangay\delete(get_connection(),$id);
        die(responses::wrapper($result));
    case 'update_barangay':
        $id = $_POST['id'];
        $name = $_POST['brgyname'];
        $old = $_POST['oldname'];
        if($id === 0){
          $result = "Failed To Update!";
          die(responses::wrapper($result));
        }
        $result = api\barangay\update(get_connection(),$id,$name,$old);
        die(responses::wrapper($result));
      /*----------------------------------------*/
    default: 
      die(responses::wrapper('Invalid Query'));
}

