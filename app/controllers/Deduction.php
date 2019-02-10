<?php 
/**
 * 
 */
class Deduction extends Controller
{
	
	public function __construct()
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");      
		}
		$this->deductionModel = $this->model('DeductionModel');    
	}

	/**
	 * [index deduction list]
	 * @return [type] [description]
	 */
	public function index()
	{
		$deductions = $this->deductionModel->deductions(); 
		$data = [
			'title' => 'Deductions',
			'deductions' => $deductions 
		];
		$this->view('backend/deduction/index', $data);    
	}

	/**
	 * [create brand new Deductions]
	 * @return [type] [description]
	 */
	public function create() 
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);   

			$data = [
				'title' => 'Positiom create',
				'description' => trim($_POST['description']),
				'amount' => trim($_POST['amount']),   
				'description_error' => '', 
				'amount_error' => ''  
		
			];   

			if (empty($data['description'])) {
				$data['description_error'] = 'Description is required.';  
			} 

			if (empty($data['amount'])) {
				$data['amount_error'] = 'Rate is required.';      
			} elseif ( !is_numeric($data['amount'])) {
				$data['amount_error'] = 'Invalid formate, please type decimal number.';   
			}

			if (empty($data['description_error']) && empty($data['amount_error'])) {
				// process 
				
				if ($this->deductionModel->store($data)) {      
					flash('success', 'Deduction successfully created.');  
					redirect('deduction/index');        
				} else {
					die('Something went wrong!'); 
					redirect('deduction/index');    
				} 

			} else { // load with errors
				$this->view('backend/deduction/create', $data);    
			} 

		} else { // if get request
			$data = [
				'title' => 'Deduction create',  
				'description' => '',
				'amount' => '', 
				'description_error' => '',
				'amount_error' => ''
		
			];

			$this->view('backend/deduction/create', $data); 
		}
	}

	/**
	 * [edit deduction by id]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function edit($id) 
	{
		$deduction = $this->deductionModel->findById($id);     
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			$data = [ 
				'title' => 'Position Edit',
				'deduction' => $deduction,      
				'description' => trim($_POST['description']), 
				'amount' => trim($_POST['amount']),
				'description_error' => '', 
				'amount_error' => ''  
			];  

			if (empty($data['description'])) {
				$data['description_error'] = 'Description is required.';  
			} 

			if (empty($data['amount'])) { 
				$data['amount_error'] = 'Amount is required.';  
			} elseif(! is_numeric($data['amount'])) {
				$data['amount_error'] = 'Invalid formate, please type decimal number.'; 
			} 

			if (empty($data['description_error']) && empty($data['amount_error'])) {   
				// process 
				
				if ($this->deductionModel->update($data, $id)) {  
					flash('success', 'Deduction successfully updated.');   
					redirect('deduction/index');       
				} else {
					die('Something went wrong!');   
					redirect('deduction/index');      
				} 

			} else { // load with errors  
				$this->view('backend/deduction/edit', $data);      
			}

		} else { // if get request
			$data = [
				'title' => 'Position Edit', 
				'deduction' => $deduction,    
				'description_error' => '',   
				'amount_error' => ''   
			];

			$this->view('backend/deduction/edit', $data);          
		}
	}
	/**
	 * [delete deduction by id]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->deductionModel->destroy($id)) { 
				flash('success', 'Deduction has been removed.');  
				redirect('deduction/index');       
			} else {
				die('Something went wrong'); 
			}
		} else {
			redirect('deduction/index');        
		}
	}
}