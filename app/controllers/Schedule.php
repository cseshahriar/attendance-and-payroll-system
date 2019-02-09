<?php 
/**
 * 
 */
class Schedule extends Controller 
{
	
	public function __construct() 
	{
		$this->scheduleModel = $this->model('ScheduleModel');
	}

	/**
	 * [index schedule list]
	 * @return [object] [schedule collection]
	 */
	public function index()
	{
		$schedules = $this->scheduleModel->schedules();  
		$data = [
			'title' => 'Schedules',
			'schedules' => $schedules  
		];
		$this->view('backend/schedule/index', $data);   
	}

	public function edit($id) 
	{
		$schedule = $this->scheduleModel->findById($id); 
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			$data = [
				'title' => 'Schedule create',
				'schedule' => $schedule,
				'in_time' => date('H:i:s', strtotime($_POST['in_time'])),
				'out_time' => date('H:i:s', strtotime($_POST['out_time'])), 
				'in_time_error' => '',
				'out_time_error' => ''
			];  

			if (empty($data['in_time'])) {
				$data['in_time_error'] = 'In Time is required.';  
			} 

			if (empty($data['out_time'])) {
				$data['out_time_error'] = 'Out Time is required.';  
			} 

			if (empty($data['in_time_error']) && empty($data['out_time_error'])) {
				// process 
				
				if ($this->scheduleModel->update($data, $id)) { 
					flash('success', 'Schedule successfuly updated.');   
					redirect('schedule/index');     
				} else {
					die('Something went wrong!');  
					redirect('schedule/index');  
				} 

			} else { // load with errors  
				$this->view('backend/schedule/edit', $data);    
			}

		} else { // if get request
			$data = [
				'title' => 'Schedule create',
				'schedule' => $schedule,  
				'in_time_error' => '',
				'out_time_error' => ''   
			];

			$this->view('backend/schedule/edit', $data);
		}
	}

	public function create()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

			$data = [
				'title' => 'Schedule create',
				'in_time' => date('H:i:s', strtotime($_POST['in_time'])),
				'out_time' => date('H:i:s', strtotime($_POST['out_time'])), 
				'in_time_error' => '',
				'out_time_error' => ''
			];  

			if (empty($data['in_time'])) {
				$data['in_time_error'] = 'In Time is required.';  
			} 

			if (empty($data['out_time'])) {
				$data['out_time_error'] = 'Out Time is required.';  
			} 

			if (empty($data['in_time_error']) && empty($data['out_time_error'])) {
				// process 
				
				if ($this->scheduleModel->store($data)) {
					flash('success', 'Schedule successfuly created.'); 
					redirect('schedule/index');     
				} else {
					die('Something went wrong!'); 
					redirect('schedule/index');  
				} 

			} else { // load with errors
				$this->view('backend/schedule/create', $data); 
			}

		} else { // if get request
			$data = [
				'title' => 'Schedule create',
				'in_time_error' => '',
				'out_time_error' => ''   
			];

			$this->view('backend/schedule/create', $data);
		}
	}

	public function delete($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->scheduleModel->destroy($id)) { 
				flash('success', 'Schedule has been removed.'); 
				redirect('schedule/index');      
			} else {
				die('Something went wrong');
			}
		} else {
			redirect('schedule/index');       
		}
	}

}