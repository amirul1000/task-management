<?php
  include("template/header.php");
?>   
    <a href="company?cmd=list" class="btn green">List</a> <br><br>
     <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","company"))?></b>
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
								 <form name="frm_company" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">		
								 <div class="portlet-body">
								      <div class="table-responsive">	
									     <table class="table">
									        <!--
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
															</select>
							                      </td>
												  </tr>
												  -->
							                 <tr>
                                                 <td>Company Name</td>
                                                 <td>
                                                    <input type="text" name="company_name" id="company_name"  value="<?=$company_name?>" class="textbox">
                                                 </td>
                                             </tr>
							                 <tr>
                                                 <td valign="top">Description</td>
                                                 <td>
                                                    <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>allow task insertion in days</td>
                                                 <td>
                                                    <input type="text" name="allow_task_insertion_in_days" id="allow_task_insertion_in_days"  value="<?=$allow_task_insertion_in_days?>" class="textbox">
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>allow task update in days</td>
                                                 <td>
                                                    <input type="text" name="allow_task_update_in_days" id="allow_task_update_in_days"  value="<?=$allow_task_update_in_days?>" class="textbox">
                                                 </td>
                                             </tr>
											    <!--
							                 <tr>
													 <td>No</td>
													 <td>
													    <input type="text" name="no" id="no"  value="<?=$no?>" class="textbox">
													 </td>
											     </tr>											   
							                  <tr>
													 <td>Date Time Created</td>
													 <td>
													    <input type="text" name="date_time_created" id="date_time_created"  value="<?=$date_time_created?>" class="textbox">
														<a href="javascript:void(0);" onclick="displayDatePicker('date_time_created');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
													 </td>
											     </tr>
							                  <tr>
													 <td>Date Time Updated</td>
													 <td>
													    <input type="text" name="date_time_updated" id="date_time_updated"  value="<?=$date_time_updated?>" class="textbox">
														<a href="javascript:void(0);" onclick="displayDatePicker('date_time_updated');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
													 </td>
											     </tr>
											     -->
							                  <tr> 
							                      <td align="right"></td>
							                      <td>
							                         <input type="hidden" name="cmd" value="add">
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
