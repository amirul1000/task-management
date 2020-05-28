<?php
 	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
			  case "charge":
							$gateway_url  = 'https://api.stripe.com/v1/charges'; 
							 
							$amount = 1*100;
							$currency = 'USD';
							
							$card_array = array( 	
													"number" 			=> '4242424242424242',
													"exp_month"		 => '12',
													"exp_year"		  => '17',
													"cvc"			   => '123'
												);
											
							$gateway_data = array(  "amount"			=> $amount,
													"currency"			=> $currency,
													"card"				=> $card_array,
													"description"		=> 'Test' );
													
													
													
							$headr[] = 'Authorization: Bearer  sk_test_zpbzu4t2LgCSqUqBigf4Pzh5';
					
							$ch = curl_init( );
							curl_setopt($ch, CURLOPT_URL, $gateway_url );
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
							curl_setopt($ch, CURLOPT_POST, true ); 
							curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $gateway_data ) );
							curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
							$response = curl_exec($ch);
							
							echo "<pre>";
							  print_r($response);
							echo "</pre>";
							
							curl_close ($ch);
				break;	
			
			
		  case "subscription":
							$gateway_url  = 'https://api.stripe.com/v1/customers'; 
							 
							$amount = 1*100;
							$currency = 'USD';
							
							$card_array = array( 	"number" 			=> '4242424242424242',
													"exp_month"		 => '12',
													"exp_year"		  => '17',
													"cvc"			   => '123' );
		
				             $gateway_data = array(  "plan"					=> '1',
													 "coupon"				=> $coupon,
													 "trial_end"				=> $trial_end,
													 "card"					=> $card_array,
													 "quantity"				=> 1 );
													
							$headr[] = 'Authorization: Bearer  sk_test_zpbzu4t2LgCSqUqBigf4Pzh5';
					
							$ch = curl_init( );
							curl_setopt($ch, CURLOPT_URL, $gateway_url );
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
							curl_setopt($ch, CURLOPT_POST, true ); 
							curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $gateway_data ) );
							curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
							$response = curl_exec($ch);
							
							echo "<pre>";
							  print_r($response);
							echo "</pre>";
							
							curl_close ($ch);
				break;
			case "subscription2":
			                $customer_id = 'cus_7yEV3QSjggLSCo';
							$gateway_url  = 'https://api.stripe.com/v1/customers/' . $customer_id . '/subscriptions'; 
							 
							$amount = 1*100;
							$currency = 'USD';
							
							$card_array = array( 	"number" 			=> '4242424242424242',
													"exp_month"		 => '12',
													"exp_year"		  => '17',
													"cvc"			   => '123' );
		
				            $gateway_data = array(  "plan"					=> 1,
													"coupon"				=> $coupon,
													"trial_end"				=> $trial_end,
													"card"					=> $card_array,
													"quantity"				=> 1 );
													
													
													
							$headr[] = 'Authorization: Bearer  sk_test_zpbzu4t2LgCSqUqBigf4Pzh5';
					
							$ch = curl_init( );
							curl_setopt($ch, CURLOPT_URL, $gateway_url );
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
							curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
							curl_setopt($ch, CURLOPT_POST, true ); 
							curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $gateway_data ) );
							curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
							$response = curl_exec($ch);
							
							echo "<pre>";
							  print_r($response);
							echo "</pre>";
							
							curl_close ($ch);
				break;		
			
			case "get_subscription":
			                $customer_id = 'cus_7yFbccWuPlsHbr';
							$subscriptions_id = 'sub_7yFbLCjinunf5a';
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
							
							echo "<pre>";
							  print_r($response);
							echo "</pre>";
							
							curl_close ($ch);
				break;			
				
	   }
  
  
  
    




?>