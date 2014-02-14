
<?php
include "header.php";
require_once "check.php";
if (!$auth) { header("Location: login.php"); exit();}

$id=$_COOKIE['id'];

switch ($_REQUEST['op']){
	case 1: $op_type="Расход";break;
	case 2: $op_type="Доход";break;
}

function select_option()
{
	global $db;
	
	try
	{
		$stmt = $db->prepare("SELECT category_id, category_name FROM categories WHERE operation_type_id = :op");
		$stmt->bindParam(':op', $_REQUEST['op']);
		$stmt->execute(); 

		while ($row = $stmt->fetch())
		{
			echo "<option value={$row['category_id']}>{$row['category_name']}</option>";
		}
	}

	catch (PDOException $e) 
	{
		echo $e->getMessage();
	}
}


if (isset($_POST['submit']))
{
	$summ=$_POST['summ'];
	if ($_REQUEST['op']==1 && $summ>0) {$summ*=-1;}
		
	try
	{
		$stmt = $db->prepare("INSERT INTO operations (user_id, category_id, summ, date) VALUES (:id, :cat_id, :summ, :dt)");
		$data = array('id' => $id, 'cat_id' => $_POST['cat_id'], 'summ' => $summ, 'dt' => $_POST['date']);
		$stmt->execute($data);
	}

	catch (PDOException $e) 
	{
		echo $e->getMessage();
	}
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
			<? 	select_option(); ?>
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


<?include "footer.php";?>
