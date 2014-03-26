<form  method="POST"  class="form-inline" role="form">
	<div class="form-group">
		<label class="sr-only" for="InputEmail">Email</label>
		<input name="email" type="email" required class="form-control" id="InputEmail" placeholder="Email">
	</div>
	<div class="form-group">
		<label class="sr-only" for="InputPassword">Password</label>
		<input type="password" name="password" required class="form-control" id="InputPassword" placeholder="Password">
	</div>
	<button name="login_button" type="submit" class="btn btn-primary">Войти</button>
	<a href ="user/register">Регистрация</a>
    <a href = "user/password_recovery">Забыли пароль?</a>
	<? if(!empty($data['message'])) : ?>
		<p><?=$data['message']?>
	<? endif; ?>
</form>

