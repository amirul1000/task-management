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
	   	
	     case "company_search":
			    $no = trim($_REQUEST["no"]);
			     unset($info);
				  unset($data);
				$info["table"] = "company";
				$info["fields"] = array("company.*"); 
				$info["where"]   = "1  AND no='".$no."' ORDER BY company_name ASC ";
				$arr1 =  $db->select($info);
				if(count($arr1)==0)
				  {				  
					$message = "Company with this no is not available";
				  }
				  include("employee_register_editor.php");
			    break;
			case "company_register":			      
					unset($info);
					unset($data);
			      $info["table"] = "company_register";
				  $info["fields"] = array("company_register.*"); 
				  $info["where"]   = "1  AND company_id='".$_REQUEST['company_id']."'
				                         AND users_id='".$_SESSION['users_id']."'";
				  $arr =  $db->select($info);
				   
						unset($info);
						unset($data);
					$info['table']    = "company_register";
					$data['company_id']   = $_REQUEST['company_id'];
					$data['users_id']   = $_SESSION['users_id'];
					$data['status']   = 'accept';
					$data['register_status'] = 'register';
					$data['date_created']   = date("Y-m-d");
					$info['data']     =  $data;  
				  if(count($arr)==0)
				  {    
						$db->insert($info);
						
						$id = mysql_insert_id();
						if($id>0)
						{
							$message = "Registration with the company has been completed successfully";	  	
						}
				  }
				  else
				  {
					$info['where'] = "id='".$arr[0]['id']."'";  
					$db->update($info);  
					  
				    $message = "Registration with the company has been completed successfully";	  	  	
				  }
				  include("employee_register_editor.php");
			     break;
		    default:
		           include("employee_register_editor.php");
			      
		}
?>