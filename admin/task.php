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
				$info['table']    = "task";
				$data['company_id']   = $_REQUEST['company_id'];
                $data['users_id']   = $_REQUEST['users_id'];
                $data['posted_date_time']   = $_REQUEST['posted_date_time'];
                $data['task_name']   = $_REQUEST['task_name'];
                $data['description']   = $_REQUEST['description'];
                $data['rate']   = $_REQUEST['rate'];
                $data['unit_type']   = $_REQUEST['unit_type'];
				$data['max_units_per_day']   = $_REQUEST['max_units_per_day'];
                $data['approx_completed_no_unit']   = $_REQUEST['approx_completed_no_unit'];
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
				
				include("task_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "task";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$company_id    = $res[0]['company_id'];
					$users_id    = $res[0]['users_id'];
					$posted_date_time    = $res[0]['posted_date_time'];
					$task_name    = $res[0]['task_name'];
					$description    = $res[0]['description'];
					$rate    = $res[0]['rate'];
					$unit_type    = $res[0]['unit_type'];
					$max_units_per_day = $res[0]['max_units_per_day'];
					$approx_completed_no_unit    = $res[0]['approx_completed_no_unit'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("task_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "task";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("task_list.php");						   
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
				include("task_list.php");
				break; 
        case "search_task":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("task_list.php");
				break;  								   
						
	     default :    
		       include("task_list.php");		         
	   }
?>
