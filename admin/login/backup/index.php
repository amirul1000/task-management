<?php

session_start();



		include '../../business/login/config.php';



		// if Logged in redirect to dashboard

		if(isset($_SESSION['admin'])){

			header('location:../land');

			exit();

		}



			

?>

<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>



    <title>ADMIN PANEL- LOGIN </title>

	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    



    <!-- ------------- CSS FILES ------------------- -->





    	<link rel="stylesheet" href="../../_resources/user_management/UserManagement_email_verification/Script/assets/css/font-awesome.min.css" type="text/css" />

    	<link rel="stylesheet" href="../../_resources/user_management/UserManagement_email_verification/Script/assets/css/bootstrap.min.css" type="text/css" />

		<link rel="stylesheet" href="../../_resources/user_management/UserManagement_email_verification/Script/assets/css/Login.css" type="text/css" />

		



	<!--- --------------END OF CSS FILES-------------- -->



</head>



<body>

<div style="position:relative;bottom:74px">



<!--<a href="../index.php"  class="btn btn-success btn-lg btn-block">GO TO FRONT END &nbsp; <i class="fa fa-play-circle"></i></a>

-->

</div>



<div id="login-container">



	



	<div id="logo">

		<a href="">

			<img src="../../_resources/user_management/UserManagement_email_verification/Script/assets/img/logos/logo-login.png" alt="Logo" />

		</a>

	</div>



	<div id="login">



		<h3>ADMINISTRATOR</h3>



		<h5>Please sign in to get access.</h5>

		

<!--Error division start -->		

		<div id="error"> </div>

<!--Error division end  -->





<!-- START OF LOGIN FORM -->

		<form id="login-form" action="" class="form">



				<div class="form-group">

				<label for="login-username">Username</label>



				<!-- id="username" is used for the client side validation ,So is important-->

				<input type="text" class="form-control" id="username" name="username"  placeholder="Username" >

			</div>



			<div class="form-group">

				<label for="login-password">Password</label>



				<!-- id="password" is used for the client side validation ,So is important-->				

				<input type="password" class="form-control" id="password" name="password" placeholder="Password">

			</div>



			<div class="form-group">



				<button type="submit" id="login-btn" onClick="login();return false;" class="btn btn-info btn-block">Signin &nbsp; <i class="fa fa-play-circle"></i></button>



			</div>



			

		</form>



<!-- END OF LOGIN FORM -->

		



	</div> <!-- /#login -->

	





</div> <!-- /#login-container -->



<!-- JS FILES    -->

	<script src="../../_resources/user_management/UserManagement_email_verification/Script/assets/js/jquery-1.9.1.min.js"></script>

	<script src="../../_resources/user_management/UserManagement_email_verification/Script/assets/js/bootstrap.min.js"></script>

<!-- END OF JS FILES    -->



<script>

function login(){



   	var username = $('#username').val();

   	var password = $('#password').val();



   	$('#error').html('<div class="alert alert-info">Submitting..</div>');	



   	//Check if username and password are entered or not

   	if(username.length==0 || password.length==0)

   	{

   		$('#error').html('<div class="alert alert-danger">Both Fields are necessary..</div>');

   		return;	

   	}



   	$("#login-btn").prop('disabled', true);



   	//Send ajax Request to code/ajaxlogin.php  to verify the credentials

   	$.ajax({

                type: "GET",

                url: "code/ajaxlogin.php",

                data: {'username':username,'password':password}



            }).done( function( response ) {



                    	var obj = jQuery.parseJSON(response);

                    	if(obj.error=='success'){

							$('#error').html('<div class="alert alert-success"><p>'+obj.msg+'</p></div>');

							window.location.href = "../land";

						}else if(obj.error=='error')

						{	

							$("#login-btn").prop('disabled', false);

							$('#error').html('<div class="alert alert-danger"><p>'+obj.msg+'</p></div>');

						}

                 });	

   	

}

   	

</script>

</body>

</html>s