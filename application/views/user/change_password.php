<form  method="POST"  class="form-inline" role="form">
    <div class="form-group">
        <label class="sr-only" for="InputPassword">Password</label>
        <input type="password" name="password" required class="form-control" id="InputPassword" placeholder="Password">
    </div>
    <button name="change_pass" type="submit" class="btn btn-primary">Сменить пароль</button>
    <? if (!empty($data)) : ?>
    <? foreach($data as $msg) : ?>
    <p><?= $msg ?>
        <? endforeach; ?>
        <? endif; ?>
</form>
