<form method="POST">

Логин <input name="login" type="text"><br>
Пароль <input name="password" type="password"><br>
Имя <input name="name" type="text"><br>
Email <input name="email" type="text"><br>

<input name="submit_reg" type="submit" value="Зарегистрироваться">

</form>
<? if(!empty($data['message'])) : ?>
	<p><?=$data['message']?>
<? endif; ?>
