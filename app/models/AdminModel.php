<?php 
/**
 * User Model 
 */
class AdminModel extends Database   
{
	private $db;
	
	public function __construct() 
	{
		$this->db = new Database;   
	}

	public function users()
	{
		$this->db->query("SELECT id, name, email, photo, type, created_at FROM admins");
		$rows = $this->db->get();
		return $rows;  
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


	public function register($data)
	{
		$this->db->query('INSERT INTO admins(name,email,password) VALUES(:name,:email,:password)');
		// Bind values
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);
		// Execute
		if($this->db->execute()) {
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
		$this->db->query('SELECT * FROM admins WHERE email = :email'); 
		$this->db->bind(':email', $email); 
		$row = $this->db->single();

		$hashPasswordd = $row->password; 
		if (password_verify($password, $hashPasswordd)) {
			return $row;
		} else {
			return false;  
		}
	}

	/**
	 * [getUserById description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */ 
	public function getUserById($id) 
	{
		$this->db->query('SELECT * FROM admins WHERE id = :id');    
		$this->db->bind(':id', $id);
		$row = $this->db->single(); 
		return $row;  	  
	}

	public function findUserByEmailExceptThisId($email, $id)    
	{
		$this->db->query("SELECT email FROM admins WHERE email = :email AND id !=:id");       
		$this->db->bind(':email', $email); 
		$this->db->bind(':id', $id);  

		$row = $this->db->single(); 
		
		// check row 
		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false; 
		}
	}

	public function isSuperAdmin($id)     
	{
		$this->db->query("SELECT * FROM admins WHERE type=:type AND id =:id");        
		$this->db->bind(':type', 'superadmin');       
		$this->db->bind(':id', $id);     

		$row = $this->db->single(); 
		
		// check row 
		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false; 
		}
	}

	public function update($data, $id) 
	{

		$this->db->query("UPDATE admins SET name=:name, email=:email, type=:type, updated_at=:updated_at WHERE id=:id");       

		$this->db->bind(':id', $id);  
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':type', $data['type']);
		$this->db->bind(':updated_at', $data['updated_at']);      

		if ($this->db->execute()) {
			return true;
		} else {
			return false;  
		}
	}

	public function photo($data, $id)  
	{
		$this->db->query("UPDATE admins SET photo=:photo WHERE id=:id");        

		$this->db->bind(':id', $id);  
		$this->db->bind(':photo', $data['photo']);      
     
		if ($this->db->execute()) { 
			return true;
		} else {
			return false;  
		}
	}

	public function changePhoto($photo, $id)      
	{
		$this->db->query("UPDATE admins SET photo=:photo WHERE id=:id");        

		$this->db->bind(':id', $id);  
		$this->db->bind(':photo', $data['image']);          
     
		if ($this->db->execute()) { 
			return true;
		} else {
			return false;  
		}
	}

	public function currentUserById($id)
	{
		$this->db->query("SELECT * FROM admins WHERE id=:id"); 
		$this->db->bind(':id', $id);
		$row = $this->db->single();
		return $row; 
	} 

	public function currentUserUpdate($data, $id)
	{
		$this->db->query("UPDATE admins SET name=:name, email=:email WHERE id=:id");

		$this->db->bind(':id', $id);
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);

		if ($this->db->execute()) {   
			return true;
		} else {
			return false;  
		}
	} 

	public function currentUserPasswordUpdate($data, $id)
	{
		$this->db->query("UPDATE admins SET password=:password WHERE id=:id"); 

		$this->db->bind(':id', $id);
		$this->db->bind(':password', $data['password']);  

		if ($this->db->execute()) {   
			return true;
		} else {
			return false;  
		}
	} 

}