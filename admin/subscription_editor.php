<?php
  include("template/header.php");
?>   
    
     <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","subscription"))?></b>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
             
            <div class="portlet-body"> 
                <table class="table table-striped table-bordered table-hover" id="sample_1">
 <tr>
  <td>  
     <a href="subscription?cmd=list" class="nav3">List</a>
	 <form name="frm_subscription" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		            <tr>
							 <td>Users</td>
							 <td><?php
								$info['table']    = "users";
								$info['fields']   = array("*");   	   
								$info['where']    =  "1=1 ORDER BY id DESC";
								$resusers  =  $db->select($info);
							?>
							<select  name="users_id" id="users_id"   class="textbox">
								<option value="">--Select--</option>
								<?php
								   foreach($resusers as $key=>$each)
								   { 
								?>
								  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['first_name']?> <?=$resusers[$key]['last_name']?></option>
								<?php
								 }
								?> 
							</select>
                            </td>
					  </tr>
                      <tr>
							 <td>Plan</td>
							 <td><?php
									$info['table']    = "plan";
									$info['fields']   = array("*");   	   
									$info['where']    =  "1=1 ORDER BY id DESC";
									$resplan  =  $db->select($info);
								?>
								<select  name="plan_id" id="plan_id"   class="textbox">
									<option value="">--Select--</option>
									<?php
									   foreach($resplan as $key=>$each)
									   { 
									?>
									  <option value="<?=$resplan[$key]['id']?>" <?php if($resplan[$key]['id']==$plan_id){ echo "selected"; }?>><?=$resplan[$key]['plan_name']?></option>
									<?php
									 }
									?> 
								</select>
                                </td>
					  </tr>
                      <tr>
						 <td>Start Date</td>
						 <td>
						    <input type="text" name="current_period_start" id="current_period_start"  value="<?=$current_period_start?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('current_period_start');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr>
                     <tr>
						 <td>End Date</td>
						 <td>
						    <input type="text" name="current_period_end" id="current_period_end"  value="<?=$current_period_end?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('current_period_end');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr>
                     <tr> 
                         <td align="right"></td>
                         <td>
                            <input type="hidden" name="cmd" value="add">
                            <input type="hidden" name="id" value="<?=$Id?>">			
                            <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
                         </td>     
                     </tr>
		</table>
	</form>
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



