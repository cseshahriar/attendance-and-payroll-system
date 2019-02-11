<?php 

/**
 * default controller  
 */
class Front extends Controller     
{
	
	public function __construct() 
	{
		// the constructore  
	}

	// default method must have 
	public function index() 
	{   
		$data = [
			'title' => 'SharePosts', 
		]; 
		$this->view('welcome', $data);          
	}    

	public function login() 
	{
		if (isset($_POST['email'])) {
			
			// messages
			$output = array('errors' => false, 'success' => false);    
		
			// set default time zone
			date_default_timezone_set('Asia/Dhaka');

			$status = trim($_POST['status']);   
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);

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
			
			// var_dump($output);

			// make sure no errors   
			if ( $output['errors'] != true && empty($output['status_error']) && empty($output['email_error']) && empty($output['password_error']) ) {     

				$output['errors'] = false;  

				$output['success'] = true;
				$output['message'] = 'Success';  

			} else {
				$output['errors'] = true;  
				// die('Something went wrong!'); 
			}
			
		}

		echo json_encode($output); 
	}

}