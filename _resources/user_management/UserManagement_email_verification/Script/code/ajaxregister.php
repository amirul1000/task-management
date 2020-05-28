<?php
session_start();
	include("../config.php");
    error_reporting(0);
	require '../assets/PHPMailer/PHPMailerAutoload.php';

	$username	=	trim($_REQUEST['username']);
	$password	=	trim($_REQUEST['password']);
	$cpassword	=	trim($_REQUEST['cpassword']);
	$name		=	trim($_REQUEST['name']);
	$email		=	trim($_REQUEST['email']);
	$captcha 	=	$_REQUEST['captcha'];

	$google_url		=	"https://www.google.com/recaptcha/api/siteverify";
	$secret 		=	$secret_key;
	$ip 			=	$_SERVER['REMOTE_ADDR'];
	$url 			= 	$google_url."?secret=".$secret."&response=".$captcha."&remoteip=".$ip;
	$res 			=	getCurlData($url);
	$res 			= 	json_decode($res, true);
	
	//Server side validation

	if(empty($captcha))
	{
			$output['error']	=	'error';
			$output['msg']		=	'Please Enter the Captcha';
			die(json_encode($output)); 		

	}	


	//check if all fields are enter or not
	if($username == '' || $password == '' || $name =='' || $email =='')
	{
			$output['error']	=	'error';
			$output['msg']		=	'All fields are mandatory';			
	}

	//Check password and confirm password match or not
	else if($cpassword != $password)
	{
			$output['error']	=	'error';
			$output['msg']		=	'Password and confirm password do not Match';
			
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
			$output['error']	=	'error';			
			$output['msg']		=	'Enter correct Email ID';
			
	}
	// Insert the data into the database
	else{

			// SELECT MATCH FROM THE DATABASE
			$queryMatch		=	"SELECT * FROM `users` where username=?";			
			$statementMatch	=	$db->prepare($queryMatch);
			$statementMatch->execute(array($username));
	
			if($statementMatch->rowCount() > 0) 
			{

				$output['error']	=	'error';
				$output['msg']		=	'Username Already exists.Try another username.';

			}else{

				// Generate key for email verification
				$key = sha1($encryption_key.$username.$email);

				$query		=	"INSERT INTO `users` SET username=? , password =? , name = ? ,email = ?,`key` = ?,status = ?,email_verified =?";
				$parameters	=	array($username,sha1($password),$name,$email,$key,"enable","no");
				
				$statement	=	$db->prepare($query);				
				$statement->execute($parameters);

				//------------ Email verification------------
				$mail 			= new PHPMailer;
				$mail->From 	= $fromAddress;
				$mail->FromName = $fromName;
				$mail->addAddress($email, $email);     // Add a recipient
				$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Confirm Your Email Address';
				$mail->Body    = "Welcome <strong>{$name}</strong>
				<hr>
				To activate your account you need to verify your Email address. Please click on the link below or copy it into your browser address line:<br>
{$base_url}confirm.php?key={$key}
				";

				if(!$mail->send()) {
				    $output['mailstatus']	=	'error';
				    $output['mailmsg']	=	$mail->ErrorInfo;
				
				} else {
					$output['mailstatus']	=	'success';
				    
				}
				//-------------- End email verification ----------------
				
				$output['error']	=	'success';
				$output['msg']		=	'Mail sent to your email.Please verify your email to get Registered';
			}
			
	}	
	echo json_encode($output); 	
?>