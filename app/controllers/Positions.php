<?php 
/**
 * 
 */
class Positions extends Controller
{
	
	public function __construct()
	{
		
	}

	public function index()
	{
		$data = [
			'title' => 'Positions' 
		];
		$this->view('backend/position/index', $data);       
	}
}