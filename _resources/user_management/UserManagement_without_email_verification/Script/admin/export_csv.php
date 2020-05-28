<?php
		include('../config.php');
		error_reporting(0);
		$filename =	"exported-data".time().".csv";
		//header to give the order to the browser
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment;filename='.$filename);

		//select table to export the data
		$stmt = $db->prepare("SELECT * FROM users");
   	    $stmt->execute();
		$rows 	= $stmt->fetch(PDO::FETCH_ASSOC);

		if ($rows)
		{
			getcsv(array_keys($rows));
		}
		while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			getcsv($rows);
			
		}

		// get total number of fields present in the database
		function getcsv($no_of_field_names)
		{
		$separate = '';


		// do the action for all field names as field name
		foreach ($no_of_field_names as $field_name)
		{
			if (preg_match('/\\r|\\n|,|"/', $field_name))
			{
				$field_name = '' . str_replace('', $field_name) . '';
			}
			echo $separate . $field_name;

			//sepearte with the comma
			$separate = ',';
		}

			//make new row and line
			echo "\r\n";
		}
?>