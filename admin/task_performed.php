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
				$info['table']    = "task_performed";
				$data['task_id']   = $_REQUEST['task_id'];
                $data['users_id']   = $_REQUEST['users_id'];
                $data['date_time']   = $_REQUEST['date_time'];
                $data['description']   = $_REQUEST['description'];
                $data['no_of_units_completed']   = $_REQUEST['no_of_units_completed'];
                
				
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
				
				include("task_performed_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "task_performed";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$task_id    = $res[0]['task_id'];
					$users_id    = $res[0]['users_id'];
					$date_time    = $res[0]['date_time'];
					$description    = $res[0]['description'];
					$no_of_units_completed    = $res[0]['no_of_units_completed'];
					
				 }
						   
				include("task_performed_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "task_performed";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("task_performed_list.php");						   
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
				include("task_performed_list.php");
				break; 
        case "search_task_performed":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("task_performed_list.php");
				break;  								   
						
	     default :    
		       include("task_performed_list.php");		         
	   }
?>
