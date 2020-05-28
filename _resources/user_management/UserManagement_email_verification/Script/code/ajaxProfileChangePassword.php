<?php
session_start();
	include("../config.php");
  
  
  if(!isset($_SESSION['username']))
  {
          $output['error']  = 'error';
          $output['msg'] = "Session is destroyed";
          die(json_encode($output));
  }

	$password	=	$_GET['password'];
	$cpassword	=	$_GET['cpassword'];
	
	// SELECT MATCH FROM THE DATABASE
	if($password != $cpassword )
      {        
        $output['error']  = 'error';
        $output['msg'] = "Password and confirm password do not match";

      }else if(strlen($password)<6)
      {        
        $output['error']  = 'error';
        $output['msg'] = "Password must be greater than 6 character";

      }else{

        $query  = "UPDATE `users` SET password = ? where username='{$_SESSION['username']}'";        
        $statement  = $db->prepare($query);
        $statement->execute(array(sha1($password)));

        $output['error']  = 'success';
        $output['msg'] = "Password Changed successfully";

      }
	echo json_encode($output); 	
?>