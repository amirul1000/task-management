<?php
  include("template/header.php");
?>   
    
     <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","task_performed"))?></b>
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
     <a href="task_performed?cmd=list" class="nav3">List</a>
	 <form name="frm_task_performed" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
            <tr>
                 <td>Task</td>
                 <td><?php
                        $info['table']    = "task";
                        $info['fields']   = array("*");   	   
                        $info['where']    =  "1=1 ORDER BY id DESC";
                        $restask  =  $db->select($info);
                    ?>
                    <select  name="task_id" id="task_id"   class="textbox">
                        <option value="">--Select--</option>
                        <?php
                           foreach($restask as $key=>$each)
                           { 
                        ?>
                          <option value="<?=$restask[$key]['id']?>" <?php if($restask[$key]['id']==$task_id){ echo "selected"; }?>><?=$restask[$key]['task_name']?></option>
                        <?php
                         }
                        ?> 
                    </select>
                    </td>
            </tr>
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
                              <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['first_name']?> <?=$resusers[$key]['last_name']?></option>
                            <?php
                             }
                            ?> 
                        </select>
                        </td>
            </tr>
            <tr>
             <td>Date Time</td>
             <td>
                <input type="text" name="date_time" id="date_time"  value="<?=$date_time?>" class="textbox">
                <a href="javascript:void(0);" onclick="displayDatePicker('date_time');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
             </td>
            </tr><tr>
             <td valign="top">Description</td>
             <td>
                <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
             </td>
            </tr><tr>
             <td>No of units completed</td>
             <td>
                <input type="text" name="no_of_units_completed" id="no_of_units_completed"  value="<?=$no_of_units_completed?>" class="textbox">
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


