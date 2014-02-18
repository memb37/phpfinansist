<form method=POST>
<table align=center>
<tr>
	<td>
		<input type=submit name=edit1 value=расход></input>
	</td>
	<td>
		<input type=submit name=edit2 value=доход></input>
	</td>
	<td>
		<input type=hidden name=category_type_id value=<?=$data[0]['category_type_id']?>></input>
	</td>
</tr>
</table>
<table border=1 align=center>
<tr>
	<th colspan=3>
		<?=$data[0]['category_type_name']?>
	</th>

</tr>
<tr>
	<td>
	
	</td>
	<td colspan=2>
		Категория
	</td>

</tr>
<?foreach ($data as $d):?>
<tr>
	<td>
		<input type=radio name=category_id value="<?=$d['category_id']?>"></input>
	</td>
	<td>
		<input type=text name="<?=$d['category_id']?>" value="<?=$d['category_name']?>"></input>
	</td>
</tr>

<?endforeach?>

<tr>

	<td colspan=2>
		<input type=submit name=edit_category value=изменить></input>
		<input type=submit name=delete_category value=удалить></input>		
	</td>


</tr>
<tr>
	<td>
		<input type=submit name=add_category value=добавить></input>
	</td>
	<td>
		<input type=text name=category_name></input>
	</td>

</tr>
</table>
</form>
<a href="user">назад</a>
