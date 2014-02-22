<?php
class Model_Category extends Model
{
	public $id;
	public $name;
	public $user_id;
	
	public function __construct($id = null) {
		global $db;
		if($id) {
		$stmt = $db->prepare('select category_id, category_name, user_id
			from categories
			where category_id=:id');
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$row = $stmt->fetch();

			if($row) {
				$this->id = $row['category_id'];
				$this->name = $row['category_name'];
				$this->user_id = $row['user_id'];
			}
		}
	}
	
	
	public static function find_all($user_id) {
		global $db;
		$stmt = $db->prepare('select category_id, category_name
			from categories
			where user_id=:user_id
			order by 2 asc');
		$stmt->bindParam(':user_id', $user_id);
		$stmt->execute();
		$result = array();
		while($row = $stmt->fetch()) {
			$c = new Model_Category();
			$c->id = $row['category_id'];
			$c->name = $row['category_name'];
			$result[] = $c;	
		}
		return $result;
	}
	
	public function save() {
		global $db;
		if($this->id) {
			$stmt=$db->prepare("UPDATE categories
				SET category_name = :category_name
				WHERE category_id = :category_id AND user_id = :user_id");
			$stmt->bindParam(':category_name', $this->name);			
			$stmt->bindParam(':category_id', $this->id);
			$stmt->bindParam(':user_id', $this->user_id);		
		} else {
			$stmt = $db->prepare("INSERT INTO categories (user_id, category_name) 
				VALUES (:user_id, :category_name)");
			$stmt->bindParam(':category_name', $this->name);			
			$stmt->bindParam(':user_id', $this->user_id);
		}
		$stmt->execute();
	}
	
	public function delete() {
		global $db;
		$stmt = $db->prepare("DELETE FROM categories
			WHERE category_id = :category_id AND user_id = :user_id");
		$stmt->bindParam(':category_id', $this->id);
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->execute();
	}
}
