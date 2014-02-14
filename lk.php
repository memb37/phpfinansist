<?php
include "header.php";
require_once "check.php";

if (!$auth) { header("Location: login.php"); exit();}
$id=$_COOKIE['id'];
try
{
	$stmt = $db->prepare("SELECT user_name, balance FROM users WHERE user_id= :id ");
	$stmt->bindParam(':id', $id); 
	$stmt->execute();
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
}

catch(PDOException $e)
{
	echo $e->getMessage();
}

echo "<p align=\"center\">привет ".$row['user_name']."</p>";
echo "твой баланс = ".$row['balance']."<br>";

try
{
	$stmt = $db->prepare("SELECT date, operation_type_name, category_name, summ from operations 
		LEFT JOIN categories USING(category_id) 
		LEFT JOIN operation_type USING(operation_type_id) 
		WHERE user_id= :id ORDER BY date DESC, operation_id DESC LIMIT 0,10");
	$stmt->bindParam(':id', $id); 
	$stmt->execute();
	while ($row = $stmt->fetch())
	{
		echo $row['date']." ".$row['operation_type_name']."  ".$row['category_name']."  ".$row['summ']."<br>";
	}
}

catch(PDOException $e)
{
	echo $e->getMessage();
}

?>

<table align="center" border="1">
<tr>
	<td>
		
	</td>
	<td>
		
	</td>
</tr>
<tr>
	<td>
		<a href="operation_add.php?op=1">добавить расход</a>
	</td>
	<td>
		<a href="operation_add.php?op=2">добавить доход</a>
	</td>
</tr>

</table>
<? include "logout.php";
include "footer.php"; ?>
