<?php
/**
 * Overtime Controller
 */
class Overtime extends Controller   
{
	
	public function __construct()
	{
		$this->overtimeModel = $this->model('OvertimeModel'); 
		$this->employeeModel = $this->model('EmployeeModel');    
	} 

	public function index() 
	{
		$overtimes = $this->overtimeModel->overtimes(); 
		$data = [
			'overtimes' => $overtimes,  
			'title' => 'Overtimes' 
		];
		$this->view('backend/overtime/index', $data);         
	}

	public function create()
	{
		$employees = $this->employeeModel->employeesId();
	
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);    

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		 
			$data = [
				'title'			=> 'Overtime Create',
				'employees' 	=> $employees,
				'employee_id'  	=> $_POST['employee_id'],
				'hours'  		=> date('H:i:s', strtotime($_POST['hours'])),  
				'rate'  		=> floatval($_POST['rate']),   
				'overtime_date' => date('Y-m-d', strtotime($_POST['overtime_date'])),          
				'overtime_date_error'  => '',    
				'hours_error'   => '', 
				'rate_error'    => ''       
			];        

			// validations 
			if (empty($data['hours'])) { 
				$data['hours_error'] = 'Time is required.';   
			}

			if (empty($data['rate'])) {
				$data['rate_error'] = 'Rate is required.';
			}   
			if (empty($data['overtime_date'])) {
				$data['overtime_date_error'] = 'Date is required.'; 
			} 


			// make sure no errors 
			if ( empty($data['overtime_date_error']) && empty($data['hours_error']) && empty($data['rate_error']))
			{   
				
				// data process 
				if ($this->overtimeModel->store($data)) {
					flash('success', 'Overtime has been created.');      
					redirect('overtime/index');        
				} else {
					die('Something went wrong!');
				}
			
		
			} else { // load view with errors 
				$this->view('backend/overtime/create', $data); 
			}
		 
		} else { //get request 
			$data = [
				'title' => 'Overtime Create',
				'employees' => $employees,
				'employee_id'  => '',
				'overtime_date'  => '',
				'hours'  => '', 
				'rate'  => '',
				'overtime_date_error'  => '',
				'hours_error'  => '',
				'rate_error'  => '', 
			];  
			$this->view('backend/overtime/create', $data);  
		}
	}

	public function edit($id) 
	{
		$overtime = $this->overtimeModel->overtimeFindById($id);
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$data = [
				'title' => 'Overtime Edit',
				'overtime' => $overtime,
				'hours'  		=> date('H:i:s', strtotime($_POST['hours'])),  
				'rate'  		=> floatval($_POST['rate']),   
				'overtime_date' => date('Y-m-d', strtotime($_POST['overtime_date'])),          
				'overtime_date_error'  => '',    
				'hours_error'   => '', 
				'rate_error'    => ''       
			];

			// validations 
			if (empty($data['hours'])) {  
				$data['hours_error'] = 'Time is required.';   
			}

			if (empty($data['rate'])) {
				$data['rate_error'] = 'Rate is required.';
			}   
			if (empty($data['overtime_date'])) {
				$data['overtime_date_error'] = 'Date is required.';   
			} 


			// make sure no errors 
			if ( empty($data['overtime_date_error']) && empty($data['hours_error']) && empty($data['rate_error']))
			{   
				
				// data process 
				if ($this->overtimeModel->update($data, $id)) {
					flash('success', 'Overtime has been updated.');      
					redirect('overtime/index');        
				} else {
					die('Something went wrong!');   
				}
		
			} else { // load view with errors 
				$this->view('backend/overtime/edit', $data);  
			}
			
		} else {
			$data = [
				'title' => 'Overtime Edit',
				'overtime' => $overtime,
				'hours_error' => '',
				'rate_error' => '',
				'overtime_date_error' => '',

			];
			$this->view('backend/overtime/edit', $data);  
		}

	}
}