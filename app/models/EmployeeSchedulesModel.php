<?php 
/**
 * Schedule Model 
 */
class EmployeeSchedulesModel extends Database      
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
	public function employeeSchedules() 
	{
		$this->db->query("SELECT employees.id, employees.employee_id, employees.firstname, employees.lastname, schedules.id as sid, schedules.in_time, schedules.out_time FROM employees INNER JOIN schedules ON employees.schedule_id=schedules.id");    
		$rows = $this->db->get();
		return $rows;  
	}

	/**
	 * [shedules schedules collection] 
	 * @return [type] [description]
	 */
	public function schedules()   
	{
		$this->db->query("SELECT * FROM schedules");         
		$rows = $this->db->get(); 
		return $rows; 
	}

	public function empScheduleById($id)
	{
		$this->db->query("SELECT employees.id, employees.employee_id,employees.firstname,employees.lastname, employees.schedule_id FROM employees WHERE id=:id");
		$this->db->bind(':id', $id);            
		$rows = $this->db->single();    
		return $rows;
	}


	/**
	 * [update employee schedule]  
	 * @param  [type] $data [description]
	 * @param  [type] $id   [description]
	 * @return [type]       [description]
	 */
	public function update($schedule_id, $userId)      
	{
		$this->db->query("UPDATE employees SET schedule_id=:schedule_id WHERE id=:id"); 

		$this->db->bind(':id', $userId);   
		$this->db->bind(':schedule_id', $schedule_id);      
	
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
