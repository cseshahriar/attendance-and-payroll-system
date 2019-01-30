<?php 
/**
 * Base Controller 
 * Author: <cse.shahriar.hosen@gmail.com>
 */
class Controller
{
	/**
	 * The Constructor
	 */
	public function __construct()
	{
		# code...
	}

	/**
	 * @param  [model file]
	 * @return [object]
	 */
	public function model($model)
	{
		// require model file
		require_once '../app/models/'.$model.'.php'; 

		// instantiate model 
		return new $model();  // return a obj 
	}

	/**
	 * @param  [view file]
	 * @param  data array
	 * @return [view file with data array]
	 */
	public function view($view, $data = [])
	{
		// check for the view file 
		if (file_exists('../app/views/'.$view.'.php')) {
			require_once '../app/views/'.$view.'.php'; 
		} else {
			// Views does not exist 
			die('View does not exists'); 
		}
	}

}