<?php
session_start();
  include 'config.php';
  error_reporting(0);

  // Check if session is set or not.If not session redirect to login page
  if(!isset($_SESSION['username'])){
      header('location:index.php');
      exit();
    }

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

    <title>User Dashboard - Change Password </title>
	   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!---CSS FILES -->
    
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
  	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/Login.css" type="text/css" />
		

	 <!---END OF CSS FILES -->

</head>

<body>


   <section id="content2" class="section wrapper" >
      <div class="container dashbord_container">
        <div class="row">
          <?php include 'dashboard_sidemenu.php'; ?>
         
         
      <div class="col-sm-9 col-md-9">
            <div class="well">
<h4>Change Password</h4>
  
  <div id="error"></div>
     
               
               
    <form role="form" action="" id='form' method="POST">
        
        <div class="form-group">
          <label for="password">New Password</label>
          <input type="password" name="password" id="password" class="form-control" id="" placeholder="New Password" >
        </div>
        <div class="form-group">
          <label for="lastname">Confirm New Password</label>
          <input type="password" name="cpassword" id="cpassword" class="form-control" id="" placeholder="Confirm New Password" >
        </div>
       

        <button type="submit" name="submit" onClick="changePassword();return false;" id="changepassword" class="btn btn-success"><i class="fa fa-key"></i> Change Password</button>
</form>
            </div>
        </div>
          
        </div><!--End Row-->
        
                
                 
      </div>
    <div class="push"></div>
    </section>
        
    <!-- JS FILES    -->
  <script src="assets/js/jquery-1.9.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
<!-- END OF JS FILES    -->

<script>
function changePassword(){

    var password = $('#password').val();
    var cpassword = $('#cpassword').val();

    $('#error').html('<div class="alert alert-info">Submitting..</div>'); 

    //Check if username and password are entered or not
    if(password.length==0 || cpassword.length==0)
    {
      $('#error').html('<div class="alert alert-danger"><b>Error:</b> Both Fields are necessary..</div>');
      return; 
    }else if(password.length != cpassword.length)
    {
      $('#error').html('<div class="alert alert-danger"><b>Error:</b> Password and Confirm Password do not match</div>');
      return; 
    }

    $("#changepassword").prop('disabled', true);

    //Send ajax Request to code/ajaxlogin.php  to verify the credentials
    $.ajax({
                type: "GET",
                url: "code/ajaxProfileChangePassword.php",
                data: {'password':password,'cpassword':cpassword}

            }).done( function( response ) {

                      var obj = jQuery.parseJSON(response);
                      if(obj.error=='success'){
                      $('#error').html('<div class="alert alert-success"><p><b>Success:</b> '+obj.msg+'</p></div>');
                      $('#form').hide();
              
            }else if(obj.error=='error')
            { 
              $("#changepassword").prop('disabled', false);
              $('#error').html('<div class="alert alert-danger"><p><b>Error:</b> '+obj.msg+'</p></div>');
            }
                 });  
    
}
    
</script>
</body>
</html>