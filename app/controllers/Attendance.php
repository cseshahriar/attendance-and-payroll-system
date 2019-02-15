<?php
/**
 * Attendence Controller
 */
class Attendance extends Controller   
{
	public $in_time = NULL;
	public $out_time = NULL;  

	public function __construct()
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");       
		}

		$this->attendanceModel = $this->model('AttendanceModel');   
		$this->frontModel = $this->model('FrontModel');     
	} 

	public function index()
	{
		$attendances = $this->attendanceModel->attendances(); 
		$employees = $this->attendanceModel->employees();  

		$data = [
			'attendances' => $attendances,
			'employees' =>  $employees,
			'title' => 'Attendance' 
		];
		$this->view('backend/attendance/index', $data);   
	}

	public function create() 
	{	
		$employees = $this->attendanceModel->employees();      

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
				'status'	  => $_POST['status'],        
				'employee_error' => '',  
				'date_error' => '',
				'intime_error' => '',
				'status_error' => '',
				'already_present_error' => ''
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

			if ( empty($data['status']) && $data['status'] != 0) {
				$data['status_error'] = 'Status is required.';  
			}  elseif($data['status'] != 1 && $data['status'] != 0) {   
				$data['status_error'] = 'Opps!, Invalid Formate.';    
			} else {
				$data['status'] = trim($_POST['status']);   
			}

			if ($this->attendanceModel->alreadySubmitAttendance($data['employee_id'], $data['created_at'])) {
				$data['already_present_error'] = 'This Employee Attendance already submitted.';   
			}

			// Makes sure errors are empty 
			if ( empty($data['employee_error']) && empty($data['date_error']) && empty($data['intime_error']) && empty($data['status_error']) && empty($data['already_present_error']) )  {   

				// prcess  
				if($this->attendanceModel->create($data)) { // receive true/false 
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
				'status_error' => '',
				'already_present_error' => '' 
			];
			$this->view('backend/attendance/create', $data);     
		} 
	}

	public function edit($id) 
	{	  
		$attendance = $this->attendanceModel->findById($id);           

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
				'status'	  => $_POST['status'],         
				'date_error' => '',
				'intime_error' => '',
				'outtime_error' => '',
				'status_error' => '' 
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

			if ( empty($data['status']) && $data['status'] != 0) {
				$data['status_error'] = 'Status is required.';  
			}  elseif($data['status'] != 1 && $data['status'] != 0) {   
				$data['status_error'] = 'Opps!, Invalid Formate.';    
			} else {
				$data['status'] = trim($_POST['status']);   
			}

			// Makes sure errors are empty 
			if ( empty($data['date_error']) && empty($data['intime_error']) && empty($data['outtime_error']) && empty($data['status_error']) ) {     
				// prcess  
				if($this->attendanceModel->update($data, $id)) {     
					
					$this->workingHoursCal($id);  // attendance it    

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
				'outtime_error' => '',
				'status_error' => ''  
			];
			$this->view('backend/attendance/edit', $data);        
		} 
	}

	public function workingHoursCal($id)     
	{ 
		// -------------------- working hours calculation --------------- 
		$attendanceData = $this->frontModel->attendanceById($id);          
		
		$this->in_time = strtotime($attendanceData->in_time);        
		$this->out_time = strtotime($attendanceData->out_time);            

		$employeeId = $attendanceData->employee_id;     
		$employee_attendance_date = $attendanceData->created_at;       
		
		// employee in_time, out_time 
		$employeeData = $this->frontModel->employeeById($employeeId);      
		$employee_start_time  = strtotime($employeeData->in_time);   
		$employee_end_time    = strtotime($employeeData->out_time);            
		
		// if employee strting time > attendance starting time 
		if ($employee_start_time  > $this->in_time) {    
			$this->in_time = $employee_start_time;    
		} 

		// if employee ending time < attendance ending time 
		if ($employee_end_time  < $this->out_time) {  
			$this->out_time = $employee_end_time;      
		} 

		$workingTime = $this->timeDiff($this->in_time, $this->out_time);             

		$this->frontModel->employeeWorkingHours($workingTime, $id);         
		// -------------------- end working hours calculation ---------------  
	} 

	 public function timeDiff($start, $end) {      
	    // Convert $start and $end into EN format (ISO 8601)  
	    $start  = date('H:i:s',$start);  
	    $end    = date('H:i:s',$end);  
	    
	    $d_start    = new DateTime($start); 
	    $d_end      = new DateTime($end); 
	    
	    //$diff      = $d_start->diff($d_end);     
	    $diff      = date_diff($d_start, $d_end);        
	     
	    // return all data 
	    $date = [
	        'hour'     => $diff->format('%h'), 
	        'min'      => $diff->format('%i'), 
	        'sec'      => $diff->format('%s')
	    ];
	    
	    $times = $date['hour'].":".$date['min'].":".$date['sec']; 

	    return $times;  
	} 


	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->attendanceModel->destroy($id)) {
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