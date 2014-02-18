<form action = "operation" method = "POST" align = "center">
	<input type = "submit" name = "outgo" value = "Добавить расход"> 
	<input type = "submit" name = "income" value = "Добавить доход"> 
</form>
<? 
if ($data)
{
	foreach ($data as $d)
	{
		echo $d['date']." ".$d['category_type_name']."  ".$d['category_name']."  ".$d['summ']."<br>";
	}
}

?>
<a href="category">редактировать категории</a>

