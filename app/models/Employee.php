<?php 
/**
 * 
 */
class Employee extends Database
{
	private $db;
	
	public function __construct()
	{
		$this->db = new Database; 
	}

	public function employees()
	{
		$this->db->query("SELECT employees.*,position.description,schedules.in_time, schedules.out_time FROM `employees` LEFT JOIN position ON employees.position_id=position.id LEFT JOIN schedules ON employees.schedule_id=schedules.id;");  
		$rows = $this->db->get(); 
		return $rows;  
	}

	public function positions()
	{
		$this->db->query("SELECT id, description FROM position");  
		$rows = $this->db->get();
		return $rows;  
	}

	public function schedules()
	{
		$this->db->query("SELECT in_time, out_time FROM schedules");    
		$rows = $this->db->get();
		return $rows;  
	}
}