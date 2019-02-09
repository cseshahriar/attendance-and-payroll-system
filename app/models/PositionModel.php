<?php 
/**
 * Schedule Model 
 */
class PositionModel extends Database     
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
	public function positions() 
	{
		$this->db->query('SELECT * FROM positions');  
		$rows = $this->db->get(); 
		return $rows;   
	}

	public function store($data)  
	{
		$this->db->query("INSERT INTO positions(description, rate) VALUES(:description, :rate)"); 

		$this->db->bind(':description', $data['description']);
		$this->db->bind(':rate', $data['rate']);  

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
		$this->db->query("SELECT * FROM positions WHERE id=:id");   
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
		$this->db->query("UPDATE positions SET description=:description, rate=:rate WHERE id=:id");    
		$this->db->bind(':id', $id); 
		$this->db->bind(':description', $data['description']);
		$this->db->bind(':rate', $data['rate']);

		if ($this->db->execute()) {              
			return true;
		} else {
			return false; 
		}
	}


	public function destroy($id)  
	{
		$this->db->query('DELETE FROM positions WHERE id=:id');  
		$this->db->bind(':id', $id);  

		if ($this->db->execute()) {      
			return true;  
		} else {
			return false;     
		}

	} 
}
