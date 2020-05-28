<?php
session_start();
	include("../../config.php");
      error_reporting(0);
      $user_id = $_GET['id'];


      $query      =     "DELETE FROM `users` WHERE id=?";
      $parameters =     array($user_id);
      $statement  =     $db->prepare($query);
      $statement->execute($parameters);
      
      $error['msg'] ="deleted"; 
      echo json_encode($error);





?>
