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
	     
		  case 'change': 
						 $info['table']    = "users";
						 $data['first_name']   = $_REQUEST['first_name'];
						 $data['last_name']   = $_REQUEST['last_name'];					
						 $info['data']     =  $data;
						
					 	 $info['where'] = "id=".$_SESSION['users_id'];
					  	 $db->update($info);
					  	 
					  	 
					  	$info['table']    = "users";
						$info['fields']   = array("*");   	   
						$info['where']    = "id=".$_SESSION['users_id'];					   
						$res  =  $db->select($info);
					   
						$Id        = $res[0]['id'];  
						$first_name   = $res[0]['first_name'];
						$last_name   = $res[0]['last_name'];				   
					
				include("change_profile_editor.php");						   
				break;  
	     default :    
		    
					$info['table']    = "users";
					$info['fields']   = array("*");   	   
					$info['where']    = "id=".$_SESSION['users_id'];
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$first_name   = $res[0]['first_name'];
					$last_name   = $res[0]['last_name'];
				   
				include("change_profile_editor.php");
	   }
?>
