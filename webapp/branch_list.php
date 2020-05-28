<?php
 include("../template/header.php");
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
			<td align="center" valign="top">
			  <form name="search_frm" id="search_frm" method="post">
				<table width="60%" border="0"  cellpadding="3" cellspacing="3" class="bodytext">
				  <TR>
					<TD  nowrap="nowrap">
					  <?php
						  $hash    =  getTableFieldsName("branch");
						  $hash    = array_diff($hash,array("id","head_branch_id"));
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
					  <input type="hidden" name="cmd" id="cmd" value="search_branch" >
					  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
					</td>
				  </TR>
				</table>
			  </form>
			</td>
   </tr>
   <tr>
   <td> 
		<a href="branch.php?cmd=edit" class="nav3">Add a branch</a>
           <script language="javascript">
        function set_data_status()
        {
            document.forms["form_data_type"].submit();
        }
        </script>
        <form name="form_data_type"   id="form_data_type"> 
            <select class="form-control" name="selected_branch_id" onchange="set_data_status(this.value);">
                <option value="all">All</option>
				 <?php
				   //non super
				   if($_SESSION["roles"]['super']!='super')
				   {
                    $arr_branch = explode(",",$_SESSION["in_branch_id_list"]);
                    foreach($arr_branch as $key=>$value)
                    {
                       $branch_arr  = branch_info($db,$value);
                       $branch_name = $branch_arr[0]['name'];
                 ?> 
                  <option value="<?=$value?>" <?php if($_SESSION['selected_branch_id'] == $value){echo "selected";}?>><?=$branch_name?></option>
                 <?php
                    }
				  }
                 ?> 
                 
                 <?php
				 //super can see all  branch
				 if($_SESSION["roles"]['super']=='super')
				 {
						unset($info);
						unset($data);  
				$info['table']    = "branch";
				$info['fields']   = array("*");   	   
				$info['where']    =  "1=1 ORDER BY name ASC";
				$resbranch  =  $db->select($info);
			
				   foreach($resbranch as $key=>$each)
				   { 
				?>
				  <option value="<?=$resbranch[$key]['id']?>" <?php if($resbranch[$key]['id']==$_SESSION['selected_branch_id']){ echo "selected"; }?>><?=$resbranch[$key]['name']?></option>
				<?php
				   }
				 } 
				?>
           </select>
           <input type="hidden" name="cmd"  od="cmd" value="select_branch" />
         </form> 
		<table class="table table-bordered table-striped table-condensed flip-content">
			<tr bgcolor="#ABCAE0">
			  <th>Head Branch </th>
			  <th>Name</th>
               <th>Direct Approve access category</th>	
			  <th>Address</th>
			  <th>Action</th>
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
				  
			   if($_SESSION["roles"]['super']!='super')
				 {
					  if($_SESSION['selected_branch_id']=="all")
					  {
						 $whrstr .= " AND id in(".$_SESSION["in_branch_id_list"].")";
					  } 
					  else
					  {
						$whrstr .= " AND id in(".$_SESSION['selected_branch_id'].")";
					  }
				 } 	  
				 else if($_SESSION["roles"]['super']=='super')
				 {
					  if($_SESSION['selected_branch_id']=="all")
					  {
						 //$whrstr .= " AND branch_id in(".$_SESSION["in_branch_id_list"].")";
					  } 
					  else
					  {
						$whrstr .= " AND id in(".$_SESSION['selected_branch_id'].")";
					  }
				 }		 		  
		 
				$rowsPerPage = 50;
				$pageNum = 1;
				if(isset($_REQUEST['page']))
				{
					$pageNum = $_REQUEST['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;  
		 
		 
							  
				$info["table"] = "branch";
				$info["fields"] = array("branch.*"); 
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
						
						$row="#D6D6D6";
					}
				
		 ?>
           <!-- <?php
			  if($_SESSION['selected_branch_id']=="all")
			  {
			    if(count($arr)>0)
				 {
					 if($i==0)
					 {
					 	$branch_name = $arr[$i]['name'];
						$first_used = true; 
					 }
					 if($branch_name !=$arr[$i]['name'])
					 {
					   $branch_name = $arr[$i]['name'];
					   $first_used = true;
					 }
					 if($first_used == true)
					 {
			 ?>
                <tr>
                    <td colspan="8">
                       <b><?=$branch_name?></b>
                    </td>
                </tr> 
             <?php 
			        $first_used = false;
			        }
			    
			    }	 
			  }
			 ?>   -->
			<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
			  <td>
				<?php
                    unset($info2);        
                    $info2['table']    = "branch";	
                    $info2['fields']   = array("name");	   	   
                    $info2['where']    =  "1 AND id='".$arr[$i]['head_branch_id']."' LIMIT 0,1";
                    $res2  =  $db->select($info2);
                    echo $res2[0]['name'];	
                ?>
              </td>
			  <td><?=$arr[$i]['name']?></td>
              <td><?=$arr[$i]['direct_approve_access_category']?></td>
			  <td><?=$arr[$i]['address']?></td>			  
			  <td nowrap>
				  <a href="branch.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i>Edit</a> 
				  <a href="branch.php?cmd=delete&id=<?=$arr[$i]['id']?>"  class="btn default btn-xs black"  onClick=" return confirm('Are you sure to delete this item ?');"><i class="fa fa-trash-o"></i>Delete</a> 
              </td>
		
			</tr>
		<?php
				  }
		?>
		
		<tr>
		   <td colspan="10" align="center">
			  <?php              
						unset($info);
						
						$info["table"] = "branch";
						$info["fields"] = array("*"); 
						$info["where"]   = "1  $whrstr ORDER BY id DESC";
						
						$res  = $db->select($info);  
						
						
						$numrows = count($res);
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'branch.php?cmd=list';
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
    </td>
    </tr>
    </table>

</td>
</tr>
</table>
</div>
</div>

<?php
include("../template/footer.php");
?>









