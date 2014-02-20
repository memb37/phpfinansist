    <form method = "POST">
        <input name=login placeholder=Login>
        <input type=password name=password placeholder=Password>
        <button type=submit>Login</button>
		<a href =" <?=MAINPAGE?>/user/register">Регистрация</a>
		<? if(!empty($data['message'])) : ?>
			<p><?=$data['message']?>
		<? endif; ?>
    </form>
