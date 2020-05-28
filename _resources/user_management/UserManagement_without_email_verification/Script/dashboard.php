<?php
session_start();
	include 'config.php';

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

  <title>User Dashboard </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!---CSS FILES -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/Login.css" type="text/css" />
		

	<!---END OF CSS FILES -->

</head>

<body>


 <section id="content2" class="section wrapper" s>
      <div class="container dashbord_container">
        <div class="row">
           <?php include 'dashboard_sidemenu.php'; ?>
         
        
         
		   <div class="col-sm-9 col-md-9">
            <div class="well">
<h4>Welcome <span style="color: red"><?php echo $_SESSION['name']?></span></h4>
           Welcome to Dashboard
             
              </div>
        </div>
          
        </div><!--End Row-->
        
                
                 
      </div>
	  <div class="push"></div>
    </section>


</body>
</html>