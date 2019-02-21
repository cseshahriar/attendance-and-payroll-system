<?php 
/**
 * Deduction Model 
 */
class DeductionModel extends Database      
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
	public function deductions() 
	{
		$this->db->query('SELECT deductions.*, employees.firstname, employees.lastname FROM deductions LEFT JOIN employees ON deductions.employee_id = employees.employee_id  ORDER BY id DESC');    
		$rows = $this->db->get(); 
		return $rows;   
	}

	public function store($data)  
	{
		$this->db->query("INSERT INTO deductions(employee_id, description, amount) VALUES(:employee_id, :description, :amount)"); 

		$this->db->bind(':employee_id', $data['employee_id']);    
		$this->db->bind(':description', $data['description']); 
		$this->db->bind(':amount', $data['amount']);   

		if ($this->db->execute()) {          
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
		$this->db->query("SELECT deductions.*, employees.firstname, employees.lastname FROM deductions LEFT JOIN employees ON deductions.employee_id = employees.employee_id WHERE deductions.id=:id");   

		$this->db->bind(':id', $id); 

		$row = $this->db->single();   
		return $row;    
	}

	/**
	 * [update description]
	 * @param  [array] $data [description]
	 * @param  [id] $id   [description]
	 * @return [true/false]       [description]
	 */
	public function update($data, $id)        
	{
		$this->db->query("UPDATE deductions SET description=:description, amount=:amount WHERE id=:id");    
		$this->db->bind(':id', $id); 
		$this->db->bind(':description', $data['description']);
		$this->db->bind(':amount', $data['amount']);

		if ($this->db->execute()) {              
			return true;
		} else {
			return false; 
		}
	}


	public function destroy($id)   
	{
		$this->db->query('DELETE FROM deductions WHERE id=:id');  
		$this->db->bind(':id', $id);   

		if ($this->db->execute()) {       
			return true;  
		} else {
			return false;     
		}

	} 
} 
