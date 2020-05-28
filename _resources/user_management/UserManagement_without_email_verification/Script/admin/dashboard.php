<?php
session_start();
	include "../config.php";

	//error_reporting(0);
	
      	// SESSION CHECK SET OR NOT
      	if(!isset($_SESSION['admin']))
      	{
      		header('location:index.php');
      	}
	$sql = "SELECT count(*) FROM `users` where status=?"; 

	$result = $db->prepare($sql); 
	$result->execute(array('enable')); 
	$ActiveUsers = $result->fetchColumn();


	//inactive users
	$result->execute(array('disable')); 
	$InactiveUsers = $result->fetchColumn();


	$sql = "SELECT count(*) FROM `users`"; 
	$result = $db->prepare($sql); 
	$result->execute(); 
	$TotalUsers = $result->fetchColumn();

	$userData = $db->prepare("SELECT * FROM users ORDER BY created_at desc LIMIT 0,5 ");
    $userData->execute();

   


?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>Dashboard -  Admin</title>
	<?php include "include/head.php" ?>
</head>

<body>

<div id="wrapper">	

	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	
	
<div id="content">		
		
		<div id="content-header">
			<h1>Dashboard</h1>
		</div> <!-- #content-header -->	


		<div id="content-container">

			<div>
				<h4 class="heading-inline">User Details
				</h4>

				
			</div>

			<br />


			<div class="row">

				<div class="col-md-4 col-sm-6">

					<a href="javascript:;" class="dashboard-stat tertiary">
						<div class="visual">
							<i class="fa fa-clock-o"></i>
						</div> <!-- /.visual -->

						<div class="details">
							<span class="content">Total users</span>
							<span class="value"><?php echo $TotalUsers; ?></span>
						</div> <!-- /.details -->

						<i class="fa fa-play-circle more"></i>

					</a> <!-- /.dashboard-stat -->

				</div> <!-- /.col-md-3 -->

				<div class="col-md-4 col-sm-6">

					<a href="javascript:;" class="dashboard-stat primary">
						<div class="visual">
							<i class="fa fa-star"></i>
						</div> <!-- /.visual -->

						<div class="details">
							<span class="content">Active users</span>
							<span class="value"><?php echo $ActiveUsers; ?></span>
						</div> <!-- /.details -->

						<i class="fa fa-play-circle more"></i>

					</a> <!-- /.dashboard-stat -->

				</div> <!-- /.col-md-3 -->

				<div class="col-md-4 col-sm-6">

					<a href="javascript:;" class="dashboard-stat secondary">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div> <!-- /.visual -->

						<div class="details">
							<span class="content">Inactive User</span>
							<span class="value"><?php echo $InactiveUsers; ?></span>
						</div> <!-- /.details -->

						<i class="fa fa-play-circle more"></i>

					</a> <!-- /.dashboard-stat -->

				</div> <!-- /.col-md-3 -->

				


			</div> <!-- /.row -->

			<div class="row">
				
					<div class="col-md-12">

					<div class="portlet">

						<div class="portlet-header">

							<h3>
								<i class="fa fa-bar-chart-o"></i>
								<strong>Registration Stats :</strong> <?php echo date("F  Y"); ?>
							</h3>

						</div> <!-- /.portlet-header -->

						<div class="portlet-content">

							<div id="line-chart" class="chart-holder"></div>							

						</div> <!-- /.portlet-content -->

					</div> <!-- /.portlet -->					

				</div> <!-- /.col -->


			</div>

			<div class="row">
				<div class="col-md-6">
						<div id="result"></div>
						<div class="portlet">

							<div class="portlet-header">

								<h3>
									<i class="fa fa-group"></i>
									Recent Signups
								</h3>

								<ul class="portlet-tools pull-right">
									<li>
										<a  href="add_user.php" class="btn btn-sm btn-default">
											Add User
										</a>
									</li>
								</ul>

							</div> <!-- /.portlet-header -->

							<div class="portlet-content">


								<div class="table-responsive">

								<table id="user-signups" class="table table-striped table-checkable"> 
									<thead> 
										<tr> 
											 
											<th class="hidden-xs">Name
											</th> 
											<th>Username</th> 
											<th>Status
											</th> 

											<th class="align-center">Action
											</th> 

										</tr> 
									</thead> 

									<tbody> 
									<?php 
										while($row = $userData->fetch(PDO::FETCH_ASSOC))
										{		
											 	$user_id = $row['id'];
										?>
										<tr class="" id="row<?php echo $user_id;?>"> 
											 

											<td class="hidden-xs"><?php echo $row['name'] ?></td> 
											<td><?php echo $row['username'] ?></td> 
											<td> <?php 
														if($row['status']=='enable') {
																$status =	'label-success';
																$value 	=	'Active';
															}
														else{
																$status='label-default';
																$value 	=	'Inactive';
															}
												echo "<span class='label $status'>$value</span>";
												?>
											</td> 
											<td class="align-center">
												
												<a type="button" href="edit_user.php?id=<?php echo $user_id;?>" class="btn btn-info btn-xs">	<i class="fa fa-edit"></i></a>
										    	<a href="javascript:;" onclick="del(<?php echo $user_id;?>,'<?php echo $row['name'];?>')" class="btn btn-primary btn-xs">	<i class="fa fa-trash-o"></i></a>
										   
											</td> 
										</tr> 
										<?php }?>
										


										
																				

									</tbody> 
								</table>
										

								</div> <!-- /.table-responsive -->

							
								
							</div> <!-- /.portlet-content -->

						</div> <!-- /.portlet -->

					</div> <!-- /.col-md-4 -->
	

			</div>


			
		</div> <!-- /#content-container -->
		

	</div> <!-- #content -->	
	
