<?php 
/**
 * Schedule Model 
 */
class ScheduleModel extends Database    
{
	private $db;
	
	public function __construct() 
	{
		$this->db = new Database;    
	} 

	/**
	 * [schedules collections of schedules]
	 * @return [object] [return all schedules]
	 */
	public function schedules()
	{
		$this->db->query('SELECT * FROM schedules');  
		$rows = $this->db->get();
		return $rows;  
	}

	public function store($data)  
	{
		$this->db->query("INSERT INTO schedules(in_time, out_time) VALUES(:in_time, :out_time)"); 

		$this->db->bind(':in_time', $data['in_time']);
		$this->db->bind(':out_time', $data['out_time']);

		if ($this->db->execute()) {         
			return true;
		} else {
			return false;
		}
	}


	public function update($data, $id)     
	{
		$this->db->query("UPDATE schedules SET in_time=:in_time, out_time=:out_time WHERE id=:id"); 

		$this->db->bind(':id', $id); 
		$this->db->bind(':in_time', $data['in_time']);
		$this->db->bind(':out_time', $data['out_time']);

		if ($this->db->execute()) {           
			return true;
		} else {
			return false; 
		}
	}

	public function findById($id) 
	{
		$this->db->query("SELECT * FROM schedules WHERE id=:id");
		$this->db->bind(':id', $id);
		$row = $this->db->single();  
		return $row;    
	}

	public function destroy($id) 
	{
		$this->db->query('DELETE FROM schedules WHERE id=:id'); 
		$this->db->bind(':id', $id);   

		if ($this->db->execute()) {  
			return true;  
		} else {
			return false;     
		}

	}
}
