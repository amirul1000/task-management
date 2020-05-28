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
				$info['table']    = "plan";
				$data['plan_name']   = $_REQUEST['plan_name'];
                $data['price']   = $_REQUEST['price'];
                $data['no_of_company_allow']   = $_REQUEST['no_of_company_allow'];
                $data['no_of_tasks_allow']   = $_REQUEST['no_of_tasks_allow'];
                $data['no_of_contractor_report']   = $_REQUEST['no_of_contractor_report'];
                $data['subscription_duration_days']   = $_REQUEST['subscription_duration_days'];
				$data['description']   = $_REQUEST['description'];
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
				
				include("plan_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "plan";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$plan_name    = $res[0]['plan_name'];
					$price    = $res[0]['price'];
					$no_of_company_allow    = $res[0]['no_of_company_allow'];
					$no_of_tasks_allow    = $res[0]['no_of_tasks_allow'];
					$no_of_contractor_report    = $res[0]['no_of_contractor_report'];
					$subscription_duration_days    = $res[0]['subscription_duration_days'];
					$description    = $res[0]['description'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("plan_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "plan";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("plan_list.php");						   
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
				include("plan_list.php");
				break; 
        case "search_plan":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("plan_list.php");
				break;  								   
						
	     default :    
		       include("plan_list.php");		         
	   }
?>
