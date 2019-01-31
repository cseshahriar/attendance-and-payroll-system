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
		$positions = $this->employeeModel->positions(); 
		$schedules = $this->employeeModel->schedules();  
		$data = [
			'title' => 'Employees', 
			'employees' => $employees,
			'positions' => $positions, 
			'schedules' => $schedules
		];
		$this->view('backend/employee/index', $data);
	}
}