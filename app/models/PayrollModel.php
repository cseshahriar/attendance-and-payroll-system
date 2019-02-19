<?php  
/**
 * 
 */
class PayrollModel extends Database 
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
	public function deductions() 
	{
		$this->db->query("SELECT * FROM deductions");               
		$rows = $this->db->get();        
		return $rows;    
	} 
	public function deductionsTotal() 
	{
		$this->db->query("SELECT SUM(amount) as total_amount FROM deductions");                
		$rows = $this->db->single();         
		return $rows;    
	} 

	public function employeeTotalAttendances($from, $to) 
	{
		$this->db->query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC(num_hr))) as total_hours, positions.rate, employees.employee_id, employees.firstname, employees.lastname FROM attendance 
			LEFT JOIN employees ON attendance.employee_id = employees.employee_id
			LEFT JOIN positions ON employees.position_id = positions.id
			WHERE attendance.created_at BETWEEN '$from' AND '$to'
			GROUP BY employees.id");    
	   		$rows = $this->db->get();           
	   
		   if ($this->db->rowCount() > 0) {            
		   		return $rows;
		   } else {
		   		return false;
		   }
	    
	}

	public function overtimes($from, $to) 
	{
		$this->db->query("SELECT overtime.employee_id, overtime.rate, SEC_TO_TIME( SUM( TIME_TO_SEC(hours))) as total_overtime FROM employees LEFT JOIN overtime ON employees.employee_id = overtime.employee_id WHERE overtime.overtime_date BETWEEN '$from' AND '$to' GROUP BY overtime.id");          

	   		$rows = $this->db->get();           
	   
		   if ($this->db->rowCount() > 0) {             
		   		return $rows;
		   } else {
		   		return false;
		   }
	    
	}



	public function cash($id, $from, $to)    
	{
		$this->db->query("SELECT cashadvances.*, SUM(amount) AS cashamount FROM cashadvances WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'");                    
		$rows = $this->db->single();         
		return $rows;    
	} 

}