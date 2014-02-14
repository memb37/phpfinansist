<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?
require_once "connect.php";

if(isset($_POST['submit']))
{
    $err = array();
    # проверям логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
  
	try
	{
		$stmt = $db->prepare("SELECT COUNT(user_id) as count FROM users WHERE login= :login");
		$stmt->bindParam(':login', $_POST['login']); 
		$stmt->execute();
		$row = $stmt->fetch();
		$row_count = $row['count'];
	}

	catch (PDOException $e) 
	{
		echo $e->getMessage();
	}

	
    if($row_count > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    if(count($err) == 0)
    {
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

        header("Location: login.php"); exit();
    }

    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
       
		foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}

?>


<form method="POST">

Логин <input name="login" type="text"><br>
Пароль <input name="password" type="password"><br>
Имя <input name="name" type="text"><br>


<input name="submit" type="submit" value="Зарегистрироваться">

</form>
</body>
</html>
