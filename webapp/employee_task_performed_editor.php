<?php
  include("template/header.php");
?>   

<link rel="stylesheet" href="<?=$assets_url?>/datepicker/jquery-ui.css">
<script src="<?=$assets_url?>/datepicker/jquery-1.10.2.js"></script>
<script src="<?=$assets_url?>/datepicker/jquery-ui.js"></script>

<!--
<link rel="stylesheet" href="datepicker/jquery-ui.css">
<script src="datepicker/jquery-1.10.2.js"></script>
<script src="datepicker/jquery-ui.js"></script>
-->
   <a href="employee_task_performed?cmd=list&task_id=<?=$_REQUEST['task_id']?>" class="btn green">List</a> <br><br>
     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","task_performed"))?></b>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
             
				 <div class="portlet-body">
					      <div class="table-responsive">	
						     <table class="table">
				 <tr>
				  <td>  
				
					 <form name="frm_task_performed" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
						 <div class="portlet-body">
					      <div class="table-responsive">	
						     <table class="table">
				            <tr>
				             <td>Date</td>
				             <td>
				                <input type="text" name="date_time" id="date_time"  value="<?php if(empty($date_time)){echo date("Y-m-d");} else{ echo $date_time;} ?>" class="datepicker">
				             </td>
				            </tr><tr>
				             <td valign="top">Description</td>
				             <td>
				                <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
				             </td>
				            </tr><tr>
				             <td>No of units <br> completed</td>
				             <td>
				                <input type="number" name="no_of_units_completed" id="no_of_units_completed"  value="<?=$no_of_units_completed?>" class="textbox">
				             </td>
				            </tr>
				            <tr> 
				             <td align="right"></td>
				             <td>
				                <input type="hidden" name="cmd" value="add">
				                <input type="hidden" name="id" value="<?=$Id?>">	
				                <input type="hidden" name="task_id" value="<?=$_REQUEST['task_id']?>">			
				                <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
				             </td>     
				            </tr>
						</table>
						</div>
					</form>
				  </td>
				 </tr>
				</table>
			</div>
			</div>
			</div>
	</div>


   
	<script>
		$( ".datepicker" ).datepicker({
			dateFormat: "yy-mm-dd", 
			changeYear: true,
			changeMonth: true,
			showOn: 'button',
			buttonText: 'Show Date',
			buttonImageOnly: true,
			buttonImage: 'images/calendar.gif',
		});
	</script>

<?php
  include("template/footer.php");
?>					               

