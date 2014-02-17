<?php

class Model_User extends Model
{
	
    public function get_data()
    {	
		global $db;
		try
		{
			$stmt = $db->prepare("SELECT `user_name`, `login`, `e-mail` FROM users WHERE user_id= 13");
			$stmt->execute();
			$data = $stmt->fetch(); 
			return ($data);
		}

		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
	
	public function add_user()
	{
		global $db;
		$password = md5(md5(trim($_POST['password'])));
		try
		{
			$stmt = $db->prepare("INSERT INTO users (login, password, user_name) VALUES (:login, :password, :user_name)");
			$data = array('login' => $_POST['login'], 'password' => $password, 'user_name' => $_POST['name']);
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
}

