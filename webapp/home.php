<?php
    session_start();
   include("../common/lib.php");
   include("../lib/class.db.php");
   include("../common/config.php");
   
   if(empty($_SESSION["users_id"]))
   {
       Header("Location: login");
   }
   
   $cmd = $_REQUEST['cmd'];
   
   switch($cmd)
   {
	  case "duration":
	         $_SESSION['this_duration'] = $_REQUEST['this_duration'];
	         Header('Location: home');
	       break;
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
					 
				 $info['table']    = "task_performed";
				 $data['task_id']   = $_REQUEST['task_id'];
				 //$data['users_id']   = $_SESSION['users_id'];
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
				Header('Location: home');			   
				break; 	    
      default:
	       include("home_view.php");
			
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
   
   /*   function get_posted_date_time($db)
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
		 //$_SESSION['insertion_days'] = $insertion_days;
		  
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
		// $_SESSION['update_days'] = $update_days;
		 
		 
		 $posted = strtotime($posted_date_time)+60*60*24*$update_days;
		 
		 if($now>$posted)
		 {
		   return false;	 
		 }
		 
		 return true;
   }*/
?>