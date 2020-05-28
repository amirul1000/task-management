<?php
       session_start();
       include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: login");
	   }
	   
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
		case "contractor":
		             unset($info);
					 unset($data);
				    $info["table"] = "task_performed LEFT OUTER JOIN task on(task_performed.task_id=task.id)
					                                 LEFT OUTER JOIN company on(task.company_id=company.id)
													 LEFT OUTER JOIN users on(task_performed.users_id=users.id)";
				$info["fields"] = array("distinct(task_performed.users_id) as id"); 
				$info["where"]   = "1 AND task.company_id='".$_REQUEST['company_id']."'";
				$arr_users =  $db->select($info);
				
				for($i=0;$i<count($arr_users);$i++)
				{
			       $arr_id[] = $arr_users[$i]['id'];  		
				}
				$info["table"] = "users";
				$info["fields"] = array("users.id,concat(users.first_name,' ',users.last_name) as employee"); 
				$info["where"]   = "1   AND id in (".implode(",",$arr_id).")";
				$arr_users =  $db->select($info);
				echo json_encode($arr_users);
		       break;     
	     case "report_company_date_range":
				   if(isset($_REQUEST['company_id']))
					{
					   $where = " AND task.company_id='".$_REQUEST['company_id']."'"; 
					}
					if(isset($_SESSION['users_id']))
					{
					   $where .= " AND task.users_id='".$_SESSION['users_id']."'"; 
					}
					if(!empty($_REQUEST['users_id']))
					{
					   $where .= " AND task_performed.users_id='".$_REQUEST['users_id']."'"; 
					}
					if(!(empty($_REQUEST['date_from'])&&empty($_REQUEST['date_to'])))
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
				    include("company_report_date_range_editor.php");
				   break; 
			case "report_company_date_range_email":
						    if(isset($_REQUEST['company_id']))
							{
							   $where = " AND task.company_id='".$_REQUEST['company_id']."'"; 
							}
							if(isset($_SESSION['users_id']))
							{
							   $where .= " AND task.users_id='".$_SESSION['users_id']."'"; 
							}
							if(!empty($_REQUEST['users_id']))
							{
							   $where .= " AND task_performed.users_id='".$_REQUEST['users_id']."'"; 
							}
							if(!(empty($_REQUEST['date_from'])&&empty($_REQUEST['date_to'])))
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
							$info["where"]   = "1  AND id='".$_SESSION['users_id']."'";
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
								$message  .= "<tr><td>".$arr_data[$i]['employee']."</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
								$message  .= "<tr><td>Date</td><td>Task name</td><td>Note</td><td>Unit type</td><td>Rate</td><td>No of units completed</td><td>Fee</td></tr>";
							  $task_perfomed = $arr_data[$i]['task_perfomed'];
							  for($j=0;$j<count($task_perfomed);$j++)
							  { 
							    
								$date_time             = $task_perfomed[$j]['date_time'];
								$notes                 = $task_perfomed[$j]['description'];
								$unit_type             = $task_perfomed[$j]['unit_type'];
							    $rate                  = $task_perfomed[$j]['rate'];
								$task_name             = $task_perfomed[$j]['task_name'];
								$no_of_units_completed = $task_perfomed[$j]['no_of_units_completed']; 
								$fee                   = $task_perfomed[$j]['fee']; 
								$message  .= "<tr><td>".$date_time."</td><td>".$task_name."</td><td>".$notes."</td><td>".$unit_type."</td><td>".$rate."</td><td>".$no_of_units_completed."</td><td>".$fee."</td></tr>";
			                  }
							  $message  .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>".$arr_data[$i]['fee_total']."</td></tr>";
							}
							$message  .= "</table>";


							mail($email, $subject, $message, $headers);
							include("company_report_date_range_editor.php");
			              break; 
			   case "pdf":	
		                   if(isset($_REQUEST['company_id']))
							{
							   $where = " AND task.company_id='".$_REQUEST['company_id']."'"; 
							}
							if(isset($_SESSION['users_id']))
							{
							   $where .= " AND task.users_id='".$_SESSION['users_id']."'"; 
							}
							if(!empty($_REQUEST['users_id']))
							{
							   $where .= " AND task_performed.users_id='".$_REQUEST['users_id']."'"; 
							}
							if(!(empty($_REQUEST['date_from'])&&empty($_REQUEST['date_to'])))
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
								    
						    
							// Mail it
							$subject = "Report of ".$_REQUEST['date_from'].' to '.$_REQUEST['date_to']; 
							if(empty($_REQUEST['date_from'])&& empty($_REQUEST['date_to']))
							{
								$subject = "Report";
							}
							
							$html  = "";
							$html  .= "Subject: ".$subject;
							$html  .= "<br>";
							$html  .= date("F j , Y",strtotime(date("Y-m-d")));
							$html  .= "<br><br><br>";
							$html  .= "<table border=\"1\">";
							for($i=0;$i<count($arr_data);$i++)
							{
								$html  .= "<tr><td>".$arr_data[$i]['employee']."</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
								$html  .= "<tr><td>Date</td><td>Task name</td><td>Note</td><td>Unit type</td><td>Rate</td><td>No of units completed</td><td>Fee</td></tr>";
							  $task_perfomed = $arr_data[$i]['task_perfomed'];
							  for($j=0;$j<count($task_perfomed);$j++)
							  { 
							    
								$date_time             = $task_perfomed[$j]['date_time'];
								$notes                 = $task_perfomed[$j]['description'];
								$unit_type             = $task_perfomed[$j]['unit_type'];
							    $rate                  = $task_perfomed[$j]['rate'];
								$task_name             = $task_perfomed[$j]['task_name'];
								$no_of_units_completed = $task_perfomed[$j]['no_of_units_completed']; 
								$fee                   = $task_perfomed[$j]['fee']; 
								$html  .= "<tr><td>".$date_time."</td><td>".$task_name."</td><td>".$notes."</td><td>".$unit_type."</td><td>".$rate."</td><td>".$no_of_units_completed."</td><td>".$fee."</td></tr>";
			                  }
							  $html  .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>".$arr_data[$i]['fee_total']."</td></tr>";
							}
							$html  .= "</table>";
		           
			         	include("../mpdf60/mpdf.php");					
						$mpdf=new mPDF('','A4'); 
						
						//$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 
						//$mpdf->mirrorMargins = true;

                       $mpdf->SetDisplayMode('fullpage');
						//==============================================================
						$mpdf->autoScriptToLang = true;
						$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
						$mpdf->autoVietnamese = true;
						$mpdf->autoArabic = true;
						
						$mpdf->autoLangToFont = true;
						
						$mpdf->setAutoBottomMargin = 'stretch'; 
						
						/* This works almost exactly the same as using autoLangToFont:
							$stylesheet = file_get_contents('../lang2fonts.css');
							$mpdf->WriteHTML($stylesheet,1);
						*/
						$mpdf->SetWatermarkImage('images/logo.png', 0.20, 'F');
						$mpdf->showWatermarkImage = true;
						
						$stylesheet = file_get_contents('../mpdf60/lang2fonts.css');
						$mpdf->WriteHTML($stylesheet,1);
						
						$mpdf->WriteHTML($html);
						//$mpdf->AddPage();
						
											
						$mpdf->Output($filePath);
						//$mpdf->Output();
						//$mpdf->Output( $filePath,'S');
						exit;		  
			       break; 
			   default:
			           include("company_report_date_range_editor.php");
			      
			}