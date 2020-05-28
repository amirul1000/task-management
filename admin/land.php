<?php
    session_start();
   include("../common/lib.php");
   include("../lib/class.db.php");
   include("../common/config.php");
   
   if(empty($_SESSION["admin"]))
   {
       Header("Location: login");
   }
   
   $cmd = $_REQUEST['cmd'];
   
   switch($cmd)
   {
      default:
	       include("land_view.php");
			
   }
?>