<?php 
/**
 * 
 */
class Deductions extends Controller
{
	
	public function __construct()
	{
		
	}

	public function index()
	{
		$data = [
			'title' => 'Deductions' 
		];
		$this->view('backend/deduction/index', $data);    
	}
}