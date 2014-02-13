<html>
<head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title></title>
</head>
<body>
<?php
require_once "connect.php";
require_once "check.php";
if (!$auth) { header("Location: login.php"); exit();}
$id=$_COOKIE['id'];
switch ($_REQUEST['op']){
	case 1: $op_type="Расход";break;
	case 2: $op_type="Доход";break;
}
 function select_option($op)
	{
	$query="SELECT `category_id`, `category_name` FROM `categories` WHERE `operation_type_id`=$op";
	$res = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_array($res))
		{
		$id=$row['category_id'];
		$a=$row['category_name'];
		echo "<option value=$id>$a</option>";
		}
	}
	
if (isset($_POST['submit']))
	{
	
	$summ=$_POST['summ'];
	if ($_REQUEST['op']==1 && $summ>0) {$summ*=-1;}
	$dt=$_POST['date'];
	$cat_id=$_POST['cat_id'];
	echo $cat_id;
	$query="INSERT INTO `operations` (`user_id`, `category_id`, `summ`, `date`) VALUES ('$id', '$cat_id', '$summ', '$dt');";
	mysql_query($query) or die(mysql_error());
	$query="UPDATE `users` SET balance = balance+$summ WHERE `user_id`=$id";
	mysql_query($query) or die(mysql_error());
	}
	
?>
<form method="POST">
<table border = "1" align="center">
<tr height="30">
	<td colspan="2">
		<p align="center">
		<? echo $op_type;?>    
		
		</p>
	</td>
</tr>
<tr>
	<td>
		Категория
	</td>
	<td>
		<select name="cat_id">
			<? select_option($_REQUEST['op']); ?>
		</select>		
	</td>
</tr>
<tr>
	<td>
		Сумма
	</td>
	<td>
		<input type="text" name="summ" size="10" value="0"></input>
	</td>
</tr>
<tr>
	<td>
		Дата
	</td>
	<td>
		<input name="date" size = "10" value=<? echo date('Y-m-d');?> type="text"/>
	</td>
</tr>
<tr>
	<td>
		Комментарий
	</td>
	<td>
		<textarea rows="3" cols="20" name="comment"></textarea>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" value="добавить" name="submit">
	</td>
<tr>
</table>

</form>
<a href="lk.php">назад
<?

?>

</body></html>