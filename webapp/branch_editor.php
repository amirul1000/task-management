<?php
 include("../template/header.php");
 include("tinymce.php");
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

<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i>Branch</div>
        <!--<div style="float:right;">
        	<a href="member_archive?cmd=list" class="btn default btn-xs blue">Archive</a>
        </div>-->
        <div class="tools">
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
    </div>
<div class="portlet-body flip-scroll">
<table class="table table-bordered table-striped table-condensed flip-content">
 <tr>
  <td>  
     <a href="branch.php?cmd=list" class="nav3">List</a>
	 <form name="frm_branch" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
		<table cellspacing="3" cellpadding="3" border="0" align="center" class="bodytext" width="100%">  
             <tr>
                     <td>Head Branch</td>
                     <td><?php
                            $info['table']    = "branch";
                            $info['fields']   = array("*");   	   
                            $info['where']    =  "1=1 ORDER BY id DESC";
                            $resbranch  =  $db->select($info);
                        ?>
                        <select  name="head_branch_id" id="head_branch_id"   class="textbox">
                            <option value="">--Select--</option>
                            <?php
                               foreach($resbranch as $key=>$each)
                               { 
                            ?>
                              <option value="<?=$resbranch[$key]['id']?>" <?php if($resbranch[$key]['id']==$head_branch_id){ echo "selected"; }?>><?=$resbranch[$key]['name']?></option>
                            <?php
                             }
                            ?> 
                        </select>
                        </td>
              </tr>
              <tr>
                 <td>Name</td>
                 <td>
                    <input type="text" name="name" id="name"  value="<?=$name?>" class="textbox">
                 </td>
             </tr>
             <tr>
                 <td valign="top"> Direct Approve access category</td>
                 <td>[PRESS  CNTRL + SELECT OPTION]<br />
                      <?php
                         $arr3  =  explode(",",$direct_approve_access_category); 
                          
                         unset($info);
                        $info["table"] = "category";
                        $info["fields"] = array("category.*"); 
                        $info["where"]   = "1  ORDER BY name ASC";
                        $arr2 =  $db->select($info);
                      ?>
                        <select name="direct_approve_access_category[]" size="5" multiple="multiple"> 
                      <?php	
                        for($j=0;$j<count($arr2);$j++)
                        {   
                            $selected ="";
                            foreach($arr3 as $key=>$value)
                            {
                               if($arr2[$j]['name']==trim($value))
                               {
                                   $selected = 'selected="selected"';
                                   break;
                               }
                            } 
                       ?>
                         <font color="#<?=$arr2[$j]['color_code']?>"><?=$arr2[$j]['name']?></font>
                         <option value="<?=$arr2[$j]['name']?>" <?=$selected?> /><?=$arr2[$j]['name']?></option>
                        <?php
                         }
                        ?> 
                        </select>
                      
                    </td>
            </tr>
            <tr>
                 <td valign="top">Address</td>
                 <td>
                    <textarea name="address" id="address"  class="textbox" style="width:200px;height:100px;"><?=$address?></textarea>
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

<?php
 include("../template/footer.php");
?>

