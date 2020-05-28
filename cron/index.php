<?php
     session_start();
   include("../common/lib.php");
   include("../lib/class.db.php");
   include("../common/config.php");  
	   
	   unset($info);
	   unset($data);
	$info["table"] = "subscription_type";
	$info["fields"] = array("subscription_type.*"); 
	$info["where"]   = "1 AND status='on'";
	$arr =  $db->select($info);
	for($i=0;$i<count($arr);$i++)
	{
	
	    $customer_id = $arr[$i]['customers'];
		$subscriptions_id = $arr[$i]['susbcription'];
		$gateway_url  = 'https://api.stripe.com/v1/customers/' . $customer_id . '/subscriptions/'.$subscriptions_id; 
		
		$headr[] = 'Authorization: Bearer  sk_test_zpbzu4t2LgCSqUqBigf4Pzh5';

		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, true ); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( array() ) );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
		$response = curl_exec($ch);
		echo $response;
		$obj = json_decode($response);
		$staus = $obj->status;
		
		echo $staus;
		
		curl_close ($ch);
	}
?>