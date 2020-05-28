<?php
session_start();
	include("../config.php");
	require '../assets/PHPMailer/PHPMailerAutoload.php';

	$username	=	$_GET['username'];

	// SELECT MATCH FROM THE DATABASE 
	$query	=	"SELECT * FROM `users` where username=? ";
	$parameters	=	array($username);
	$statement	=	$db->prepare($query);
	$statement->execute($parameters);

	
	if($statement->rowCount() > 0) {

			$data = $statement->fetch(PDO::FETCH_ASSOC);

			// Forget Key generation Login
			$forget_key =	sha1($encryption_key.$username);

			$statement	=	$db->prepare("UPDATE `users` SET forget_key = ?  where username=? ");
			$statement->execute(array($forget_key,$username));

			$mail = new PHPMailer;
			$mail->From = $fromAddress;
			$mail->FromName = $fromName;
			$mail->addAddress($data['email'], $data['name']);     // Add a recipient
			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Reset Password';
			$mail->Body    = "Welcome <strong>{$data['name']}</strong>
			<hr>
			Please follow the below link to reset your password

			<br>
			{$base_url}reset_password.php?key={$forget_key}

			";

			if(!$mail->send()) {
			    $output['mailstatus']	=	'error';
			    $output['mailmsg']	=	$mail->ErrorInfo;
			
			} else {
				$output['mailstatus']	=	'success';
			    
			}
			
			$output['error']	=	'success';
			$output['msg']		=	'Reset password mail sent to <b>'.$data['email'].'</b>';
	
	}else
	{
			$output['error']	=	'error';
			$output['msg']		=	'This username is not registered.Please type the correct username';
	}
	echo json_encode($output); 	
?>