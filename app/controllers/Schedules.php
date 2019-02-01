<?php 
/**
 * 
 */
class Schedules extends Controller
{
	
	public function __construct()
	{
		
	}

	public function index()
	{
		$data = [
			'title' => 'Schedules' 
		];
		$this->view('backend/schedule/index', $data);  
	}
}