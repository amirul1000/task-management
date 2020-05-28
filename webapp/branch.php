<?php
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   include("../../common_lib/lib.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/login.php");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "branch";
				$data['head_branch_id']   = $_REQUEST['head_branch_id'];
                $data['name']   = $_REQUEST['name'];
				if(isset($_REQUEST['direct_approve_access_category']))
				{
				 foreach($_REQUEST['direct_approve_access_category'] as $eachvalue)
				 {
				   $arr_value[]  = $eachvalue; 
				 }
				  $data['direct_approve_access_category']   = implode(", ",$arr_value);
				}
                $data['address']   = $_REQUEST['address'];
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					
					$db->update($info);
				}
				
				include("../branch/branch_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "branch";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id                         = $res[0]['id'];  
					$head_branch_id             = $res[0]['head_branch_id'];
					$name                       = $res[0]['name'];
					$direct_approve_access_category    = $res[0]['direct_approve_access_category'];
					$address                    = $res[0]['address'];
					
				 }
						   
				include("../branch/branch_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "branch";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("../branch/branch_list.php");						   
				break; 
		case "select_branch":
			   $_SESSION['selected_branch_id'] = $_REQUEST['selected_branch_id'];
			   include("../branch/branch_list.php");					   
			   break; 				   
         case "list" :    	 
			  if(!empty($_REQUEST['page'])&&$_SESSION["search"]=="yes")
				{
				  $_SESSION["search"]="yes";
				}
				else
				{
				   $_SESSION["search"]="no";
					unset($_SESSION["search"]);
					unset($_SESSION['field_name']);
					unset($_SESSION["field_value"]); 
				}
				include("../branch/branch_list.php");
				break; 
        case "search_branch":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("../branch/branch_list.php");
				break;  								   
						
	     default :    
		       include("../branch/branch_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "branch";
	   $info['fields']   = array("max(id) as maxid");   	   
	   $info['where']    =  "1=1";
	  
	   $resmax  =  $db->select($info);
	   if(count($resmax)>0)
	   {
		 $max = $resmax[0]['maxid']+1;
	   }
	   else
	   {
		$max=0;
	   }	  
	   return $max;
 } 	 
?>
