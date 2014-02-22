<a href="category/create" class="btn btn-default">
    <span class="glyphicon glyphicon-plus">Добавить категорию</span>
</a>
<table class=table >
<tr>
	<th>#</th>
	<th>Категория</th>
        <th><span class="glyphicon glyphicon-edit"></span></th>
        <th><span class="glyphicon glyphicon-remove"></span></th>
</tr>
<? foreach($data['categories'] as $cat): ?>
<tr>
	<td><?=$cat->id?></td>
	<td><?=$cat->name?></td>
        <th><a href="category/edit?id=<?=$cat->id?>" class="glyphicon glyphicon-edit"></a></th>
        <th><a href="category/delete?id=<?=$cat->id?>" class="confirm glyphicon glyphicon-remove"></a></th>
        
</tr>
<? endforeach; ?>
</table>
<script>
$(function(){
    $('a.confirm').click(function(){
        return confirm('Уверены?');    
    });  
});
</script>