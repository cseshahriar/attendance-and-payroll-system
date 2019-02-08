<?php  
/**
 * 
 */
class OvertimeModel extends Database
{
	private $db;
	
	public function __construct()
	{
		$this->db = new Database;  
	}

	/**
	 * [overtimes description]
	 * @return [type] [description]
	 */
	public function overtimes()
	{
		$this->db->query("SELECT overtime.*, employees.employee_id, employees.firstname, employees.lastname FROM overtime LEFT JOIN employees on overtime.employee_id=employees.id;"); 
		$rows = $this->db->get(); 
		return $rows;  
	}

	/**
	 * [store description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function store($data)    
	{
		
		$this->db->query("INSERT INTO overtime(employee_id, hours, rate, overtime_date) 
			VALUES(:employee_id, :hours, :rate, :overtime_date)");

		$this->db->bind('employee_id', $data['employee_id']);   
		$this->db->bind('hours', $data['hours']);   
		$this->db->bind('rate', $data['rate']); 
		$this->db->bind('overtime_date', $data['overtime_date']);          

		if ($this->db->execute()) {
			return true;
		} else {
			return false; 
		}
	}
	public function overtimeFindById($id)
	{
		$this->db->query("SELECT * FROM `overtime` WHERE id=:id"); 
		$this->db->bind('id', $id);
		$row = $this->db->single(); 
		return $row;   
	}

	public function update($data, $id)
	{
		$this->db->query("UPDATE overtime SET hours=:hours, rate=:rate, overtime_date=:overtime_date WHERE id=:id"); 
		
		$this->db->bind('id', $id);
		$this->db->bind('hours', $data['hours']);
		$this->db->bind('rate', $data['rate']);
		$this->db->bind('overtime_date', $data['overtime_date']); 

		if ($this->db->execute()) {
			return true;		
		} else {
			return false; 
		}
	}
}