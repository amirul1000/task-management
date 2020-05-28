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

			$mail = new PHPMailer;
			$mail->From = $fromAddress;
			$mail->FromName = $fromName;
			$mail->addAddress($data['email'], $data['name']);     // Add a recipient
			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Forget Password';
			$mail->Body    = "Welcome <h2 style='color:red'>{$data['name']}</h2>
			<hr>
			Your Login details are

			<br>
			<br>
			<b>username:</b> {$data['username']}<br>
			<b>password:</b> {$data['password']}<br>
			<b>email:</b> {$data['email']}<br>
			";

			if(!$mail->send()) {
			    $output['mailstatus']	=	'error';
			    $output['mailmsg']	=	$mail->ErrorInfo;
			
			} else {
				$output['mailstatus']	=	'success';
			    
			}
			
			$output['error']	=	'success';
			$output['msg']		=	'Password sent successfully to <b>'.$data['email'].'</b>';
	
	}else
	{
			$output['error']	=	'error';
			$output['msg']		=	'This username is not registered.Please type the correct username';
	}
	echo json_encode($output); 	
?>