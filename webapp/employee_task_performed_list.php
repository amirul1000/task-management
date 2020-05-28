<?php
  include("template/header.php");
?>   
<?php									     
		 /*  unset($info);
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
			$info["where"]   = "1  AND status='active' AND company_id in($list) ORDER BY id DESC";
			$arr2 =  $db->select($info);
	
		  }	
		
		for($k=0;$k<count($arr2);$k++)
		{
			$task_id = $arr2[$k]['id'];
			*/
?>
  <!--
	 <div class="portlet-body">
					<div class="table-responsive">
						<table class="table">
						  <tr>
						   <td> 
								 <div class="portlet-body">
								      <div class="table-responsive">	
									     <table class="table">								
										 <?php
													  unset($info);
													  unset($data);
													$info["table"] = "task";
													$info["fields"] = array("task.*"); 
													$info["where"]   = "1  AND id='".$task_id."'";
													$arr =  $db->select($info);							
												  
										 ?>
											<tr>
											   <td>Name</td><td><?=$arr[0]['task_name']?></td>
											</tr>
											<tr>   
											   <td>Description</td><td><?=$arr[0]['description']?></td>
											</tr>
											<tr>   
											  <td>Rate</td><td><?=$arr[0]['rate']?></td>
											</tr>
											<tr>  
											  <td>Unit</td><td><?=$arr[0]['unit_type']?></td>
											</tr>
											<tr>  
											  <td>Max units per day</td><td><?=$arr[0]['max_units_per_day']?></td>	
											</tr>	
									</table>
								</div>	
								</div>			
			         </td>
			        </tr>
			      </table>
			  </div>
	</div>
  
    <a href="employee_task_performed?cmd=edit&task_id=<?=$task_id?>" class="btn green">Add a task performed</a> <br><br>
    -->
     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","task_performed"))?></b>
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
				 <div class="portlet-body">
			      <div class="table-responsive">	
				     <table class="table">
						<tr bgcolor="#ABCAE0">
						  <td>Date</td>
						  <td>Task</td>
						  <td>Note</td>
						  <td>No of units <br> completed</td>
						  <td>Action</td>
						</tr>
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
							$info["where"]   = "1  AND status='active' AND company_id in($list) ORDER BY id DESC";
							$arr2 =  $db->select($info);
					
						  }	
						
						 for($k=0;$k<count($arr2);$k++)
						 {
							 $task_id = $arr2[$k]['id'];
							  
							 $whrstr =" AND task_id='".$task_id."' AND users_id='".$_SESSION['users_id']."'"; 
							  
					 
							/*$rowsPerPage = 10;
							$pageNum = 1;
							if(isset($_REQUEST['page']))
							{
								$pageNum = $_REQUEST['page'];
							}
							$offset = ($pageNum - 1) * $rowsPerPage;*/  
					 
					 
										  
							$info["table"] = "task_performed";
							$info["fields"] = array("task_performed.*"); 
							$info["where"]   = "1   $whrstr ORDER BY date_time DESC";//  LIMIT $offset, $rowsPerPage";
												
							
							$arr =  $db->select($info);
							
							for($i=0;$i<count($arr);$i++)
							{
							
							   $rowColor;
					
								if($i % 2 == 0)
								{
									
									$row="#C8C8C8";
								}
								else
								{
									
									$row="#FFFFFF";
								}
							
					 ?>
						<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">	
						  <td><?=$arr[$i]['date_time']?></td>
						  <td><?=$arr2[$k]['task_name']?></td>
						  <td><?=$arr[$i]['description']?></td>
						  <td><?=$arr[$i]['no_of_units_completed']?></td>
						  <td nowrap >
			                  <a href="employee_task_performed?cmd=edit&id=<?=$arr[$i]['id']?>&task_id=<?=$task_id?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
			                  <a href="employee_task_performed?cmd=delete&id=<?=$arr[$i]['id']?>&task_id=<?=$task_id?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> 
						 </td>
						</tr>
					<?php
							  }
							  
					     }	  
					?>
					<!--
					<tr>
					   <td colspan="10" align="center">
			               <style>          
							 #navlist li
								{
									float:left;
									display: inline;
									list-style-type: none;
									padding-right: 20px;
								}
							</style>
						  <?php              
								  /*unset($info);
				
								  $info["table"] = "task_performed";
								  $info["fields"] = array("count(*) as total_rows"); 
								  $info["where"]   = "1  $whrstr ORDER BY id DESC";
								  
								  $res  = $db->select($info);  
				
				
									$numrows = $res[0]['total_rows'];
									$maxPage = ceil($numrows/$rowsPerPage);
									$self = 'employee_task_performed?cmd=list&task_id='.$task_id;
									$nav  = '';
									
									$start    = ceil($pageNum/5)*5-5+1;
									$end      = ceil($pageNum/5)*5;
									
									if($maxPage<$end)
									{
									  $end  = $maxPage;
									}
									
									for($page = $start; $page <= $end; $page++)
									//for($page = 1; $page <= $maxPage; $page++)
									{
										if ($page == $pageNum)
										{
											$nav .= "<li>$page</li>"; 
										}
										else
										{
											$nav .= "<li><a href=\"$self&&page=$page\" class=\"nav\">$page</a></li>";
										} 
									}
									if ($pageNum > 1)
									{
										$page  = $pageNum - 1;
										$prev  = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a></li>";
								
									   $first = "<li><a href=\"$self&&page=1\" class=\"nav\">[First Page]</a></li>";
									} 
									else
									{
										$prev  = '<li>&nbsp;</li>'; 
										$first = '<li>&nbsp;</li>'; 
									}
								
									if ($pageNum < $maxPage)
									{
										$page = $pageNum + 1;
										$next = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Next]</a></li>";
								
										$last = "<li><a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a></li>";
									} 
									else
									{
										$next = '<li>&nbsp;</li>'; 
										$last = '<li>&nbsp;</li>'; 
									}
									
									if($numrows>1)
									{
									  echo '<ul id="navlist">';
									   echo $first . $prev . $nav . $next . $last;
									  echo '</ul>';
									}*/
								?>     
					   </td>
					</tr>-->
				</table>
				</div>
				</div>
		  </td>
		 </tr>
</table>
</div>
</div>
</div>
<!-- END Logins log TABLE PORTLET-->
 <?php
   //}
 ?>    
</div>
<?php
  include("template/footer.php");
?>					               






