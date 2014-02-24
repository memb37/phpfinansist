<?php
class Model_Operation extends Model
{
	public function get_data() {
		
		global $db;
		$op_type = isset($_POST['outgo']) ? 1 : 2;
		$data = array();
		$data['optype'] = $op_type;
		try
		{
			$stmt = $db->prepare("SELECT category_id, category_name
				FROM categories 
				WHERE user_id = :user_id 
				ORDER BY category_name");
			$stmt->bindParam(':user_id', $_SESSION['user_id']);
			$stmt->execute(); 			
		}
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
		while ($row = $stmt->fetch()) {
			$data['categories'][] = $row;
		}
		return $data;	
	}

	
	public function add_data() {
		global $db;
		if($_POST['optype'] == 1) {
			$_POST['summ'] = -1 * $_POST['summ'];
		}
        $_POST['cat_id'] = isset($_POST['cat_id']) ? $_POST['cat_id'] :NULL;
		try
		{
			$stmt = $db->prepare("INSERT INTO operations
				(user_id, category_id, summ, date, comment) 
				VALUES (:id, :cat_id, :summ, :dt, :comm)");
		$data = array(
			'id' => $_SESSION['user_id'],
			'cat_id' => $_POST['cat_id'],
			'summ' => $_POST['summ'],
			'dt' => $_POST['date'],
			'comm' => $_POST['comment']);
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
		if (!isset($_POST['date_from']))
			{$_POST['date_from']=date('Y-m-01');}
		if (!isset($_POST['date_to']))
			{$_POST['date_to']=date('Y-m-d');}

		$stmt = $db->prepare("SELECT operation_id, date, category_name,
			summ,  comment
			from operations 
			LEFT JOIN categories USING(category_id)
			
			WHERE operations.user_id = :id
				AND date BETWEEN :date_from AND :date_to
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
