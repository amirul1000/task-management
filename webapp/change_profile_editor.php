<?php
  include("template/header.php");
?>   
    
     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Profile"))?></b>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
             
            <div class="portlet-body"> 
                <div class="portlet-body">
	<div class="table-responsive">
	 <table class="table">
 <tr>
  <td>  
	 <form name="frm_company" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<div class="portlet-body">
	      <div class="table-responsive">
	         <table class="table">
		 			 <tr>
						 <td>First Name</td>
						 <td>
						    <input type="text" name="first_name" id="first_name"  value="<?=$first_name?>" class="textbox">
						 </td>
				     </tr>
                 <tr>
						 <td valign="top">Last Name</td>
						 <td>
						     <input type="text" name="last_name" id="last_name"  value="<?=$last_name?>" class="textbox">
						 </td>
				     </tr>                     
	              <tr> 
	                   <td align="right"></td>
	                   <td>
	                      <input type="hidden" name="cmd" value="change">
	                      <input type="hidden" name="id" value="<?=$Id?>">			
	                      <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
	                   </td>     
	              </tr>
		 </table>
		</div>
		</div>
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
