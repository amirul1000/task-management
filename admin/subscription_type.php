<?php
       session_start();
       include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	   if(empty($_SESSION['admin'])) 
	   {
	     Header("Location: login");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "subscription_type";
				$data['subscription_id']   = $_REQUEST['subscription_id'];
                $data['users_id']   = $_REQUEST['users_id'];
                $data['plan_id']   = $_REQUEST['plan_id'];
                $data['plan']   = $_REQUEST['plan'];
				$data['susbcription']   = $_REQUEST['susbcription'];
                $data['customers']   = $_REQUEST['customers'];
                $data['cards']   = $_REQUEST['cards'];
                $data['status']   = $_REQUEST['status'];
				
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
				
				include("subscription_type_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "subscription_type";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$subscription_id    = $res[0]['subscription_id'];
					$users_id    = $res[0]['users_id'];
					$plan_id    = $res[0]['plan_id'];
					$plan    = $res[0]['plan'];
					$susbcription    = $res[0]['susbcription'];
					$customers    = $res[0]['customers'];
					$cards    = $res[0]['cards'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("subscription_type_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "subscription_type";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("subscription_type_list.php");						   
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
				include("subscription_type_list.php");
				break; 
        case "search_subscription_type":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("subscription_type_list.php");
				break;
	     default :    
		       include("subscription_type_list.php");		         
	   }
?>
