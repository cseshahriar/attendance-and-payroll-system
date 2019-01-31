<?php
/**
 * Attendences Controller
 */
class Attendances extends Controller 
{
	
	public function __construct()
	{
		$this->attendenceModel = $this->model('Attendance');
	} 

	public function index()
	{
		$attendances = $this->attendenceModel->attendances(); 
		$employees = $this->attendenceModel->employees();  
		$data = [
			'attendances' => $attendances,
			'employees' =>  $employees,
			'title' => 'Attendance'
		];
		$this->view('backend/attendance/index', $data);   
	}

	public function create()
	{	
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
			// sanitize post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
			
			// init data 
			$data = [
				'employee_id' => trim($_POST['employee_id']),    
				'date' 		  => trim($_POST['date']),
				'in_time'     => date('H:i:s', strtotime($_POST['in_time'])), 
				'out_time'    => date('H:i:s', strtotime($_POST['out_time'])), 
				'status'	  => '1',     
				'employee_error' => '',
				'date_error' => '',
				'intime_error' => '',
				'outtime_error' => '' 
			]; 

			// validte name
			if (empty($data['name'])) { 
				$data['employee_error'] = 'Employee ID is required.'; 
			} 
			if (empty($data['date'])) {
				$data['date_error'] = 'Date is required.';
			} 
			if (empty($data['in_time'])) {
				$data['intime_error'] = 'In Time required.';
			} 
			if (empty($data['out_time'])) {
				$data['outtime_error'] = 'Out Time is required.'; 
			}  

			// Makes sure errors are empty 
			if ( empty($data['employee_error']) || empty($data['date_error']) || empty($data['intime_error']) || empty($data['outtime_error']) ) {

				// Add New
				if($this->attendenceModel->create($data)) { // receive true/false 
					flash('success', 'Attedance has created', 'alert alert-success');                
					redirect('/attendances/index');    
				} else { 
					flash('success', 'Something went wrong!', 'alert alert-danger');
					redirect('/attendances/index');      
				}
				
			} else {
				flash('success', 'Something went wrong!', 'alert alert-danger');
				redirect('/attendances/index');     
			} 

		}  else {
				flash('success', 'Something went wrong!', 'alert alert-danger');
				redirect('/attendances/index');   
		}
	}

	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->attendenceModel->destroy($id)) {
				flash('success', 'Attendance has been removed');
				redirect('/attendances/index');      
			} else {
				die('Something went wrong');
			}
		} else {
			redirect('/attendances/index');   
		}
	
	} 
}