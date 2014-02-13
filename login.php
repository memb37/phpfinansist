<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form method="POST">

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

<input name="submit" type="submit" value="Войти">

</form>

<?
require_once "connect.php";


if(isset($_POST['submit']))

{

   	$login=$_POST['login'];
    $query = mysql_query("SELECT `user_id`, `password` FROM `users` WHERE `login`='$login' LIMIT 1");

    $data = mysql_fetch_assoc($query);


    if($data['password'] === md5(md5($_POST['password'])))

    {


        $hash = md5(microtime().getmypid());

    
        mysql_query("UPDATE users SET hash='".$hash."' WHERE user_id='".$data['user_id']."'");

        
        setcookie("id", $data['user_id'], time()+60*60*24*30);

        setcookie("hash", $hash, time()+60*60*24*30);

        header("Location: lk.php"); exit();

    }

    else

    {

        print "Вы ввели неправильный логин/пароль";

    }

}

?>


</body>
</html>