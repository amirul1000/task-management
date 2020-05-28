<?php
session_start();
	include("../config.php");

	$username	=	$_GET['username'];
	$password	=	$_GET['password'];
	
	// SELECT credentials MATCH FROM THE DATABASE
	$query	=	"SELECT * FROM `admin` where username=? and password=?";
	$parameters	=	array($username,sha1($password));
	$statement	=	$db->prepare($query);
	$statement->execute($parameters);
	
	// If match found in database then login
	if($statement->rowCount() > 0) {

			$data = $statement->fetch(PDO::FETCH_ASSOC);

			// Create Session of Admin Name and admin
			$_SESSION['adminName']	=	$data['name'];
			$_SESSION['admin']	    =	$data['username'];
			
			//custom
			$_SESSION['admin_id']	=	$data['id'];
			$_SESSION['users_type']	=	$data['users_type'];
			
			//Last login update
			$queryLastLogin	=	"UPDATE `admin` SET lastlogin_at = NOW() where username=?";			
			$statementLastLogin	=	$db->prepare($queryLastLogin);
			$statementLastLogin->execute(array($username));

			$output['error']	=	'success';
			$output['msg']		=	'Logged in Successfully';
	
	}else
	{
			$output['error']	=	'error';
			$output['msg']		=	'Wrong Login Details';
	}
	
	// output the json format of messages
	echo json_encode($output); 	
?>