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
					$scheduleId = $employee->employee_id;
					$date_now = date('Y-m-d');         

					// check status
					if ($status === 'start') { // in time
					  	
					  	// already present or not
					  	if ($this->frontModel->alreadyAttendance($employeeId, $date_now)) {

					  		$output['error'] = true;
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