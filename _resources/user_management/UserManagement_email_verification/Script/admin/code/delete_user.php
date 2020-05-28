<?php
session_start();
	include("../../config.php");
      error_reporting(0);

      // get userid from url to be deleted 
      $user_id = $_GET['id'];

      // Check session of admin.If sesssion is not set die it.
      if(!isset($_SESSION['admin']))
  		{
         	$output['error']  = 'error';
         	$output['msg'] = "Session is destroyed";
         	die(json_encode($output));
  		}

      // Delete from database
      $query      =     "DELETE FROM `users` WHERE id=?";
      $parameters =     array($user_id);
      $statement  =     $db->prepare($query);
      $statement->execute($parameters);
      
      $error['msg'] ="deleted";

      // output the message in json format
      echo json_encode($error);





?>
