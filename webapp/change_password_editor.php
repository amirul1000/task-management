<?php
 include("template/header.php");
?>
<div id="dialog-token-points" title="Token points">
     <p>
         <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        <div id="inner_data_token"></div>
    </p>
</div>
<div id="dialog-prizes-points" title="Prizes points">
    <p>
         <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        <div id="inner_data_prizes"></div>
    </p>
</div>	
<div id="spinner"></div>	

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i>Change Password</div>
        <!--<div style="float:right;">
        	<a href="member_archive?cmd=list" class="btn default btn-xs blue">Archive</a>
        </div>-->
        <div class="tools">
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
    </div>
<div class="portlet-body">
	<div class="table-responsive">
	 <table class="table">
			<tr>
				<td width="80%" valign="top">
           
				   <span class="error">
					   <?php
						 if(isset($message))
						 { 
						   echo $message;
						 }
					   ?>
				   </span>
								<form name="frm_users" method="post" enctype="multipart/form-data"
									onSubmit="return checkRequired();">
									<table class="table">
										<tr>
											<td>Email<span>*</span>
											</td>
											<td><input type="email" name="email" id="email"
												value="<?=$_SESSION['email']?>" class="textbox" readonly="readonly" required>
											</td>
										</tr>
										<tr>
											<td>Old Password<span>*</span>
											</td>
											<td><input type="password" name="old_password" id="old_password"
												value="<?=$_REQUEST['old_password']?>" class="textbox" required>
											</td>
										</tr>
										<tr>
											<td>New Password<span>*</span>
											</td>
											<td><input type="password" name="password" id="password"
												value="<?=$_REQUEST['password']?>" class="textbox" required>
											</td>
										</tr>
										<tr>
											<td>
											<input type="hidden" name="cmd" value="change"> 
											<input type="hidden" name="id" value="<?=$Id?>"> 
											<input type="submit" name="btn_submit" id="btn_submit" value="submit"  class="button_blue"> 
										</tr>
									</table>
								</form>
							
				</td>
			</tr>
	</table>                 
</div>
</div>

<?php
include("template/footer.php");
?>

