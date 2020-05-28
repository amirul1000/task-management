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
				     if(empty($_REQUEST['id']))
					 {
					   $days = get_insertion_days($db);
					 }
					 else
					 {
					   $days = get_update_days($db);
					 }
					 if(strtotime(date("Y-m-d H:i:s"))-strtotime($_REQUEST['date_time'])>60*60*24*$days)
					 {
						  $message = " Date of task is not allowed, please contact system admin";
						  $_SESSION['message'] = $message;  	  	
						  Header("Location:home");						   
						  break;    
					 }
				 
				   $max_units_per_day     = allowed_max_units_per_day($db);   
				   $total_unit_performed  = total_task_perfomed($db);
				   
				   $remaining = $max_units_per_day - $total_unit_performed; 
				  
				  if(get_perday_type($db)=="unlimited")
				  {
					 $info['table']    = "task_performed";
					 $data['task_id']   = $_REQUEST['task_id'];
					 $data['users_id']   = $_SESSION['users_id'];
					 $data['date_time']   = $_REQUEST['date_time'];
					 $data['description']   = $_REQUEST['description'];
					 $data['no_of_units_completed']   = $_REQUEST['no_of_units_completed'];
					
					 $info['data']     =  $data;
					
					if(empty($_REQUEST['id']))
					{
						
						  $db->insert($info);
						  $message = "Insertion has been completed successfully"; 
						  $_SESSION['message'] = $message;  	 
						
					}
					else
					{
						
							$Id            = $_REQUEST['id'];
							$info['where'] = "id=".$Id;
							$db->update($info);
							
							 $message = "Update has been completed successfully"; 
							$_SESSION['message'] = $message;  	  	
					
					}	 
				  }			
				  else if($_REQUEST['no_of_units_completed']>$remaining) 
				  {
					$message = " Max unit per day allowed is $max_units_per_day & at ".$_REQUEST['date_time']." total unit performed is $total_unit_performed  & remaining is  $remaining";               
					$_SESSION['message'] = $message; 
					Header("Location:home");	
					break;	
				  }
				  else
				  {
					 $info['table']    = "task_performed";
					 $data['task_id']   = $_REQUEST['task_id'];
					 $data['users_id']   = $_SESSION['users_id'];
					 $data['date_time']   = $_REQUEST['date_time'];
					 $data['description']   = $_REQUEST['description'];
					 $data['no_of_units_completed']   = $_REQUEST['no_of_units_completed'];
					
					 $info['data']     =  $data;
					
					if(empty($_REQUEST['id']))
					{
						
							
						  $db->insert($info);
						  $message = "Insertion has been completed successfully"; 
						  $_SESSION['message'] = $message;  	 
						
					}
					else
					{
						
							$Id            = $_REQUEST['id'];
							$info['where'] = "id=".$Id;
							$db->update($info);
							
							 $message = "Update has been completed successfully"; 
							$_SESSION['message'] = $message;  	  	
						
					}	 
				  }
              
				
				Header("Location:home");						   
				break;    
		case "edit":      
		        if(in_5_days()==false)
				{
				  $message = " 5 days over You can not edit";  
				  $_SESSION['message'] = $message; 	
				  Header("Location:home");			
				}
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "task_performed";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id='".$Id."' AND task_id='".$_REQUEST['task_id']."' AND users_id='".$_SESSION['users_id']."'"; 
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$task_id    = $res[0]['task_id'];
					$users_id    = $res[0]['users_id'];
					$date_time    = $res[0]['date_time'];
					$description    = $res[0]['description'];
					$no_of_units_completed    = $res[0]['no_of_units_completed'];
					
				 }
						   
				include("employee_task_performed_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "task_performed";
				$info['where']    = "id='$Id' AND task_id='".$_REQUEST['task_id']."' AND users_id='".$_SESSION['users_id']."'"; 
				
				if($Id)
				{
					$db->delete($info);
				}
				include("employee_task_performed_list.php");						   
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
				include("employee_task_performed_list.php");
				break; 
        case "search_task_performed":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("employee_task_performed_list.php");
				break;  								   
						
	     default :    
		       include("employee_task_performed_list.php");		         
	   }
	   
	   
   function total_task_perfomed($db)	
   {
      $whrstr .=" AND task_id='".$_REQUEST['task_id']."' AND date_time='".$_REQUEST['date_time']."'"; 		 
		$info["table"] = "task_performed";
		$info["fields"] = array("sum(no_of_units_completed) as no_of_units_completed"); 
		$info["where"]   = "1   $whrstr ";
		$arr =  $db->select($info);       
				
		return $arr[0]['no_of_units_completed'];    
   }   
   
   function allowed_max_units_per_day($db)
   {
	   	unset($info);
		  unset($data);
		$info["table"] = "task";
		$info["fields"] = array("task.*"); 
		$info["where"]   = "1  AND id='".$_REQUEST['task_id']."'";
		$arr =  $db->select($info);
   	
   	return $arr[0]['max_units_per_day'];
   }
   function get_perday_type($db)
   {
	      unset($info);
		  unset($data);
		$info["table"] = "task";
		$info["fields"] = array("task.*"); 
		$info["where"]   = "1  AND id='".$_REQUEST['task_id']."'";
		$arr =  $db->select($info);
   	
   	return $arr[0]['perday_type'];
   }	
   
