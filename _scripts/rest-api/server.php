<?php
  date_default_timezone_set('America/New_York'); 
  session_start();
  
class Server {

    public function serve() {
	
			$uri = $_SERVER['REQUEST_URI'];
			$method = $_SERVER['REQUEST_METHOD'];
			$arrreq = explode("/",$_REQUEST['_url']);
			array_shift($arrreq);
			array_shift($arrreq);
			$cmd = $arrreq[0];
			switch($method)
			{   
			     //search
				 case "GET":
				           $this->get($cmd,$arrreq);
						   break;
				 //insert		   
				 case "POST":
						   $this->post($cmd,$arrreq);	
						   break;
				 //update		   
				 case "PUT":
						   $this->put($cmd,$arrreq);	
						   break;
				//delete		   
				 case "DELETE":
						   $this->delete($cmd,$arrreq);	
						   break;
				   default:
						   echo 'error';
			}
	
	}
	
	//search
	function get($cmd,$arrreq)
	{
		       session_start();
		   include("../../common/lib.php");
		   include("../../lib/class.db.php");
		   include("../../common/config.php");
	       include("lib.php");

	   switch($cmd)
	   {
	      case "register":
					$first_name = trim($_REQUEST["first_name"]);
					$last_name = trim($_REQUEST["last_name"]);
					$email = trim($_REQUEST["email"]);
					$password = trim($_REQUEST["password"]);
					$user_type = trim($_REQUEST["user_type"]);
					
						unset($info);
						unset($data);
					$info["table"] = "users";
					$info["fields"] = array("users.*"); 
					$info["where"]   = "1 AND  email='".$email."'";	
					$res =  $db->select($info);
					
					if(count($res)==0)
					{
						   $info['table']    = "users";
						$data['first_name']   = $first_name;
						$data['last_name']   = $last_name;
						$data['email']   = $email;
						$data['password']   = $password;
						$data['user_type']   = $user_type;
						$info['data']     =  $data;
						 $db->insert($info);
						 
						$message = "Registration has been completed successfully";	  	
					}
					else
					{
				    	$message = "Error-Duplicate username";
					}	
					echo $message;
	              break;
	       case "login":					
					$info["table"] = "users";
					$info["fields"] = array("users.*"); 
					$info["where"]   = "1 AND  email='".mysql_real_escape_string(trim($_REQUEST['email']))."' AND password='".mysql_real_escape_string(trim($_REQUEST['password']))."'";							
					$res =  $db->select($info);
					
					if(count($res)==0)
					{
					   $message = "fail"; 
					   echo $message;	
					}
					else
					{
						echo json_encode($res);
					}
	           break;
		  case "email_password":
					$info["table"]     = "users";
					$info["fields"]   = array("*");
					$info["where"]    = " 1=1 AND email  LIKE BINARY '".$_REQUEST["email"]."'";
					$res  = $db->select($info);
					if(count($res)>0)
					{
						$first_name    = $res[0]["first_name"];
						$last_name     = $res[0]["last_name"];
						$email         = $res[0]["email"];
						$password      = $res[0]["password"];
						
						$subject = "Recovery Password from contractortrackerapp";
						
						$body = "Dear $first_name $last_name,<br>
								Your Login information is like below:<br> 
								 Email:$email<br> 
								 password:$password<br><br>
								 
								 Thanks,<br>
								 Contractortrackerapp Team";
						//send email
							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From: contractortrackerapp <info@contractortrackerapp.com>' . "\r\n";
							
						mail($_REQUEST["email"], $subject, $body, $headers);
						$message ="An email has been sent to your E-mail address";	
					}
					else
					{
					   $message = "No email is found with this address";	
					}
				    echo $message;
		       break;	   
		  case "current_plan_allow_access":	   
		        $arr = get_current_plan_info($db,$_REQUEST['users_id']);
				$plan_name = $arr['plan'];
				$status = $arr['status'];
				$current_period_start = $arr['current_period_start'];
				$current_period_end = $arr['current_period_end'];
				if($status=='inactive' || $status=='' || empty($status))
				{
				   $plan_name = 'basic'; 
				   ///////////////if no plan exists in stripe set plan date time////////////
					
				    $plan_id  = get_plan_id($db,$plan_name);
				   
				   
				     //check if exits
				  		 unset($info);
						 unset($data);
					$info["table"] = "subscription";
					$info["fields"] = array("subscription.*"); 
					$info["where"]   = "1 AND  users_id ='".$_REQUEST['users_id']."' ORDER BY id DESC";
				    $res2 =  $db->select($info);
				   
				    //check if exists with current_period_end
						 unset($info);
						 unset($data);
					$info["table"] = "subscription";
					$info["fields"] = array("subscription.*"); 
					$info["where"]   = "1 AND  users_id ='".$_REQUEST['users_id']."'
										   AND current_period_end<'".time()."' ORDER BY id DESC";
					$res3 =  $db->select($info);					
					$current_period_start = $res3[0]['current_period_start'];
					$current_period_end   = $res3[0]['current_period_end'];
					if(count($res2)==0)
					{
						
						$current_period_start   = date("Y-m-d");
						$current_period_end     = date("Y-m-d", strtotime("+1 month", strtotime($current_period_start)));
						
						$current_period_start   = strtotime($current_period_start);
						$current_period_end     = strtotime($current_period_end);
						
						   unset($info);
						   unset($data);
						$info['table']    = "subscription";
						$data['users_id']   = $_REQUEST['users_id'];
						$data['plan_id']   = $plan_id;
						$data['current_period_start'] = $current_period_start;
						$data['current_period_end']   = $current_period_end;
						$info['data']     =  $data;
					    $db->insert($info);
					   
					}
					elseif($current_period_end<time())
					{
						$current_period_start   = date("Y-m-d");
						$current_period_end     = date("Y-m-d", strtotime("+1 month", strtotime($current_period_start)));
						
						$current_period_start   = strtotime($current_period_start);
						$current_period_end     = strtotime($current_period_end);

						
						   unset($info);
						   unset($data);
						$info['table']    = "subscription";
						$data['users_id']   = $_REQUEST['users_id'];
						$data['plan_id']   = $plan_id;
						$data['current_period_start'] = $current_period_start;
						$data['current_period_end']   = $current_period_end;
						$info['data']     =  $data;
						
					   $info['where']     =  "id='".$res3[0]['id']."'";
					   $db->update($info);
					}	    
				   /////////////////////////////////////////////////////////////////////////	
				}
				
					unset($info);
					unset($data);
				$info["table"] = "plan";
				$info["fields"] = array("plan.*"); 
				$info["where"]   = "1 AND plan_name='".$plan_name."'";
				$arr_data =  $db->select($info);
				$arr_data[0]['current_period_start'] = $current_period_start;
				$arr_data[0]['current_period_end'] = $current_period_end;
				echo json_encode($arr_data);				
		       break;   
	      case "company_add":		  
				$users_id = trim($_REQUEST["users_id"]);
				$company_name = trim($_REQUEST["company_name"]);
				$description = trim($_REQUEST["description"]);
				
				$current_period_start = trim($_REQUEST["current_period_start"]);
				$current_period_end = trim($_REQUEST["current_period_end"]);
				$no_of_company_allow = trim($_REQUEST["no_of_company_allow"]);
				
				$no_company_created = get_current_no_of_company_created($db,$users_id,$current_period_start,$current_period_end);
				if($no_company_created>$no_of_company_allow-1)
				{
				   $message = "You have reached the maximum  no of company allow ($no_of_company_allow) in the current plan.
									   Please subscribe with us if you stared with basic otherwise change your plan 
									   from My subscription";
				   echo $message;  					   	  	
				   exit; 					   
				}
				
				   unset($info);
				   unset($data);
				$info['table']    = "company";
				$data['users_id']   = $users_id;
                $data['no']   = time();
                $data['company_name']   = $company_name;
                $data['description']   = $description;
                $data['date_time_created']   = date("Y-m-d H:i:s");
                $data['date_time_updated']   = date("Y-m-d H:i:s");
				$info['data']     =  $data;
					 $db->insert($info);
					 
				$id = mysql_insert_id();
				if($id>0)
				{
						unset($info);
						unset($data);
					$info['table']    = "company";
					$data['no']   = $id;
					$info['data']     =  $data;
					$info['where']     = "id='".$id."'";
					$db->update($info);
				
					$message = "Company has been created successfully";	  	
				}
				else
				{
				  $message = "Insertion fail";	  	
				}
				echo $message;
			 break;
		case "profile":
		        $info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "1 AND  id ='".$_REQUEST['users_id']."'";
				$arr_data =  $db->select($info); 
				echo json_encode($arr_data);	
		     break;  	 
		case "update_profile":
				$users_id = trim($_REQUEST["users_id"]);
				$first_name = trim($_REQUEST["first_name"]);
				$last_name = trim($_REQUEST["last_name"]);
				$email = trim($_REQUEST["email"]);
				   unset($info);
				   unset($data);
				$info['table']    = "users";
				$data['first_name']   = $first_name;
				$data['last_name']   = $last_name;
				$data['email']   = $email;
				$info['data']     =  $data;
				$Id            = $users_id;
				$info['where'] = "id=".$Id;
				
				$result = $db->update($info);
				if($result == TRUE )
				{
					$message = "Your Profile has been updated  successfully";	  	
				}
				else
				{
					$message = "Update fail";	  	
				}
				echo $message;
		      break;
		 case "change_password":
		        $users_id = trim($_REQUEST["users_id"]);
				$password_old = trim($_REQUEST["password_old"]);
				$pasword_new = trim($_REQUEST["pasword_new"]);				
				$password_confirm = trim($_REQUEST["password_confirm"]);
				
				
				//////////////check old password/////////////
					$info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "1 AND  id ='".$users_id."'
									   AND password='".$password_old."'";
				$res =  $db->select($info);  
				
				if(count($res)==0)
				{
				   $message = "Your old password is not correct"; 
				   echo $message;
				   exit;	
				}
				////////////////update/////////////////////////;
					$info['table']    = "users";;
                $data['password']   = $pasword_new;;
				$info['data']     =  $data;
				$info['where'] = " id ='".$users_id."'
									       AND password='".$password_old."'";
				$result =	$db->update($info);
				if($result == TRUE )
				{
					$message = "Your Password has been changed successfully";	  	
				}
				else
				{
				  $message = "Update fail";	  	
				}
				echo $message;
		      break;   	  	 
	   /*case "subscription_add":
		        $users_id = trim($_REQUEST["users_id"]);
				$plan = trim($_REQUEST["plan"]);
				
				//////////////check old password/////////////
				  unset($info);
				  unset($data);
				$info["table"] = "subscription";
				$info["fields"] = array("subscription.*"); 
				$info["where"]   = "1 AND  users_id ='".$users_id."'
									   AND end_date>='".date("Y-m-d")."'";	
									
				
				$res =  $db->select($info);
				if(count($res)>0)
				{
				   $message = "Your are already subscribed in plan ".$res[0]['plan']; 
				   echo $message;
				   exit;	
				}
				else
				{
				    $plans = array('basic'=>'The basic service allows the owner to list 1 company and 3 tasks, and have 1 contractor report time',
                                   'plus'=>'The plus service allows the owner to list 1 company and 10 tasks and have up to 10 contractors report time',
                                   'premium'=>'The premium service allows unlimited services and is 5.99 a month');

				    $description   = $plans[$plan];
					$start_date   = date("Y-m-d");
					$end_date     =  date("Y-m-d", strtotime("+1 month", strtotime($start_date)));
					
				       unset($info);
				       unset($data);
					$info['table']    = "subscription";
					$data['users_id']   = $users_id;
					$data['plan']   = $plan;
					$data['description']   = $description;
					$data['start_date']   = $start_date;
					$data['end_date']   = $end_date;
					$info['data']     =  $data;
					$db->insert($info);
				
					$id = mysql_insert_id();
					if($id>0)
					{
						$message = "Subscription has been inserted successfully";	  	
					}
					else
					{
					  $message = "Insertion fail";	  	
					}
					echo $message;				
				}
				 break;*/   	  	
		  case "company_list":
			    $users_id = trim($_REQUEST["users_id"]);
			      unset($info);
				  unset($data);
				$info["table"] = "company";
				$info["fields"] = array("company.*"); 
				$info["where"]   = "1  AND users_id='".$users_id."' ORDER BY company_name ASC ";
				$arr =  $db->select($info);
				
			    echo json_encode($arr);
				break;
		  case "company_search":
			    $no = trim($_REQUEST["no"]);
			      unset($info);
				  unset($data);
				$info["table"] = "company";
				$info["fields"] = array("company.*"); 
				$info["where"]   = "1  AND no='".$no."' ORDER BY company_name ASC ";
				$arr =  $db->select($info);
				if(count($arr)>0)
				  {
				    echo json_encode($arr);
				  }
				  else
				  {
					$message = "Company with this no is not available";	
					echo $message;   	
				  }
			    break;
			case "company_register":
					unset($info);
					unset($data);
			      $info["table"] = "company_register";
				  $info["fields"] = array("company_register.*"); 
				  $info["where"]   = "1  AND company_id='".$_REQUEST['company_id']."'
				                         AND users_id='".$_REQUEST['users_id']."'";
				  $arr =  $db->select($info);
				   
						unset($info);
						unset($data);
					$info['table']    = "company_register";
					$data['company_id']   = $_REQUEST['company_id'];
					$data['users_id']   = $_REQUEST['users_id'];
					$data['status']   = 'accept';
					$data['register_status'] = 'register';
					$data['date_created']   = date("Y-m-d");
					$info['data']     =  $data;  
				  if(count($arr)==0)
				  {    
						$db->insert($info);
						
						$id = mysql_insert_id();
						if($id>0)
						{
							$message = "Registration with the company has been completed successfully";	  	
						}
				  }
				  else
				  {
					$info['where'] = "id='".$arr[0]['id']."'";  
					$db->update($info);  
					  
				    $message = "Registration with the company has been completed successfully";	  	  	
				  }
				  echo $message; 
			     break;
			case "employee_registered_company_list":
			     	unset($info);
					unset($data);
			      $info["table"] = "company_register LEFT OUTER JOIN company ON(company_register.company_id=company.id)";
				  $info["fields"] = array("company.no,company.company_name,company.description,company_register.*"); 
				  $info["where"]   = "1  AND company_register.users_id='".$_REQUEST['users_id']."'
										 AND register_status='register'";
				  $arr =  $db->select($info);
				  echo json_encode($arr);
			     break; 
		    case "employee_unregister_company":
					$info['table']    = "company_register";
					$data['register_status']   = 'unregister';
					$info['data']     =  $data;					
					$Id            = $_REQUEST['id'];
					$info['where'] = "id='".$Id."' AND users_id='".$_REQUEST['users_id']."'";
					$db->update($info);
			     break; 
				 //////////////task list of register  company for employee///////////////	  	
		   case "available_task_list":
			       unset($info);
					unset($data);
			      $info["table"] = "company_register";
				  $info["fields"] = array("company_register.*"); 
				  $info["where"]   = "1  AND users_id='".$_REQUEST['users_id']."' AND register_status='register'";
				  $arr =  $db->select($info);
				  for($i=0;$i<count($arr);$i++)
				  {
				    $company_id[] = $arr[$i]['company_id'];
				  }
				  
			     if(count($company_id)>0)
				 {
				     $list = implode(",", $company_id);
				 
					  unset($info);
					  unset($data);
					$info["table"] = "task";
					$info["fields"] = array("task.*"); 
					$info["where"]   = "1  AND status='active' AND company_id in($list)";
					$arr =  $db->select($info);
					
					echo json_encode($arr);
				}	
				break;
		  case "company_info":
			    $company_id = trim($_REQUEST["company_id"]);
			      unset($info);
				  unset($data);
				$info["table"] = "company";
				$info["fields"] = array("company.*"); 
				$info["where"]   = "1  AND  id='".$company_id."' ORDER BY company_name ASC ";
				$arr =  $db->select($info);
				
			    echo json_encode($arr);
			    break;
		  case "business_posted_task":
			         unset($info);
					 unset($data);
			      $info["table"] = "task";
				  $info["fields"] = array("task.*"); 
				   $info["where"]   = "1  AND company_id='".$_REQUEST['company_id']."'
				                          AND users_id='".$_REQUEST['users_id']."'
										  ORDER BY id DESC";
				  $arr =  $db->select($info);
			       echo json_encode($arr);
			     break;
		  case "business_posted_task_add":
		        $users_id   = $_REQUEST['users_id'];
		        $current_period_start = trim($_REQUEST["current_period_start"]);
				$current_period_end = trim($_REQUEST["current_period_end"]);
				$no_of_tasks_allow = trim($_REQUEST["no_of_tasks_allow"]);
				
				$no_of_tasks_allow_created = get_current_no_of_tasks_created($db,$users_id,$current_period_start,$current_period_end);
				
				if($no_of_tasks_allow_created>$no_of_tasks_allow-1)
				{
				   $message = "You have reached the maximum  no of tasks allow ($no_of_tasks_allow) in the current plan.
									   Please subscribe with us if you stared with basic otherwise change your plan 
									   from My subscription";
				   echo $message;  					   	  	
				   exit; 					   
				}
		  
			       unset($info);
				   unset($data);
			    $info['table']    = "task";
				$data['company_id']   = $_REQUEST['company_id'];
                $data['users_id']   = $_REQUEST['users_id'];
                $data['task_name']   = $_REQUEST['task_name'];
                $data['description']   = $_REQUEST['description'];
                $data['rate']   =  number_format($_REQUEST['rate'],2);
                $data['unit_type']   = $_REQUEST['unit_type'];
				$data['max_units_per_day']   = $_REQUEST['max_units_per_day'];
                $data['approx_completed_no_unit']   = $_REQUEST['approx_completed_no_unit'];
                
				
				$info['data']     =  $data;
				if(empty($_REQUEST['id']))
				{    
				     $data['status']              = 'active';
					 $data['posted_date_time']   = date("Y-m-d H:i:s");
				}
				else
				{
					$data['posted_date_time']   = date("Y-m-d H:i:s");
				} 
				$info['data']     =  $data;
				
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
					 $message = "Task has been posted successfully";	
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					$result = $db->update($info);
					if($result == TRUE)
					{
					  $message = "Task has been updated successfully";	  	
					}
				} 
				echo $message; 
			   break;	
			case "business_posted_task_delete":
			    $Id               = $_REQUEST['id'];
				$info['table']    = "task";
				$info['where']    = "id='$Id'";
				if($Id)
				{
					$db->delete($info);
					
					///relational task perfomed
					$Id               = $_REQUEST['id'];				
					$info['table']    = "task_performed";
					$info['where']    = "task_id='$Id'";
					$db->delete($info);
					
				}
				$message = "Job has been deleted successfully";
				echo $message; 
			   break;
			case "business_posted_task_perfomed":
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
				$info["fields"] = array("task_performed.*,task.unit_type,task.task_name as task_name,concat(users.first_name,' ',users.last_name) as employee"); 
				$info["where"]   = "1 AND task_performed.task_id='".$_REQUEST['task_id']."'";
				$arr =  $db->select($info);
			     
			    echo json_encode($arr);
			     break;
			case "business_posted_task_info":
			         unset($info);
					 unset($data);
			      $info["table"] = "task";
				  $info["fields"] = array("task.*"); 
				   $info["where"]   = "1  AND id='".$_REQUEST['task_id']."'";
				  $arr =  $db->select($info);
			       echo json_encode($arr);
			         break;	 
		   case "task_perfomed":
			         unset($info);
					 unset($data);
			      $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
				$info["fields"] = array("task_performed.*,task.unit_type,task.task_name as task_name,concat(users.first_name,' ',users.last_name) as employee"); 
				$info["where"]   = "1  AND task_performed.users_id='".$_REQUEST['users_id']."'
				                       AND task_performed.task_id='".$_REQUEST['task_id']."' ORDER BY id DESC";
				  $arr =  $db->select($info);
			       echo json_encode($arr);
			         break;
			case "task_perfomed_add":
			   //Max units per day	
			    $info["table"] = "task";
				$info["fields"] = array("task.*"); 
				$info["where"]   = "1 AND id='".$_REQUEST['task_id']."'";
				$arr =  $db->select($info);
			    $max_units_per_day = $arr[0]['max_units_per_day'];
				
				//Total completed to day
				$date_time = date("Y-m-d",strtotime($_REQUEST['date_time']));
				$start  = $date_time." 00:00:00";
				$end    = $date_time." 23:59:59";
				$info["table"] = "task_performed";
				$info["fields"] = array("sum(no_of_units_completed) as units_completed"); 
				$info["where"]   = "1  AND task_id='".$_REQUEST['task_id']."'
				                       AND date_time BETWEEN '".$start."' AND '".$end."'";
				$arr =  $db->select($info);
				$total_units_completed_today = $arr[0]['units_completed'];
				
				if($_REQUEST['no_of_units_completed']>$max_units_per_day-$total_units_completed_today)
				{
				  $message = "No of units completed has been greater than max units per day allowed.
				              Max units per day is  $max_units_per_day and  
							  in ".$_REQUEST['date_time']."  total units completed is $total_units_completed_today";	
				  echo $message;
				  exit;			  
				}
			
			
			       unset($info);
				   unset($data);
			    $info['table']       = "task_performed";
				$data['users_id']   = $_REQUEST['users_id'];
                $data['task_id']   = $_REQUEST['task_id'];
				$data['date_time']   = date("Y-m-d",strtotime($_REQUEST['date_time']));
                $data['description']   = $_REQUEST['description'];
                $data['no_of_units_completed']   = $_REQUEST['no_of_units_completed'];
				$info['data']     =  $data;
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
					 $message = "Task perfomed has been inserted successfully";	
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					$result = $db->update($info);
					if($result == TRUE)
					{
					  $message = "Task perfomed has been updated successfully";	  	
					}
				} 
				echo $message; 
			   break;	
			case "task_perfomed_delete":
			    $Id               = $_REQUEST['id'];
				$info['table']    = "task_performed";
				$info['where']    = "id='$Id'";
				if($Id)
				{
					$db->delete($info);
				}
				$message = "Task perfomed has been deleted successfully";
				echo $message; 
			   break;
			case "report_this_week":
			      if($_REQUEST['user_type']=='employer'){
							unset($info);
							unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.date_time"); 
						$info["where"]   = "1  AND task.users_id='".$_REQUEST['users_id']."'
						                        AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())
						                        GROUP BY task_performed.date_time DESC";
						$arr_task =  $db->select($info);
						 
