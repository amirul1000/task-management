<?php
  include("template/header.php");
?>   
    
     <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Task"))?></b>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
             
            <div class="portlet-body"> 
                <table class="table table-striped table-bordered table-hover" id="sample_1">
   <tr>
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="60%" border="0"  cellpadding="0" cellspacing="0" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap">
					  <?php
						  $hash    =  getTableFieldsName("task");
						  $hash    = array_diff($hash,array("id"));
					  ?>
					  Search Key:
					  <select   name="field_name" id="field_name"  class="textbox">
						<option value="">--Select--</option>
						<?php
						foreach($hash as $key=>$value)
						{
					    ?>
						<option value="<?=$key?>" <?php if($_SESSION['field_name']==$key) echo "selected"; ?>><?=str_replace("_"," ",$value)?></option>
						<?php
					    }
					  ?>
					  </select>
					</TD>
					<TD  nowrap="nowrap" align="right"><label for="searchbar"><img src="../images/icon_searchbox.png" alt="Search"></label>
					   <input type="text"    name="field_value" id="field_value" value="<?=$_SESSION["field_value"]?>" class="textbox"></TD>
					<td nowrap="nowrap" align="right">
					  <input type="hidden" name="cmd" id="cmd" value="search_task" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<a href="task?cmd=edit" class="nav3">Add a task</a>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<tr bgcolor="#ABCAE0">
			  <td>Company </td>
			  <td>Users </td>
			  <td>Posted Date Time</td>
			  <td>Task Name</td>
			  <td>Description</td>
			  <td>Rate</td>
			  <td>Unit Type</td>
              <td>Max units per day</td>
			  <td>Approx Completed No Unit</td>
			  <td>Status</td>
			  <td>Action</td>
			</tr>
		 <?php
				
				if($_SESSION["search"]=="yes")
				  {
					$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
				  }
				  else
				  {
					$whrstr = "";
				  }
		 
				$rowsPerPage = 100;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "task";
				$info["fields"] = array("task.*"); 
				$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
									
				
				$arr =  $db->select($info);
				
				for($i=0;$i<count($arr);$i++)
				{
				
				   $rowColor;
		
					if($i % 2 == 0)
					{
						
						$row="#C8C8C8";
					}
					else
					{
						
						$row="#FFFFFF";
					}
				
		 ?>
			<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
			  <td>
					<?php
                        unset($info2);        
                        $info2['table']    = "company";	
                        $info2['fields']   = array("*");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['company_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['company_name'];	
                    ?>
               </td>
			  <td>
					<?php
                        unset($info2);        
                        $info2['table']    = "users";	
                        $info2['fields']   = array("*");	   	   
                        $info2['where']    =  "1 AND id='".$arr[$i]['users_id']."' LIMIT 0,1";
                        $res2  =  $db->select($info2);
                        echo $res2[0]['first_name'].' '.$res2[0]['last_name'];	
                    ?>
               </td>
			  <td><?=$arr[$i]['posted_date_time']?></td>
			  <td><?=$arr[$i]['task_name']?></td>
			  <td><?=$arr[$i]['description']?></td>
			  <td><?=$arr[$i]['rate']?></td>
			  <td><?=$arr[$i]['unit_type']?></td>
              <td><?=$arr[$i]['max_units_per_day']?></td>
			  <td><?=$arr[$i]['approx_completed_no_unit']?></td>
			  <td><?=$arr[$i]['status']?></td>
			  
			  <td nowrap >
                  <a href="task?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
                  <a href="task?cmd=delete&id=<?=$arr[$i]['id']?>" class="btn btn-sm red filter-cancel"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-times"></i>Delete</a> 
			 </td>
		
			</tr>
		<?php
				  }
		?>
		
		<tr>
		   <td colspan="10" align="center">
              <style>          
				 #navlist li
					{
						float:left;
						display: inline;
						list-style-type: none;
						padding-right: 20px;
					}
				</style>
			  <?php              
					  unset($info);
	
					  $info["table"] = "task";
					  $info["fields"] = array("count(*) as total_rows"); 
					  $info["where"]   = "1  $whrstr ORDER BY id DESC";
					  
					  $res  = $db->select($info);  
	
	
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'task?cmd=list';
						$nav  = '';
						
						$start    = ceil($pageNum/5)*5-5+1;
						$end      = ceil($pageNum/5)*5;
						
						if($maxPage<$end)
						{
						  $end  = $maxPage;
						}
						
						for($page = $start; $page <= $end; $page++)
						//for($page = 1; $page <= $maxPage; $page++)
						{
							if ($page == $pageNum)
							{
								$nav .= "<li>$page</li>"; 
							}
							else
							{
								$nav .= "<li><a href=\"$self&&page=$page\" class=\"nav\">$page</a></li>";
							} 
						}
						if ($pageNum > 1)
						{
							$page  = $pageNum - 1;
							$prev  = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a></li>";
					
						   $first = "<li><a href=\"$self&&page=1\" class=\"nav\">[First Page]</a></li>";
						} 
						else
						{
							$prev  = '<li>&nbsp;</li>'; 
							$first = '<li>&nbsp;</li>'; 
						}
					
						if ($pageNum < $maxPage)
						{
							$page = $pageNum + 1;
							$next = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Next]</a></li>";
					
							$last = "<li><a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a></li>";
						} 
						else
						{
							$next = '<li>&nbsp;</li>'; 
							$last = '<li>&nbsp;</li>'; 
						}
						
						if($numrows>1)
						{
						  echo '<ul id="navlist">';
						   echo $first . $prev . $nav . $next . $last;
						  echo '</ul>';
						}
					?>     
		   </td>
		</tr>
		</table>

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


