<?php
  include("template/header.php");
?> 
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","plan"))?></b>
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
     <a href="plan?cmd=list" class="nav3">List</a>
	 <form name="frm_plan" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		 <tr>
						 <td>Plan Name</td>
						 <td>
						    <input type="text" name="plan_name" id="plan_name"  value="<?=$plan_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Price</td>
						 <td>
						    <input type="text" name="price" id="price"  value="<?=$price?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>No Of Company Allow</td>
						 <td>
						    <input type="text" name="no_of_company_allow" id="no_of_company_allow"  value="<?=$no_of_company_allow?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>No Of Tasks Allow</td>
						 <td>
						    <input type="text" name="no_of_tasks_allow" id="no_of_tasks_allow"  value="<?=$no_of_tasks_allow?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>No Of Contractor Report</td>
						 <td>
						    <input type="text" name="no_of_contractor_report" id="no_of_contractor_report"  value="<?=$no_of_contractor_report?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Subscription Duration Days</td>
						 <td>
						    <input type="text" name="subscription_duration_days" id="subscription_duration_days"  value="<?=$subscription_duration_days?>" class="textbox">
						 </td>
				     </tr>
                     <tr>
						 <td>description</td>
						 <td>
						    <textarea name="description" id="description" style="width:400px;height:100px;"><?=$description?></textarea>
						 </td>
				     </tr>
                     <tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumplan = getEnumFieldValues('plan','status');
?>
<select  name="status" id="status"   class="textbox">
<?php
   foreach($enumplan as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
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



