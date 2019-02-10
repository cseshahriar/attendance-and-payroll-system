<?php
/**
 * Attendence Controller
 */
class Attendance extends Controller   
{
	
	public function __construct()
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");       
		}
		
		$this->attendenceModel = $this->model('AttendanceModel');   
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
		$employees = $this->attendenceModel->employees();     

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
			// sanitize post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
			
			// init data 
			$data = [
				'title' => 'Attendance Create',
				'employees' => $employees,
				'employee_id' => trim($_POST['employee_id']),     
				'created_at'  => $_POST['created_at'], 
				'in_time'     => $_POST['in_time'], 
				'out_time'    => $_POST['out_time'],   
				'status'	  => '1',      
				'employee_error' => '', 
				'date_error' => '',
				'intime_error' => '',
				'outtime_error' => '' 
			]; 

			// validation
			if (empty($data['employee_id'])) {   
				$data['employee_error'] = 'Employee ID is required.'; 
			} 

			if (empty($data['created_at'])) { 
				$data['date_error'] = 'Date is required.';
			} else {
				$data['created_at'] = date('Y-m-d', strtotime($_POST['created_at']));   
			} 

			if (empty($data['in_time'])) {
				$data['intime_error'] = 'In Time required.';
			} else {
				$data['in_time'] = date('H:i:s', strtotime($_POST['in_time']));  
			}  

			if (empty($data['out_time'])) {
				$data['outtime_error'] = 'Out Time is required.'; 
			}  else {
				$data['out_time'] = date('H:i:s', strtotime($_POST['out_time']));  
			} 

			// Makes sure errors are empty 
			if ( empty($data['employee_error']) && empty($data['date_error']) && empty($data['intime_error']) && empty($data['outtime_error']) ) {  

				// prcess  
				if($this->attendenceModel->create($data)) { // receive true/false 
					flash('success', 'Attedance has created', 'alert alert-success alert-dismissible');        
					redirect('attendance/index');         
				} else { 
					die('Something wend wrong'); 
					$this->view('backend/attendance/create', $data);        
				}
				
			} else { // load view with errors
				$this->view('backend/attendance/create', $data);       
			} 

		}  else { // if get request 
			$data = [
				'title' => 'Attendance Create',
				'employees' => $employees,
				'employee_error' => '', 
				'date_error' => '',
				'intime_error' => '',
				'outtime_error' => ''  
			];
			$this->view('backend/attendance/create', $data);     
		} 
	}

	public function edit($id) 
	{	  
		$attendance = $this->attendenceModel->findById($id);           

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {   
			// sanitize post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
			
			// init data 
			$data = [
				'title' => 'Attendance Create',
				'attendance' => $attendance,        
				'created_at'  => $_POST['created_at'], 
				'in_time'     => $_POST['in_time'], 
				'out_time'    => $_POST['out_time'],   
				'status'	  => 1,      
				'date_error' => '',
				'intime_error' => '',
				'outtime_error' => '' 
			]; 

			// validation 
			if (empty($data['created_at'])) { 
				$data['date_error'] = 'Date is required.';
			} else {
				$data['created_at'] = date('Y-m-d', strtotime($_POST['created_at']));   
			} 

			if (empty($data['in_time'])) {
				$data['intime_error'] = 'In Time required.';
			} else {
				$data['in_time'] = date('H:i:s', strtotime($_POST['in_time']));  
			}  

			if (empty($data['out_time'])) {
				$data['outtime_error'] = 'Out Time is required.'; 
			}  else {
				$data['out_time'] = date('H:i:s', strtotime($_POST['out_time']));  
			} 

			// Makes sure errors are empty 
			if ( empty($data['date_error']) && empty($data['intime_error']) && empty($data['outtime_error']) ) {  
				// prcess  
				if($this->attendenceModel->update($data, $id)) { 
					flash('success', 'Attedance has updated');             
					redirect('attendance/index');         
				} else { 
					die('Something wend wrong'); 
					$this->view('backend/attendance/edit', $data);         
				}
				
			} else { // load view with errors
				$this->view('backend/attendance/edit', $data);        
			} 

		}  else { // if get request 
			$data = [
				'title' => 'Attendance Create',
				'attendance' => $attendance,  
				'date_error' => '',
				'intime_error' => '',
				'outtime_error' => ''  
			];
			$this->view('backend/attendance/edit', $data);       
		} 
	}

	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->attendenceModel->destroy($id)) {
				flash('success', 'Attendance has been removed'); 
				redirect('attendance/index');      
			} else {
				die('Something went wrong');
			}
		} else {
			redirect('attendance/index');    
		}
	
	} 

	
}