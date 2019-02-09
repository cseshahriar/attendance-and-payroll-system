<?php 
/**
 * Position Controller
 */
class Position extends Controller 
{
	
	public function __construct() 
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");         
		}

		$this->positinModel = $this->model('PositionModel'); 
	} 

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$positions = $this->positinModel->positions();  
		$data = [
			'title' => 'Positions',
			'positions' => $positions 
		];
		$this->view('backend/position/index', $data);       
	}


	public function create() 
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  

			$data = [
				'title' => 'Positiom create',
				'description' => trim($_POST['description']),
				'rate' => floatval($_POST['rate']), 
				'description_error' => '',
				'rate_error' => ''
		
			];   

			if (empty($data['description'])) {
				$data['description_error'] = 'Description is required.';  
			} 

			if (empty($data['rate'])) {
				$data['rate_error'] = 'Rate is required.';   
			} 

			if (empty($data['description_error']) && empty($data['rate_error'])) {
				// process 
				
				if ($this->positinModel->store($data)) {     
					flash('success', 'Position successfuly created.');  
					redirect('position/index');       
				} else {
					die('Something went wrong!'); 
					redirect('position/index');   
				} 

			} else { // load with errors
				$this->view('backend/position/create', $data);    
			}

		} else { // if get request
			$data = [
				'title' => 'Positiom create', 
				'description' => '',
				'rate' => '', 
				'description_error' => '',
				'rate_error' => ''
		
			];

			$this->view('backend/position/create', $data);
		}
	}

	public function edit($id) 
	{
		$position = $this->positinModel->findById($id);    
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			$data = [ 
				'title' => 'Position Edit',
				'position' => $position,    
				'description' => trim($_POST['description']),
				'rate' => trim(floatval($_POST['rate'])),
				'description_error' => '', 
				'rate_error' => ''  
			];  

			if (empty($data['description'])) {
				$data['description_error'] = 'Description is required.';  
			} 

			if (empty($data['rate'])) { 
				$data['rate_error'] = 'Rate is required.';  
			}   

			if (empty($data['description_error']) && empty($data['rate_error'])) {   
				// process 
				
				if ($this->positinModel->update($data, $id)) {  
					flash('success', 'Positon successfuly updated.');   
					redirect('position/index');      
				} else {
					die('Something went wrong!');   
					redirect('position/index');     
				} 

			} else { // load with errors  
				$this->view('backend/position/edit', $data);     
			}

		} else { // if get request
			$data = [
				'title' => 'Position Edit', 
				'position' => $position,   
				'description_error' => '',   
				'rate_error' => ''  
			];

			$this->view('backend/position/edit', $data);          
		}
	}


	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->positinModel->destroy($id)) { 
				flash('success', 'Positiom has been removed.'); 
				redirect('position/index');      
			} else {
				die('Something went wrong'); 
			}
		} else {
			redirect('position/index');       
		}
	}
}