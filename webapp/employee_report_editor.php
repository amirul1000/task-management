<?php
  include("template/header.php");
?>   

<link rel="stylesheet" href="<?=$assets_url?>/datepicker/jquery-ui.css">
<script src="<?=$assets_url?>/datepicker/jquery-1.10.2.js"></script>
<script src="<?=$assets_url?>/datepicker/jquery-ui.js"></script>

 <script language="javascript">
 $( document ).ready(function() {
		 	$( "#btn_email_submit" ).click(function() {
		   $( "#cmd" ).val("report_task_date_range_email");
		   $( "#frm_task" ).submit();
   });
});
</script> 
       
     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Report"))?></b>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
             
           <div class="portlet-body">
			      <div class="table-responsive">	
				     <table class="table">
						 <tr>
						  <td>  			
			 	  <form name="frm_task" id="frm_task" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
					 <div class="portlet-body">
			      <div class="table-responsive">	
				     <table class="table">
							      <tr>
										 <td>Company</td>
										 <td>
											 <?php
														unset($info);
														unset($data);
											     $info["table"] = "company_register LEFT OUTER JOIN company ON(company_register.company_id=company.id)";
												  $info["fields"] = array("company.id as company_id  ,company.no,company.company_name,company.description,company_register.*"); 
												  $info["where"]   = "1  AND company_register.users_id='".$_SESSION['users_id']."'
																		 AND register_status='register'";
												  $rescompany  =  $db->select($info);
											 ?>
											<select  name="company_id" id="company_id"   class="textbox" required>
												<option value="">--Select--</option>
												<?php
												   foreach($rescompany as $key=>$each)
												   { 
												?>
												  <option value="<?=$rescompany[$key]['company_id']?>" <?php if($rescompany[$key]['company_id']==$_REQUEST['company_id']){ echo "selected"; }?>><?=$rescompany[$key]['company_name']?></option>
												<?php
												 }
												?> 
											</select>
										</td>
								  </tr> 
					           <tr>
									 <td>Date from</td>
									 <td>
									    <input type="text" name="date_from" id="date_from"  value="<?=$_REQUEST['date_from']?>" class="datepicker">
									 </td>
							     </tr>										   
			                <tr>
									 <td>Date to</td>
									 <td>
									    <input type="text" name="date_to" id="date_to"  value="<?=$_REQUEST['date_to']?>" class="datepicker">
									 </td>
							    </tr>               
			                <tr> 
			                     <td align="right"></td>
			                     <td nowrap="nowrap">
			                        <input type="hidden" name="cmd" id="cmd" value="report_task_date_range">
			                        <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn green">
			                        <input type="submit" name="btn_submit" id="btn_email_submit" value="Email this report" class="btn green">
			                     </td>     
			                </tr>
					  </table>
				</div>
				</div>
			 </form>	
			 </td>
			 </tr>
			</table>
			</div>
			</div>
		</div>
		
	 <?php
	          if($_POST)
	          {                   
	               $report  = "";
						$report  .= '<div class="portlet-body">
										      <div class="table-responsive">	
											     <table class="table">';
						for($i=0;$i<count($arr_data);$i++)
						{
							$report  .= "<tr><td>".$arr_data[$i]['company']."</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
							$report  .= "<tr><td>Date</td><td>Task Name</td><td>Note</td><td>Unit type</td><td>Rate</td><td>No of units completed</td><td>Fee</td></tr>";
						  $task_perfomed = $arr_data[$i]['task_perfomed'];
						  for($j=0;$j<count($task_perfomed);$j++)
						  { 
						    $task_name             = $task_perfomed[$j]['task_name'];
							$date_time             = $task_perfomed[$j]['date_time'];
							$unit_type             = $task_perfomed[$j]['unit_type'];
						    $rate                  = $task_perfomed[$j]['rate'];
							$description           = $task_perfomed[$j]['description'];
							$no_of_units_completed = $task_perfomed[$j]['no_of_units_completed']; 
							$fee                   = $task_perfomed[$j]['fee']; 
							$report  .= "<tr><td>".$date_time."</td><td>".$task_name."</td><td>".$description."</td><td>".$unit_type."</td><td>".$rate."</td><td>".$no_of_units_completed."</td><td>".$fee."</td></tr>";
		                  }
						  $report  .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>".$arr_data[$i]['fee_total']."</td></tr>";
						}
						
						$report  .= "</table>
			                        </div>
			                        </div>"; 
	
	               echo $report;
	          }  
  ?>
		
		
		<script>
			$( ".datepicker" ).datepicker({
				dateFormat: "yy-mm-dd", 
				changeYear: true,
				changeMonth: true,
				showOn: 'button',
				buttonText: 'Show Date',
				buttonImageOnly: true,
				buttonImage: 'images/calendar.gif',
			});
	    </script>
<?php
  include("template/footer.php");
?>					               
