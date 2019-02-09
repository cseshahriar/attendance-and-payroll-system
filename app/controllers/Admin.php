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
				'confirm_password_error' => '',
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
					$data['email_error'] = 'Email is aready taken.';
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

} // end of the class 