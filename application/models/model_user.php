<?php

class Model_User extends Model
{
	
    public function get_data()
    {	
		global $db;
		try
		{
			$stmt = $db->prepare("SELECT `user_name`, `login`, `email` FROM users WHERE user_id= :id");
			$stmt->bindParam(':id', $_SESSION['user_id']);			
			$stmt->execute();
			$data = $stmt->fetch(); 
			return ($data);
		}

		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
	
	public function get_user()
	{
		global $db;
		try
		{
    		$stmt = $db->prepare("SELECT user_id, user_name, password FROM users WHERE login = :login LIMIT 1");
			$stmt->bindParam(':login', $_POST['login']);
			$stmt->execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		}

		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
		return $row;
	}
	public function add_user()
	{
		global $db;
		$password = md5(md5(trim($_POST['password'])));
		try
		{
			$stmt = $db->prepare("INSERT INTO users (login, password, user_name, email) VALUES (:login, :password, :user_name, :email)");
			$data = array('login' => $_POST['login'], 'password' => $password, 
							'user_name' => $_POST['name'], 'email' => $_POST['email']);
			$stmt->execute($data);			
		} 
       
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	}

	public function login_free()
	{
		global $db;
		try
	{
		$stmt = $db->prepare("SELECT COUNT(user_id) as count FROM users WHERE login= :login");
		$stmt->bindParam(':login', $_POST['login']); 
		$stmt->execute();
		$row = $stmt->fetch();
		return $row['count'];
	}

	catch (PDOException $e) 
	{
		echo $e->getMessage();
	}
	}

	public function get_operations()
	{
		try
		{	
			global $db; $data=null;
			$stmt = $db->prepare("SELECT date, category_name, summ from operations
			LEFT JOIN categories USING(category_id)
			WHERE operations.user_id= :id ORDER BY date DESC, operation_id DESC LIMIT 0,10");
			$stmt->bindParam(':id', $_SESSION['user_id']); 
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

