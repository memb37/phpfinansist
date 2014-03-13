<form class=form method=POST action="<?=$data['action']?>">
    <input type=hidden name=id value="<?=$data['category']->id?>">
    <input type=text name=category_name value="<?=$data['category']->name?>">
    <button type=submit>Сохранить</button>
</form>
<? if (!empty($message)) : ?>
<p><?= $message ?>
    <? endif; ?>
