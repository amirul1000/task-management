<?php
	function get_current_plan_info($db,$users_id)
	{
		  unset($info);
		  unset($data);
		$info["table"] = "subscription_type";
		$info["fields"] = array("subscription_type.*"); 
		$info["where"]   = "1 AND users_id='".$users_id."' ORDER BY id DESC";
		$arr =  $db->select($info);
		
		$customer_id = $arr[0]['customers'];
		$subscriptions_id = $arr[0]['susbcription'];
		$gateway_url  = 'https://api.stripe.com/v1/customers/' . $customer_id . '/subscriptions/'.$subscriptions_id; 
		
		$headr[] = 'Authorization: Bearer  '.get_sk_key($db);//sk_test_qBrclNqTvp6vxU4iace8YI1b';
		
		$ch = curl_init( );
		curl_setopt($ch, CURLOPT_URL, $gateway_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
		curl_setopt($ch, CURLOPT_POST, true ); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( array() ) );
		curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
		$response = curl_exec($ch);
		
		$response  = json_decode($response);
		
		curl_close ($ch);
		
		return array('plan'=>$response->plan->id,
		             'status'=>$response->status,
					 'current_period_start'=>$response->current_period_start,
					 'current_period_end'=>$response->current_period_end);
	}
	
	
	function get_plan_id($db,$plan_name)
	{
	    	unset($info);
			unset($data);
		$info["table"] = "plan";
		$info["fields"] = array("plan.*"); 
		$info["where"]   = "1 AND plan_name='".$plan_name."'";
		$arr_plan =  $db->select($info);
		
		return $arr_plan[0]['id'];
	}
	
	//get total no of company creation
	function get_current_no_of_company_created($db,$users_id,$current_period_start,$current_period_end)
	{
	    $info["table"] = "company";
		$info["fields"] = array("company.*"); 
		$info["where"]   = "1  AND users_id='".$users_id."' AND date_time_created BETWEEN '".date("Y-m-d H:i:s",$current_period_start)."' AND '".date("Y-m-d H:i:s",$current_period_end)."'";
		$arr =  $db->select($info);	
        
		return count($arr); 		
	}
	
	
	//get total no of company creation
	function get_current_no_of_tasks_created($db,$users_id,$current_period_start,$current_period_end)
	{
	    $info["table"] = "task";
		$info["fields"] = array("task.*"); 
		$info["where"]   = "1  AND users_id='".$users_id."' AND posted_date_time BETWEEN '".date("Y-m-d H:i:s",$current_period_start)."' AND '".date("Y-m-d H:i:s",$current_period_end)."'";
		$arr =  $db->select($info);	
        
		return count($arr); 		
	}
	
	function get_sk_key($db)
	{
	    $info["table"] = "payment_key";
		$info["fields"] = array("payment_key.*"); 
		$info["where"]   = "1 AND status='active'";
		$arr =  $db->select($info);	
		
		return $arr[0]['secret_key'];
	}
	
	/*function get_no_of_company_allow($db,$users_id)
	{
		$arr = get_current_plan_info($db,$_REQUEST['users_id']);
		$plan_name = $arr['plan'];
		$status = $arr['status'];
		if($status=='inactive' || $status=='' || empty($status))
		{
		   $plan_name = 'basic'; 	
		}
		
			unset($info);
			unset($data);
		$info["table"] = "plan";
		$info["fields"] = array("plan.*"); 
		$info["where"]   = "1 AND plan_name='".$plan_name."'";
		$arr_data =  $db->select($info);
		$obj = json_decode($arr_data);
		
		return $obj[0]['no_of_company_allow'];
	}
	
	function get_no_of_tasks_allow($db,$users_id)
	{
		$arr = get_current_plan_info($db,$_REQUEST['users_id']);
		$plan_name = $arr['plan'];
		$status = $arr['status'];
		if($status=='inactive' || $status=='' || empty($status))
		{
		   $plan_name = 'basic'; 	
		}
		
			unset($info);
			unset($data);
		$info["table"] = "plan";
		$info["fields"] = array("plan.*"); 
		$info["where"]   = "1 AND plan_name='".$plan_name."'";
		$arr_data =  $db->select($info);
		$obj = json_decode($arr_data);
		
		return $obj[0]['no_of_tasks_allow'];
	}
	
	function get_no_of_contractor_report($db,$users_id)
	{	
		$arr = get_current_plan_info($db,$_REQUEST['users_id']);
		$plan_name = $arr['plan'];
		$status = $arr['status'];
		if($status=='inactive' || $status=='' || empty($status))
		{
		   $plan_name = 'basic'; 	
		}
		
			unset($info);
			unset($data);
		$info["table"] = "plan";
		$info["fields"] = array("plan.*"); 
		$info["where"]   = "1 AND plan_name='".$plan_name."'";
		$arr_data =  $db->select($info);
		$obj = json_decode($arr_data);
		
		return $obj[0]['no_of_contractor_report'];
		
	}*/
?>