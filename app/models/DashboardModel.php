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

	public function employeeCount()
	{
		$this->db->query("SELECT COUNT(id) as numberOfEmployees FROM employees");  
		$row = $this->db->single();
		return $row; 
	}
}