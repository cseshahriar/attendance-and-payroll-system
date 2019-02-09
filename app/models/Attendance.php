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

	public function employees()
	{
		$this->db->query("SELECT employee_id FROM employees");  
		$rows = $this->db->get();
		return $rows;   
	}

	public function create($data)
	{
		$this->db->query("INSERT INTO attendance(employee_id, date, in_time, out_time) VALUES(:employee_id, :date, :in_time, :out_time)");
		// Bind values
		$this->db->bind(':employee_id', $data['employee_id']);
		$this->db->bind(':date', $data['date']);
		$this->db->bind(':in_time', $data['in_time']);
		$this->db->bind(':out_time', $data['out_time']); 
		// Execute
		if($this->db->execute()) {  
			return true;
		} else {
			return false;    
		}
	}

	public function update($data)  
	{
		$this->db->query("UPDATE attendance SET date=:date, in_time=:in_time, out_time=:out_time, status=:status WHERE id=:id"); 
		// Bind values
		$this->db->bind(':id', $data['id']); 
		$this->db->bind(':date', $data['date']); 
		$this->db->bind(':in_time', $data['in_time']);
		$this->db->bind(':out_time', $data['out_time']); 
		$this->db->bind(':status', $data['status']); 

		// Execute
		if($this->db->execute()) {  
			return true;
		} else {
			return false;    
		} 
	}

	public function destroy($id) 
	{
		$this->db->query('DELETE FROM attendance WHERE id=:id');
		$this->db->bind(':id', $id);  

		if ($this->db->execute()) {  
			return true;  
		} else {
			return false;     
		}

	}
}