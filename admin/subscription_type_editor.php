<?php
  include("template/header.php");
?> 
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","subscription_type"))?></b>
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
     <a href="subscription_type?cmd=list" class="nav3">List</a>
	 <form name="frm_subscription_type" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		            <tr>
							 <td>Subscription</td>
							 <td><?php
									$info['table']    = "subscription";
									$info['fields']   = array("*");   	   
									$info['where']    =  "1=1 ORDER BY id DESC";
									$ressubscription  =  $db->select($info);
								?>
								<select  name="subscription_id" id="subscription_id"   class="textbox">
									<option value="">--Select--</option>
									<?php
									   foreach($ressubscription as $key=>$each)
									   { 
									?>
									  <option value="<?=$ressubscription[$key]['id']?>" <?php if($ressubscription[$key]['id']==$subscription_id){ echo "selected"; }?>><?=$ressubscription[$key]['start_date']?></option>
									<?php
									 }
									?> 
								</select>
                                </td>
					  </tr>
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
								  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['first_name']?></option>
								<?php
								 }
								?> 
							</select></td>
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
						 <td>Plan</td>
						 <td>
						    <input type="text" name="plan" id="plan"  value="<?=$plan?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Susbcription</td>
						 <td>
						    <input type="text" name="susbcription" id="susbcription"  value="<?=$susbcription?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Customers</td>
						 <td>
						    <input type="text" name="customers" id="customers"  value="<?=$customers?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>Cards</td>
						 <td>
						    <input type="text" name="cards" id="cards"  value="<?=$cards?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
		           		 <td>Status</td>
				   		 <td><?php
								$enumsubscription_type = getEnumFieldValues('subscription_type','status');
							?>
							<select  name="status" id="status"   class="textbox">
							<?php
							   foreach($enumsubscription_type as $key=>$value)
							   { 
							?>
							  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
							 <?php
							  }
							?> 
							</select>
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


