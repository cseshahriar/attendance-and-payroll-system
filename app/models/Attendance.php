<?php
/**
 * 
 */
class Attendance extends Database
{
	private $db;
	
	public function __construct()   
	{
		$this->db = new Database;  
	}

	public function attendances()
	{
		$this->db->query('SELECT * FROM attendance ORDER BY id DESC'); 
		$rows = $this->db->get(); 
		return $rows;  	   
	}
}