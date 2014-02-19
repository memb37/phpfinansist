<?php
class Model_Category extends Model
{
	public function get_categories($category_type_id)
	{
		global $db;
		$stmt = $db->prepare("SELECT category_id, category_name, category_type_id, category_type_name  
							FROM categories INNER JOIN category_type USING (category_type_id) 
							WHERE (user_id = :user_id OR user_id = 777) AND category_type_id = :ct_id ORDER BY category_name");
		$stmt->bindParam(':user_id', $_SESSION['user_id']);
		$stmt->bindParam(':ct_id', $category_type_id);
		$stmt->execute(); 
		while ($row = $stmt->fetch())
			{$data[] = $row;}
		return ($data);
	}
	
		public function add_category()
		{
			global $db;
			if ($_POST['category_name']=="")
			{
				$_SESSION['error'] = "Название категории не может быть пустым";
			}
			else
			{
				$stmt = $db->prepare("INSERT INTO categories (user_id, category_type_id, category_name) 
									VALUES (:user_id, :category_type_id, :category_name)");
				$data = array('user_id' => $_SESSION['user_id'], 'category_type_id' => $_POST['category_type_id'], 
							'category_name' => $_POST['category_name']);
				$stmt->execute($data);
			}
		}

		public function delete_category()
		{
			global $db;
			$stmt=$db->prepare("DELETE FROM categories WHERE category_id = :category_id AND user_id = :user_id");
			$stmt->bindParam(':category_id', $_POST['category_id']);
			$stmt->bindParam(':user_id', $_SESSION['user_id']);
			$stmt->execute();
		}

		public function edit_category()
		{
			global $db;
			if ($_POST[$_POST['category_id']]=="")
			{
				$_SESSION['error'] = "Название категории не может быть пустым";
			}
			else
			{
				$stmt=$db->prepare("UPDATE categories SET category_name = :category_name 
								WHERE category_id = :category_id AND user_id = :user_id");
				$stmt->bindParam(':category_name', $_POST[$_POST['category_id']]);			
				$stmt->bindParam(':category_id', $_POST['category_id']);
				$stmt->bindParam(':user_id', $_SESSION['user_id']);
				$stmt->execute();
			}
		}
}

?>
