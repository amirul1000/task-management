<?php
session_start();
	include "../config.php";

	//error_reporting(0);
	
      	// SESSION CHECK SET OR NOT
      	if(!isset($_SESSION['admin']))
      	{
      		header('location:index.php');
      	}
     
 
  // SELECT CURRENT LOGGED IN ADMIN DETAILS MATCH FROM THE DATABASE
  $statement  = $db->prepare("SELECT * FROM `admin` where username=?");
  $statement->execute(array($_SESSION['admin']));
  $userdata = $statement->fetch(PDO::FETCH_ASSOC); 	
 ?>   	

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

    <?php include "include/head.php" ?>
	
	</head>

<body>

<div id="wrapper">

	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>

	
	<div id="content">		
		
		<div id="content-header">
			<h1>Settings</h1>
		</div> <!-- #content-header -->	


		<div id="content-container">

			<div class="row">

		    	<div class="col-md-3 col-sm-4">
		    
				    <ul id="myTab" class="nav nav-pills nav-stacked">
				        <li class="active">
				        	<a href="#profile-tab" data-toggle="tab">
				        		<i class="fa fa-user"></i> 
				        		&nbsp;&nbsp;Profile Settings
				        	</a>
				        </li>
				        <li>
				        	<a href="#password-tab" data-toggle="tab">
				        		<i class="fa fa-lock"></i> 
				        		&nbsp;&nbsp;Change Password
				        	</a>
				        </li>
				        
				      </ul>

				</div> <!-- /.col -->

				<div class="col-md-9 col-sm-8">

				      <div class="tab-content stacked-content">
				        <div class="tab-pane fade in active" id="profile-tab">
				          
				          <h3 class="">Edit Profile Settings</h3>

				          <div id="errorProfile"></div>
				          <hr />

				          <br />

				          <form action="" class="form-horizontal">
				          	<div class="form-group">

				          		<label class="col-md-3">Username</label>

				          		<div class="col-md-7">
				          			<input type="text" name="username" id="username" value="<?php echo $userdata['username'] ?>" class="form-control" disabled />
				          		</div> <!-- /.col -->

				          	</div> <!-- /.form-group -->

				          	<div class="form-group">

				          		<label class="col-md-3">Name</label>

				          		<div class="col-md-7">
				          			<input type="text" name="name" id="name" value="<?php echo $userdata['name'] ?>" class="form-control" />
				          		</div> <!-- /.col -->

				          	</div> <!-- /.form-group -->

				          	<div class="form-group">

				          		<label class="col-md-3">Email Address</label>

				          		<div class="col-md-7">
				          			<input type="text" name="email" id="email" value="<?php echo $userdata['email'] ?>" class="form-control" />
				          		</div> <!-- /.col -->

				          	</div> <!-- /.form-group -->

				          	
				          	<br />

				          	<div class="form-group">

				          		<div class="col-md-7 col-md-push-3">
				          			<button type="submit" name="submit" onClick="changeProfile();return false;" id="savechanges"  class="btn btn-primary"><i class="fa fa-edit"></i> Save Changes</button>
				          			
				          							          			
				          		</div> <!-- /.col -->

				          	</div> <!-- /.form-group -->

				          </form>


				        </div>
				        <div class="tab-pane fade" id="password-tab">
				          <h3 class="">Change Your Password</h3>
				          <div id="error"></div>
				          <hr />
				          <br />
				          
				          

				          <form action="" id="changePassForm" class="form-horizontal">

				          	<div class="form-group">
				          		<label class="col-md-3">New Password</label>

				          		<div class="col-md-7">
				          			<input type="password" id="password" name="password" class="form-control" />
				          		</div> <!-- /.col -->

				          	</div> <!-- /.form-group -->

				          	<div class="form-group">

				          		<label class="col-md-3">New Password Confirm</label>

				          		<div class="col-md-7">
				          			<input type="password" id="cpassword" name="password" class="form-control" />
				          		</div> <!-- /.col -->

				          	</div> <!-- /.form-group -->

				          	<br />

				          	<div class="form-group">

				          		<div class="col-md-7 col-md-push-3">
				          			<button type="submit"  name="submit" onClick="changePassword();return false;"  id="changepassword" class="btn btn-primary"><i class="fa fa-key"></i> Change Password</button>
				          			
				          		</div> <!-- /.col -->

				          	</div> <!-- /.form-group -->

				          </form>
				        </div>

				      
				      </div>

				</div> <!-- /.col -->

			</div> <!-- /.row -->


		</div> <!-- /#content-container -->
		

	</div> <!-- #content -->
	
	
</div> <!-- #wrapper -->


<?php include "include/footer.php" ?>
<?php include "include/footerjs.php" ?>
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
                url: "code/ajaxChangePasswordAdmin.php",
                data: {'password':password,'cpassword':cpassword}

            }).done( function( response ) {

                      var obj = jQuery.parseJSON(response);
                      if(obj.error=='success'){
                      $('#error').html('<div class="alert alert-success"><p><b>Success:</b> '+obj.msg+'</p></div>');
                      $('#changePassForm').hide();
              
            }else if(obj.error=='error')
            { 
              $("#changepassword").prop('disabled', false);
              $('#error').html('<div class="alert alert-danger"><p><b>Error:</b> '+obj.msg+'</p></div>');
            }
                 });  
    
}
    

function changeProfile(){

    var name = $('#name').val();
    var email = $('#email').val();

    $('#errorProfile').html('<div class="alert alert-info">Submitting..</div>'); 

    //Check if name and email are entered or not
    if(name.length==0 || email.length==0)
    {
      $('#errorProfile').html('<div class="alert alert-danger"><b>Error:</b> Both Fields are necessary..</div>');
      return; 
    }

    $("#savechanges").prop('disabled', true);

    //Send ajax Request to code/ajaxlogin.php  to verify the credentials
    $.ajax({
                type: "GET",
                url: "code/ajaxAdminProfile.php",
                data: {'name':name,'email':email}

            }).done( function( response ) {

                      var obj = jQuery.parseJSON(response);
                      if(obj.error=='success'){
                      $('#errorProfile').html('<div class="alert alert-success"><p><b>Success:</b> '+obj.msg+'</p></div>');
                      
              
            }else if(obj.error=='error')
            { 
              $("#savechanges").prop('disabled', false);
              $('#errorProfile').html('<div class="alert alert-danger"><p><b>Error:</b> '+obj.msg+'</p></div>');
            }
                 });  
    
}

</script>
</body>
</html>