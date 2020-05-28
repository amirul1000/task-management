<?php
       session_start();
       include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: login");
	   }
	   
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
			    $info['table']    = "company";
			    $data['users_id']   = $_SESSION['users_id'];
	          $data['company_name']   = $_REQUEST['company_name'];
	          $data['description']   = $_REQUEST['description'];
			  $data['allow_task_insertion_in_days']   = $_REQUEST['allow_task_insertion_in_days'];
			  $data['allow_task_update_in_days']   = $_REQUEST['allow_task_update_in_days'];
	          //$data['no']   = $_REQUEST['no'];
	          if(empty($_REQUEST['id'])){
	        		  $data['date_time_created']   = date("Y-m-d H:i:s");
	          }
	          else {
	       		  $data['date_time_updated']   = date("Y-m-d H:i:s");
	          }
				$info['data']     =  $data;
				
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
					 
					 $id = mysql_insert_id();
					 if($id>0)
					 {
							unset($info);
							unset($data);
						$info['table']    = "company";
						$data['no']   = $id;
						$info['data']     =  $data;
						$info['where']     = "id='".$id."'";
						$db->update($info);
					
						$message = "Company has been created successfully";	  	
				 	 }
					 else
					 {
					  $message = "Insertion fail";	  	
					 }
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					
					$db->update($info);
				}
				
				include("company_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "company";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id='".$Id."' AND users_id='".$_SESSION['users_id']."'";
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$company_name    = $res[0]['company_name'];
					$description    = $res[0]['description'];
					$allow_task_insertion_in_days   = $res[0]['allow_task_insertion_in_days'];
			        $allow_task_update_in_days   = $res[0]['allow_task_update_in_days'];
					$no    = $res[0]['no'];
					$date_time_created    = $res[0]['date_time_created'];
					$date_time_updated    = $res[0]['date_time_updated'];
					
				 }
						   
				include("company_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "company";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("company_list.php");						   
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
				include("company_list.php");
				break; 
        case "search_company":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("company_list.php");
				break;  								   
						
	     default :    
		       include("company_list.php");		         
	   }
?>
