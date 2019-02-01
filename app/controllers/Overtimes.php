<?php
/**
 * Overtime Controller
 */
class Overtimes extends Controller   
{
	
	public function __construct()
	{
		$this->attendenceModel = $this->model('Overtime'); 
	} 

	public function index()
	{
		$overtimes = $this->attendenceModel->overtimes(); 
		$data = [
			'overtimes' => $overtimes, 
			'title' => 'Overtimes'
		];
		$this->view('backend/overtime/index', $data);       
	}
}