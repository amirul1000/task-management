<?php
session_start();
		include('../config.php'); 
      	error_reporting(0);
      	// SESSION CHECK SET OR NOT
      	if(!isset($_SESSION['admin']))
      	{
      		header('location:index.php');
      	}

      	
   if(isset($_POST['submit']))
  	{
		
			// SELECT creqentials MATCH FROM THE DATABASE
			$queryMatch	=	"SELECT * FROM `users` where username=?";			
			$statementMatch	=	$db->prepare($queryMatch);
			$statementMatch->execute(array($_POST['username']));

		if($statementMatch->rowCount() > 0) {
				
				$error  = 'danger';
                $errormsg = "<b>Error :</b> User with this username already exists.Try different username";

		}else{	
          //When no image is selected
          if($_FILES['image']['name']=='')
          {
                $query  = "INSERT INTO `users` SET name = ?,username=?,password=?,email = ?,address=?,latitude=?,longitude=?,status=?,email_verified =?";
                $parameters = array($_POST['name'],$_POST['username'],sha1($_POST['password']),$_POST['email'],$_POST['address'],$_POST['latitude'],$_POST['longitude'],$_POST['status'],$_POST['email_verified']);

          }else{
                  $allowed_filetypes = array('jpg','jpeg','png','gif','pjpeg'); 
                  $ext = end((explode(".", $_FILES['image']['name'])));
                  $imageName  = $_POST['username'].'.'.$ext;
                  $path = "../".$path.$imageName;
                  $tmp =  $_FILES['image']['tmp_name'];

                  // Check if uploaded image of the format specified
                  if(!in_array($ext,$allowed_filetypes))
                    {                     

                      $error  = 'danger';
                      $errormsg = "You uploaded wrong image format";                      
                   
                    }else
                    {
                        $moved = move_uploaded_file($tmp,$path);
                        //Resize the uploaded avatar
                        resize($path , '150px', '150px', $ext);
                        $query  = "INSERT INTO `users` SET name = ?,username=?,password=?,email = ?,address=?,avatar=?,latitude=?,longitude=?,status=?,email_verified = ?";
                        $parameters = array($_POST['name'],$_POST['username'],sha1($_POST['password']),$_POST['email'],$_POST['address'],$imageName,$_POST['latitude'],$_POST['longitude'],$_POST['status'],$_POST['email_verified']);
                               
                        
                    }
                  
            }

            	$statement  = $db->prepare($query);
                $statement->execute($parameters);

                $error  = 'success';
                $errormsg = "New User added successfully";
                


       
        }
      

  }

      		
     		
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>

    <title>Add User</title>
	<?php include "include/head.php" ?>
	<link rel="stylesheet" href="../assets/plugins/fileupload/bootstrap-fileupload.css" type="text/css" />

	<style>
      
      .gmnoprint img {
    		max-width: none; 
	}
	#mapCanvas{
		 height: 300px;
        width: 480px;
        border: 1px solid #333;
        margin-top: 0.6em;
	}
	#select4 {
			height: 300px;
		}		
</style>

</head>

<body>
<div id="wrapper">

	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>

	<div id="content">		
		<div id="content-header">
			<h1>Add New User</h1>
		</div> <!-- #content-header -->	
		<div id="content-container">
		<?php 
  if($errormsg){
    echo "<div class='alert alert-$error'  style='padding-left: 5px;'>$errormsg</div>";
  }?> 
			<div class="row">
				<div class="col-sm-6">
					<div class="portlet">
						<div class="portlet-header">
							<h3><i class="fa fa-plus-square"></i>
								Add User
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
							<div id="error"></div>
							<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" id="name" name="name" class="form-control" data-required="true" value="<?php echo $_POST['name'] ?>">
								</div>
								
								<div class="form-group">
									<label for="name">Username</label>
									<input type="text" id="username" name="username" class="form-control"  data-required="true" value="<?php echo $_POST['username'] ?>" >
								</div>
								<div class="form-group">
									<label for="name">Email</label>
									<input type="email" id="email" name="email" class="form-control" data-parsley-type="email" data-required="true" value="<?php echo $_POST['email'] ?>" >
								</div>
								<div class="form-group">
									<label for="name">Password</label>
									<input type="text" id="password" name="password" class="form-control" data-required="true" value="">
								</div>

								
								<div class="form-group">
									<label for="name">Address</label>
									<input type="text" id="currentlocation" name="address" class="form-control"  data-required="true" value="" >
								</div>
								<div id="mapCanvas"></div>
								<div id="infoPanel">
									<input type="hidden" name="latitude" id="lat" value=""/>
									<input type="hidden"name="longitude" id="lng" value="" />
									<div id="info"></div>    
								</div>
								<div class="form-group">
					         <label for="avatar">Profile Image</label>
					          <div class="fileupload fileupload-new" data-provides="fileupload">
					                    <div class="fileupload-new thumbnail" style="width: 180px; height: 150px;"><img src="../images/avatar/noimage.gif" alt="Profile Avatar" /></div>
					                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 200px; line-height: 20px;"></div>
					                    <div>
					                      <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>

					                      <input type="file" name='image' /></span>
					                      <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
					                    </div>
					                  </div>
        					</div>
								<div class="form-group">	
								<label for="select-input">Status</label>
								<select id="select-input" name="status" class="form-control">
									<option value="Enable">Enable</option>									
									<option value="Disable">Disable</option>
								</select>
								</div>
								<div class="form-group">	
								<label for="select-input">Verified Email</label>
								<select id="select-input" name="email_verified" class="form-control">
									<option value="yes">Yes - Email is verified</option>									
									<option value="no">No - Email is not verified</option>
								</select>
								</div>
								<div class="form-group">
									<button type="submit"  name="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Submit</button>
								</div>
							</form>
						</div> 
					  <!--END PORTLET-CONTENT -->
					</div> 
				  <!-- END PORTLET -->
	            </div> 
	           <!-- END COL -->
			</div> 
		  <!--END ROW -->
		</div> 
	   <!-- END CONTENT-CONATINER -->
	</div> 
  <!--END CONTENT -->
