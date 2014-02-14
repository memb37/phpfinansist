<?include "header.php";?>

<form method="POST">

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

<input name="submit" type="submit" value="Войти">

</form>

<?
require_once "connect.php";

if(isset($_POST['submit']))
{
   	$login = $_POST['login'];
	try
	{
    	$stmt = $db->prepare("SELECT user_id, password FROM users WHERE login = :login LIMIT 1");
		$stmt->bindParam(':login', $login);
		$stmt->execute();
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	}

	catch (PDOException $e) 
			{
			echo $e->getMessage();
			}

    if($row['password'] === md5(md5($_POST['password'])))
    {
        $hash = md5(microtime().getmypid());
		try 
		{
	    	$stmt = $db->prepare("UPDATE users SET hash = :hash WHERE user_id = :user_id");
			$stmt->bindParam(':hash', $hash); 
			$stmt->bindParam(':user_id', $row['user_id']); 
			$stmt->execute();
		} 
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}

        
        setcookie("id", $row['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);

        header("Location: lk.php"); exit();
    }

    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
include "footer.php";
?>
