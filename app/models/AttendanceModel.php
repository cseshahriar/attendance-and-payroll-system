<?php
/**
 * 
 */
class AttendanceModel extends Database 
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
		$this->db->query("SELECT * FROM employees");   
		$rows = $this->db->get();
		return $rows;   
	}
	
	public function alreadySubmitAttendance($empId, $created_at)
	{
		$this->db->query("SELECT * FROM attendance WHERE employee_id=:employee_id and created_at=:created_at");
		$this->db->bind(':employee_id', $empId); 
		$this->db->bind(':created_at', $created_at);

		$row = $this->db->single();

		if ($this->db->rowCount()) {
		 	return $row;   
		 }  else {
		 	return false; 
		 }
	}

	public function create($data)   
	{
		$this->db->query("INSERT INTO attendance(employee_id, created_at, in_time, status) VALUES(:employee_id, :created_at, :in_time, :status)");     
		// Bind values
		$this->db->bind(':employee_id', $data['employee_id']);
		$this->db->bind(':created_at', $data['created_at']);
		$this->db->bind(':in_time', $data['in_time']);
		$this->db->bind(':status', $data['status']);   
		// Execute
		if($this->db->execute()) {   
			return true;
		} else {
			return false;    
		}
	}

	/**
	 * [findById description] 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function findById($id) 
	{
		$this->db->query("SELECT attendance.*, employees.firstname, employees.lastname FROM attendance INNER JOIN employees ON attendance.employee_id=employees.employee_id WHERE attendance.id=:id");    
		$this->db->bind(':id', $id);
		$row = $this->db->single();   
		return $row;    
	}

	public function update($data, $id)  
	{
		$this->db->query("UPDATE attendance SET created_at=:created_at, in_time=:in_time, out_time=:out_time, status=:status WHERE id=:id"); 
		// Bind values
		$this->db->bind(':id', $id); 
		$this->db->bind(':created_at', $data['created_at']);   
		$this->db->bind(':in_time', $data['in_time']); 
		$this->db->bind(':out_time', $data['out_time']); 
		$this->db->bind(':status', $data['status']);     

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