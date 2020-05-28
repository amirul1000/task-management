<?php
session_start();
  include("../../config.php");

  $name = $_GET['name'];
  $email  = $_GET['email'];
  
  // SELECT MATCH FROM THE DATABASE
  if($name == '' || $email =='')
      {        
        $output['error']  = 'error';
        $output['msg'] = "Both fields cannot be left blank";

      }else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
       {
         $output['error']  = 'error';      
         $output['msg']    = 'Enter correct Email ID';
      
    }else{
         $query  = "UPDATE `admin` SET name = ? , email = ? where username='{$_SESSION['admin']}'";
         $parameters = array($name,$email);
         $statement  = $db->prepare($query);
         $statement->execute($parameters);
         $output['error']  = 'success';
         $output['msg'] = "Profile Details Changed successfully";

      }
  echo json_encode($output);  
?>