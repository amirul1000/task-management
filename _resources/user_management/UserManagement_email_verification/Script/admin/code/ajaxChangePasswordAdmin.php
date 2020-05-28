<?php
session_start();
  include("../../config.php");

  // ADMIN SESSION CHECK SET OR NOT
  if(!isset($_SESSION['admin']))
  {
          $output['error']  = 'error';
          $output['msg']    = "Session is destroyed";
          die(json_encode($output));
  }

  $password   = $_GET['password'];
  $cpassword  = $_GET['cpassword'];
  
  //Server side validation
  // check if password and confirm password matched or not 
  if($password != $cpassword )
      {        
        $output['error']  = 'error';
        $output['msg']    = "Password and confirm password do not match";

      }else if(strlen($password)<5) //Length of password must be greater than 5 character
      {        
        $output['error']  = 'error';
        $output['msg']    = "Password must be greater than 5 character";

      }else{

        // Update database with new password
        $query      = "UPDATE `admin` SET password = ? where username='{$_SESSION['admin']}'";
        $parameters = array(sha1($password));
        $statement  = $db->prepare($query);
        $statement->execute($parameters);

        $output['error']  = 'success';
        $output['msg']    = "Password Changed successfully";

      }
   // output the json format 
  echo json_encode($output);  
?>