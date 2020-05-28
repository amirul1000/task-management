<?php
session_start();
	include("../config.php");

	
	$username	=	$_GET['username'];
	$password	=	$_GET['password'];
	
	// SELECT MATCH FROM THE DATABASE
	$query	=	"SELECT * FROM `users` where username=? and password=?";
	$parameters	=	array($username,sha1($password));
	$statement	=	$db->prepare($query);
	$statement->execute($parameters);
	
	if($statement->rowCount() > 0) {			

			$data = $statement->fetch(PDO::FETCH_ASSOC);

			//check if the status of user is enabled or disabled		   	
			if($data['status']== 'disable')
			{
				$output['error']	=	'error';
			    $output['msg']		=	'The user is currently disabled';

			//check if the email  of user is verified or not		   	
			}elseif($data['email_verified']=='no')
			{
				$output['error']	=	'error';
			    $output['msg']		=	'Your email is not verified.Please verify your email to get logged in';

			}else{

				//Enabled users
				$_SESSION['name']	=	$data['name'];
				$_SESSION['username']	=	$data['username'];
				
				//Last login update
				$queryLastLogin	=	"UPDATE `users` SET lastlogin_at = NOW() where username=?";			
				$statementLastLogin	=	$db->prepare($queryLastLogin);
				$statementLastLogin->execute(array($username));

				$output['error']	=	'success';
				$output['msg']		=	'Logged in Successfully';
			}	
	
	}else
	{
			$output['error']	=	'error';
			$output['msg']		=	'Wrong Login Details';
	}
	echo json_encode($output); 	
?>