<?php 
/**
 * Front Model 
 */
class FrontModel extends Database    
{
	private $db;
	
	public function __construct() 
	{
		$this->db = new Database;   
	}

	/**
	 * [findUserByEmail description]
	 * @param  [type] $email [description]
	 * @return [type] true   [description]
	 */
	public function findUserByEmail($email) 
	{
		$this->db->query('SELECT * FROM admins WHERE email = :email'); 
		$this->db->bind(':email', $email); 

		$row = $this->db->single(); 
		
		// check row 
		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false; 
		}
	}

	/**
	 * [login description]
	 * @param  [string] $email    [description]
	 * @param  [string] $password [description]
	 * @return [true/false]           [description]
	 */
	public function login($email, $password) 
	{
		$this->db->query('SELECT * FROM employees WHERE email = :email'); 
		$this->db->bind(':email', $email); 
		$row = $this->db->single(); 

		// check row   
		if ($this->db->rowCount() > 0) {
			
			$hashPasswordd = $row->password; 
			if (password_verify($password, $hashPasswordd)) {
				return $row;
			} else {
				return false;  
			} 
			
		} else {
			return false;   
		}

	}

	public function alreadyAttendance($employeeId, $created_at) 
	{
		$this->db->query("SELECT * FROM attendance WHERE employee_id = :employee_id AND created_at=:created_at AND in_time IS NOT NULL");  
		
		$this->db->bind(':employee_id', $employeeId);  
		$this->db->bind(':created_at', $created_at);    
		
		$row = $this->db->single();
		
		// check row   
		if ($this->db->rowCount() > 0) {
			//return true;
			return $row;  
		} else {
			return false; 
		}
		
	}

	public function employeeJobStartingTime($employeeId) 
	{ 
		$this->db->query("SELECT schedules.in_time FROM employees INNER JOIN schedules ON employees.schedule_id=schedules.id WHERE employees.employee_id=:employee_id");  
		
		$this->db->bind(':employee_id', $employeeId);  
		 
		$row = $this->db->single();

		return $row->in_time;  

	}

	public function employeeisPresentToday($employeeId, $created_at)  
	{ 
		$this->db->query("SELECT schedules.out_time FROM employees INNER JOIN schedules ON employees.schedule_id=schedules.id WHERE employees.employee_id=:employee_id AND created_at=:created_at");  
		
		$this->db->bind(':employee_id', $employeeId);  
		$this->db->bind(':employee_id', $created_at);   
		 
		$row = $this->db->single();

		return $row->in_time;    
	}

	public function attendance($employeeId, $date_now, $time_now, $earlyOfNotStatus)
	{
		$this->db->query("INSERT INTO attendance(employee_id, created_at, in_time, status) VALUES (:employee_id, :created_at, :in_time, :status)");
		
		$this->db->bind(':employee_id', $employeeId);
		$this->db->bind(':created_at', $date_now);
		$this->db->bind(':in_time', $time_now);
		$this->db->bind(':status', $earlyOfNotStatus);  

		if ($this->db->execute()) {
			return true;
		} else {
			return false; 
		}
		
	} 

	public function leave($attendanceId, $employeeId, $time_now)    
	{
		$this->db->query("UPDATE attendance SET out_time=:out_time WHERE employee_id=:employee_id AND id=:id");   
		
		$this->db->bind(':id', $attendanceId);  
		$this->db->bind(':employee_id', $employeeId); 
		$this->db->bind(':out_time', $time_now);    

		if ($this->db->execute()) {
			return true;
		} else {
			return false; 
		}
		
	}   

	// for hours calculation
	/**
	 * [attendanceById for hours calculation]
	 * @param  [type] $attendanceId [description]
	 * @return [type]               [description]
	 */
	public function attendanceById($attendanceId)
	{
		$this->db->query("SELECT * FROM attendance WHERE id=:id");     
		$this->db->bind(':id', $attendanceId);
		$row = $this->db->single();      
		return $row;    
	}

	public function employeeById($employeeId)
	{
		$this->db->query("SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.employee_id=:employee_id");       
		$this->db->bind(':employee_id', $employeeId);      
		$row = $this->db->single();    
		return $row; 
	}  

	public function employeeWorkingHours($num_hr, $id)   
	{
		$this->db->query("UPDATE attendance SET num_hr=:num_hr WHERE id=:id");         
		
		$this->db->bind(':num_hr', $num_hr); 
		$this->db->bind(':id', $id);  

		if( $this->db->execute() ) {  
			return true;
		} else {
			return false;     
		}
	}


} 