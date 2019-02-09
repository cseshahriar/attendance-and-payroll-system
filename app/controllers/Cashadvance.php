<?php 
/**
 * 
 */
class Cashadvance extends Controller 
{
	
	public function __construct()
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");      
		}

		$this->cashAdvanceModel = $this->model('cashAdvanceModel');  	  
		$this->employeeModel = $this->model('EmployeeModel');  	   
	}

	public function index()  
	{
		$cashadvances = $this->cashAdvanceModel->cashadvances(); 

		$data = [
			'title' => 'Cash Advances',
			'cashadvances' => $cashadvances 
		];

		$this->view('backend/cashadvance/index', $data);        
	}

	public function create()
	{
		
		$employees = $this->employeeModel->employeesId();  

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  
			
			$data = [
				'title' => 'Cash Advance',
				'employees' => $employees, 
				'date_advance' => $_POST['date_advance'],
				'employee_id' => trim($_POST['employee_id']),
				'amount' => floatval(trim($_POST['amount'])),   
				'date_advance_error' => '',
				'employee_id_error' => '',
				'amount_error' => ''
			];

			if ( empty($data['date_advance'])) {
				$data['date_advance_error'] = 'Date of advance is required.';  
			} else {
				$data['date_advance'] = date('Y-m-d', strtotime($_POST['date_advance']));    
			}

			if ( empty($data['employee_id'])) {
				$data['employee_id_error'] = 'Employee ID is required.';  
			}

			if ( empty($data['amount'])) { 
				$data['amount_error'] = 'Advance amount is required.';
			}

			// make sure no errors 
			if (empty($data['date_advance_error']) && empty($data['employee_id_error']) && empty($data['amount_error']) ) {

				if($this->cashAdvanceModel->store($data) ) {
					flash('success', 'Cash Advance successfully created.');  
					redirect('cashadvance/index');  
				} else {
					die('Something went wrong!');
					redirect('cashadvance/create');   
				}

			} else { // load view with error
				$this->view('backend/cashadvance/create', $data);     
			}
			
		} else { // if get request 
			$data = [
				'title' => 'Cash Advance',
				'employees'	=> $employees,  
				'date_advance' => '',
				'employee_id' => '',
				'amount' => '', 
				'date_advance_error' => '',
				'employee_id_error' => '', 
				'amount_error' => ''
			]; 
			$this->view('backend/cashadvance/create', $data);
		}
	}

	public function edit($id)  
	{
		$employees = $this->employeeModel->employeesId();  
		$cashadvance = $this->cashAdvanceModel->findById($id);   

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  
			
			$data = [
				'title' => 'Cash Advance',
				'employees' => $employees, 
				'date_advance' => $_POST['date_advance'],
				'amount' => floatval($_POST['amount']),       
				'date_advance_error' => '',
				'amount_error' => ''
			];

			if ( empty($data['date_advance'])) {
				$data['date_advance_error'] = 'Date of advance is required.';  
			} else {
				$data['date_advance'] = date('Y-m-d', strtotime($_POST['date_advance']));    
			}

			if ( empty($data['amount'])) { 
				$data['amount_error'] = 'Advance amount is required.';
			}

			// make sure no errors 
			if (empty($data['date_advance_error']) && empty($data['amount_error']) ) {

				if($this->cashAdvanceModel->update($data, $id) ) { 
					flash('success', 'Cash Advance successfully updated.');  
					redirect('cashadvance/index');  
				} else {
					die('Something went wrong!');
					redirect('cashadvance/edit');        
				}

			} else { // load view with error
				$this->view('backend/cashadvance/edit', $data);       
			}
			
		} else { // if get request 
			$data = [
				'title' => 'Cash Advance',
				'employees'	=> $employees,  
				'cashadvance' => $cashadvance, 
				'date_advance' => '',
				'amount' => '', 
				'date_advance_error' => '',
				'amount_error' => ''
			]; 
			$this->view('backend/cashadvance/edit', $data);
		} 
	}

	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->cashAdvanceModel->destroy($id);  
			flash('success', 'Cash advance has been deleted.'); 
			redirect('cashadvance/index');  
		}
	}  
}