<?php
class Model_Operation extends Model
{
		
	public function get_data()
    {
		
		global $db;$op_type=1;
		if (isset($_POST['outgo'])) {$op_type=1;}
			else if (isset($_POST['income'])) {$op_type=2;}
				
		try
		{
			$stmt = $db->prepare("SELECT category_id, category_name FROM categories 
									WHERE category_type_id = :op_type AND (user_id = :user_id OR user_id = 777)
									ORDER BY category_name");
			$stmt->bindParam(':op_type', $op_type);
			$stmt->bindParam(':user_id', $_SESSION['user_id']);
			$stmt->execute(); 
			while ($row = $stmt->fetch())
				{$data[] = $row;}
			return ($data);
			
		
			
		}

		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	
	}

	
	public function add_data()
    {
		global $db;
	
		try
		{
		$stmt = $db->prepare("INSERT INTO operations (user_id, category_id, summ, date, comment) 
									VALUES (:id, :cat_id, :summ, :dt, :comm)");
		$data = array('id' => $_SESSION['user_id'], 'cat_id' => $_POST['cat_id'], 'summ' => $_POST['summ'], 'dt' => $_POST['date'], 'comm' => $_POST['comment']);
		$stmt->execute($data);
		}

		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	}
}
