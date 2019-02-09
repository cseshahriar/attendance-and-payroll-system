<?php 
/**
 * 
 */
class Deductions extends Controller
{
	
	public function __construct()
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");      
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Deductions' 
		];
		$this->view('backend/deduction/index', $data);    
	}
}