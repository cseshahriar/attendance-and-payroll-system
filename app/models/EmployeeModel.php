<?php 
/**
 * 
 */
class EmployeeModel extends Database 
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
		$this->db->query("SELECT id, in_time, out_time FROM schedules");     
		$rows = $this->db->get();
		return $rows;   
	}

	public function employeeStore($data)    
	{

		$this->db->query("INSERT INTO employees(employee_id, firstname, lastname, address, birthdate, contact_info, gender, position_id, schedule_id, photo) 
			VALUES (:employee_id, :firstname, :lastname, :address, :birthdate, :contact_info, :gender,  :position_id, :schedule_id, :photo )");   

		$this->db->bind(':employee_id', $data['employee_id']); 
		$this->db->bind(':firstname', $data['firstname']);
		$this->db->bind(':lastname', $data['lastname']);
		$this->db->bind(':address', $data['address']);
		$this->db->bind(':birthdate', $data['birthdate']);
		$this->db->bind(':contact_info', $data['contact_info']);
		$this->db->bind(':gender', $data['gender']);
		$this->db->bind(':position_id', $data['position_id']);  
		$this->db->bind(':schedule_id', $data['schedule_id']); 
		$this->db->bind(':photo', $data['photo']);    

		if ($this->db->execute()) {
			return true;
		} else {
			return false;   
		}  
	}
}