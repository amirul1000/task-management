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
	      case "employee_unregister_company":
						$info['table']    = "company_register";
						$data['register_status']   = 'unregister';
						$info['data']     =  $data;					
						$Id            = $_REQUEST['id'];
						$info['where'] = "id='".$Id."' AND users_id='".$_SESSION['users_id']."'";
						$db->update($info);
						include("employee_unregist_list.php");
				     break; 
		    default:
		           include("employee_unregist_list.php");
			      
		}
?>