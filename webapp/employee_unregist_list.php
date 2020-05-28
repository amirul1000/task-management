<?php
  include("template/header.php");
?>   

     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Unregister"))?></b>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
             
           	 <div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
						 <tr>
						  <td>  			
			 	  <form name="frm_task" id="frm_task" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
					<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<tr bgcolor="#ABCAE0">			 
							  <th>No</th>
							  <th>Company name</th>
							  <th>Description</th>
							  <th>Status</th>
				           <th>Register Status</th>
				           <th>Date created</th>
							  <th>Action</th>
							</tr>
						 <?php
								
								unset($info);
								unset($data);
						      $info["table"] = "company_register LEFT OUTER JOIN company ON(company_register.company_id=company.id)";
							  $info["fields"] = array("company.no,company.company_name,company.description,company_register.*"); 
							  $info["where"]   = "1  AND company_register.users_id='".$_SESSION['users_id']."'
													 AND register_status='register'";
							  $arr =  $db->select($info);
								
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
							  <td><?=$arr[$i]['no']?></td>
							  <td><?=$arr[$i]['company_name']?></td>
							  <td><?=$arr[$i]['description']?></td>
							  <td><?=$arr[$i]['status']?></td>
				           <td><?=$arr[$i]['register_status']?></td>
				           <td><?=$arr[$i]['date_created']?></td>
							  <td nowrap >
                            <a href="employee_unregister?cmd=employee_unregister_company&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to unregister this item ?');"><i class="fa fa-times"></i>Unregister</a> 
							  </td>						
							</tr>
						<?php
								  }
						?>
						</table>
				     </div>
			 </form>	
			 </td>
			 </tr>
			</table>
			</div>
		</div>	
<?php
  include("template/footer.php");
?>					               
