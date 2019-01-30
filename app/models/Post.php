<?php 
/**
 * 
 */
class Post extends Database
{
	private $db; 
	public function __construct() 
	{
		$this->db = new Database; 
	} 

	/**
	 * [getPost description]
	 * @return [type] [description] 
	 */
	public function getPost()  
	{
		$this->db->query("SELECT *, posts.id as postId, users.id as userId, posts.created_at as pcreated_at
						FROM posts
						INNER JOIN users
						ON posts.user_id = users.id
						ORDER BY posts.created_at DESC"   
					);
		$result = $this->db->resultSet();
		return $result;  
	} 

	/**
	 * [getPostById description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getPostById($id) 
	{
		$this->db->query("SELECT * FROM posts WHERE id=:id");
		$this->db->bind(':id', $id);
		$result = $this->db->single();   
		return $result;  
	} 

	public function store($data)
	{
		$this->db->query('UPDATE posts SET title=:title, body=:body WHERE id=:id');
		//Bidn 
		$this->db->bind(':id', $_SESSION['id']);
		$this->db->bind(':title', $data['title']); 
		$this->db->bind(':body', $data['body']);

		if ($this->db->execute()) {
			return true;
		} else {
			return false; 
		}
	}

	public function update($data)
	{
		$this->db->query('INSERT INTO posts(title, user_id,body) VALUES(:title, :user_id, :body)');
		//Bidn 
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':user_id', $_SESSION['user_id']);
		$this->db->bind(':body', $data['body']);

		if ($this->db->execute()) {
			return true;
		} else {
			return false; 
		}
	}

	public function destroy($id) 
	{
		$this->db->query('DELETE FROM posts WHERE id=:id');
		$this->db->bind(':id', $id);  

		if ($this->db->execute()) { 
			return true;
		} else {
			return false;     
		}

	}
}