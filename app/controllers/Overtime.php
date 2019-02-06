<?php
/**
 * Overtime Controller
 */
class Overtime extends Controller   
{
	
	public function __construct()
	{
		$this->overtimeModel = $this->model('OvertimeModel'); 
	} 

	public function index() 
	{
		$overtimes = $this->overtimeModel->overtimes(); 
		$data = [
			'overtimes' => $overtimes,  
			'title' => 'Overtimes' 
		];
		$this->view('backend/overtime/index', $data);         
	}
}