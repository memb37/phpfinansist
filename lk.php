<html>
<head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title></title>
</head>
<body>
<?php
require_once "check.php";
if (!$auth) { header("Location: login.php"); exit();}
$table="users";
$id=$_COOKIE['id'];
$query="SELECT `user_name`, `balance` FROM $table WHERE `user_id`=$id ";
$res = mysql_query($query) or die(mysql_error());
$row=mysql_fetch_array($res);
echo "<p align=\"center\">привет ".$row['user_name']."</p>";
echo "твой баланс = ".$row['balance']."<br>";




$query="SELECT date, operation_type_name, category_name, summ from operations 
	LEFT JOIN categories USING(category_id) 
	LEFT JOIN operation_type USING(operation_type_id) 
	WHERE user_id='$id' ORDER BY date DESC, operation_id DESC LIMIT 0,10"; 
$res = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($res))
		{
		echo $row['date']." ".$row['operation_type_name']."  ".$row['category_name']."  ".$row['summ']."<br>";
		}
?>

<table border="1">

</table>

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
<? include "logout.php" ?>


</body>
</html>