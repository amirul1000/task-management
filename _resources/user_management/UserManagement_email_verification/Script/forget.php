<?php
session_start();

		include 'config.php';

		if(isset($_SESSION['username'])){
			header('location:dashboard.php');
			exit();
		}

			
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

    <title>Forget Password </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!---CSS FILES -->
    	<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
    	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/Login.css" type="text/css" />
	
	<!---END OF CSS FILES -->

</head>

<body>

<div id="login-container">

	

	<div id="login">

		<h3>FORGET PASSWORD</h3>

		<h5>Enter your username</h5>
		
<!--Error division start -->		
		<div id="error"> </div>
<!--Error division end  -->


<!-- START OF FORGET FORM -->
		<form id="login-form" action="" class="form">

				<div class="form-group">
				<label for="login-username">Username</label>

				<!-- id="username" is used for the client side validation ,So is important-->
				<input type="text" class="form-control" id="username" name="username"  placeholder="Username" >
			</div>

			

			<div class="form-group">

				<button type="submit" id="forget-btn" onClick="forget();return false;" class="btn btn-success btn-lg btn-block">Submit &nbsp; <i class="fa fa-play-circle"></i></button>

			</div>
		</form>

<!-- END OF LOGIN FORM -->
		

	</div> <!-- /#FORGET -->

	<a href="index.php" id="signup-btn" class="btn btn-lg btn-block">
	<i class="fa fa-backward"></i>	Back
	</a>


</div> <!-- /#login-container -->

<!-- JS FILES    -->
	<script src="assets/js/jquery-1.9.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
<!-- END OF JS FILES    -->

<script>
function forget(){

   	var username = $('#username').val();

   	$('#error').html('<div class="alert alert-info">Submitting..</div>');	

   	//Check if username is entered or not
   	if(username.length==0)
   	{
   		$('#error').html('<div class="alert alert-danger">Field is necessary..</div>');
   		return;	
   	}

   	$("#forget-btn").prop('disabled', true);

   	//Send ajax Request to code/ajaxlogin.php  to verify the credentials
   	$.ajax({
                type: "GET",
                url: "code/ajaxforget.php",
                data: {'username':username}

            }).done( function( response ) {

                    	var obj = jQuery.parseJSON(response);
                    	if(obj.error=='success'){
							$('#error').html('<div class="alert alert-success"><p>'+obj.msg+'</p></div>');
							$('#login-form').hide();
						}else if(obj.error=='error')
						{	
							$("#forget-btn").prop('disabled', false);
							$('#error').html('<div class="alert alert-danger"><p>'+obj.msg+'</p></div>');
						}
                 });	
   	
}
   	
</script>
</body>
</html>s