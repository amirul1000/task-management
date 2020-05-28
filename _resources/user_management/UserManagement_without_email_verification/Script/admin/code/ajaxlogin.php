<?php
session_start();
	include("../../config.php");

	$username	=	$_GET['username'];
	$password	=	$_GET['password'];
	
	// SELECT MATCH FROM THE DATABASE
	$query	=	"SELECT * FROM `admin` where username=? and password=?";
	$parameters	=	array($username,$password);
	$statement	=	$db->prepare($query);
	$statement->execute($parameters);
	
	if($statement->rowCount() > 0) {

			$data = $statement->fetch(PDO::FETCH_ASSOC);
			$_SESSION['adminName']	=	$data['name'];
			$_SESSION['admin']	=	$data['username'];
			
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
	echo json_encode($output); 	
?>