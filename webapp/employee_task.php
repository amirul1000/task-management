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
		  default:
		      include("employee_task_list.php");	
		
      }
?>