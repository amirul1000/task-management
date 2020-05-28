<?php
  include("template/header.php");
?>   

     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Register"))?></b>
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
						  <?php
						     if($_POST) 
			              {
                        echo $message;
                       }
						  ?>		
			 	  <form name="frm_task" id="frm_task" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
					<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							  <tr>
							       <td>
							             <b>Enter Company Registration Number</b><br>
							            <input type="text" name="no" id="no" value="<?=$_REQUEST['no']?>"><br>
							            <input type="hidden" name="cmd" id="cmd" value="company_search">
							            <input type="submit" value="Search"> 
							       </td>
							  </tr>							 
							
						   </table>
				     </div>
			 </form>	
			 
			 <form method="post">
			  <?php
			   if($_POST && count($arr1)>0) 
			   {
			  ?>
			  <table class="table table-bordered table-striped table-condensed flip-content">
			  <tr>
			       <td>
			             <input type="checkbox" name="company_id" value="<?php echo $arr1[0]['id']?>" checked="checked"><?php echo $arr1[0]['company_name']?><br>
			             <input type="hidden" name="cmd" id="cmd" value="company_register">
			             <input type="hidden" name="no" id="no" value="<?=$_REQUEST['no']?>">
			             <input type="submit" value="Register">
			       </td>
			  </tr>
			  </table>
			  <?php
			    }
			  ?> 
			 </form>
			 
			 </td>
			 </tr>
			</table>
			</div>
		</div>	
<?php
  include("template/footer.php");
?>					               
