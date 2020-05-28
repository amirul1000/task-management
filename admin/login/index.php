<?php
	session_start();
	ob_start();
	include("../../common/lib.php");
	include("../../lib/class.db.php");
	include("../../common/config.php");
	
	$cmd = $_REQUEST['cmd'];
	
	switch($cmd)
	{
	
		case "login":
			$info["table"]     = "admin";
			$info["fields"]   = array("*");
			$info["where"]    = " 1=1 AND username  LIKE  '".clean($_REQUEST["email"])."' AND password  LIKE  '".clean($_REQUEST["password"])."'";			
			$res  = $db->select($info);
			if(count($res)>0)
			{
				// Create Session of Admin Name and admin
				$_SESSION['adminName']	=	$res[0]['name'];
				$_SESSION['admin']	    =	$res[0]['username'];
				
				//custom
				$_SESSION['admin_id']	=	$res[0]['id'];
				$_SESSION['users_type']	=	$res[0]['users_type'];
					
				Header("location:../land");
			}
			else
			{
				$message="Login fail,Please verify your userid or password";
				include("login_editor.php");
			}
			break;
		case "logout":
			session_destroy();
			unset($_SESSION["adminName"]);
			unset($_SESSION["admin"]);
			unset($_SESSION["admin_id"]);
			unset($_SESSION["users_type"]);
	
			include("login_editor.php");
			break;
		case "forget_editor":
			include("forget_editor.php");
			break;
		case "forget_pass":
		      $info["table"]     = "admin";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND email  LIKE BINARY '".$_REQUEST["email"]."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
					$first_name    = $res[0]["first_name"];
					$last_name     = $res[0]["last_name"];
					$email         = $res[0]["email"];
					$password      = $res[0]["password"];
					
					$subject = "Recovery Password from contractortrackerapp";
					
					$body = "Dear $first_name $last_name,<br>
							Your Login information is like below:<br> 
							 Email:$email<br> 
							 password:$password<br><br>
							 
							 Thanks,<br>
							 Contractortrackerapp Team";
					//send email
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: contractortrackerapp <info@contractortrackerapp.com>' . "\r\n";
						
					mail($_REQUEST["email"], $subject, $body, $headers);
					$message ="An email has been sent to your E-mail address";	
				}
				else
				{
				   $message = "No email is found with this address";	
				}
				include("forget_editor.php");
				break;
		default :
			include("login_editor.php");
	}
	/*
	  check user plan exits
	*/
	function clean($str) {
			$str = @trim($str);
			if(get_magic_quotes_gpc()) {
				$str = stripslashes($str);
			}
			return mysql_real_escape_string($str);
		}		
?>