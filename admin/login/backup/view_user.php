<?php
session_start();
		include('../config.php'); 
      	error_reporting(0);
   

      	// ADMIN SESSION CHECK SET OR NOT
      	if(!isset($_SESSION['admin']))
      	{
      		header('location:index.php');
      	}


      	// QUERY TO GET USER DATA
        $userData = $db->prepare("SELECT * FROM users");
        $userData->execute();
       
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

    <title>View Users</title>
	<?php include "include/head.php" ?>
</head>

<body>

<div id="wrapper">
	
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>	

	<div id="content">				
		<div id="content-header">
			<h1>View Users</h1>
		</div>
		 <!-- #content-header -->	
		<div id="content-container">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet">
						<div class="portlet-header">
							<h3>
								<i class="fa fa-table"></i>
								View Users
							</h3>
							<ul class="portlet-tools pull-right">
								<li>
									<div class="btn-group">
									  
									  <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
									   Export <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
									    <li><a href="export_csv.php">Download CSV</a></li>
									    
									  </ul>
									</div>
								</li>
							</ul>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">						
							<div id="load"><?php echo $msg; ?></div>	
							<div class="table-responsive">
							<table 
								class="table table-striped table-bordered table-hover table-highlight table-checkable" 
								data-provide="datatable" 
								data-display-rows="10"
								data-info="true"
								data-search="true"
								data-length-change="true"
								data-paginate="true">
									<thead>
										<tr>
											
											
											<th  data-sortable="true"  class="hidden-xs hidden-sm">Name</th>
											<th data-filterable="false" >Avatar</th>											
											<th  data-sortable="true">User Name</th>
											<th  data-sortable="true" class="hidden-xs hidden-sm">Email</th>
											<th data-filterable="false" class="hidden-xs hidden-sm">Address</th>
											<th data-filterable="false" data-sortable="true" data-direction="desc" class="hidden-xs hidden-sm">Time</th>
											<th data-sortable="true" clal-dialog -->
		</div>
	<!--End modal -->
	
<?php include "include/footer.php" ?>
<?php include "include/footerjs.php" ?>

<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/DT_bootstrap.js"></script>

<script>

		function del(id,name)
		{
	
			$('#deleteModal').appendTo("body").modal('show');
			$('#info').html('Are you sure ! You want to delete <strong>'+name+'??</strong>');
			$("#delete").click(function()
			{
					 $.ajax({
		                type: "GET",
		                url: "code/delete_user.php",
		                data: {"id":id}
		                     
		            	}).done(function(response)
		           		 {		                  
		                 	 var output = jQuery.parseJSON(response);		                  
		               	 	  if(output.msg == "deleted")
		                 	 {		
		                 	 		$("html, body").animate({ scrollTop: 0 }, "slow");
		                  	   		$('#deleteModal').modal('hide');
		                 	  		$('#row'+id).closest('tr').remove();
		                 	  		$('#load').html("<p class='alert alert-success text-center'><strong>"+name +"</strong> Successfully Deleted</p>");
		                  	  }
		           		 });
				})

			}
</script>
</body>
</html>