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
}