					   for($i=0;$i<count($arr_task);$i++)
					   {
					  
							 unset($info);
							 unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.*,
												FORMAT(task.rate,2) as rate,
												task.unit_type,
												FORMAT(task_performed.no_of_units_completed*task.rate,2) as 	fee,
												task.task_name,
												concat(users.first_name,' ',users.last_name) as employee"); 
						$info["where"]   = "1  AND task.users_id='".$_REQUEST['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."' 
						                       AND task.status='active'
											   AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())";
						  $arr_task_perfomed =  $db->select($info);
						  
						  
						  unset($info);
						  unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
						$info["where"]   = "1  AND task.users_id='".$_REQUEST['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."'						
						                       AND task.status='active'
											   AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())";
						  $arr_fee_total =  $db->select($info);
						  
						  if($arr_fee_total[0]['fee_total']>0)
						  {
							  $arr_week[] = array('date_time'=>$arr_task[$i]['date_time'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=>$arr_fee_total[0]['fee_total']);
						  }					  
					  }	  
						  
						echo json_encode($arr_week);
			  }else if($_REQUEST['user_type']=='employee'){
			  
			     
				        unset($info);
						unset($data);
					  $info["table"] = "company_register";
					  $info["fields"] = array("company_register.*"); 
					  $info["where"]   = "1  AND users_id='".$_REQUEST['users_id']."'";
					  $arr =  $db->select($info);
					  for($i=0;$i<count($arr);$i++)
					  {
						$company_id[] = $arr[$i]['company_id'];
					  }
					  
					 if(count($company_id)>0)
					 {
						 $list = implode(",", $company_id);
					 
						  unset($info);
						  unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.date_time"); 
						$info["where"]   = "1  AND task.status='active' 
						                       AND task.company_id in($list)
						                       AND task_performed.users_id='".$_REQUEST['users_id']."' 
											   AND YEARWEEK(task_performed.date_time) = YEARWEEK(NOW())
						                       GROUP BY task_performed.date_time DESC";
											   
											   
										   
						$arr_task =  $db->select($info);
						
						for($i=0;$i<count($arr_task);$i++)
					   {
					  
							 unset($info);
							 unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														 LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("task_performed.*,
												FORMAT(task.rate,2) as rate,
												task.unit_type,
												task.task_name,
												FORMAT(task_performed.no_of_units_completed*task.rate,2) as fee,
												concat(users.first_name,' ',users.last_name) as employee"); 
						$info["where"]   = "1  AND task_performed.users_id='".$_REQUEST['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."'
											   AND task.status='active'";
						
						  $arr_task_perfomed =  $db->select($info);
						  
						  
						  unset($info);
						  unset($data);
						$info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
														  LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
						$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
						$info["where"]   = "1  AND task_performed.users_id='".$_REQUEST['users_id']."' 
						                       AND task_performed.date_time='".$arr_task[$i]['date_time']."'
											   AND task.status='active'";
						$arr_fee_total =  $db->select($info);
						  
						  if($arr_fee_total[0]['fee_total']>0)
						  {
							  $arr_week[] = array('date_time'=>$arr_task[$i]['date_time'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=>$arr_fee_total[0]['fee_total']);
						  }					  
					  }	  
						  
						echo json_encode($arr_week);
					}
			  }
				
			   break;  
			case "report_company_date_range":
			    if(isset($_REQUEST['company_id']))
				{
				   $where = " AND task.company_id='".$_REQUEST['company_id']."'"; 
				}
				if(isset($_REQUEST['users_id']))
				{
				   $where .= " AND task.users_id='".$_REQUEST['users_id']."'"; 
				}
				if(isset($_REQUEST['date_from'])&&isset($_REQUEST['date_to']))
				{
				   $where .= "AND task_performed.date_time>='".date("Y-m-d",strtotime($_REQUEST['date_from']))."' 
							  AND task_performed.date_time<='".date("Y-m-d",strtotime($_REQUEST['date_to']))."'";
				}
				
			         unset($info);
					 unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
				$info["fields"] = array("task_performed.users_id,concat(users.first_name,' ',users.last_name) as employee"); 
				$info["where"]   = "1 $where GROUP BY task_performed.users_id";
				$arr_employee =  $db->select($info);
				
				for($i=0;$i<count($arr_employee);$i++)
				{
				     unset($info);
					 unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("task_performed.*,
				                         task.task_name,
				                         FORMAT(task.rate,2) as rate,
										 task.unit_type,
										 FORMAT(task_performed.no_of_units_completed*task.rate,2) as 	fee"); 
				$info["where"]   = "1 $where AND task_performed.users_id='".$arr_employee[$i]['users_id']."'";
				$arr_task_perfomed =  $db->select($info);
				
				
					unset($info);
					unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
				$info["where"]   = "1 $where AND task_performed.users_id='".$arr_employee[$i]['users_id']."'";
				$arr_fee_total =  $db->select($info);
				
				
				 if($arr_fee_total[0]['fee_total']>0)
						  {
							  $arr_data[] = array('employee'=>$arr_employee[$i]['employee'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=>$arr_fee_total[0]['fee_total']);
						  }	
				}
					    
			    echo json_encode($arr_data);
			   break; 
			case "report_company_date_range_email":
			    if(isset($_REQUEST['company_id']))
				{
				   $where = " AND task.company_id='".$_REQUEST['company_id']."'"; 
				}
				if(isset($_REQUEST['users_id']))
				{
				   $where .= " AND task.users_id='".$_REQUEST['users_id']."'"; 
				}
				if(isset($_REQUEST['date_from'])&&isset($_REQUEST['date_to']))
				{
				   $where .= "AND task_performed.date_time>='".date("Y-m-d",strtotime($_REQUEST['date_from']))."' 
							  AND task_performed.date_time<='".date("Y-m-d",strtotime($_REQUEST['date_to']))."'";
				}
				
			         unset($info);
					 unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
				$info["fields"] = array("task_performed.users_id,concat(users.first_name,' ',users.last_name) as employee"); 
				$info["where"]   = "1 $where GROUP BY task_performed.users_id";
				$arr_employee =  $db->select($info);
				
				for($i=0;$i<count($arr_employee);$i++)
				{
				     unset($info);
					 unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("task_performed.*,
				                         task.task_name,
				                         FORMAT(task.rate,2) as rate,
										 task.unit_type,
										 FORMAT(task_performed.no_of_units_completed*task.rate,2) as 	fee"); 
				$info["where"]   = "1 $where AND task_performed.users_id='".$arr_employee[$i]['users_id']."'";
				$arr_task_perfomed =  $db->select($info);
				
				
					unset($info);
					unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
				$info["where"]   = "1 $where AND task_performed.users_id='".$arr_employee[$i]['users_id']."'";
				$arr_fee_total =  $db->select($info);
				
				
				 if($arr_fee_total[0]['fee_total']>0)
						  {
							  $arr_data[] = array('employee'=>$arr_employee[$i]['employee'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=>$arr_fee_total[0]['fee_total']);
						  }	
				}
					    
			    ///person info
				 unset($info);
				 unset($data);
				$info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "1  AND id='".$_REQUEST['users_id']."'";
				$arr_users =  $db->select($info);
				
				$first_name = $arr_users[0]['first_name'];
				$last_name  = $arr_users[0]['last_name'];
				$email      = $arr_users[0]['email'];
				
				//send email
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Additional headers
				$headers .= 'From: contractortrackerapp <reports@contractortrackerapp.com>' . "\r\n";
				//$headers .= 'Cc: amirrucst@gmail.com' . "\r\n";
				//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				
				// Mail it
				$subject = "Report of ".$_REQUEST['date_from'].' to '.$_REQUEST['date_to']; 
				if(empty($_REQUEST['date_from'])&& empty($_REQUEST['date_to']))
				{
					$subject = "Report";
				}
				$message  = "";
				$message  .= "<table border=\"1\">";
				for($i=0;$i<count($arr_data);$i++)
				{
					$message  .= "<tr><td>".$arr_data[$i]['employee']."</td><td></td><td></td><td></td><td></td><td></td></tr>";
					$message  .= "<tr><td>Date</td><td>Task name</td><td>Unit type</td><td>Rate</td><td>No of units completed</td><td>Fee</td></tr>";
				  $task_perfomed = $arr_data[$i]['task_perfomed'];
				  for($j=0;$j<count($task_perfomed);$j++)
				  { 
				    
					$date_time             = $task_perfomed[$j]['date_time'];
					$unit_type             = $task_perfomed[$j]['unit_type'];
				    $rate                  = $task_perfomed[$j]['rate'];
					$task_name             = $task_perfomed[$j]['task_name'];
					$no_of_units_completed = $task_perfomed[$j]['no_of_units_completed']; 
					$fee                   = $task_perfomed[$j]['fee']; 
					$message  .= "<tr><td>".$date_time."</td><td>".$task_name."</td><td>".$unit_type."</td><td>".$rate."</td><td>".$no_of_units_completed."</td><td>".$fee."</td></tr>";
                  }
				  $message  .= "<tr><td></td><td></td><td></td><td></td><td></td><td>".$arr_data[$i]['fee_total']."</td></tr>";
				}
				$message  .= "</table>";
				
				
				mail($email, $subject, $message, $headers);
			   break; 
			      
			case "report_task_date_range":
			    if(isset($_REQUEST['company_id']))
				{
				   $where = " AND task.company_id='".$_REQUEST['company_id']."'"; 
				}
				if(isset($_REQUEST['users_id']))
				{
				   $where .= " AND task_performed.users_id='".$_REQUEST['users_id']."'"; 
				}
				if(isset($_REQUEST['date_from'])&&isset($_REQUEST['date_to']))
				{
				   $where .= "AND task_performed.date_time>='".date("Y-m-d",strtotime($_REQUEST['date_from']))."' 
							  AND task_performed.date_time<='".date("Y-m-d",strtotime($_REQUEST['date_to']))."'";
				}
				
			         unset($info);
					 unset($data);
			    $info["table"] = "task 
				                        LEFT OUTER JOIN company on(task.company_id=company.id)
										LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("company.company_name,concat(users.first_name,' ',users.last_name) as employee"); 
				$info["where"]   = "1 AND task.company_id='".$_REQUEST['company_id']."'";
				$arr_company =  $db->select($info);
				
				
				     unset($info);
					 unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("task_performed.*,task.task_name,
				                         FORMAT(task.rate,2) as rate,
										 task.unit_type,
										 FORMAT(task_performed.no_of_units_completed*task.rate,2) as 	fee"); 
				$info["where"]   = "1 $where";
				$arr_task_perfomed =  $db->select($info);
				
				
					unset($info);
					unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
				$info["where"]   = "1 $where";
				$arr_fee_total =  $db->select($info);
				
				
				 if($arr_fee_total[0]['fee_total']>0)
					{
							  $arr_data[] = array('company'=>$arr_company[0]['company_name'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=> $arr_fee_total[0]['fee_total']
												  );
					}	
				
					    
			    echo json_encode($arr_data);
			   break; 	     	    
		 case "report_task_date_range_email":
			    if(isset($_REQUEST['company_id']))
				{
				   $where = " AND task.company_id='".$_REQUEST['company_id']."'"; 
				}
				if(isset($_REQUEST['users_id']))
				{
				   $where .= " AND task_performed.users_id='".$_REQUEST['users_id']."'"; 
				}
				if(isset($_REQUEST['date_from'])&&isset($_REQUEST['date_to']))
				{
				   $where .= "AND task_performed.date_time>='".date("Y-m-d",strtotime($_REQUEST['date_from']))."' 
							  AND task_performed.date_time<='".date("Y-m-d",strtotime($_REQUEST['date_to']))."'";
				}
				
			         unset($info);
					 unset($data);
			    $info["table"] = "task 
				                        LEFT OUTER JOIN company on(task.company_id=company.id)
										LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("company.company_name,concat(users.first_name,' ',users.last_name) as employee"); 
				$info["where"]   = "1 AND task.company_id='".$_REQUEST['company_id']."'";
				$arr_company =  $db->select($info);
				
				
				     unset($info);
					 unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("task_performed.*,task.task_name,
				                         FORMAT(task.rate,2) as rate,
										 task.unit_type,
										 FORMAT(task_performed.no_of_units_completed*task.rate,2) as 	fee"); 
				$info["where"]   = "1 $where";
				$arr_task_perfomed =  $db->select($info);
				
				
					unset($info);
					unset($data);
			    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
				                                 LEFT OUTER JOIN company on(task.company_id=company.id)
												 LEFT OUTER JOIN users on(task.users_id=users.id)";
				$info["fields"] = array("FORMAT(sum(task_performed.no_of_units_completed*task.rate),2) as 	fee_total"); 
				$info["where"]   = "1 $where";
				$arr_fee_total =  $db->select($info);
				
				
				 if($arr_fee_total[0]['fee_total']>0)
					{
							  $arr_data[] = array('company'=>$arr_company[0]['company_name'],
												  'task_perfomed'=>$arr_task_perfomed,
												  'fee_total'=> $arr_fee_total[0]['fee_total']
												  );
					}	
				
				///person info
				 unset($info);
				 unset($data);
				$info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "1  AND id='".$_REQUEST['users_id']."'";
				$arr_users =  $db->select($info);
				
				$first_name = $arr_users[0]['first_name'];
				$last_name  = $arr_users[0]['last_name'];
				$email      = $arr_users[0]['email'];
				
				//send email
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Additional headers
				$headers .= 'From: contractortrackerapp <reports@contractortrackerapp.com>' . "\r\n";
				//$headers .= 'Cc: amirrucst@gmail.com' . "\r\n";
				//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				
				// Mail it
				$subject = "Report of ".$_REQUEST['date_from'].' to '.$_REQUEST['date_to']; 
				$message  = "";
				$message  .= "<table border=\"1\">";
				for($i=0;$i<count($arr_data);$i++)
				{
					$message  .= "<tr><td>".$arr_data[$i]['company']."</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					$message  .= "<tr><td>Date</td><td>Task Name</td><td>Note</td><td>Unit type</td><td>Rate</td><td>No of units completed</td><td>Fee</td></tr>";
				  $task_perfomed = $arr_data[$i]['task_perfomed'];
				  for($j=0;$j<count($task_perfomed);$j++)
				  { 
				    $task_name             = $task_perfomed[$j]['task_name'];
					$date_time             = $task_perfomed[$j]['date_time'];
					$unit_type             = $task_perfomed[$j]['unit_type'];
				    $rate                  = $task_perfomed[$j]['rate'];
					$description           = $task_perfomed[$j]['description'];
					$no_of_units_completed = $task_perfomed[$j]['no_of_units_completed']; 
					$fee                   = $task_perfomed[$j]['fee']; 
					$message  .= "<tr><td>".$date_time."</td><td>".$task_name."</td><td>".$description."</td><td>".$unit_type."</td><td>".$rate."</td><td>".$no_of_units_completed."</td><td>".$fee."</td></tr>";
                  }
				  $message  .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>".$arr_data[$i]['fee_total']."</td></tr>";
				}
				$message  .= "</table>";
				
				
				mail($email, $subject, $message, $headers);
			    
			   break; 
		case "my_subscription_list":
		        $info["table"] = "subscription
				                  LEFT OUTER JOIN plan ON(subscription.plan_id=plan.id)";
				$info["fields"] = array("plan.*,subscription.*"); 
				$info["where"]   = "1 AND subscription.users_id='".$_REQUEST['users_id']."'
				                       ORDER BY subscription.id DESC";
				$arr_data =  $db->select($info);
				echo json_encode($arr_data);
			   break; 
		/*case "paypal_auth":
				$plan	      = $_REQUEST['plan'];	
				//plan	
				$info["table"] = "plan";
				$info["fields"] = array("plan.*"); 
				$info["where"]   = "1 AND plan_name='".$plan."'";
				$arr =  $db->select($info);
				
				$plan_id                    = $arr[0]['id'];
				$subscription_duration_days = $arr[0]['subscription_duration_days'];
				$price                      = $arr[0]['price'];
				$description = $arr[0]['plan_name'].' price-'.$arr[0]['price'].' company-'.$arr[0]['no_of_company_allow'].' 
							   tasks-'.$arr[0]['no_of_tasks_allow'].' report-'.$arr[0]['no_of_contractor_report'].' days-'.$arr[0]['subscription_duration_days'];
				
					
				$users_id      = $_REQUEST['users_id'];
				
				
				$first_name    = $_REQUEST['first_name'];	
				$last_name     = $_REQUEST['last_name'];		
				$card_type     = $_REQUEST['card_type'];	
				$card_number   = $_REQUEST['card_number'];	
				$cvv2          = $_REQUEST['cvv2'];	 
				$expire_mon    = $_REQUEST['expire_mon'];	
				$expire_year   = $_REQUEST['expire_year'];	

		
				$ch = curl_init();
				$clientId = "Abgghw1sXcQZTjEwvvb7mmNM6brDS9C0NhpW9DKs8oJVISAezFUDaLtGKkeZyH9rQss--SLt3Pkt98GN";
				$secret   = "EJJXLkr0vqIE2SPHLz8kb8tjTkdOU505QxlPMVXivBuHh0bCguiqP5SXiXKKaNYyyD1XNZPA2peDiVwm";
				
				curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
				
				$result = curl_exec($ch);
				
				if(empty($result))die("Error: No response.");
				else
				{
					$json = json_decode($result);
					//print_r($json->access_token);
					$accesstoken = $json->access_token;
					//echo json_encode($json);
				}
				curl_close($ch);
				
				
				$headers2 = array( 'Content-Type: application/json', 
				                   'Authorization: Bearer ' . $accesstoken
								  );
				$data = array(
							  "intent"=>"sale",
							  "payer"=>array(
								"payment_method"=>"credit_card",
								"funding_instruments"=>array(array(
									"credit_card"=>array(
									  "number"=>$card_number,
									  "type"=>$card_type,
									  "expire_month"=>$expire_mon,
									  "expire_year"=>$expire_year,
									  "cvv2"=>$cvv2,
									  "first_name"=>$first_name,
									  "last_name"=>$last_name
									  )
								)
								)
								),
							  "transactions"=> array(array(
								  "amount"=>array(
									"total"=>$price,
									"currency"=>"USD"),
								  "description"=>$description
								  )
								)
							   );
							   
				$saleurl = "https://api.sandbox.paypal.com/v1/payments/payment";
				
				$sale = curl_init();
				curl_setopt($sale, CURLOPT_URL, $saleurl);
				curl_setopt($sale, CURLOPT_VERBOSE, TRUE);
				curl_setopt($sale, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($sale, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($sale, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($sale, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($sale, CURLOPT_HTTPHEADER, $headers2);
				$finalsale = curl_exec($sale);
				
				$verb = json_decode($finalsale, TRUE);
				
				if($_REQUEST['test']==1)
				{
					echo json_encode($verb);
				}
				//if success
				
				if($verb["state"]=="approved")
				{
				  unset($info);
				  unset($data);
				$info['table']    = "subscription";
				$data['users_id']   = $_REQUEST['users_id'];
                $data['plan_id']   =   $plan_id;
                $data['start_date']   = date("Y-m-d");
                $data['end_date']   = date("Y-m-d",strtotime("+$subscription_duration_days days", strtotime(date("Y-m-d"))));
                $info['data']     =  $data;
				 $db->insert($info);
				 
				 $message = "Subscription has been completed.".$description;
				}
				else
				{
				  $message = $verb["name"]." ".json_encode($verb["details"]);	
				}
				echo $message;
				break;	
	  case "paypal_make_payment":
	        break;	*/  
	  case "plan":
						unset($info);
						unset($data);
					$info["table"] = "plan";
					$info["fields"] = array("plan.*"); 
					$info["where"]   = "1 ORDER BY id DESC";
					$arr_data =  $db->select($info);
					echo json_encode($arr_data);
	             break;
	  case "plan_description":
						unset($info);
						unset($data);
					$info["table"] = "plan";
					$info["fields"] = array("plan.*"); 
					$info["where"]   = "1 AND plan_name='".$_REQUEST['plan_name']."'";
					$arr_data =  $db->select($info);
					echo json_encode($arr_data);
	             break;			 
	  case "stripe_susbcribe":
	            $gateway_url  = 'https://api.stripe.com/v1/customers'; 
							 
				//$amount = 1*100;
				//$currency = 'USD';
				
				$card_array = array( 	"number" 			=> $_REQUEST['number'],
										"exp_month"		 => $_REQUEST['exp_month'],
										"exp_year"		  => $_REQUEST['exp_year'],
										"cvc"			   => $_REQUEST['cvc'] );

				$gateway_data = array(   "plan"			  => $_REQUEST['plan'],
										 "coupon"			=> $coupon,
										 "trial_end"		 => $trial_end,
										 "card"			  => $card_array,
										 "quantity"		  => 1 );
										
				$headr[] = 'Authorization: Bearer  '.get_sk_key($db);//sk_test_qBrclNqTvp6vxU4iace8YI1b';
		
				$ch = curl_init( );
				curl_setopt($ch, CURLOPT_URL, $gateway_url );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
				curl_setopt($ch, CURLOPT_POST, true ); 
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $gateway_data ) );
				curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
				$response = curl_exec($ch);				
				curl_close ($ch);
				
				$objsubscribe =  json_decode($response);
				
				if(strlen($objsubscribe->error->message)>0)
				{
					echo $objsubscribe->error->message.' '.$objsubscribe->error->type.' '.$objsubscribe->error->code;
				}
				else
				{
					////////////////////save data//////////////
					$users_id = trim($_REQUEST["users_id"]);
					$plan = trim($_REQUEST["plan"]);
					
					
					/////////////get plan id////////////////
					$info["table"] = "plan";
					$info["fields"] = array("plan.*"); 
					$info["where"]   = "1 AND plan_name='".$plan."'";
					$arr =  $db->select($info);
					
					$plan_id                    = $arr[0]['id'];
					$subscription_duration_days = $arr[0]['subscription_duration_days'];
					$price                      = $arr[0]['price'];
					$description = $arr[0]['plan_name'].' price-'.$arr[0]['price'].' company-'.$arr[0]['no_of_company_allow'].' 
								   tasks-'.$arr[0]['no_of_tasks_allow'].' report-'.$arr[0]['no_of_contractor_report'].' days-'.$arr[0]['subscription_duration_days'];
					
										
						  unset($info);
						  unset($data);
						$info['table']    = "subscription";
						$data['users_id']   = $_REQUEST['users_id'];
						$data['plan_id']   =   $plan_id;
						$data['current_period_start']   = $objsubscribe->subscriptions->data[0]->current_period_start;
						$data['current_period_end']   = $objsubscribe->subscriptions->data[0]->current_period_end;
						$info['data']     =  $data;
						 $db->insert($info);
					
						$id = mysql_insert_id();
						if($id>0)
						{
							  unset($info);
							  unset($data);
							$info['table']    = "subscription_type";
							$data['subscription_id']   = $id;
							$data['users_id']   = $_REQUEST['users_id'];
							$data['plan_id']   = $plan_id;
							$data['plan']   = $plan;
							$data['susbcription']   = $objsubscribe->subscriptions->data[0]->id;
							$data['customers']   = $objsubscribe->subscriptions->data[0]->customer;
							$data['cards']   = $objsubscribe->sources->data[0]->id;
							$data['status']   = 'active';
							$info['data']     =  $data;
							$db->insert($info);
							
							$message = "Subscription has been completed successfully";
							
						}
						else
						{
						  $message = "Insertion fail";	  	
						}
						echo $message;				
				}
	     	    break;
		 case "stripe_unsusbcription":
	               unset($info);
				   unset($data);
				$info["table"] = "subscription_type";
				$info["fields"] = array("subscription_type.*"); 
				$info["where"]   = "1 AND users_id='".$_REQUEST['users_id']."' ORDER BY id DESC";
				$arr =  $db->select($info);
				
				$customer_id = $arr[0]['customers'];
				$subscriptions_id = $arr[0]['susbcription'];
				$gateway_url  = 'https://api.stripe.com/v1/customers/' . $customer_id . '/subscriptions/'.$subscriptions_id; 
				
				$headr[] = 'Authorization: Bearer  '.get_sk_key($db);//sk_test_qBrclNqTvp6vxU4iace8YI1b';
		
				 $ch = curl_init( );
				curl_setopt($ch, CURLOPT_URL, $gateway_url );
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
				curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
				$response = curl_exec($ch);
				echo $response;				
				curl_close ($ch);
				break;	
			case "stripe_get_subscription";			 
					   unset($info);
					   unset($data);
					$info["table"] = "subscription_type";
					$info["fields"] = array("subscription_type.*"); 
					$info["where"]   = "1 AND users_id='".$_REQUEST['users_id']."' ORDER BY id DESC";
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
					echo $response;
					curl_close ($ch);
				  break;	
		 case "stripe_change_plan";			 
					   unset($info);
					   unset($data);
					$info["table"] = "subscription_type";
					$info["fields"] = array("subscription_type.*"); 
					$info["where"]   = "1 AND users_id='".$_REQUEST['users_id']."' ORDER BY id DESC";
					$arr =  $db->select($info);
					
					$customer_id = $arr[0]['customers'];
					$subscriptions_id = $arr[0]['susbcription'];
					$gateway_url  = 'https://api.stripe.com/v1/customers/' . $customer_id . '/subscriptions/'.$subscriptions_id; 
					
					$headr[] = 'Authorization: Bearer  '.get_sk_key($db);//sk_test_qBrclNqTvp6vxU4iace8YI1b';
			         
					$gateway_data = array(   "plan"			  => $_REQUEST['plan']); 
					 
					 
					$ch = curl_init( );
					curl_setopt($ch, CURLOPT_URL, $gateway_url );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headr );
					curl_setopt($ch, CURLOPT_POST, true ); 
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $gateway_data ) );
					curl_setopt($ch, CURLOPT_TIMEOUT, (int)30);
					$response = curl_exec($ch);
					echo $response;
					curl_close ($ch);
				  break;		  
				  
			   default:
				   echo 'Error';
	   }
	}
	//update		
	function put($cmd,$arrreq)
	{
	     switch($cmd)
		   {
			   case '':
				  
						 break;
						 
				   default:
					   echo 'Error';
		   }
	
	}
	//delete	
	function delete($cmd,$arrreq)
	{
	    switch($cmd)
		   {
			   case '':
				  
						 break;
						 
				   default:
					   echo 'Error';
		   }
	
	}
  }
$server = new Server;
$server->serve();

?>