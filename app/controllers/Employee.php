<?php  
/**
 *  Employee Controller
 */
class Employee extends Controller  
{
	
	public function __construct()  
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");      
		}

		$this->employeeModel = $this->model('EmployeeModel');   
	}

	public function index() 
	{ 
		
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
				'email' => trim($_POST['email']), 
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'address' => trim($_POST['address']),  
				'birthdate' => trim($_POST['birthdate']),   
				'contact_info' => trim($_POST['contact_info']),    
				'gender' => trim($_POST['gender']),    
				'position_id' => trim($_POST['position_id']),    
				'schedule_id' => trim($_POST['schedule_id']),     
				'photo' => $_FILES['photo'],    
				'firstname_error' => '',
				'lastname_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => '', 
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

			// validate email 
			if (empty($data['email'])) {
				$data['email_error'] = 'Email is required.';
			} else {
				// valid email address 
				if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['email_error'] = 'Invalid Email Address.'; 
				}
				// already exist 
				if ($this->employeeModel->findUserByEmail($data['email'])) {
					$data['email_error'] = 'Email is already taken.';
				} 
			}

			//validate password 
			if (empty($data['password'])) {
				$data['password_error'] = 'Password is required.';
			} elseif(strlen($data['password']) < 6) {
				$data['password_error'] = 'Password must be at least 6 characters.';
			}

			// conf password 
			if (empty($data['confirm_password'])) {
				$data['confirm_password_error'] = 'Confirm Password is required.'; 
			} else {
				if ($data['password'] != $data['confirm_password'] ) {
					$data['confirm_password_error'] = 'Password did not match.';   
				}
			}

			if (empty($data['address'])) {
				$data['address_error'] = 'Address is required';
			} 

			if (empty($data['birthdate'])) {
				$data['birthdate_error'] = 'Birthdate is required';   
			}   

			if (empty($data['contact_info'])) {
				$data['contact_error'] = 'Contact is required';  
			}  elseif(!validate_mobile($data['contact_info'])) { 
				$data['contact_error'] = 'Invalid format. Please input 11 digit mobile number, for example: 01710835653';  
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
			if ( empty($data['firstname_error']) && empty($data['lastname_error']) && empty($data['address_error']) && empty($data['birthdate_error']) && empty($data['contact_error']) && empty($data['gender_error']) && empty($data['position_error']) && empty($data['schedule_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])  ) {
					
				// Hash Password 
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);  

				// image process 
				if ($data['photo']['name'] != false) {  //optional     
					
					// Allow certain file formats
					$imageFileType = strtolower(pathinfo($data['photo']['name'], PATHINFO_EXTENSION));  
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) { 
					    
						$data = [ 
							'employees' => $employees, 
							'positions' => $positions, 
							'schedules' => $schedules, 
							'title' => 'Employee Store',    
							'employee_id' => '',   
							'firstname' => '', 
							'lastname' => '', 
							'email' => '',
							'password' => '',
							'confirm_password' => '',
							'address' => '',  
							'birthdate' => '',   
							'contact_info' => '',    
							'gender' => '',    
							'position_id' => '',    
							'schedule_id' => '',   
							'photo' => '',   
							'firstname_error' => '',
							'lastname_error' => '',
							'password_error' => '',
							'email_error' => '', 
							'confirm_password_error' => '',
							'address_error' => '', 
							'birthdate_error' => '',
							'contact_error' => '',
							'gender_error' => '',
							'position_error' => '', 
							'schedule_error' => '',
							'photo_error' => 'File is not a image, please upload a image file' 
						];
						$this->view('backend/employee/create', $data);   
					}    
					// Check file size 
					elseif ($data["photo"]["size"] >= 500000) { // 500KB 
						$data = [ 
							'employees' => $employees, 
							'positions' => $positions, 
							'schedules' => $schedules,  
							'title' => 'Employee Store',     
							'employee_id' => '',   
							'firstname' => '', 
							'lastname' => '', 
							'email' => '',
							'password' => '',
							'confirm_password' => '',
							'address' => '',  
							'birthdate' => '',   
							'contact_info' => '',    
							'gender' => '',    
							'position_id' => '',    
							'schedule_id' => '',   
							'photo' => '',   
							'firstname_error' => '',
							'lastname_error' => '',
							'password_error' => '',
							'email_error' => '', 
							'confirm_password_error' => '',
							'address_error' => '', 
							'birthdate_error' => '',
							'contact_error' => '',
							'gender_error' => '',
							'position_error' => '',
							'schedule_error' => '',
							'photo_error' => 'Sorry, your file is too large.'   
						];

						$this->view('backend/employee/create', $data);          
					} else {	 
						// image rename and upload process 
						$name = $data['photo']['name'];
						$tmp_name = $data['photo']['tmp_name'];
						$type = $data['photo']['type']; 
						$size = $data['photo']['size'];   

						// rename 
						$newName = date('Y-m-d_H-i-s')."_".uniqid();        
						$ext = pathinfo($name, PATHINFO_EXTENSION); 
						$newName = $newName.".".$ext; // name with extension
						$fileNameWithUploadDir = '../public/uploads/employee/'.$newName;            

						// for database  
						$data['photo'] = $newName; // for database  
						if ( empty($data['photo_error'])) {
							move_uploaded_file($tmp_name, $fileNameWithUploadDir);        
						}    
					} 

				}  
				
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
				'email' => '',
				'password' => '',
				'confirm_password' => '',
				'address' => '',  
				'birthdate' => '',   
				'contact_info' => '',    
				'gender' => '',    
				'position_id' => '',    
				'schedule_id' => '',   
				'photo' => '',   
				'firstname_error' => '',
				'lastname_error' => '',
				'password_error' => '',
				'email_error' => '', 
				'confirm_password_error' => '',
				'address_error' => '', 
				'birthdate_error' => '',
				'contact_error' => '',
				'gender_error' => '',
				'position_error' => '',
				'schedule_error' => '', 
				'photo_error' => ''
			];
			$this->view('backend/employee/create', $data);             
		}
	}

	public function update($id) { 
		
		$positions = $this->employeeModel->positions(); 
		$schedules = $this->employeeModel->schedules();
		
		// fetch employee data 
		$employeeData = $this->employeeModel->employeeFindById($id);   
		

		if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

			// update
			// input sanitize
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  

			$data = [    
				'positions' => $positions, 
				'schedules' => $schedules, 
				'employeeData' => $employeeData,
				'title' => 'Employee Store',     
				'employee_id' => uniqid(),  
				'firstname' => trim($_POST['firstname']), 
				'lastname' => trim($_POST['lastname']), 
				'address' => trim($_POST['address']),  
				'birthdate' => date('Y-m-d', strtotime($_POST['birthdate'])),    
				'contact_info' => trim($_POST['contact_info']),    
				'gender' => trim($_POST['gender']),    
				'position_id' => trim($_POST['position_id']),    
				'schedule_id' => trim($_POST['schedule_id']),     
				'photo' => $_FILES['photo'],    
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
				
				// image process 
				if ($data['photo']['name'] != false) {  //optional     
					
					// Allow certain file formats
					$imageFileType = strtolower(pathinfo($data['photo']['name'], PATHINFO_EXTENSION));  
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) { 
					    
						$data = [ 
							'employees' => $employees, 
							'positions' => $positions, 
							'schedules' => $schedules, 
							'employeeData' => $employeeData,
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
							'photo' => '',   
							'firstname_error' => '',
							'lastname_error' => '',
							'address_error' => '', 
							'birthdate_error' => '',
							'contact_error' => '',
							'gender_error' => '',
							'position_error' => '',
							'schedule_error' => '',
							'photo_error' => 'File is not a image, please upload a image file' 
						];
  
						$this->view("backend/employee/edit", $data); 
					}    
					// Check file size 
					elseif ($data["photo"]["size"] >= 500000) { // 500KB 
						$data = [ 
							'employees' => $employees, 
							'positions' => $positions, 
							'schedules' => $schedules,  
							'employeeData' => $employeeData,
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
							'photo' => '',   
							'firstname_error' => '',
							'lastname_error' => '',
							'address_error' => '', 
							'birthdate_error' => '',
							'contact_error' => '',
							'gender_error' => '',
							'position_error' => '',
							'schedule_error' => '',
							'photo_error' => 'Sorry, your file is too large.'   
						];

						$this->view("backend/employee/edit", $data);            
					} else {	
						// image rename and upload process 
						$name = $data['photo']['name'];
						$tmp_name = $data['photo']['tmp_name'];
						$type = $data['photo']['type'];
						$size = $data['photo']['size'];   

						// rename 
						$newName = date('Y-m-d_H-i-s')."_".uniqid();       
						$ext = pathinfo($name, PATHINFO_EXTENSION); 
						$newName = $newName.".".$ext; // name with extension
						$fileNameWithUploadDir = '../public/uploads/employee/'.$newName;            

						// for database  
						$data['photo'] = $newName; // for database  
						if ( empty($data['photo_error'])) {
							move_uploaded_file($tmp_name, $fileNameWithUploadDir);        
						}     
					} 
				}  else { // old photo 
					$data['photo'] = $_POST['oldphoto']; // for database    
 				}  
				
				// Register employee
				if($this->employeeModel->employeeUpdate($data, $id)) { // receive true/false 
					flash('message', 'Employee has been updated.');       
					redirect('employee/index');         
				} else {
					die('Something went wrong!');     
				} 
			} else {
				// load view with errors 
				$this->view("backend/employee/edit", $data);      
			}
			// /update
			
		} else { // get request

			// fetch employee data 
			$employeeData = $this->employeeModel->employeeFindById($id); 
		        
			$data = [
				'title' => 'Employee Edit', 
				'positions' => $positions,
				'schedules' => $schedules, 
				'employeeData' => $employeeData,    
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
			$this->view("backend/employee/edit", $data);           
		}
	}

	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->employeeModel->destroy($id)) {
				flash('success', 'Employee has been removed');   
				redirect('employee/index');    
			} else {
				die('Something went wrong');
			}
		} else {
			redirect('employee/index');       
		}
	}

} // end of the class   