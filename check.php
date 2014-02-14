<?
require_once "connect.php";
$auth=0;

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{   
	try
	{
    	$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?  LIMIT 1");
		$stmt->bindValue(1, intval($_COOKIE['id']), PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
   	}

	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

    if(($row['hash'] !== $_COOKIE['hash']) or ($row['user_id'] !== $_COOKIE['id']))
		{
			setcookie("id", "", time() - 3600*24*30*12, "/");
   	     	setcookie("hash", "", time() - 3600*24*30*12, "/");
		}

    else
    {
   		$auth=1;
    }
}

else
{
	print "Включите куки";
}
