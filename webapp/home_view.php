<?php
	//$_SERVER['SERVER_NAME'] = $_SERVER['SERVER_NAME'].'/webapp';
	//$site_url = "http://".$_SERVER['SERVER_NAME'];
	$assets_url = '../v4.0.1/theme';
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.0
Version: 3.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD --><head>
<meta charset="utf-8"/>
<title>Contractor Tracker App</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?=$assets_url?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<?=$assets_url?>/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?=$assets_url?>/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?=$assets_url?>/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?=$assets_url?>/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->

<style>
 .heading_text_logo{
	color: #fff;
    float: left;
    font-size: 15px;
    font-weight: 600;
    padding-left: 12px;
    padding-top: 2px;
    text-transform: uppercase;
	font-weight:bold
 }
</style>
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square"> 
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<div class="page-logo" style="width:363px;">
			<a href="">
            <label>
			<img src="images/logo.png" alt="logo" class="logo-default" style="width:30px;float:left"/>
            <h6 class="heading_text_logo">Contractor Tracker App</h6></label>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			
			</div>
		</div>
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<?php
		 include("template/top_menu.php");
		?>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	 <?php
	  include("template/left_menu.php");
	 ?> 
	<!-- END SIDEBAR -->
    
				
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			
			<link rel="stylesheet" href="<?=$assets_url?>/datepicker/jquery-ui.css">
          <script src="<?=$assets_url?>/datepicker/jquery-1.10.2.js"></script>
          <script src="<?=$assets_url?>/datepicker/jquery-ui.js"></script>
           
           <div class="row">
               <?php
               
                   if(isset($_SESSION['message'])) {
                   	   echo "<center><font color=\"red\"><b>".$_SESSION['message']."</b></font></center><br>";
                   	   unset($_SESSION['message']);
                   	}
				?>	
			</div>
         
         
          <!-------------------------Employee task popup------------------------------------->
 
			    <?php
			      if($_SESSION['user_type']=='employee')
			      {			  
			    ?>
			    
            <div class="row">
               <?php
						   unset($info);
							unset($data);
					     $info["table"] = "company_register";
						  $info["fields"] = array("company_register.*"); 
						  $info["where"]   = "1  AND users_id='".$_SESSION['users_id']."' AND register_status='register'";
						  $arr =  $db->select($info);
						  for($i=0;$i<count($arr);$i++)
						  {
						    $company_id[] = $arr[$i]['company_id'];
						  }
						  
					     if(count($company_id)>0)
						  {
							   $list = implode(",", $company_id);
						 
								  unset($info);
								  unset($data);
								$info["table"] = "task";
								$info["fields"] = array("task.*"); 
								$info["where"]   = "1  AND status='active' AND company_id in($list)";
								$arr_modal =  $db->select($info);
								
						  }
				 ?>
				   <!--------  Employee Popup  ------------>
				   
             <script language="javascript">
               function AddaTask() 
               {
                 id = $("#add_a_employee_task").val();  
                 id = "#"+id;
                 $( id ).modal('show');
               }
             </script>				  
				  <center>
				  <select name="add_a_employee_task" id="add_a_employee_task" class="form-control" style="width:200px;">
				  <?php  
					 for($i=0;$i<count($arr_modal);$i++)
						{
				  ?>
				   <option value="form_home_modal_<?=$i?>"><?php echo $arr_modal[$i]['task_name'];?></option>								
				 <?php
				      }
				 ?> 
				 </select>     
				 <input type="button" name="btn_submit" id="btn_submit" value="Add a Task" class="btn blue" onclick="AddaTask();">
				</center>
				   
           <?php
            for($i=0;$i<count($arr_modal);$i++)
						{
			  ?> 
             <div id="form_home_modal_<?=$i?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">                   
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<center>											
										   	<h4 class="modal-title"> <b><?php echo $arr_modal[$i]['task_name'];?></b> </h4>
											</center>
											<center>	
												<p>
												    <?php echo $arr_modal[$i]['description'];?>
												</p>
											</center>
										</div>
										<div class="modal-body">
											<table class="table"> 
											 <tr>
											  <td> 
												 <form name="frm_task_performed" method="post"  action="employee_task_performed"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
													<div class="portlet-body">
														<table class="table"> 
											            <tr>
											             <td>Date</td>
											             <td>
											                <input type="text" name="date_time" id="date_time_e_<?=$i?>"  value="<?=date("Y-m-d");?>" class="datepicker_e_<?=$i?>">
											             </td>
											            </tr><tr>
											             <td valign="top">Description</td>
											             <td>
											                <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
											             </td>
											            </tr><tr>
											             <td>No of units completed</td>
											             <td>
											                <input type="number" name="no_of_units_completed" id="no_of_units_completed"  value="<?=$no_of_units_completed?>" class="textbox">
											             </td>
											            </tr>
											            <tr> 
											             <td align="right"></td>
											             <td>
											                <input type="hidden" name="cmd" value="add">
											                <input type="hidden" name="task_id" value="<?=$arr_modal[$i]['id']?>">			
											                <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
											             </td>     
											            </tr>
													</table>
													</div>
											</form>
											  </td>
											 </tr>
											</table>
										</div>
										<div class="modal-footer">
											<button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>											
										</div>
									</div>
								</div>
								<script>
								$( ".datepicker_e_<?=$i?>" ).datepicker({
									dateFormat: "yy-mm-dd", 
									changeYear: true,
									changeMonth: true,
									showOn: 'button',
									buttonText: 'Show Date',
									buttonImageOnly: true,
									buttonImage: 'images/calendar.gif',
								});
							</script>
				   </div>				  
				 <?php
              }
            ?>	
            </div>
            <?php
              }
            ?>
       <!------------------------------------------------------------------------------>
             
       
      <!--   Employer task popup    -->

           <script language="javascript">
               function AddaEmployerTask() 
               {
                 id = $("#add_a_employer_task").val();  
                 id = "#"+id;
                 $( id ).modal('show');
               }
             </script>				    
           <?php
				   if( $_SESSION["user_type"] == 'employer')
				   {
				 ?>
            <div class="row">
				<?php
				       unset($info);
						$info["table"] = "company";
						$info["fields"] = array("company.*"); 
						$info["where"]   = "1  AND users_id='".$_SESSION['users_id']."'  ORDER BY id DESC";
						$arr =  $db->select($info);
				 ?>				    
				  <center>
				  <select name="add_a_employer_task" id="add_a_employer_task" class="form-control" style="width:200px;">
				  <?php  
					for($i=0;$i<count($arr);$i++)
						{
				  ?>
				   <option value="form_home_company_modal_<?=$i?>"><?php echo $arr[$i]['company_name'];?></option>								
				 <?php
				      }
				 ?> 
				 </select>     
				 <input type="button" name="btn_submit" id="btn_submit" value="Add a Task" class="btn blue" onclick="AddaEmployerTask();">
				</center>       
				<?php				   
				?>   



            <?php  
					for($i=0;$i<count($arr);$i++)
						{
				  ?>

           <div id="form_home_company_modal_<?=$i?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">             
            <div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<center>	
						   	<div class="portlet-body">
								  <div class="table-responsive">
									<table class="table">
											<tr>			
											   <td>No</td>								 
								           <td><?=$arr[$i]['no']?></td>    
								         </tr>   
								         <tr>
								            <td>Company Name</td>
											  <td><?=$arr[$i]['company_name']?></td>
											</tr>
											<tr>  
											  <td>Description</td>		
											  <td><?=$arr[$i]['description']?></td>
											</tr>
									 </table>
								 </div> 
								 </div>
							</center>							
						</div>
						<div class="modal-body">
							<table class="table"> 
							 <tr>
							  <td>  				
							 <form name="frm_task" method="post"  action="task"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								<div class="portlet-body">
										<table class="table"> 
								           <tr>
												 <td>Task Label</td>
												 <td>
												    <input type="text" name="task_name" id="task_name"  value="<?=$task_name?>" class="textbox">
												 </td>
										     </tr>
										     <tr>
												 <td valign="top">Note</td>
												 <td>
												    <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
												 </td>
										     </tr>
										     <tr>
												 <td>Rate</td>
												 <td>
												    <input type="text" name="rate" id="rate"  value="<?=$rate?>" class="textbox">
												 </td>
										     </tr>
										     <tr>
								           		 <td>Unit Type</td>
						                      <td><?php
						                                $enumtask = getEnumFieldValues('task','unit_type');
						                            ?>
						                            <select  name="unit_type" id="unit_type"   class="textbox">
						                            <?php
						                               foreach($enumtask as $key=>$value)
						                               { 
						                            ?>
						                              <option value="<?=$value?>" <?php if($value==$unit_type){ echo "selected"; }?>><?=$value?></option>
						                             <?php
						                              }
						                            ?> 
						                            </select>
						                        </td>
										    </tr>
                                            <tr>
												 <td colspan="2">
                                                   <script language="javascript">
												      function setChecked()
													  {
													   if($("#perday_type_limited").is(':checked')){														   
															$("#max_units_per_day").removeAttr("disabled");
														} 
														else if($("#perday_type_unlimited").is(':checked')){
															$("#max_units_per_day").attr("disabled","disabled");
														}
													  }
													</script>
                                                    <b>Max units per day</b><br>
												    Limited<input type="radio" name="perday_type" id="perday_type_limited"  value="limited" onClick="setChecked();" checked="checked">
                                                    Unlimited<input type="radio" name="perday_type" id="perday_type_unlimited" onClick="setChecked();"  value="unlimited">
												 </td>
										    </tr>
                                            <tr>
                                                     <td>Max units per day</td>
                                                     <td>
                                                        <input type="text" name="max_units_per_day" id="max_units_per_day"  value="<?=$max_units_per_day?>" class="textbox">
                                                     </td>
                                                </tr>               
                                            <tr> 
						                     <td align="right"></td>
						                     <td>
						                        <input type="hidden" name="cmd" value="add">
						                        <input type="hidden" name="id" value="<?=$Id?>">			
						                        <input type="hidden" name="company_id" value="<?=$arr[$i]['id']?>">		
						                        <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
						                     </td>     
						                </tr>
								</table>
								</div>
						</form>
					  </td>
					 </tr>
					</table>
					</div>
						<div class="modal-footer">
							<button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>											
						</div>
					</div>
				</div>
			 </div>	
			   <script>
					/*$( ".datepicker" ).datepicker({
						dateFormat: "yy-mm-dd", 
						changeYear: true,
						changeMonth: true,
						showOn: 'button',
						buttonText: 'Show Date',
						buttonImageOnly: true,
						buttonImage: 'images/calendar.gif',
					});*/
				</script>
           <?php
				      }
			  ?> 
			   </div>
            <?php
              }
            ?>
      <!--               Employer task popup  //                             -->


            

            <div class="row">
             <?php
                
				  if(isset($_SESSION['this_duration'])&&$_SESSION['this_duration']=='this_week')
				  {
					  $duration='week';
				  }
				  elseif(isset($_SESSION['this_duration'])&&$_SESSION['this_duration']=='this_month')
				  {
					 $duration='month'; 
				  }
				  else
				  {
					$duration='week';  
				  }
				
                 if($_SESSION['user_type']=='employer'){
							unset($info);
							unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.date_time"); 
						$info["where"]   = "1  AND task.users_id='".$_SESSION['users_id']."'";
						if($duration=='week')
						{					   
							$info["where"]   .= " AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())";
						}
						else if($duration=='month')
						{
						  $info["where"]     .= " AND MONTH(task_performed.date_time) = MONTH(NOW())";	
						  $info["where"]   .= " AND YEAR(task_performed.date_time) = YEAR(NOW())";	
						}
						$info["where"]      .= " GROUP BY task_performed.date_time DESC";
						 
						$arr_task =  $db->select($info);
						 
					   for($i=0;$i<count($arr_task);$i++)
					   {
					  
							 unset($info);
							 unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.*,
												FORMAT(task.rate,2) as rate,
												task.unit_type,
												FORMAT(task_performed.no_of_units_completed*task.rate,2) as 	fee,
												task.task_name,
												concat(users.first_name,' ',users.last_name) as employee"); 
						$info["where"]   = "1  AND task.users_id='".$_SESSION['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."' 
						                       AND task.status='active'";
						if($duration=='week')
						{					   
							$info["where"]   .= " AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())";
						}
						else if($duration=='month')
						{
						  $info["where"]   .= " AND MONTH(task_performed.date_time) = MONTH(NOW())";	
						  $info["where"]   .= " AND YEAR(task_performed.date_time) = YEAR(NOW())";	
						}
						
						$arr_task_perfomed =  $db->select($info);

						  
						  unset($info);
						  unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
						$info["where"]   = "1  AND task.users_id='".$_SESSION['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."'						
						                       AND task.status='active'";
						if($duration=='week')
						{					   
							$info["where"]   .= " AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())";
						}
						else if($duration=='month')
						{
						  $info["where"]   .= " AND MONTH(task_performed.date_time) = MONTH(NOW())";	
						  $info["where"]   .= " AND YEAR(task_performed.date_time) = YEAR(NOW())";	
						}
						  $arr_fee_total =  $db->select($info);
						  
						  if($arr_fee_total[0]['fee_total']>0)
						  {
							  $arr_week[] = array('date_time'=>$arr_task[$i]['date_time'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=>$arr_fee_total[0]['fee_total']);
						  }					  
					  }	  
						  
						//echo json_encode($arr_week);
			  }else if($_SESSION['user_type']=='employee'){			  
			     
				      unset($info);
						unset($data);
					  $info["table"] = "company_register";
					  $info["fields"] = array("company_register.*"); 
					  $info["where"]   = "1  AND users_id='".$_SESSION['users_id']."'";
					  $arr =  $db->select($info);
					  for($i=0;$i<count($arr);$i++)
					  {
						$company_id[] = $arr[$i]['company_id'];
					  }
					  
					 if(count($company_id)>0)
					 {
						 $list = implode(",", $company_id);
					 
						  unset($info);
						  unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.date_time"); 
						$info["where"]   = "1  AND task.status='active' 
						                       AND task.company_id in($list)
						                       AND task_performed.users_id='".$_SESSION['users_id']."'";
						if($duration=='week')
						{					   
							$info["where"]   .= " AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())";
						}
						else if($duration=='month')
						{
						  $info["where"]   .= " AND MONTH(task_performed.date_time) = MONTH(NOW())";	
						  $info["where"]   .= " AND YEAR(task_performed.date_time) = YEAR(NOW())";	
						}  
						$info["where"]   .= " GROUP BY task_performed.date_time DESC";
											   
											   
										   
						$arr_task =  $db->select($info);
						
						for($i=0;$i<count($arr_task);$i++)
					   {
					  
							 unset($info);
							 unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														 LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.*,
												FORMAT(task.rate,2) as rate,
												task.unit_type,
												task.task_name,
												FORMAT(task_performed.no_of_units_completed*task.rate,2) as fee,
												concat(users.first_name,' ',users.last_name) as employee"); 
						$info["where"]   = "1  AND task_performed.users_id='".$_SESSION['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."'
											   AND task.status='active'";
						
						$arr_task_perfomed =  $db->select($info);
						  
						
						  
						  unset($info);
						  unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
						$info["where"]   = "1  AND task_performed.users_id='".$_SESSION['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."'
											   AND task.status='active'";
						$arr_fee_total =  $db->select($info);
						  
						  if($arr_fee_total[0]['fee_total']>0)
						  {
							  $arr_week[] = array('date_time'=>$arr_task[$i]['date_time'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=>$arr_fee_total[0]['fee_total']);
						  }					  
					  }	  
						  
						//echo json_encode($arr_week);
					}
			  }
             
             ?>
             
            <h3> 
               <script language="javascript">
			      function setDuration(value)
				  {
					 window.location.href = 'home?cmd=duration&this_duration='+value; 
				  }
			   </script>
               <select name="duration" id="duration" class="form-control-static" onChange="setDuration(this.value);">
                   <option value="this_week" <?php if($_SESSION['this_duration']=='this_week'){ echo "selected";} ?>>This Week</option> 
                   <option value="this_month" <?php if($_SESSION['this_duration']=='this_month'){ echo "selected";} ?>>This Month</option> 
               </select>
            </h3>


		          <div class="portlet-body">
						      <div class="table-responsive">	
							     <table class="table">
							      <tr>
					               <td>Date</td>
					               <?php
					                 if($_SESSION['user_type']=='employer')
					                 {
					               ?>
					               <td>Employee</td>
					               <?php
					                  }
					               ?>   
							         <td>Task</td>
							         <td>Rate</td> 
							         <td>No of units <br> completed</td> 
							         <td>Total</td>
					            </tr>
			               <?php
			               
			                 for($i=0;$i<count($arr_week);$i++) 
			                 {
			               ?>					        
					            <?php
					               $task_arr = $arr_week[$i]['task_perfomed']; 
					               for($j=0;$j<count($task_arr);$j++) 
			                       {

					            ?>
					             <tr onClick="$('#form_home_modal_<?=$i?><?=$j?>').modal('show');">
					                      <td><?=$arr_task[$i]['date_time']?></td> 
					                      <?php
							                 if($_SESSION['user_type']=='employer')
							                 {
							               ?>
					                       <td><?=$task_arr[$j]['employee']?></td> 
					                      <?php
								               }
								             ?>    
								             <td><?=$task_arr[$j]['task_name']?></td>
								             <td><?=$task_arr[$j]['rate']?></td> 
								             <td><?=$task_arr[$j]['no_of_units_completed']?></td> 
								             <td><?php 
								                         $task_arr[$j]['rate'] = str_replace(",","", $task_arr[$j]['rate']);
								                         $task_arr[$j]['no_of_units_completed'] = str_replace(",","", $task_arr[$j]['no_of_units_completed']);
								                         
								                         $total  = $task_arr[$j]['rate']*$task_arr[$j]['no_of_units_completed'];
								                         $grand_total = $grand_total + $total;
								                         echo  number_format($total,2);
								                   ?>
                                                   
                                                   
                                                   
                                                   
                                                   <!------------------------------------Modal Popup-------------------------------------->
                                                   
                                                    <div id="form_home_modal_<?=$i?><?=$j?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">                   
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <center>											
                                                                <h4 class="modal-title"> <b><?php echo $task_arr[$j]['task_name'];?></b> </h4>
                                                                </center>
                                                                <center>	
                                                                    <p>
                                                                        <?php //echo $task_arr[$j]['description'];?>
                                                                    </p>
                                                                </center>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table"> 
                                                                 <tr>
                                                                  <td>  
                                                                     <form name="frm_task_performed" method="post"  action=""  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                                                                        <div class="portlet-body">
                                                                            <table class="table"> 
                                                                            <tr>
                                                                             <td>Date</td>
                                                                             <td>
                                                                                <input type="text" name="date_time" id="date_time_e_<?=$i?><?=$j?>"  value="<?=$arr_task[$i]['date_time']?>" class="datepicker_e_<?=$i?><?=$j?>">
                                                                             </td>
                                                                            </tr><tr>
                                                                             <td valign="top">Description</td>
                                                                             <td>
                                                                                <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$task_arr[$j]['description']?></textarea>
                                                                             </td>
                                                                            </tr><tr>
                                                                             <td>No of units completed</td>
                                                                             <td>
                                                                                <input type="number" name="no_of_units_completed" id="no_of_units_completed"  value="<?=$task_arr[$j]['no_of_units_completed']?>" class="textbox">
                                                                             </td>
                                                                            </tr>
                                                                            <tr> 
                                                                             <td align="right"></td>
                                                                             <td>
                                                                                <input type="hidden" name="cmd" value="add">
                                                                                <input type="hidden" name="task_id" value="<?=$task_arr[$j]['task_id']?>">
                                                                                <input type="hidden" name="id" value="<?=$task_arr[$j]['id']?>">			
                                                                                <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
                                                                             </td>     
                                                                            </tr>
                                                                        </table>
                                                                        </div>
                                                                </form>
                                                                  </td>
                                                                 </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>											
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                    $( ".datepicker_e_<?=$i?><?=$j?>" ).datepicker({
                                                        dateFormat: "yy-mm-dd", 
                                                        changeYear: true,
                                                        changeMonth: true,
                                                        showOn: 'button',
                                                        buttonText: 'Show Date',
                                                        buttonImageOnly: true,
                                                        buttonImage: 'images/calendar.gif',
                                                    });
                                                    </script>
                                                    </div>
                                                   <!------------------------------------------------------------------------------------->
                                                   
                                                   
                                                   
								             </td>
					             </tr>
					            <?php
					                 }
					            ?>					           
			               <?php
			                 }
			               ?>
			                   <tr>
			                     <td></td>
							         <?php
					                 if($_SESSION['user_type']=='employer')
					                 {
					               ?>
			                       <td></td> 
			                      <?php
						               }
						             ?>    
							         <td></td>
							         <td></td>
							         <td></td>
							         <td><?=number_format($grand_total,2)?></td>
					           </tr>
		              </table>
		         </div>  
		         </div>   
             
             
            </div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
			
		</div>
	</div>
	<!-- END CONTENT -->	
	
</div>
        <!-- END PAGE HEADER-->
        </div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">         
         Copyright@<?=date("Y")?>. All right reserved.</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?=$assets_url?>/assets/global/plugins/respond.min.js"></script>
<script src="<?=$assets_url?>/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?=$assets_url?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?=$assets_url?>/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?=$assets_url?>/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=$assets_url?>/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?=$assets_url?>/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>