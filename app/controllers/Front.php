<?php 

/**
 * default controller  
 */
class Front extends Controller     
{
	
	public function __construct() 
	{
		$this->frontModel = $this->model('FrontModel');  
	}

	// default method must have 
	public function index()  
	{   
		$data = [
			'title' => 'Attendance and Payroll Home', 
		]; 
		$this->view('welcome', $data);          
	}    

	public function login()  
	{
		// if isset post
		if (isset($_POST)) {
			
			// messages
			$output = array('errors' => false, 'success' => false);    
		
			// set default time zone
			date_default_timezone_set('Asia/Dhaka');

			// input values
			$status = trim($_POST['status']);   
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);

			// validation start
			if (empty($status)) { 
				$output['errors'] = true;
				$output['status_error'] = 'Status is required.'; 
			} elseif($status != 'start' && $status != 'stop') {
				$output['errors'] = true;
				$output['status_error'] = 'Opps!, status is wrong.';  
			} 

			if (empty($email)) { 
				$output['errors'] = true;
				$output['email_error'] = 'Email is required.'; 
			}  

			if (empty($password)) {   
				$output['errors'] = true; 
				$output['password_error'] = 'Password is required.';   
			}   
			// end validation
			

			// start make sure no errors   
			if ( $output['errors'] != true && empty($output['status_error']) && empty($output['email_error']) && empty($output['password_error']) ) {     

				/* $output['errors'] = false;  
				$output['success'] = true;
				$output['message'] = 'Success'; */

				// employee is match wher email and password  
				$employee = $this->frontModel->login($email, $password); 
				// start login
				if ($employee) { // if login true 
					$employeeId = $employee->employee_id;
					$scheduleId = $employee->schedule_id; 
					$date_now = date('Y-m-d');         

					// check status
					if ($status === 'start') { // in time
					  	
					  	// already present or not
					  	if ($this->frontModel->alreadyAttendance($employeeId, $date_now)) {

					  		$output['success'] = true; 
							$output['message'] = 'You have already attended for today';        

					  	} else {

					  		// strart insert present 
					  		$time_now = date('H:i:s');
					  		$empJobStartingTime = $this->frontModel->employeeJobStartingTime($employeeId);     
					  		$earlyOfNotStatus = ($time_now > $empJobStartingTime) ? 0: 1;  
					  		
					  		// insert attendance 
					  		if ($this->frontModel->attendance($employeeId, $date_now, $time_now, $earlyOfNotStatus)) { 

					  			$output['success'] = true;
								$output['message'] = 'Welcome, Attendance successfully submited';        
					  			
					  		} else {
					  			$output['errors'] = true; 
							    $output['email_error'] = 'Attendance submit errors!';    
					  		}
					  	
					  	}
					  	// end insert present 

					} else { // end intime and start outtime
										
					  		// attendance check 
					  		$row = $this->frontModel->alreadyAttendance($employeeId, $date_now); 
						  	if ($row) { // attended 
						  		
						  		$attendanceId = $row->id;     
						  		// var_dump($row);  

						  		// out_time is not empty 
						  		if($row->out_time != '00:00:00' && $row->out_time != NULL && $row->out_time != '') { // not empty 
						  			$output['success'] = true;         
									$output['message'] = 'You have already leave for today';    
						  		} else { // if not leave today 

						  			// update leave time 
							  		$time_now = date('H:i:s'); 
							  		
							  		if ($this->frontModel->leave($attendanceId, $employeeId, $time_now) ) {    
							  			
							  			// -------------------- working hours calculation ---------------
										$time_in = ''; 
										$time_out = ''; 
										$attendanceData = $this->frontModel->attendanceById($attendanceId);
										$in_time_from_attendance = $attendanceData->in_time;
										$out_time_from_attendance = $attendanceData->out_time;  
										
										// employee in_time, out_time 
										$employeeData = $this->frontModel->employeeById($employeeId);  
										$employee_start_time  = $employeeData->in_time; 
										$employee_end_time = $employeeData->out_time;    
										
										// if employee starting tiem is grater than from attendance time
										// start before from schedule  
										if($employee_start_time > $in_time_from_attendance) {  
											$time_in = $employee_start_time;  
										} else {
											$time_in = $in_time_from_attendance;
										}
										// if employee ending tiem is grater than from attendance stop time  
										// stop before schedule 
										if($employee_end_time < $out_time_from_attendance){
											 $time_out = $employee_end_time;    
										} else {
											$time_out = $out_time_from_attendance;    
										}

										$time_in = new DateTime($time_in);
										$time_out = new DateTime($time_out);
										$interval = $time_in->diff($time_out);  
										$workingTime = $interval->format("%H:%I:%S"); 

										$this->frontModel->employeeWorkingHours($workingTime, $attendanceId);    
										// -------------------- end working hours calculation  ---------------
										$output['success'] = true;  
										$output['message'] = 'Goodbye, You time is ended for today'; 

							  		} else {
							  			$output['success'] = true;   
									    $output['message'] = 'Opps!, Something went wrong.';   
							  		}  

						  		}						  		

							} else {
							  	$output['errors'] = true;
								$output['leave_message'] = 'Please submit your attendance first.';               
							}

					} // end outtime 
					
				} else { // if login false

					    $output['errors'] = true;    
						$output['didNotMatch'] = 'Email or Password did not match.';           

				} // end login
				
				
			} else {
					$output['errors'] = true;  
			} 
			// end make sure no errors   
			
		} // end if not isset
		
		echo json_encode($output);
	} // end login function 

}