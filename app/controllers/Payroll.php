<?php 
/**
 * Payroll Controller
 */
class Payroll extends Controller 
{
	
	public function __construct()  
	{
		// $this->userModel = $this->model('PayrollModel');   
	}

	public function index() 
	{
		// auth check   
		$this->isLoggedInUser();   
		
		$data = [
			'title' => 'Payroll',
		];

		$this->view('backend/payroll/index', $data);      

	}

} // end of the class 