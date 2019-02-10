<?php 
/**
 * 
 */
class Employeeschedule extends Controller   
{
	
	public function __construct() 
	{
		// auth check
		if (!isset($_SESSION['user_id'])) {
			header("Location: /admin/login");      
		}

		$this->scheduleScheduleModel = $this->model('EmployeeSchedulesModel');   
	}

	/**
	 * [index schedule list]
	 * @return [object] [schedule collection]
	 */
	public function index()
	{   
		$employeeSchedules = $this->scheduleScheduleModel->employeeSchedules(); 
		$data = [ 
			'title' => 'Employee Schedules', 
			'employeeSchedules' => $employeeSchedules
		];
		$this->view('backend/employeeschedule/index', $data);     
	}

	
	public function edit($id)  
	{
		$empScheduleById = $this->scheduleScheduleModel->empScheduleById($id);          
		$schedules = $this->scheduleScheduleModel->schedules();          
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  

			$data = [
				'title' => 'Employee Schedule Edit',
				'schedules' => $schedules,  
				'empScheduleById' => $empScheduleById, 
				'schedule_id' => trim($_POST['schedule_id']),   
				'schedule_id_error' => ''
			];  

			if (empty($data['schedule_id'])) {
				$data['schedule_id_error'] = 'Schedule ID is required.';  
			} else {
				$data['schedule_id'] = $_POST['schedule_id'];         
			}

			if ( empty($data['schedule_id_error']) ) {   
				// process 
				
				if ( $this->scheduleScheduleModel->update($data['schedule_id'], $id) ) {      
					flash('success', 'Employee Schedule successfully updated.');      
					redirect('employeeschedule/index');      
				} else {
					die('Something went wrong!');  
					redirect('employeeschedule/index');   
				} 

			} else { // load with errors  
				$this->view('backend/employeeschedule/edit', $data);    
			}

		} else { // if get request
			$data = [
				'title' => 'Employee Schedule Edit',
				'schedules' => $schedules,
				'empScheduleById' => $empScheduleById, 
				'schedule_id_error' => ''    
			];

			$this->view('backend/employeeschedule/edit', $data); 
		}
	} 

}