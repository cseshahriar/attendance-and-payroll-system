<?php 
/**
 * 
 */
class cashAdvanceModel extends Database
{
	private $db; 
	public function __construct() 
	{
		$this->db = new Database; 
	} 

	public function cashadvances()
	{
		// query ok but not desc for datatable js 
		$this->db->query("SELECT cashadvances.*, employees.firstname, employees.lastname FROM cashadvances INNER JOIN employees ON cashadvances.employee_id=employees.employee_id ORDER BY cashadvances.created_at DESC");   
		$rows = $this->db->get();      
		return $rows;    
	}

	public function store($data)
	{
		$this->db->query("INSERT INTO cashadvances(date_advance, employee_id, amount) VALUES(:date_advance, :employee_id, :amount)"); 
		
		$this->db->bind(':date_advance', $data['date_advance']);  
		$this->db->bind(':employee_id', $data['employee_id']); 
		$this->db->bind(':amount', $data['amount']); 

		if($this->db->execute()) { 
			return true; 
		} else {
			return false;  
		}
	}

	public function findById($id)
	{
		$this->db->query("SELECT cashadvances.*, employees.firstname, employees.lastname FROM cashadvances INNER JOIN employees ON cashadvances.employee_id=employees.employee_id WHERE cashadvances.id=:id");     
		$this->db->bind(':id', $id);
		$row = $this->db->single(); 
		return $row;   
	}

	public function update($data, $id)
	{
		$this->db->query("UPDATE cashadvances SET date_advance=:date_advance, amount=:amount WHERE id=:id");
		$this->db->bind(':id', $id); 
		$this->db->bind(':date_advance', $data['date_advance']); 
		$this->db->bind(':amount', $data['amount']); 
		if ($this->db->execute()) {
		 	return true;
		 }  else {
		 	return false; 
		 }
	}

	public function destroy($id)
	{
		$this->db->query("DELETE FROM cashadvances WHERE id=:id"); 
		$this->db->bind(':id', $id);
		if ($this->db->execute()) {   
		 	return true;
		 }  else {
		 	return false; 
		 }
	}
}