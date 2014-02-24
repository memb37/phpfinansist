<table class="table table-hover">
	<thead>
		<tr>
			<th style="width: 8%">id</th>
			<th style="width: 12%">дата и время</th>
			<th style="width: 17%">категория</th>
			<th style="width: 10%">сумма</th>
			<th style="width: 15%">расход/доход</th>
			<th style="width: 30%">комментарий</th>
		</tr>
	</thead>

	<tbody> 
<?if (isset($data)):?>
<?foreach ($data as $d):?>
		<tr class="text-left">
			<td><?=$d['operation_id']?></td>
			<td><?=$d['date']?></td>
			<td><?=$d['category_name']?></td>
			<td><?=$d['summ']?></td>
			<td>
                <?if($d['summ']>0)
                    {echo "доход";}
                elseif ($d['summ']<0)
                    {echo "расход";}
                ?>
			</td>
			<td><?=$d['comment']?></td>
<?endforeach?>
<?endif?>
	</tbody>
</table>

<form class="form-inline" role="form" method="POST">
<fieldset>
	<div class="form-group">
		<input name="date_from" type="date" class="form-control" value=<?=$_POST['date_from']?>>
	</div>
	<div class="form-group">
		<input name="date_to" type="date" class="form-control" id="date to" value=<?=$_POST['date_to']?>>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-default form-control" id="show">показать</button>
	</div>
</fieldset>
</form>



