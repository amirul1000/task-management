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
				$info['table']    = "job";
				$data['company_id']   = $_REQUEST['company_id'];
                $data['users_id']   = $_REQUEST['users_id'];
                $data['name']   = $_REQUEST['name'];
                $data['description']   = $_REQUEST['description'];
				$data['rate']   = $_REQUEST['rate'];
                $data['unit']   = $_REQUEST['unit'];
                $data['no']   = $_REQUEST['no'];
                $data['status']   = $_REQUEST['status'];
                $data['date_time_created']   = $_REQUEST['date_time_created'];
                $data['date_time_updated']   = $_REQUEST['date_time_updated'];
                
				
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
				
				include("job_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "job";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$company_id    = $res[0]['company_id'];
					$users_id    = $res[0]['users_id'];
					$name    = $res[0]['name'];
					$description    = $res[0]['description'];
					$rate    = $res[0]['rate'];
					$unit    = $res[0]['unit'];					
					$no    = $res[0]['no'];
					$status    = $res[0]['status'];
					$date_time_created    = $res[0]['date_time_created'];
					$date_time_updated    = $res[0]['date_time_updated'];
					
				 }
						   
				include("job_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "job";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("job_list.php");						   
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
				include("job_list.php");
				break; 
        case "search_job":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("job_list.php");
				break;  								   
						
	     default :    
		       include("job_list.php");		         
	   }
?>
