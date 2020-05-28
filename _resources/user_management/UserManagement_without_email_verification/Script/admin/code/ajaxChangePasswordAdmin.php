<?php
session_start();
  include("../../config.php");

  $password   = $_GET['password'];
  $cpassword  = $_GET['cpassword'];
  
  // SELECT MATCH FROM THE DATABASE
  if($password != $cpassword )
      {        
        $output['error']  = 'error';
        $output['msg']    = "Password and confirm password do not match";

      }else if(strlen($password)<5)
      {        
        $output['error']  = 'error';
        $output['msg']    = "Password must be greater than 5 character";

      }else{
        $query      = "UPDATE `admin` SET password = ? where username='{$_SESSION['admin']}'";
        $parameters = array($password);
        $statement  = $db->prepare($query);
        $statement->execute($parameters);
        
        $output['error']  = 'success';
        $output['msg']    = "Password Changed successfully";

      }
  echo json_encode($output);  
?>