</div> 
<!--END WRAPPER -->


<?php include "include/footer.php" ?>
<?php include "include/footerjs.php" ?>
<script src="../assets/plugins/fileupload/bootstrap-fileupload.js"></script>
<script src="../assets/plugins/parsley/parsley.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript">

		//Get Latitude And Longitude
		var geocoder = new google.maps.Geocoder();

		function geocodePosition(pos) 
		{
			  geocoder.geocode(
			  {
			    latLng: pos
			  }, function(responses) 
			  	{
					    if (responses && responses.length > 0) {
					      updateMarkerAddress(responses[0].formatted_address);
					    } else {
					      updateMarkerAddress('Cannot determine address at this location.');
					    }
			  	});
		}

		function updateMarkerStatus(str) 
		{
		  //document.getElementById('markerStatus').innerHTML = str;
		}

		function updateMarkerPosition(latLng) 
		{
			$('#lat').val(latLng.lat());
			$('#lng').val(latLng.lng());
		}

		function updateMarkerAddress(str) 
		{
		 
		  $('#currentlocation').val(str);
		  
		}
		    
		function initialize() 
		{
				//Latitude longitude of default
				var clat = <?php $lat=$_POST['latitude']==''?'26.912434':$_POST['latitude'];echo $lat;?>;
				var clong = <?php $long=$_POST['longitude']==''?'75.787271':$_POST['longitude'];echo $long;?>;

				var latLng = new google.maps.LatLng(clat,clong);
				  
		        var mapOptions = {
		          center: latLng,
		          zoom: 8,
		          mapTypeId: google.maps.MapTypeId.ROADMAP
		        };
				
		       map = new google.maps.Map(document.getElementById('mapCanvas'),
		          mapOptions);

		        var input = document.getElementById('currentlocation');
				
		        var autocomplete = new google.maps.places.Autocomplete(input);

		        //autocomplete.bindTo('bounds', map);

		        var infowindow = new google.maps.InfoWindow();
		        marker = new google.maps.Marker({
		          map: map,
				  position: latLng,
		          title: 'ReferSell',
		          map: map,
		          draggable: true
		        });
		         updateMarkerPosition(latLng);
		         geocodePosition(latLng);
		  
		  // Add dragging event listeners.
		  google.maps.event.addListener(marker, 'dragstart', function() {
		    updateMarkerAddress('Dragging...');
		  });
		  
		  google.maps.event.addListener(marker, 'drag', function() {
		    updateMarkerStatus('Dragging...');
		    updateMarkerPosition(marker.getPosition());
		  });
		  
		  google.maps.event.addListener(marker, 'dragend', function() {

		    updateMarkerStatus('Drag ended');
		    geocodePosition(marker.getPosition());
		  });
		        google.maps.event.addListener(autocomplete, 'place_changed', function() {
		          infowindow.close();
		          var place = autocomplete.getPlace();
				 
		          if (place.geometry.viewport) {
		            map.fitBounds(place.geometry.viewport);
		          } else {
		            map.setCenter(place.geometry.location);
		            map.setZoom(10);  // Why 17? Because it looks good.
		          }

		          var image = new google.maps.MarkerImage(
		              place.icon,
		              new google.maps.Size(71, 71),
		              new google.maps.Point(0, 0),
		              new google.maps.Point(17, 34),
		              new google.maps.Size(35, 35));
		          marker.setIcon(image);
		          marker.setPosition(place.geometry.location);
		           updateMarkerPosition(place.geometry.location);
		       
		          var address = '';
		         
		        });

		        // Sets a listener on a radio button to change the filter type on Places
		        // Autocomplete.
		        function setupClickListener(id, types) {
		          var radioButton = document.getElementById(id);
		          google.maps.event.addDomListener(radioButton, 'click', function() {
		            autocomplete.setTypes(types);
		          });
		        }
		       
		      }

		      google.maps.event.addDomListener(window, 'load', initialize);
    </script> 
</body>
</html>