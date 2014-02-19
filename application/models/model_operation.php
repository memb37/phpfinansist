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

	public function get_report()
	{
		global $db; 
		$date_from=date('Y-m-01');
		$date_to=date('Y-m-d');

		$stmt = $db->prepare("SELECT operation_id, date, category_name, summ, category_type_name, comment from operations 
		INNER JOIN categories USING(category_id) 
		INNER JOIN category_type USING(category_type_id) 
		WHERE (operations.user_id = :id) AND (date BETWEEN :date_from AND :date_to)
		ORDER BY date DESC, operation_id DESC ");
		$stmt->bindParam(':id', $_SESSION['user_id']); 
		if (isset($_POST['date_from']) and isset($_POST['date_to']))		
		{
			$stmt->bindParam(':date_from', $_POST['date_from']);
			$stmt->bindParam(':date_to', $_POST['date_to']);
		}	
		else
		{
			$stmt->bindParam(':date_from', $date_from);
			$stmt->bindParam(':date_to', $date_to);
		}

		$stmt->execute();

		while ($row = $stmt->fetch())
			{$data[] = $row;}
		if (isset ($data)) {return ($data);}

	}

}
