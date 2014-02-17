<?php
class Model_Lk extends Model
{
    public function get_data()
    {
		try
			{	
			global $db; $data=null;
			$stmt = $db->prepare("SELECT date, operation_type_name, category_name, summ from operations 
			INNER JOIN categories USING(category_id) 
			INNER JOIN operation_type USING(operation_type_id) 
			WHERE user_id= :id ORDER BY date DESC, operation_id DESC LIMIT 0,10");
			$stmt->bindParam(':id', $_SESSION['id']); 
			$stmt->execute();
			while ($row = $stmt->fetch())
				{$data[] = $row;}
			return ($data);
	
		}

		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
