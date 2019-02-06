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

	public function overtimes()
	{
		$this->db->query("SELECT overtime.*, employees.employee_id, employees.firstname, employees.lastname FROM overtime LEFT JOIN employees on overtime.employee_id=employees.id;"); 
		$rows = $this->db->get(); 
		return $rows;  
	}
}