<?php 
/**
 * 
 */
class Cashadvances extends Controller
{
	
	public function __construct()
	{
		
	}

	public function index()
	{
		$data = [
			'title' => 'Cash Advance'
		];
		$this->view('backend/cashadvance/index', $data);  
	}
}