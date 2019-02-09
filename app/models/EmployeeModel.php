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
		$this->db->query("SELECT employees.*,positions.description,schedules.in_time, schedules.out_time 
			FROM `employees` 
			LEFT JOIN positions ON employees.position_id=positions.id 
			LEFT JOIN schedules ON employees.schedule_id=schedules.id;");   
		$rows = $this->db->get();  
		return $rows;  
	}

	public function employeesId()
	{
		$this->db->query("SELECT * FROM employees");     
		$rows = $this->db->get();
		return $rows;    
	}

	// single employee for edit view 
	public function employeeFindById($id)
	{
		
		$this->db->query("SELECT employees.*, positions.id as pid, positions.description, schedules.id as sid,schedules.in_time,schedules.out_time  
			FROM employees
			LEFT JOIN positions ON employees.position_id=positions.id
			LEFT JOIN schedules ON employees.schedule_id=schedules.id  
			WHERE employees.id =:id");
		
			$this->db->bind(':id', $id);
			$result = $this->db->single();    
			return $result;   
	}

	public function positions() 
	{
		$this->db->query("SELECT id, description FROM positions");  
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

	public function employeeUpdate($data, $id)       
	{
		
		$this->db->query("UPDATE employees SET firstname=:firstname, lastname=:lastname, address=:address, birthdate=:birthdate,contact_info=:contact_info,gender=:gender,position_id=:position_id, schedule_id=:schedule_id,photo=:photo WHERE id=:id");      
		  
		$this->db->bind(':id', $id);     
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

	public function destroy($id) 
	{
		$this->db->query('DELETE FROM employees WHERE id=:id');
		$this->db->bind(':id', $id);  

		if ($this->db->execute()) {    
			return true;  
		} else {
			return false;      
		}
	} 

}