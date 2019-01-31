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
		$data = [
			'attendances' => $attendances 
		];
		$this->view('backend/attendance/index', $data);   
	}
}