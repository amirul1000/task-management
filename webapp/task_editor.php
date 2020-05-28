<?php
  include("template/header.php");
?>   
    <a href="task?cmd=list&company_id=<?=$_REQUEST['company_id']?>" class="btn green">List</a><br><br>
         
     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Task"))?></b>
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
							 <form name="frm_task" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								<div class="portlet-body">
								<div class="table-responsive">
									<table class="table">
								           <tr>
												 <td>Task Label</td>
												 <td>
												    <input type="text" name="task_name" id="task_name"  value="<?=$task_name?>" class="textbox">
												 </td>
										     </tr>
										     <tr>
												 <td valign="top">Note</td>
												 <td>
												    <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
												 </td>
										     </tr>
										     <tr>
												 <td>Rate</td>
												 <td>
												    <input type="text" name="rate" id="rate"  value="<?=$rate?>" class="textbox">
												 </td>
										     </tr>
										     <tr>
								           		 <td>Unit Type</td>
						                      <td><?php
						                                $enumtask = getEnumFieldValues('task','unit_type');
						                            ?>
						                            <select  name="unit_type" id="unit_type"   class="textbox">
						                            <?php
						                               foreach($enumtask as $key=>$value)
						                               { 
						                            ?>
						                              <option value="<?=$value?>" <?php if($value==$unit_type){ echo "selected"; }?>><?=$value?></option>
						                             <?php
						                              }
						                            ?> 
						                            </select>
						                        </td>
										    </tr>
                                            <tr>
												 <td colspan="2">
                                                   <script language="javascript">
												      function setChecked()
													  {
													   if($("#perday_type_limited").is(':checked')){														   
															$("#max_units_per_day").removeAttr("disabled");
														} 
														else if($("#perday_type_unlimited").is(':checked')){
															$("#max_units_per_day").attr("disabled","disabled");
														}
													  }
													</script>
                                                    <b>Max units per day</b><br>
												    Limited<input type="radio" name="perday_type" id="perday_type_limited"  value="limited" onClick="setChecked();" checked="checked">
                                                    Unlimited<input type="radio" name="perday_type" id="perday_type_unlimited" onClick="setChecked();"  value="unlimited">
												 </td>
										    </tr>
						                    <tr>
												 <td>Max units per day</td>
												 <td>
												    <input type="text" name="max_units_per_day" id="max_units_per_day"  value="<?=$max_units_per_day?>" class="textbox">
												 </td>
										    </tr>               
						                    <tr> 
                                                 <td align="right"></td>
                                                 <td>
                                                    <input type="hidden" name="cmd" value="add">
                                                    <input type="hidden" name="id" value="<?=$Id?>">			
                                                    <input type="hidden" name="company_id" value="<?=$_REQUEST['company_id']?>">		
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

	</div>		
<?php
  include("template/footer.php");
?>					               
