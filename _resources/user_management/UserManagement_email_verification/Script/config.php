<?php		
#------------------Changes to be done here-----------------------------
	
	// Gloabal Variable Setting
	
    $GLOBALS["HOST"]     = "localhost";
    $GLOBALS["USERNAME"] = "root";
    $GLOBALS["PASSWORD"] = "";
    $GLOBALS["DATABASE"] = "loginProject";
   
    

		// write domain name .If it is in folder then write the folder name also
		$base_url = 'http://localhost/usermanagement/'; 


		//Forget Password FROM DETAILS
		$fromAddress  =	'ajay@froiden.com' ;
		$fromName     =	'Ajay Kumar Choudhary'; 

  		//Path of the avatar image.This needs to have writtable permisssion
		$path   = 'images/avatar/';
 
 		// Encryption key.This key is used for the encryption of the keys that are generated
 		// Forget Key and Email verification Key
 		$encryption_key = 'abababa';


    // Recapcha Details
    // Vist this to generate keys https://www.google.com/recaptcha/intro/index.html
    $site_key   = "6Le5-_4SAAAAAMe1ItaO1mYVmAiC01xNu08DTAJp";
    $secret_key = "6Le5-_4SAAAAACFxyuNhDrc9cbHxgyUVWT5r1-Qw";
#------------------End Changes to be done here-----------------------------

  $db = connectDatabase();

	function connectDatabase() {
	try{
 	 	    $db = new PDO("mysql:dbname={$GLOBALS["DATABASE"]};host={$GLOBALS["HOST"]}", $GLOBALS["USERNAME"], $GLOBALS["PASSWORD"]);
       	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   	   	return $db;
	  }catch(PDOException $ex)
	  {
	  		return json_encode(array('outcome' => false, 'message' => 'Database connection failed'));
	  }	
	} 
	
	

	// Image resize function
	function resize($target, $w, $h, $ext) 
	{
    	list($w_orig, $h_orig) = getimagesize($target);
    	
    	$img = "";
    	$ext = strtolower($ext);
    	if ($ext == "gif")
    	{ 
      		$img = imagecreatefromgif($target);
    	}
    	else if($ext =="png")
		  { 
      		$img = imagecreatefrompng($target);
    	}
    	else
    	{ 
      		$img = imagecreatefromjpeg($target);
    	}
    	$tci = imagecreatetruecolor($w, $h);
    	
    	imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    	imagejpeg($tci, $target, 80);
	}


  // Get Curl Data
  function getCurlData($url)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
    $curlData = curl_exec($curl);
    curl_close($curl);
    return $curlData;
  }
	

?>