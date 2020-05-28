<?php
  include("template/header.php");
?>   
    
     <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","users"))?></b>
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
     <a href="users?cmd=list" class="nav3">List</a>
	 <form name="frm_users" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
		 <tr>
						 <td>First Name</td>
						 <td>
						    <input type="text" name="first_name" id="first_name"  value="<?=$first_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Last Name</td>
						 <td>
						    <input type="text" name="last_name" id="last_name"  value="<?=$last_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Email</td>
						 <td>
						    <input type="text" name="email" id="email"  value="<?=$email?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Password</td>
						 <td>
						    <input type="text" name="password" id="password"  value="<?=$password?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Avatar</td>
						 <td>
						    <input type="text" name="avatar" id="avatar"  value="<?=$avatar?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Address</td>
						 <td>
						    <input type="text" name="address" id="address"  value="<?=$address?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Created At</td>
						 <td>
						    <input type="text" name="created_at" id="created_at"  value="<?=$created_at?>" class="textbox">
						 </td>
				     </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumusers = getEnumFieldValues('users','status');
?>
<select  name="status" id="status"   class="textbox">
<?php
   foreach($enumusers as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
		           		 <td>User Type</td>
				   		 <td><?php
	$enumusers = getEnumFieldValues('users','user_type');
?>
<select  name="user_type" id="user_type"   class="textbox">
<?php
   foreach($enumusers as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$user_type){ echo "selected"; }?>><?=$value?></option>
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
