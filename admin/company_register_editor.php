<?php
  include("template/header.php");
?>   
    
     <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","company_register"))?></b>
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
     <a href="company_register?cmd=list" class="nav3">List</a>
	 <form name="frm_company_register" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		 <tr>
							 <td>Company</td>
							 <td><?php
	$info['table']    = "company";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$rescompany  =  $db->select($info);
?>
<select  name="company_id" id="company_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($rescompany as $key=>$each)
	   { 
	?>
	  <option value="<?=$rescompany[$key]['id']?>" <?php if($rescompany[$key]['id']==$company_id){ echo "selected"; }?>><?=$rescompany[$key]['company_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
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
					  </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumcompany_register = getEnumFieldValues('company_register','status');
?>
<select  name="status" id="status"   class="textbox">
<?php
   foreach($enumcompany_register as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
						 <td>Date Created</td>
						 <td>
						    <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('date_created');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
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
