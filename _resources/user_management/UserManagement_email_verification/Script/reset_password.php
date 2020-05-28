<?php
session_start();
  include 'config.php';
 
  error_reporting(0);
  $forget_key = $_GET['key'];
    // Get value from database where key matches
    $statementMatch = $db->prepare("SELECT * FROM `users` where `forget_key`=?");
    $statementMatch->execute(array($forget_key));
    if($statementMatch->rowCount() > 0)
    {

      $output['status']  = 'success';   
      $output['msgtype'] = 'success';   

      
    }else
    {
      $output['status']  = 'error';     
      $output['msgtype'] = 'danger';
      $output['msg']     = "Key is expired.Click <a href='index.php'> here</a> to get Login";     
      
    }

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

    <title>Reset Password </title>
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
        
               <div class="col-sm-3 col-md-3">
               </div>

      <div class="col-sm-6 col-md-6">
            <div class="well">
<h4>Reset your Password</h4>
  
  <div id="error"></div>
     
         <?php 
         if ($output['status']=='error'){
             echo  "<div class='alert alert-{$output['msgtype']}'> {$output['msg']}</div>";
          }else
          {
         ?>      
               
    <form role="form" action="" id='form' method="POST">
        
        <div class="form-group">
          <label for="password">New Password</label>
          <input type="password" name="password" id="password" class="form-control" id="" placeholder="New Password" >
        </div>
        <div class="form-group">
          <label for="lastname">Confirm New Password</label>
          <input type="password" name="cpassword" id="cpassword" class="form-control" id="" placeholder="Confirm New Password" >
        </div>
       

        <button type="button" name="submit" onClick="changePassword();return false;" id="changepassword" class="btn btn-success"><i class="fa fa-key"></i> Change Password</button>
</form>
<?php }?>
            </div>
        </div>
          <div class="col-sm-3 col-md-3">
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

    var password    = $('#password').val();
    var cpassword   = $('#cpassword').val();
    var forget_key  = '<?php echo $forget_key; ?>'

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

    //Send ajax Request to code/ajax_reset_password.php  to reset the password
    $.ajax({
                type: "GET",
                url: "code/ajax_reset_password.php",
                data: {'password':password,'cpassword':cpassword,'forget_key':forget_key}

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