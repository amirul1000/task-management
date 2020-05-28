<?php
session_start();
  include("../../config.php");

  // ADMIN SESSION CHECK SET OR NOT
  if(!isset($_SESSION['admin']))
  {
          $output['error']  = 'error';
          $output['msg'] = "Session is destroyed";
          die(json_encode($output));
  }

  $name = $_GET['name'];
  $email  = $_GET['email'];
  
  // server side validation
  // check name and email field is entered or not
  if($name == '' || $email =='')
      {        
        $output['error']  = 'error';
        $output['msg'] = "Both fields cannot be left blank";

      }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){   //Email validation
         $output['error']  = 'error';      
         $output['msg']    = 'Enter correct Email ID';
      
      }else{

        // insert into database
         $query  = "UPDATE `admin` SET name = ? , email = ? where username='{$_SESSION['admin']}'";
         $parameters = array($name,$email);
         $statement  = $db->prepare($query);
         $statement->execute($parameters);

         $output['error']  = 'success';
         $output['msg'] = "Profile Details Changed successfully";

      }

  // output json  
  echo json_encode($output);  
?>