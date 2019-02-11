<?php 

/**
 * default controller  
 */
class Front extends Controller     
{
	
	public function __construct() 
	{
		// the constructore  
	}

	// default method must have 
	public function index() 
	{   
		$data = [
			'title' => 'SharePosts', 
		]; 
		$this->view('welcome', $data);          
	}    

	public function login() 
	{

	}

}