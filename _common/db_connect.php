<?php
	
		$dbhost ="localhost";
		$dbuser	="contractor_track";
		$dbpassword ="Cabins44+";
		$dbdatabase ="contractor_tracker";
		$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
		mysql_select_db($dbdatabase, $conn);
	
?>