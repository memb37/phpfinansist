текущий баланс = <?=$balance?><br><br>
<a href="operation/create?optype=minus" class="btn btn-default">
    Добавить расход
</a>
<a href="operation/create?optype=plus" class="btn btn-default">
    Добавить доход
</a>
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
    <? foreach ($data['operations'] as $op): ?>
    <tr class="text-left">
        <td><?=$op->operation_id?></td>
        <td><?=$op->date?></td>
        <td><?=($op->category_name ? : "без категории")?></td>
        <td><?=$op->summ?></td>
        <td><?=($op->summ > 0) ? "доход" : "расход"?></td>
        <td><?=$op->comment?></td>
        <? endforeach; ?>
    </tbody>
</table>

<form class="form-inline" role="form" method="GET">
    <fieldset>
        <div class="form-group">
            <input name="date_from" type="date" class="form-control" value=<?=$data['date_from']?>>
        </div>
        <div class="form-group">
            <input name="date_to" type="date" class="form-control" id="date to" value=<?=$data['date_to']?>>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default form-control" id="show">показать</button>
        </div>
    </fieldset>
</form>



