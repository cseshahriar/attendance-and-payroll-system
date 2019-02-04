<?php 
/**
 * 
 */
class Employee extends Controller  
{
	
	public function __construct() 
	{
		$this->employeeModel = $this->model('EmployeeModel');   
	}

	public function index()
	{ 
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");     
		}

		$employees = $this->employeeModel->employees(); 
		$data = [
			'title' => 'Employees',
			'employees' => $employees 
		];
		$this->view('backend/employee/index', $data); 
	}

	/**
	 * [store description]
	 * @return [type] [description]
	 */
	public function store()  
	{
		$employees = $this->employeeModel->employees(); 
		$positions = $this->employeeModel->positions(); 
		$schedules = $this->employeeModel->schedules();

		// auth check

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  

			// input sanitize
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  

			$data = [   
				'positions' => $positions, 
				'schedules' => $schedules, 
				'title' => 'Employee Store',   
				'employee_id' => uniqid(),  
				'firstname' => trim($_POST['firstname']), 
				'lastname' => trim($_POST['lastname']), 
				'address' => trim($_POST['address']),  
				'birthdate' => trim($_POST['birthdate']),   
				'contact_info' => trim($_POST['contact_info']),    
				'gender' => trim($_POST['gender']),    
				'position_id' => trim($_POST['position_id']),    
				'schedule_id' => trim($_POST['schedule_id']),    
				'photo' => trim($_POST['photo']), 
				'firstname_error' => '',
				'lastname_error' => '',
				'address_error' => '', 
				'birthdate_error' => '',
				'contact_error' => '',
				'gender_error' => '',
				'position_error' => '',
				'schedule_error' => '',
				'photo_error' => ''   
			];  

			if (empty($data['firstname'])) {
				$data['firstname_error'] = 'Firstname is required';
			}  

			if (empty($data['lastname'])) {
				$data['lastname_error'] = 'Lastname is required';
			} 

			if (empty($data['address'])) {
				$data['address_error'] = 'Address is required';
			} 

			if (empty($data['birthdate'])) {
				$data['birthdate_error'] = 'Birthdate is required';
			}  

			if (empty($data['contact_info'])) {
				$data['contact_error'] = 'Contact is required';  
			}   

			if (empty($data['gender'])) {
				$data['gender_error'] = 'Gender is required';     
			}   

			if (empty($data['position_id'])) {
				$data['position_error'] = 'Position ID is required';      
			}   

			if (empty($data['schedule_id'])) {
				$data['schedule_error'] = 'Position ID is required';      
			}   

			// Makes sure errors are empty 
			if ( empty($data['firstname_error']) && empty($data['lastname_error']) && empty($data['address_error']) && empty($data['birthdate_error']) && empty($data['contact_error']) && empty($data['gender_error']) && empty($data['position_error']) && empty($data['schedule_error']) ) {
		
				// Register employee
				if($this->employeeModel->employeeStore($data)) { // receive true/false 
					flash('register_success', 'Employee has been registed.');      
					redirect('employee/index');        
				} else {
					die('Something went wrong!');  
				} 
			} else {
				// load view with errors 
				$this->view('backend/employee/create', $data);     
			}
	
		} else { // if request is get   
			$data = [ 
				'employees' => $employees, 
				'positions' => $positions, 
				'schedules' => $schedules, 
				'title' => 'Employee Store',    
				'employee_id' => '',   
				'firstname' => '', 
				'lastname' => '', 
				'address' => '',  
				'birthdate' => '',   
				'contact_info' => '',    
				'gender' => '',    
				'position_id' => '',    
				'schedule_id' => '',     
				'firstname_error' => '',
				'lastname_error' => '',
				'address_error' => '', 
				'birthdate_error' => '',
				'contact_error' => '',
				'gender_error' => '',
				'position_error' => '',
				'schedule_error' => '' 
			];
			$this->view('backend/employee/create', $data);           
		}
	}
}