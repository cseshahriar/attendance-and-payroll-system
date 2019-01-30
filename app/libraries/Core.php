<?php 
/**
 * App core Class
 * Creates Urls & loads core controller
 * URL FROMAT - /controller/method/params
 * Author : <cse.shahriar.hosen@gmail.com>
 */
class Core
{
	protected $currentController = 'Pages'; // default controller 
	protected $currentMethod = 'index'; // default method 
	protected $params = [];

	function __construct()
	{
		//print_r($this->getUrl()); 
		$url = $this->getUrl(); 

		// Loking in controller for first value 
		if (file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
		 	// if exists
		 	$this->currentController = ucwords($url[0]); 
		 	// unsert zero index
		 	unset($url[0]); 
		 } 

		 // Require the controller
		 require_once '../app/controllers/'.$this->currentController.'.php';  

		 // instantiate controller class 
		 $this->currentController = new $this->currentController; 

		 // Check for second part of url 
		 if (isset($url[1])) {
		 	// Check to see if method exists in controller
		 	if (method_exists($this->currentController, $url[1])) {
		 		$this->currentMethod = $url[1]; 
		 		unset($url[1]); 
		 	}
		 }

		 // get params
		 $this->params = $url ? array_values($url) : [];

		 // call a callback with array of params 
		 call_user_func_array([$this->currentController, $this->currentMethod], $this->params);  
	}

	public function getUrl() 
	{
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url =filter_var($url, FILTER_SANITIZE_URL);    
			$url = explode('/', $url);
			return $url; 
		}
	}
}