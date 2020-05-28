<?php
  include("template/header.php");
?>   
     <style>          
		 #navlist li
			{
				float:left;
				display: inline;
				list-style-type: none;
				padding-right: 20px;
			}
		</style>

     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Task"))?></b>
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
											<thead>
												<tr>
												  <th>Name</th>
												  <th>Description</th>
												  <th>Rate</th>
												  <th>Unit</th>
												  <th>Max units per day</th>
												  <th>Action</th>
												</tr>
										</thead>
										<tbody>
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
												$arr =  $db->select($info);
							
											  }	
											
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
										  <td><?=$arr[$i]['task_name']?></td>
										  <td><?=$arr[$i]['description']?></td>
										  <td><?=$arr[$i]['rate']?></td>
										  <td><?=$arr[$i]['unit_type']?></td>
										  <td><?=$arr[$i]['max_units_per_day']?></td>										  
										  <td nowrap >
							                  <a href="employee_task_performed?cmd=list&task_id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Task Performed</a> 
                                </td>
										</tr>	
							<?php
									  }
							?>			
								
								</tbody>
								</table>
							</div>
							</div>
				
		</td>
		</tr>
		</table>
		</div>
		</div>
		<!-- END Logins log TABLE PORTLET-->
     
</div>


<?php
  include("template/footer.php");
?>					               




