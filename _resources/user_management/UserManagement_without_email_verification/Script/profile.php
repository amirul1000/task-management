<?php
session_start();
	include 'config.php';
  error_reporting(0);
  
if(!isset($_SESSION['username'])){
      header('location:index.php');
      exit();
    }

  if(isset($_POST['submit']))
  {
      if($_POST['name'] == '' || $_POST['email'] == '')
      {
        
        $error  = 'danger';
        $errormsg = "Both Name and email cannot be left blank";

      }
      else
      {

       
          #When no image is selected
          if($_FILES['image']['name']=='')
          {
            
                $query  = "UPDATE `users` SET name = ?,email = ? where username='{$_SESSION['username']}'";
                $parameters = array($_POST['name'],$_POST['email']); 
                $statement  = $db->prepare($query);
                $statement->execute($parameters);
                $error  = 'success';
                $errormsg = "Profile Updated successfully";
                $_SESSION['name'] = $_POST['name'];            

          }else{
                  #Image types allowed
                  $allowed_filetypes = array('jpg','jpeg','png','gif','pjpeg'); 


                  $ext = strtolower(end((explode(".", $_FILES['image']['name']))));
                  $imageName  = $_SESSION['username'].'.'.$ext;
                  $path = $path.$imageName;
                  $tmp =  $_FILES['image']['tmp_name'];

                  if(!in_array($ext,$allowed_filetypes))
                  {
                                       
                        $error  = 'danger';
                        $errormsg = "You uploaded wrong image format";                    
                   }
                   else
                   {
                        $moved = move_uploaded_file($tmp,$path);                        
                        //Resize the uploaded avatar
                        resize($path , '150', '150', $ext);

                        $query  = "UPDATE `users` SET name = ?,email = ?,avatar = ? where username='{$_SESSION['username']}'";
                        $parameters = array($_POST['name'],$_POST['email'],$imageName);
                        $statement  = $db->prepare($query);
                        $statement->execute($parameters);
                        $error  = 'success';
                        $errormsg = "Profile Updated successfully";
                        $_SESSION['name'] = $_POST['name'];
                        
                    }
                   
                 }

              


       

      }

  }
  // SELECT MATCH FROM THE DATABASE
  $query  = "SELECT * FROM `users` where username=?";
  $parameters = array($_SESSION['username']);
  $statement  = $db->prepare($query);

  $statement->execute($parameters);

  $userdata = $statement->fetch(PDO::FETCH_ASSOC);

  

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

   <title>User Dashboard - Profile </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!---CSS FILES -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/css/Login.css" type="text/css" />
		<link rel="stylesheet" href="assets/plugins/fileupload/bootstrap-fileupload.css" type="text/css" />

	<!---END OF CSS FILES -->

</head>

<body>



  <section id="content2" class="section" >
      <div class="container dashbord_container">
        <div class="row">
          <?php include 'dashboard_sidemenu.php'; ?>
         
         
      <div class="col-sm-9 col-md-9">
            <div class="well">
<h4>Edit Profile</h4>
<?php 
  if($errormsg){
    echo "<div class='alert alert-$error'  style='padding-left: 5px;'>$errormsg</div>";
  }?> 
        
<form role="form" action="" method="POST" enctype="multipart/form-data" >
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" id="" readonly="readonly" value="<?php echo $userdata['username']?>">
        </div>
        <div class="form-group">
          <label for="firstname">Name</label>
          <input type="text" name="name" class="form-control" id="" placeholder="Full Name" value="<?php echo $userdata['name']?>">
        </div>
      
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email"name="email" class="form-control" id="" placeholder="Email" value="<?php echo $userdata['email']?>">
        </div>
        <div class="form-group">
         <label for="avatar">Profile Image</label>
          <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 180px; height: 150px;"><img src="./images/avatar/<?php  echo $userdata['avatar'];?>" alt="Profile Avatar" /></div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 200px; line-height: 20px;"></div>
                    <div>
                      <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>

                      <input type="file" name='image' /></span>
                      <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                  </div>
        </div>
        

       <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Update Profile</button>
</form>
            </div>
        </div>
          
        </div><!--End Row-->
        
                
                 
      </div>
    </section>
    
<!-- JS FILES    -->
  <script src="assets/js/jquery-1.9.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
<!-- END OF JS FILES    -->


<script src="assets/plugins/fileupload/bootstrap-fileupload.js"></script>
</body>
</html>