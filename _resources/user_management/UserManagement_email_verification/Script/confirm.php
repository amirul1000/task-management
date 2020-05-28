<?php
	include("config.php");
	
	$key	=	$_GET['key'];
	
	// Get value from database where key matches
	$statementMatch	=	$db->prepare("SELECT * FROM `users` where `key`=?");
	$statementMatch->execute(array($key));
	if($statementMatch->rowCount() > 0)
	{
		// Update database
		$statementMatch	=	$db->prepare("UPDATE  `users` SET `key`= ?,email_verified =? where `key`=?");
		$statementMatch->execute(array('','yes',$key));

		$output['status']	=	'success';			
		$output['msg']		=	'Congratulation!You have verified your email id.Click <a href="index.php"> here </a> to go to Login page';
	}else
	{
		$output['status']	=	'danger';			
		$output['msg']		=	'Sorry the key has expired.';
	}	

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

    <title>Login </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!---CSS FILES -->
    	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/Login.css" type="text/css" />
		

	<!---END OF CSS FILES -->

</head>

<body>

<div id="login-container">



	<div id="login">		
		
 <!--Output division start -->		
 	<?php echo	"<div class='alert alert-{$output['status']}'> {$output['msg']}</div>"; ?>
 <!--Ouput division end  -->


	</div> <!-- /#login -->

	
</div> <!-- /#login-container -->

<!-- JS FILES    -->
	<script src="assets/js/jquery-1.9.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
<!-- END OF JS FILES    -->

</body>
</html>