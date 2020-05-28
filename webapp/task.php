<?php
       session_start();
       include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	     include("lib.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     //Header("Location: login");
	   }
	   
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
		  		$arr = get_current_plan_info($db,$_SESSION['users_id']);
				$plan_name = $arr['plan'];
				$status = $arr['status'];
				$current_period_start = $arr['current_period_start'];
				$current_period_end = $arr['current_period_end'];
				if($status=='inactive' || $status=='' || empty($status))
				{
				   $plan_name = 'basic'; 
				   ///////////////if no plan exists in stripe set plan date time////////////
					
				    $plan_id  = get_plan_id($db,$plan_name);
				   
				   
				     //check if exits
				  		 unset($info);
						 unset($data);
					$info["table"] = "subscription";
					$info["fields"] = array("subscription.*"); 
					$info["where"]   = "1 AND  users_id ='".$_SESSION['users_id']."' ORDER BY id DESC";
				    $res2 =  $db->select($info);
				   
				    //check if exists with current_period_end
						 unset($info);
						 unset($data);
					$info["table"] = "subscription";
					$info["fields"] = array("subscription.*"); 
					$info["where"]   = "1 AND  users_id ='".$_SESSION['users_id']."'
										   AND current_period_end<'".time()."' ORDER BY id DESC";
					$res3 =  $db->select($info);					
					$current_period_start = $res3[0]['current_period_start'];
					$current_period_end   = $res3[0]['current_period_end'];
					if(count($res2)==0)
					{
						
						$current_period_start   = date("Y-m-d");
						$current_period_end     = date("Y-m-d", strtotime("+1 month", strtotime($current_period_start)));
						
						$current_period_start   = strtotime($current_period_start);
						$current_period_end     = strtotime($current_period_end);
						
						   unset($info);
						   unset($data);
						$info['table']    = "subscription";
						$data['users_id']   = $_SESSION['users_id'];
						$data['plan_id']   = $plan_id;
						$data['current_period_start'] = $current_period_start;
						$data['current_period_end']   = $current_period_end;
						$info['data']     =  $data;
					    $db->insert($info);
					   
					}
					elseif($current_period_end<time())
					{
						$current_period_start   = date("Y-m-d");
						$current_period_end     = date("Y-m-d", strtotime("+1 month", strtotime($current_period_start)));
						
						$current_period_start   = strtotime($current_period_start);
						$current_period_end     = strtotime($current_period_end);

						
						   unset($info);
						   unset($data);
						$info['table']    = "subscription";
						$data['users_id']   = $_SESSION['users_id'];
						$data['plan_id']   = $plan_id;
						$data['current_period_start'] = $current_period_start;
						$data['current_period_end']   = $current_period_end;
						$info['data']     =  $data;
						
					   $info['where']     =  "id='".$res3[0]['id']."'";
					   $db->update($info);
					}	    
				   /////////////////////////////////////////////////////////////////////////	
				}
				
					unset($info);
					unset($data);
				$info["table"] = "plan";
				$info["fields"] = array("plan.*"); 
				$info["where"]   = "1 AND plan_name='".$plan_name."'";
				$arr_data =  $db->select($info);
				
				$no_of_tasks_allow = $arr_data[0]["no_of_tasks_allow"];
				
				$no_of_tasks_allow_created = get_current_no_of_tasks_created($db,$_SESSION['users_id'],$current_period_start,$current_period_end);
				
				if($_REQUEST['perday_type']=="unlimited")
				{
					  unset($info);
			          unset($data);
				    $info['table']    = "task";
				    $data['company_id']   = $_REQUEST['company_id'];
			       $data['users_id']   = $_SESSION['users_id'];
			       $data['posted_date_time']   = date("Y-m-d H:i:s");
			       $data['task_name']   = $_REQUEST['task_name'];
			       $data['description']   = $_REQUEST['description'];
			       $data['rate']   = $_REQUEST['rate'];
			       $data['unit_type']   = $_REQUEST['unit_type'];
				   $data['perday_type']   = $_REQUEST['perday_type'];
				   $data['max_units_per_day']   = '99999999';//$_REQUEST['max_units_per_day'];
			       $data['approx_completed_no_unit']   = $_REQUEST['approx_completed_no_unit'];
			       $data['status']   = 'active';               
					
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
				}
				else if($no_of_tasks_allow_created>$no_of_tasks_allow-1)
				{
				   $message = "You have reached the maximum  no of tasks allow ($no_of_tasks_allow) in the current plan.
									   Please subscribe with us if you stared with basic otherwise change your plan 
									   from My subscription";
				}
				else 
				{
			          unset($info);
			          unset($data);
				    $info['table']    = "task";
				    $data['company_id']   = $_REQUEST['company_id'];
			       $data['users_id']   = $_SESSION['users_id'];
			       $data['posted_date_time']   = date("Y-m-d H:i:s");
			       $data['task_name']   = $_REQUEST['task_name'];
			       $data['description']   = $_REQUEST['description'];
			       $data['rate']   = $_REQUEST['rate'];
			       $data['unit_type']   = $_REQUEST['unit_type'];
				   $data['perday_type']   = $_REQUEST['perday_type'];
				   $data['max_units_per_day']   = $_REQUEST['max_units_per_day'];
			       $data['approx_completed_no_unit']   = $_REQUEST['approx_completed_no_unit'];
			       $data['status']   = 'active';               
					
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
			   }	 		
				include("task_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "task";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id='".$Id."' AND company_id='".$_REQUEST['company_id']."' AND users_id='".$_SESSION['users_id']."'";
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$company_id    = $res[0]['company_id'];
					$users_id    = $res[0]['users_id'];
					$posted_date_time    = $res[0]['posted_date_time'];
					$task_name    = $res[0]['task_name'];
					$description    = $res[0]['description'];
					$rate    = $res[0]['rate'];
					$unit_type    = $res[0]['unit_type'];
					$perday_type  = $res[0]['perday_type']; 
					$max_units_per_day = $res[0]['max_units_per_day'];
					$approx_completed_no_unit    = $res[0]['approx_completed_no_unit'];
					$status    = $res[0]['status'];					
				 }						   
				include("task_editor.php");						  
				break;						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "task";
				$info['where']    = "id='".$Id."' AND company_id='".$_REQUEST['company_id']."' AND users_id='".$_SESSION['users_id']."'";
				
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
