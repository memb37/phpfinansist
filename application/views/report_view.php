<table border=1 cellpadding=3>
<tr>
	<td>
		id
	</td>
	<td>
		дата и время
	</td>
	<td>
		категория
	</td>
	<td>
		сумма
	</td>
	<td>
		расход/доход
	</td>
	<td>
		комментарий
	</td>
<?if (isset($data)):?>
<?foreach ($data as $d):?>
<tr>
	<td>
		<?=$d['operation_id']?>
	</td>
	<td>
		<?=$d['date']?>
	</td>
	<td>
		<?=$d['category_name']?>
	</td>
	<td>
		<?=$d['summ']?>
	</td>
	<td>
		<?=$d['category_type_name']?>
	</td>
	<td>
		<?=$d['comment']?>
	</td>
<?endforeach?>
<?endif?>
</table>
<form method="POST">
С <input name="date_from" size = "10" value=<?=$_POST['date_from']?> type="text">
по <input name="date_to" size = "10" value=<?=$_POST['date_to']?> type="text">
<input type=submit value=показать>
</form>
<a href="../user">назад</a>
