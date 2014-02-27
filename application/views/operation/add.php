<form method="POST">

<table border = "1" align="center">
<tr height="30">
	<td colspan="2">
        <select name="op_type">
            <option value="minus">Расход</option>
            <option value="plus">Доход</option>
        </select>
	</td>
</tr>
<tr>
	<td>
		Категория
	</td>
	<td>
		<select name="cat_id">
            <option value>без категории</option>>
			<?foreach ($data['categories'] as $cat):?>
			    <option value=<?=$cat->id?>><?=$cat->name?></option>
             <?endforeach?>
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
		<input type="submit" value="добавить" name="add_op">
	</td>
<tr>
</table>

</form>