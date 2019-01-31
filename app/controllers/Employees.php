<?php 
/**
 * 
 */
class Employees extends Controller
{
	
	public function __construct() 
	{
		$this->employeeModel = $this->model('Employee'); 
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
}