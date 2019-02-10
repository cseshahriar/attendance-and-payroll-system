<?php
/**
 * 
 */
class DashboardModel extends Database
{
	private $db;

	public function __construct() 
	{
		$this->db = new Database; 	
	}

	/**
	 * [employeeCount How much employee]
	 * @return [count] [Number of employees]
	 */
	public function employeeCount()
	{
		$this->db->query("SELECT COUNT(id) as numberOfEmployees FROM employees");  
		$row = $this->db->single();
		return $row; 
	}


	public function numberOfAttendances()  
	{
		$this->db->query("SELECT COUNT(id) AS numberOfAttendance FROM attendance");   
		$row = $this->db->single();
		return $row; 
	}

	public function numberOfAttendancesInRightTime()  
	{
		$this->db->query("SELECT COUNT(id) AS numberOfAttendance FROM attendance WHERE status=1");     
		$row = $this->db->single();
		return $row; 
	}

	public function todayPresentRightTime()   
	{
		date_default_timezone_set('Asia/Dhaka'); 
		$timezone = date_default_timezone_get();
		$today = date('Y-m-d', time());    

		$this->db->query("SELECT COUNT(id) AS earlyPresent FROM attendance WHERE created_at='$today' AND status=1");      
		$row = $this->db->single(); 
		return $row;  
	}

	public function todayLatePresent()   
	{
		date_default_timezone_set('Asia/Dhaka'); 
		$timezone = date_default_timezone_get();
		$today = date('Y-m-d', time());    

		$this->db->query("SELECT COUNT(id) AS latePresent FROM attendance WHERE created_at='$today' AND status='0' ");        
		$row = $this->db->single();  
		return $row;  
	}
}