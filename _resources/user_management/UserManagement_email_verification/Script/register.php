<?php
session_start();

		include 'config.php';
		
		 
		//If session is already set means the user is logged in then do not show login page and redirect it to 
		//dasbhboard
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

    <title>Register Page </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!---CSS FILES -->
    	<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
    	
    	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/Login.css" type="text/css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
		

	<!---END OF CSS FILES -->

</head>

<body>

<div id="login-container">

	

	<div id="login">

		<h3>Welcome to REGISTRATION Page</h3>

		<h5>Fill up the following details to register.</h5>
		<div id="error" >
				
		</div>

<!-- --------REGISTER FORM START ----- -->		
		<form id="login-form" action="" class="form">

			<div class="form-group">
				<label for="login-name">Name</label>
				<input type="text" class="form-control" id="name" name="name"  placeholder="Name" >
			</div>

			<div class="form-group">
				<label for="login-username">Username</label>
				<input type="text" class="form-control" id="username" name="username"  placeholder="Username" >
			</div>

			<div class="form-group">
				<label for="login-password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>

			<div class="form-group">
				<label for="login-cpassword">Confirm Password</label>
				<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
			</div>

			<div class="form-group">
				<label for="login-email">Email</label>
				<input type="text" class="form-control" id="email" name="email"  placeholder="Email" >
			</div>
			<div class="form-group">
				<label for="re-capcha">Recaptcha</label>
				<div class="g-recaptcha" data-sitekey="<?php echo $site_key;?>"></div>
			</div>
			
			<div class="form-group">

				<button type="submit" id="register-btn" onClick="register();return false;" class="btn btn-success btn-block">Register &nbsp; <i class="fa fa-play-circle"></i></button>

			</div>
		</form>
<!-- --------REGISTER FORM END ----- -->


	</div> <!-- /#login -->

	<a href="index.php" id="signup-btn" class="btn btn-lg btn-block">
		<i class="fa fa-backward"></i> Back To signin
	</a>


</div> <!-- /#login-container -->

<!-- JS FILES    -->
	<script src="assets/js/jquery-1.9.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
<!-- END OF JS FILES    -->

<script>
function register(){

   	var username = $('#username').val();
   	var password = $('#password').val();
   	var name = $('#name').val();
   	var cpassword = $('#cpassword').val();
   	var email = $('#email').val();
   	var captcha = $('#g-recaptcha-response').val();

   	//Bring to top
   	$("html, body").animate({ scrollTop: 0 }, "slow");

   	$('#error').html('<div class="alert alert-info">Submitting..</div>');	

   	//Capcha Check if inserted or not
   	if(captcha.length==0 )
   	{
   		$('#error').html('<div class="alert alert-danger">Please enter the Captcha</div>');
   		return;	
    }

   	//Check if all fields are entered or not.Also this is client side validation
   	if(username.length==0 || password.length==0 || email.length==0 || name.length==0)
   	{
   		$('#error').html('<div class="alert alert-danger">All Fields are necessary</div>');
   		return;	
    }

    //Check Username entered should be of atleast 6 character
   	if(username.length<6)
   	{
   		$('#error').html('<div class="alert alert-danger">Username cannot be less than 6 character</div>');
   		return;	
    }

    if(password.length<6)
   	{
   		$('#error').html('<div class="alert alert-danger">Password Length must be greater than 6 character</div>');
   		return;	
    }

    //Password and confirm password match validation
   	if(password!=cpassword)
   	{
   		$('#error').html('<div class="alert alert-danger">Password and Confirm Password do not match</div>');
   		return;	
   	}

   	$("#register-btn").prop('disabled', true);

   	//Send ajax Request to code/ajaxregister.php  to enter details to database
   	   	$.ajax({
                type: "GET",
                url: "code/ajaxregister.php",
                data: {'username':username,'password':password,'name':name,'email':email,'cpassword':cpassword,'captcha':captcha }

            }).done( function( response ) {

            			//Used to parse the json recieved
                    	var obj = jQuery.parseJSON(response);

                    	if(obj.error=='success'){
							$('#error').html('<div class="alert alert-success"><p>'+obj.msg+'</p></div>');
							$('#login-form').hide();
						}else if(obj.error=='error')
						{	
							$("#register-btn").prop('disabled', false);
							$('#error').html('<div class="alert alert-danger"><p>'+obj.msg+'</p></div>');
						}
                 });	
   	
}
   	
</script>
</body>
</html>s