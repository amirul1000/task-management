<?php
  include("template/header.php");
?>   
    
     <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","payment_key"))?></b>
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
     <a href="payment_key?cmd=list" class="nav3">List</a>
	 <form name="frm_payment_key" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table class="table table-striped table-bordered table-hover" id="sample_1">
		 <tr>
						 <td>Secret Key</td>
						 <td>
						    <input type="text" name="secret_key" id="secret_key"  value="<?=$secret_key?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Publishable Key</td>
						 <td>
						    <input type="text" name="publishable_key" id="publishable_key"  value="<?=$publishable_key?>" class="textbox">
						 </td>
				     </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumpayment_key = getEnumFieldValues('payment_key','status');
?>
<select  name="status" id="status"   class="textbox">
<?php
   foreach($enumpayment_key as $key=>$value)
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


