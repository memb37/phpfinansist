<?
include "header.php";
require_once "check.php";
if (!$auth) { header("Location: login.php"); exit();}

try
{
	$stmt = $db->prepare("SELECT `user_name`, `login`, `e-mail` FROM users WHERE user_id= :id ");
	$stmt->bindParam(':id', $_COOKIE['id']); 
	$stmt->execute();
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
}

catch(PDOException $e)
{
	echo $e->getMessage();
}
?>

<table align = "center" border = "1">
<tr>
	<td>
		Имя
	</td>
	<td>
		<?=$row['user_name']?>
	</td>
</tr>
<tr>
	<td>
		Логин
	</td>
	<td>
		<?=$row['login']?>
	</td>
</tr>
<tr>
	<td>
		e-mail
	</td>
	<td>
		<?=$row['e-mail']?>
	</td>
</tr>
</table>
<a href="lk.php">назад
<?include "footer.php";?>