function  get_insertion_days($db)
  {
	      unset($info);
		  unset($data);
		$info["table"] = "task";
		$info["fields"] = array("task.*"); 
		$info["where"]   = "1  AND id='".$_REQUEST['task_id']."'";
		$arr =  $db->select($info);
		
		$company_id =  $arr[0]['company_id']; 
		
		  unset($info);
		  unset($data);
		$info["table"] = "company";
		$info["fields"] = array("company.*"); 
		$info["where"]   = "1   AND id='".$company_id."'";											

		$arr =  $db->select($info);
		if($arr[0]['allow_task_insertion_in_days']==0)
		{
			return 999999;
		}
	
		return $arr[0]['allow_task_insertion_in_days']; 
		
  }
  
  function  get_update_days($db)
  {
	  
	    unset($info);
		  unset($data);
		$info["table"] = "task";
		$info["fields"] = array("task.*"); 
		$info["where"]   = "1  AND id='".$_REQUEST['task_id']."'";
		$arr =  $db->select($info);
		
		$company_id =  $arr[0]['company_id']; 
		
		  unset($info);
		  unset($data);
		$info["table"] = "company";
		$info["fields"] = array("company.*"); 
		$info["where"]   = "1   AND id='".$company_id."'";											

		$arr =  $db->select($info);
		
		if($arr[0]['allow_task_update_in_days']==0)
		{
			return 999999;
		}
		
		return $arr[0]['allow_task_update_in_days']; 
	  
	  
  }
/*   
function get_posted_date_time($db)
   {
	      unset($info);
		  unset($data);
		$info["table"] = "task";
		$info["fields"] = array("task.*"); 
		$info["where"]   = "1  AND id='".$_REQUEST['task_id']."'";
		$arr =  $db->select($info);
   	 
   	    return $arr[0]['posted_date_time'];
   }	   	   
   
   function in_2_days($db)
   {
		 $posted_date_time = get_posted_date_time($db);  
		 $now              = strtotime(date("Y-m-d H:i:s"));
		 $insertion_days = get_insertion_days($db);
		 $_SESSION['insertion_days'] = $insertion_days;
		 
		 $posted = strtotime($posted_date_time)+60*60*24*$insertion_days;
		 
		 if($now>$posted)
		 {
		   return false;	 
		 }
		 
		 return true;
   }
   
   function in_5_days($db)
   {
		 $posted_date_time = get_posted_date_time($db);  
		 $now              = strtotime(date("Y-m-d H:i:s"));
	     
		 $update_days =  get_update_days($db);
		 $_SESSION['update_days'] = $update_days;
		  
		 $posted = strtotime($posted_date_time)+60*60*24*$update_days;
		 
		 if($now>$posted)
		 {
		   return false;	 
		 }
		 
		 return true;
   }*/
?>