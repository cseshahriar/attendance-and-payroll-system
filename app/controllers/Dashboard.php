<?php 
/**
 * Dashboard Controller 
 */
class Dashboard extends Controller  
{
	
	public function __construct() 
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");       
		}

		$this->dashboardModel = $this->model('DashboardModel');     
	}

	public function index()
	{
		$numbersOfEmployees = $this->dashboardModel->employeeCount();  
		$data = [
			'title' => 'Dashboard',
			'numbersOfEmployees' => $numbersOfEmployees    
		];
		
		$this->view('backend/dashboard', $data);         
	}
}