</div> <!-- #wrapper -->

<!--Begin  Modal -->
		<div id="deleteModal" class="modal modal-styled fade" >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title">Delete Confirmation</h3>
		      </div>
		      <div class="modal-body">
		       	Are you sure ! You want to delete this User??
		      </div>
		      <div class="modal-footer">
		        <button type="button" id="close" class="btn btn-tertiary" data-dismiss="modal">Close</button>
		        <button type="button" id="delete" class="btn btn-primary">Delete</button>
		      </div>
		    </div>
		    <!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
	<!--End modal -->



<?php include "include/footer.php" ?>
<?php include "include/footerjs.php" ?>

<script src="../assets/plugins/flot/jquery.flot.js"></script>
<script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="../assets/plugins/flot/jquery.flot.resize.js"></script>


<script >
	
	$(function () {
    
    var d1, d2, data, chartOptions;

<?php 
			$query ="SELECT date(`created_at`),count(*) as total,EXTRACT(DAY FROM created_at) AS  today
			       
			FROM `users` WHERE
			MONTH(CURDATE()) = MONTH(created_at) AND YEAR(CURDATE()) = YEAR(created_at) 
			GROUP BY date(`created_at`)
			ORDER BY date(`created_at`) ASC;";

			$result = $db->prepare($query); 
			$result->execute(); 
			while($row = $result->fetch(PDO::FETCH_ASSOC)){								
						$data[] = "[{$row['today']},{$row['total']}]" ;

			}		
			$date =date('t');
			for($i=1;$i<=$date;$i++){
				if(isset($data[$i]))continue;
				$data[] = "[{$i}]" ;
			}	
			$d1data=implode(',', $data);
?>
    d1 = [
        <?php echo $d1data; ?>
    ];
 
    

    data = [{ 
        label: "Total Registration", 
        data: d1
    }];
 	 
    chartOptions = {
         xaxis: {
                     ticks: <?php echo date('t'); ?>,
                    tickDecimals: 0
                },
                yaxis: {
                    ticks: 11,
                    tickDecimals: 0
           
                },
       
        series: {
            lines: {
                show: true, 
                fill: false,
                lineWidth: 3
            },
            points: {
                show: true,
                radius: 4.5,
                fill: true,
                fillColor: "#ffffff",
                lineWidth: 2.75
            }
        },
       grid: { 
            hoverable: true, 
            clickable: false, 
            borderWidth: 0 
        },
        legend: {
            show: true
        },
        
        tooltip: true,
        tooltipOpts: {
            content: '%s: %y'
        },
        colors: App.chartColors
    };

    

    var holder = $('#line-chart');

    if (holder.length) {
        $.plot(holder, data, chartOptions );
    }


});
</script>
<script>

		function del(id,name)
		{
	
			$('#deleteModal').appendTo("body").modal('show');
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
		                 	  		$('#deleteModal').modal('hide');
		                 	  		$('#row'+id).closest('tr').remove();
		                 	  		$('#result').html("<p class='alert alert-success text-center'><strong>"+name +" </strong>User Successfully Deleted</p>");
		                  	     
		                  	  }
		           		 });
				})

			}
</script>

</body>
</html>