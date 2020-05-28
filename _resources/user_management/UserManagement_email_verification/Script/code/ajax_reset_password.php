<?php
session_start();
	include("../config.php");
  

	$password	=	$_GET['password'];
	$cpassword	=	$_GET['cpassword'];
  $forget_key = $_GET['forget_key'];
	
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

        $query  = "UPDATE `users` SET password = ? where forget_key='{$forget_key}'";        
        $statement  = $db->prepare($query);
        $statement->execute(array(sha1($password)));

        $output['error']  = 'success';
        $output['msg'] = "Password Changed successfully.Click <a href='index.php'> here</a> to get Login";

      }
	echo json_encode($output); 	
?>