<?php 
/**
 * User Controller
 */
class Admin extends Controller 
{
	
	public function __construct()   
	{
		$this->userModel = $this->model('AdminModel');   
	}

	public function index() 
	{
		// auth check   
		$this->isLoggedInUser();  

		$users = $this->userModel->users(); 
		
		$data = [
			'title' => 'Admin List',
			'users' => $users  
		];

		$this->view('backend/users/index', $data);  

	}

	public function register() 
	{
		// auth check   
		$this->isLoggedInUser();

		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// process form 
			
			// sanitize post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			// init data 
			$data = [
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']), 
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => ''     
			];

			// validte name
			if (empty($data['name'])) {
				$data['name_error'] = 'Name is required.';
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
				if ($this->userModel->findUserByEmail($data['email'])) {
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
 
			// Makes sure errors are empty 
			if ( empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
		
				// Hash Password 
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 

				// Register User
				if($this->userModel->register($data)) { // receive true/false 
					flash('register_success', 'You are registered and can log in');      
					redirect('admin/login');        
				} else {
					die('Something went wrong!');  
				} 
			} else {
				// load view with errors 
				$this->view('backend/users/register', $data);    
			}


		} else {  // if post not submit 
			// init data
			$data = [
				'name' => '',
				'email' => '', 
				'password' => '',
				'confirm_password' => '',
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => '', 
			];

			// load view 
			$this->view('/backend/users/register', $data);    
		}
	}

	public function login()
	{
		// Check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			# process form 
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			// init data 
			$data = [
				'email' => trim($_POST['email']), 
				'password' => trim($_POST['password']),
				'name_error' => '',
				'email_error' => '',
				'password_error' => ''
			];

			// validate email 
			if (empty($data['email'])) {
				$data['email_error'] = 'Email is required.';
			} else {
				if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['email_error'] = 'Invalid Email Address.'; 
				} 

				// check for user/email exists 
				if ($this->userModel->findUserByEmail($data['email'])) {
					// user found
				} else {
					$data['email_error'] = 'User not found!'; 
				}
			}


			//validate password 
			if (empty($data['password'])) {
				$data['password_error'] = 'Password is required.';
			} elseif(strlen($data['password']) < 6) {
				$data['password_error'] = 'Password must be at least 6 characters.';
			} 

			// Makes sure errors are empty 
			if (empty($data['email_error']) && empty($data['password_error'])) {
				// validated 
				// check and set logged in user
				$loggedInUser = $this->userModel->login($data['email'], $data['password']); 
				if ($loggedInUser) {
					
					// create session
					$this->createUserSession($loggedInUser);

				} else {
					$data['password_error'] = 'Incorrect password!';
					$this->view('backend/users/login', $data);  
				}
			} else {
				// load view with errors 
				$this->view('backend/users/login', $data);  
			}

		} else {
			// init data
			$data = [
				'email' => '', 
				'password' => '',
				'email_error' => '',
				'password_error' => '',
				'title' => 'Login'
			];

			// load view 
			$this->view('backend/users/login', $data);   
		}
	}

	/**
	 * [createUserSession description]
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function createUserSession($user)
	{
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_name'] = $user->name;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_photo'] = $user->photo; 
		$_SESSION['user_type'] = $user->type; 
		$_SESSION['user_created_at'] = $user->created_at;            

		flash('login_success', 'Welcome, you are successfuly logged in.');    
		redirect('dashboard/index');           
	}


	public function logout()  
	{
		// auth check   
		$this->isLoggedInUser();   

		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_email']); 
		session_destroy();

		flash('logout_success', 'You are now logged out.');
		redirect('admin/login');       
	}       

	public function profile()
	{
		// auth check   
		$this->isLoggedInUser();  

		$user = $this->userModel->currentUserById($_SESSION['user_id']);   

		// -------------- for name emain update ---------------- 
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name_email']) ) {

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			$data = [
				'title' => 'Profile', 
				'user' => $user, 
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'name_error' => '', 
				'email_error' => '',  
				'password_error' => ''
			];
		   	

		   	// validte name
			if ( empty($data['name']) ) {
				$data['name_error'] = 'Name is required.'; 
			}  

			// validate email 
			if ( empty($data['email']) ) {
				$data['email_error'] = 'Email is required.';
			} else {
				// valid email address 
				if ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) {
					$data['email_error'] = 'Invalid Email Address.'; 
				}
				// already exist 
				if ( $this->userModel->findUserByEmailExceptThisId($data['email'], $_SESSION['user_id']) ) {  
					$data['email_error'] = 'Email is already taken.';   
				} 
			}
			$hashPassword = null; 
			//validate password 
			if ( empty($data['password']) ) {  
				$data['password_error'] = 'Password is required.'; 
			} else { 
				if (!password_verify($data['password'] ,$user->password) ) {   
					$data['password_error'] = 'Wrong Password!';         
				}  
			}
		   	// make sure has no error
		   	if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error'])) {
		   		// process 
		   		if ($this->userModel->currentUserUpdate($data, $_SESSION['user_id']) ) { 
		   			flash('message', 'User info has been updated.'); 
		   			redirect('admin/profile'); 
		   		} else {
		   			die('Something went wrong!');
		   		}

		   	} else {
		   		// load view with error
		   		$this->view('backend/users/profile', $data);   
		   	}
		}  else { // get request 
			$data = [
				'title' => 'Profiles',
				'user' => $user, 
				'password_error' => '',  
				'name_error' => '', 
				'email_error' => '',  
				'password_error' => ''
			];

			$this->view('backend/users/profile', $data);   
		}
	}  

	public function update($id)   
	{
		// auth check   
		$this->isLoggedInUser();

		$user = $this->userModel->getUserById($id);         

		if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  

			$data = [  
				'title' => 'Users update',
				'user' => $user, 
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']), 
				'type' => trim(strtolower($_POST['type'])),             
				'created_at' => date('Y-m-d H:i:s'),              
				'name_error' => '',
				'email_error' => '', 
				'type_error' => '',
				'type_success' => '' 
			];  

			// validte name
			if (empty($data['name'])) {
				$data['name_error'] = 'Name is required.';
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
				if ($this->userModel->findUserByEmailExceptThisId($data['email'], $id)) { 
					$data['email_error'] = 'Email is already taken.';     
				} 
			} 


			if (empty($data['type'])) {
				$data['type_error'] = 'User type is required.';  
			} elseif ($data['type'] == 'superadmin' && $data['type'] == 'admin') {   
				$data['type_error'] = 'Opps! Invalid Data.'; 
			} 

			if ( $this->userModel->isSuperAdmin($id) ) { // this it type is superadmin  and ID same 
					$data['type_success'] = 'Welcome Superadmin. Please keep it.';        
					$data['type'] = 'superadmin';     
			} else {    
				$data['type'] = 'admin';   
			}
			

			// Makes sure errors are empty    
			if ( empty($data['name_error']) && empty($data['email_error']) && empty($data['type_error']) ) {        
		
				// Register User
				if($this->userModel->update($data, $id)) { // receive true/false 
					flash('message', 'User info has been updated.');           
					redirect('admin/index');          
				} else {
					die('Something went wrong!');    
				} 
			} else {
				// load view with errors 
				$this->view('backend/users/edit', $data);         
			}
			
		} else { // get request 
			$data = [
				'title' => 'Users update', 
				'user' => $user,      
				'name_error' => '',
				'email_error' => '',
				'type_error' => '', 
				'type_success' => ''
			];
			$this->view('backend/users/edit', $data);          
		}
	}

	public function photo($id)
	{
		// auth check   
		$this->isLoggedInUser(); 
		
		$user = $this->userModel->getUserById($id);   

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [ 
				'title' => 'User Photo Update', 
				'user' => $user,
				'photo' => $_FILES['photo'],    
				'photo_error' => '' 
			];  
	

			// Allow certain file formats
			$imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION)); 

			if (empty($imageFileType) || $_FILES['photo'] == NULL) { 
				$data['photo_error'] = 'Photo is required';     
			}  

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) { 
			    
				$data = [ 
					'user' => $user, 
					'photo_error' => 'Please upload image file.'   
				];

				$this->view('backend/users/photo', $data);   
			}    
			// Check file size 
			elseif ($_FILES["photo"]["size"] >= 500000) { // 500KB 
				$data = [ 
					'user' => $user,  
					'photo_error' => 'Sorry, your file is too large than 500KB.'   
				];
				$this->view('backend/users/photo', $data); 

			} else {	   
				// image rename and upload process 
				$name = $_FILES['photo']['name'];
				$tmp_name = $data['photo']['tmp_name'];
				$type = $_FILES['photo']['type']; 
				$size = $_FILES['photo']['size'];   

				// rename 
				$newName = date('Y-m-d_H-i-s')."_".uniqid();        
				$ext = pathinfo($name, PATHINFO_EXTENSION); 
				$newName = $newName.".".$ext; // name with extension 
				$fileNameWithUploadDir = '../public/uploads/admin/'.$newName;                 

				// for database  
				$data['photo'] = $newName; // for database    

				if ( empty($data['photo_error'])) {
					move_uploaded_file($tmp_name, $fileNameWithUploadDir);   

					// database update 
					if($this->userModel->photo($data, $id)) { // receive true/false 
						flash('success', 'Photo has been changed.');       
						redirect('admin/index');           
					} else {
						die('Something went wrong!');     
					} 
				}    
			}  
		
		} else { // get request 
			$data = [
				'title' => 'User Photo Update', 
				'user' => $user, 
				'photo' => '',
				'photo_error' => '' 
			];
			$this->view('backend/users/photo', $data);     
		}

	} // end photo change method   

	
	public function password($id)
	{
		// auth check   
		$this->isLoggedInUser();  

		$user = $this->userModel->currentUserById($_SESSION['user_id']);    

		// -------------- for name emain update ---------------- 
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			$data = [
				'title' => 'Change Password', 
				'user' => $user, 
				'password' => trim($_POST['password']),  
				'conf_password' => trim($_POST['conf_password']),  
				'curent_password' => trim($_POST['curent_password']), 
				'password_error' => '',
				'confirm_password_error' => '', 
				'curent_password_error' => '' 
			];
		   	

			$hashPassword = null;  

			//validate password 
			if ( empty($data['password']) ) {  
				$data['password_error'] = 'Password is required.';   
			}  elseif(strlen($data['password']) < 6 ) {
				$data['password_error'] = 'Password is to short. please more than 6 characters';  
			}

			if ( empty($data['conf_password']) ) {  
				$data['confirm_password_error'] = 'Confirm Password is required.';  
			} else { 

				if ( $data['password'] != $data['conf_password'] ) {       
					$data['confirm_password_error'] = 'Password did not match!';           
				}    
			} 

			if ( empty($data['curent_password']) ) {   
				$data['curent_password_error'] = 'Current Password is required.'; 
			} else { 
				if (!password_verify($data['curent_password'] , $user->password) ) {    
					$data['curent_password_error'] = 'Wrong Password!';         
				}  
			}

		   	// make sure has no error
		   	if (empty($data['password_error']) && empty($data['confirm_password_error']) && empty($data['curent_password_error'])) {

		   		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);     

		   		// process 
		   		if ($this->userModel->currentUserPasswordUpdate($data, $_SESSION['user_id']) ) {  
		   			flash('message', 'User password has been updated.');    
		   			redirect('admin/profile'); 
		   		} else {
		   			die('Something went wrong!');
		   		}

		   	} else {
		   		// load view with error
		   		$this->view('backend/users/password', $data);    
		   	}

		}  else { // get request 
		

			$data = [
				'title' => 'Change Password', 
				'user' => $user,   
				'password_error' => '',
				'confirm_password_error' => '',  
				'curent_password_error' => '' 
			];

			$this->view('backend/users/password', $data);        
		}
	}  
	
} // end of the class 