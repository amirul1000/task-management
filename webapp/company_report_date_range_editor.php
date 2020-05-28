<?php
  include("template/header.php");
?>   

<link rel="stylesheet" href="datepicker/jquery-ui.css">
<script src="datepicker/jquery-1.10.2.js"></script>
<script src="datepicker/jquery-ui.js"></script>

 <script language="javascript">
 $( document ).ready(function() {
		 	$( "#btn_email_submit" ).click(function() {
		   $( "#cmd" ).val("report_company_date_range_email");
		   $( "#frm_task" ).submit();
   });
});

$( document ).ready(function() {
     $( "#btn_pdf_submit" ).click(function() {
	  $( "#cmd" ).val("pdf");
     $( "#frm_task" ).submit();
   });
});

function fillUpContractor(company_id)
{
    objselect = document.getElementById("users_id");
    objselect.options.length = 0;
    $("#spinner2").html('<img src="../images/indicator.gif" alt="Wait" />');
    $.ajax({  
      url: 'company_report?cmd=contractor&company_id='+company_id,
      success: function(data) {
              var obj = eval(data);    
              
              objselect.add(new Option('--All--',''), null);
              for(var i=0;i<obj.length;i++)
              {
                 text = obj[i].employee;
                 objselect.add(new Option(text,obj[i].id), null);
              }
            $("#spinner2").html('');
          }
        });
}
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
												$info['table']    = "company";
												$info['fields']   = array("*");   	   
												$info['where']    =  "1=1 AND users_id='".$_SESSION['users_id']."' ORDER BY id DESC";
												$rescompany  =  $db->select($info);
											 ?>
											<select  name="company_id" id="company_id" class="form-control-static"  onChange="fillUpContractor(this.value);"  required>
												<option value="">--Select--</option>
												<?php
												   foreach($rescompany as $key=>$each)
												   { 
												?>
												  <option value="<?=$rescompany[$key]['id']?>" <?php if($rescompany[$key]['id']==$_REQUEST['company_id']){ echo "selected"; }?>><?=$rescompany[$key]['company_name']?></option>
												<?php
												 }
												?> 
											</select>
                                            <div id="spinner2"></div>
										</td>
								  </tr>
                                  <tr>
                                     <td>Contractor</td>
                                     <td>
                                       <?php
									     if($_POST)
										 {
											     unset($info);
												 unset($data);
											$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
																				 LEFT OUTER JOIN company on(task.company_id=company.id)
																				 LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
											$info["fields"] = array("distinct(task_performed.users_id) as id"); 
											$info["where"]   = "1 AND task.company_id='".$_REQUEST['company_id']."'";
											$arr_users =  $db->select($info);
											
											for($i=0;$i<count($arr_users);$i++)
											{
											   $arr_id[] = $arr_users[$i]['id'];  		
											}
											$info["table"] = "users";
											$info["fields"] = array("users.id,concat(users.first_name,' ',users.last_name) as employee"); 
											$info["where"]   = "1   AND id in (".implode(",",$arr_id).")";
											$arr_users =  $db->select($info);
										 }
									   ?>
                                        <select  name="users_id" id="users_id"   class="form-control-static">
                                            <option value="">--All--</option>
                                            <?php
											   for($i=0;$i<count($arr_users);$i++)
											   {
											?>
                                             <option value="<?=$arr_users[$i]['id']?>" <?php if($arr_users[$i]['id']==$_REQUEST['users_id']){ echo "selected";} ?>><?=$arr_users[$i]['employee']?></option>
                                            <?php
											   }
											?>
                                        </select>
                                    </td>
                               </tr>  
                               <tr>
                                     <td>Date from</td>
                                     <td>
                                        <input type="text" name="date_from" id="date_from"  value="<?=$_REQUEST['date_from']?>" class="datepicker form-control-static">
                                     </td>
                               </tr>										   
                               <tr>
                                     <td>Date to</td>
                                     <td>
                                        <input type="text" name="date_to" id="date_to"  value="<?=$_REQUEST['date_to']?>" class="datepicker form-control-static">
                                     </td>
                                </tr>               
                                <tr> 
                                     <td align="right"></td>
                                     <td nowrap="nowrap">
                                        <input type="hidden" name="cmd" id="cmd" value="report_company_date_range">
                                        <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn green">
                                        <input type="submit" name="btn_submit" id="btn_email_submit" value="Email this report" class="btn green">
                                        <input type="submit" name="btn_pdf_submit" id="btn_pdf_submit" value="Pdf" class="btn green">
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
							$report  .= "<tr><td>".$arr_data[$i]['employee']."</td><td></td><td></td><td></td><td></td><td></td></tr>";
							$report  .= "<tr><td>Date</td><td>Task name</td><td>Note</td><td>Unit type</td><td>Rate</td><td>No of units completed</td><td>Fee</td></tr>";
						   $task_perfomed = $arr_data[$i]['task_perfomed'];
						  for($j=0;$j<count($task_perfomed);$j++)
						  { 								    
								$date_time             = $task_perfomed[$j]['date_time'];
								$notes                 = $task_perfomed[$j]['description'];
								$unit_type             = $task_perfomed[$j]['unit_type'];
							    $rate                  = $task_perfomed[$j]['rate'];
								$task_name             = $task_perfomed[$j]['task_name'];
								$no_of_units_completed = $task_perfomed[$j]['no_of_units_completed']; 
								$fee                   = $task_perfomed[$j]['fee']; 
								$report  .= "<tr><td>".$date_time."</td><td>".$task_name."</td><td>".$notes."</td><td>".$unit_type."</td><td>".$rate."</td><td>".$no_of_units_completed."</td><td>".$fee."</td></tr>";
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
