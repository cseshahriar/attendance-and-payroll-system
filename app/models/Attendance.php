<?php
/**
 * 
 */
class Attendance extends Database
{
	private $db;
	
	public function __construct()   
	{
		$this->db = new Database;  
	}

	public function attendances()
	{
		$this->db->query("SELECT attendance.*, employees.firstname,employees.lastname FROM attendance LEFT JOIN employees ON  attendance.employee_id = employees.employee_id ORDER BY id DESC"); 
		$rows = $this->db->get();  
		return $rows;  	   
	}
}